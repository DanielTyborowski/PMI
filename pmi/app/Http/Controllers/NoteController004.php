<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    private function getFilteredNotes(Request $request)
    {
        $sortBy = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');

        $notes = Note::filterByStatus($request->filter)
                    ->sortable($sortBy, $sortOrder)
                    ->get();

        return view('pages.note', [
            'notes' => $notes,
            'filter' => $request->filter,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,

        ]);

    }

    public function index(Request $request)
    {
        $sortBy = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');

        $notes = Note::filterByStatus($request->filter)
                    ->sortable($sortBy, $sortOrder)
                    ->get();

        return view('pages.note', [
            'notes' => $notes,
            'editingId' => null,
            'filter' => $request->filter,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


        $sortBy    = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');

        $notes = Note::filterByStatus($request->filter)
                    ->sortable($sortBy, $sortOrder)
                    ->get();

        return view('pages.note', [
            'notes' => $notes,
            'editingId' => null,
            'newNote' => true,
            'filter'    => null,
            'sortBy'    => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'min:2', 'max:60', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'description' => ['required', 'min:5', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
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
    public function edit(Note $note, Request $request)
    {

        //$notes = Note::all();

        $sortBy    = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');

        $notes = Note::filterByStatus($request->filter)
                    ->sortable($sortBy, $sortOrder)
                    ->get();


        return view('pages.note', [
            'notes' => $notes,
            'editingId' => $note->id,
            'filter'    => null,
            'sortBy'    => $sortBy,
            'sortOrder' => $sortOrder,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {

    //dd($request);

        $sortBy    = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');

        $validated = $request->validate([
            'title' => ['required', 'min:2', 'max:60', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'description' => ['required', 'min:5', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'status' => ['sometimes','in:todo,done'],
        ]);

        $note->update($validated);
        return redirect()->route('resource.index', [
            'filter'    => null,
            'sortBy'    => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
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
