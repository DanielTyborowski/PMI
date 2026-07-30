<?php

namespace App\View\Components;

use App\Models\Note;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * -----------------------------------------------------------------------------
 * NoteCard Component
 * -----------------------------------------------------------------------------
 *
 * Represents a reusable note card component.
 *
 * This component is responsible for displaying a single note and handling
 * different display states:
 *
 * - Normal note display
 * - Editing mode
 * - New note creation mode
 *
 * The component receives a Note model instance and additional state flags
 * which determine how the note card is rendered.
 */
class NoteCard extends Component
{
    /**
     * The note model instance displayed by this component.
     *
     * @var Note
     */
    public Note $note;

    /**
     * Determines whether the note card is currently in edit mode.
     *
     * When enabled, the component can display an edit form instead
     * of the normal note view.
     *
     * @var bool
     */
    public bool $editing;

    /**
     * Determines whether the component represents a new note.
     *
     * Used to display the note creation form or creation-specific behavior.
     *
     * @var bool
     */
    public bool $new;

     /**
     * Create a new component instance.
     *
     * Component parameters:
     *
     * - note:
     *   The note model that should be displayed.
     *
     * - editing:
     *   Indicates whether the component is in editing mode.
     *
     * - new:
     *   Indicates whether the component is used for creating a new note.
     *
     * @param Note $note Note model instance
     * @param bool $editing Edit mode state
     * @param bool $new New note creation state
     */
    public function __construct(Note $note, $editing = false, $new = false)
    {
        $this->note = $note;
        $this->editing = $editing;
        $this->new = $new;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.note-card');
    }
}
