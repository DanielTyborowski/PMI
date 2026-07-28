<?php

namespace App\View\Components;

use App\Models\Note;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoteCard extends Component
{

    public Note $note;
    public bool $editing;

    /**
     * Create a new component instance.
     */
    public function __construct(Note $note, $editing = false)
    {
        $this->note = $note;
        $this->editing = $editing;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.note-card');
    }
}
