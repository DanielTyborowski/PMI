<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //$notes = Note::all();
        /*
        $notes = Note::when($request->filter, function($query) use ($request){
            $query->where('status', $request->filter);
            })
            ->orderBy($request->sort, $request->order)
            ->get();
*/
        $notes = Note::when($request->filter, function($query) use ($request) {
                    $query->where('status', $request->filter);
                })
                ->orderBy($request->get('sort', 'id'), $request->get('order', 'desc'))
                ->get();


        //dd($request->filter, $request->sort, $request->order, $notes);


        //dd($notes);
        return view('pages.note', [
            'notes' => $notes,
            'editingId' => null,
            'filter' => $request->filter,
            'sortBy' => $request->sort,
            'sortOrder' => $request->order,
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
            'notes' => $notes,
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
