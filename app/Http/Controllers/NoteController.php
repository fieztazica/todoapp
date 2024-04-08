<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::where(
            'user_id',
            auth()->user()->id
        )->orderByDesc('created_at')->orderByDesc('updated_at')->paginate();
        foreach ($notes->items() as $note) {
            $note->summary = Str::limit($note->content, 256, '...');
        }
        return view("notes.home", ["notes" => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("notes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        //
        $note = new Note;
        $user = $request->user();

        $note->title = $request->title;
        $note->content = $request->content;
        $note->user_id = $user->id;

        $note->save();

        return Redirect::route('notes.show', ['note' => $note, 'id' => $note->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note, $id)
    {
        //
        $note = Note::findOrFail($id);
        // $note->done_tasks = $note->tasks()->where('done', true);

        foreach ($note->tasks as $task) {
            $task->diffDays = Carbon::parse($task->due_date)->diffInDays(now());
            $task->diffDays *= Carbon::parse($task->due_date)->isAfter(now()) ? 1 : -1;

            if ($task->diffDays <= 0) {
                $task->due_status = -1;
            } else if ($task->diffDays <= 1) {
                $task->due_status = 1;
            } else {
                $task->due_status = 0;
            }

            if ($task->done) {
                $task->due_status = 2;
            }

            $task->fromNow = $task->done ? 'Done' : Carbon::parse($task->due_date)->fromNow();
        }

        return view("notes.show", ["note" => $note, "id" => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, $id)
    {
        //
        $note = Note::findOrFail($id);
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();
        return Redirect::route('notes.show', ['id' => $id])->with('message', 'Note #' . $id . ' updated!')->with('status', 'note-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note, $id)
    {
        //
        // dd($note);
        $note = Note::findOrFail($id);
        $note->deleteOrFail();
        return Redirect::route('notes')->with('message', 'Note #' . $id . ' deleted.');
    }
}
