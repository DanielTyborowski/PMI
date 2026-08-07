<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;



/**
 * -----------------------------------------------------------------------------
 * NoteController
 * -----------------------------------------------------------------------------
 *
 * Handles all CRUD operations for notes.
 *
 * This resource controller provides functionality for:
 *
 * - Displaying all notes
 * - Creating new notes
 * - Editing existing notes
 * - Updating notes
 * - Deleting notes
 *
 * Additionally, this controller supports filtering and sorting of notes.
 */


class NoteController extends Controller
{

    /**
     * Retrieve filtered and sorted notes.
     *
     * Supported request parameters:
     *
     * - filter:
     *   Filters notes by their status (e.g. todo, done)
     *
     * - sort:
     *   Defines the column used for sorting (default: id)
     *
     * - order:
     *   Defines the sorting direction (asc or desc)
     *
     * @param Request $request Current HTTP request
     *
     * @return array Contains notes and current filter/sorting settings
     */

    private function getFilteredNotes(Request $request)
    {
        $sortBy = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');

        $notes = Note::filterByStatus($request->filter)
                    ->sortable($sortBy, $sortOrder)
                    ->get();

        return [
            'notes' => $notes,
            'filter' => $request->filter,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,

        ];
    }

     /**
     * Display a listing of all notes.
     *
     * Retrieves notes using the current filter and sorting parameters
     * and passes them to the note view.
     *
     * @param Request $request Current filter and sorting parameters
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        return view('pages.note', array_merge(
            $this->getFilteredNotes($request),
            ['editingId' => null]
        ));
    }

    /**
     * Show the form for creating a new note.
     *
     * Uses the same view as the note overview.
     * The "newNote" flag allows the view to display the creation form.
     *
     * @param Request $request Current filter and sorting parameters
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('pages.note', array_merge(
            $this->getFilteredNotes($request),
            ['editingId' => null, 'newNote' => true]
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * Validates incoming data before creating a new note.
     *
     * Validation rules:
     *
     * - Title:
     *   Required, minimum 2 characters, maximum 60 characters
     *
     * - Description:
     *   Required, minimum 5 characters
     *
     * - Special characters:
     *   Restricted to prevent unwanted or unsafe input
     *
     * @param Request $request Form data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'min:2', 'max:60', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'description' => ['required', 'min:5', 'max:500', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
        ]);

        Note::create($validated);
        return redirect()->route('notes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the edit form for a note.
     *
     * @param Note $note The note instance resolved by route model binding.
     * @param Request $request The current filter and sorting parameters.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Note $note, Request $request)
    {

        return view('pages.note', array_merge(
            $this->getFilteredNotes($request),
            ['editingId' => $note->id]
        ));
    }

    /**
     * Update an existing note.
     *
     * Validates the request data and updates the specified note in the database.
     *
     * Allowed fields for update are 'title', 'description', and 'status'.
     *
     * @param Request $request Updated data for the note.
     * @param Note $note Note instance resolved by route model binding.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Note $note)
    {

        $validated = $request->validate([
            'title'       => ['required', 'min:2', 'max:60', 'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'description' => ['required', 'min:5', 'max:500','regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'],
            'status'      => ['sometimes', 'in:todo,done'],
        ]);

        $note->update($validated);

        return redirect()->route('notes.index', request()->only(['sort', 'order', 'filter']));

    }

    /**
     * Remove the note from storage.
     *
     * @param Note $note instance of the note to be deleted
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index');
    }
}
