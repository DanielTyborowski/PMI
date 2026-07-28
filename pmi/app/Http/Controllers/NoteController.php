<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();

        //dd($notes);
        return view('pages.note', [
            'notes' => $notes,
            'editingId' => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notes = Note::all();
        return view('pages.note', [
            'notes' => $notes,
            'editingId' => null,
            'newNote' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'min:2', 'max:120'],
            'description' => ['required', 'min:5'],
        ]);

        Note::create($validated);
        return redirect()->route('resource.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //dd($note->id);
        $notes = Note::all();

        return view('pages.note', [
            'notes' => $notes,
            'editingId' => $note->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {

        $validated = $request->validate([
            'title'       => ['required', 'min:2', 'max:120'],
            'description' => ['required', 'min:5'],
        ]);

        $note->update($validated);
        return redirect()->route('resource.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('resource.index');
    }
}
