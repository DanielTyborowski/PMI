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
    public bool $new;

    /**
     * Create a new component instance.
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
