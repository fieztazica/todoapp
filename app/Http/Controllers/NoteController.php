<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;

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

        )->get();
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
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
