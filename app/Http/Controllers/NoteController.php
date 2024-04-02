<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
//use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = $request->user();
        $notes = Note::where(
            'user_id',
            $user->id

        )->paginate();
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

        return Redirect::route('notes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note, $id)
    {
        //
        $note = Note::findOrFail($id);
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
    public function update(UpdateNoteRequest $request, Note $note, $id)
    {
        //
        $note = Note::findOrFail($id);
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();
        return Redirect::route('notes.show', ['id' => $id])->with('message', 'Note updated!')->with('status', 'note-updated');
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
