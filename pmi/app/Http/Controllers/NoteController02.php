<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    // sorgen dass auch wirklich nur nach den gewünschten spalten gefiltert werden kann
    private const SORTABLE_FIELDS = ['id', 'created_at', 'updated_at'];

    // ai hilfe
    private function getNotes(?string $filter = null, string $sortBy = 'id', string $sortOrder = 'desc')
    {
        if (!in_array($filter, ['todo', 'done'])) {
        $filter = null;
        }

        if (!in_array($sortBy, self::SORTABLE_FIELDS)) {
            $sortBy = 'id';
        }

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        return Note::when($filter, function ($query) use ($filter) {
                $query->where('status', $filter);
            })
            ->orderBy($sortBy, $sortOrder)
            ->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sortBy = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');

        return view('pages.note', [
            'notes' => $this->getNotes($request->filter, $sortBy, $sortOrder),
            'editingId' => null,
            'filter' => $request->filter,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notes = Note::all();
        return view('pages.note', [
            'notes' => $this->getNotes(),
            'editingId' => null,
            'newNote' => true,
            'filter'    => null,
            'sortBy'    => 'id',
            'sortOrder' => 'desc',
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
    public function edit(Note $note)
    {
        //dd($note->id);
        $notes = Note::all();

        return view('pages.note', [
            'notes' => $this->getNotes(),
            'editingId' => $note->id,
            'filter'    => null,
            'sortBy'    => 'id',
            'sortOrder' => 'desc',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {

    //dd($request);
        $validated = $request->validate([
            'title' => ['required', 'min:2', 'max:60', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'description' => ['required', 'min:5', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'status' => ['sometimes','in:todo,done'],
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
