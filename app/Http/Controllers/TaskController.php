<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::with([
            'note' => function ($query) {
                $query->where('user_id', auth()->user()->id)->with('user');
            }
        ])->whereHas('note', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->orderByDesc('created_at')->orderByDesc('updated_at')->paginate(16);
        // foreach ($notes->items() as $note) {
        //     $note->summary = Str::limit($note->content, 256, '...');
        // }
        return view("tasks.home", ["tasks" => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        if (!$request->has('note_id')) {
            return Redirect::route("notes");
        }
        return view("tasks.create", ['note_id' => $request->input('note_id')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        //
        $task = new Task;

        $task->name = $request->name;
        $task->description = $request->description;
        $task->note_id = $request->note_id;
        if ($request->done) {
            $task->done = true;
        }
        $task->due_date = $request->due_date;

        $task->save();

        return Redirect::route("tasks.edit", ['task' => $task, 'id' => $task->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', ['task' => $task, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task, $id)
    {
        $task = Task::findOrFail($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->done = $request->done != null;
        $task->due_date = $request->due_date;
        $task->save();
        return Redirect::route("tasks.edit", ['id' => $id])->with('message', 'Task #' . $id . ' updated!')->with('status', 'task-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task, $id)
    {
        $in_edit = boolval($request->input('in_edit'));
        $task = Task::findOrFail($id);
        $task->deleteOrFail();
        $redirect = $in_edit == true ?
            Redirect::route('notes.show', ['id' => $task->note_id]) : Redirect::route('tasks', ['id' => $task->note_id]);
        return $redirect->with('message', 'Task #' . $id . ' deleted.');
    }
}
