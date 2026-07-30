<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortButton extends Component
{
    public string $nextOrder;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $column,
        public string $label,
        public string $currentSortBy,
        public string $currentSortOrder,
    )
    {
        $this->nextOrder = ($currentSortBy === $column && $currentSortOrder === 'desc') ? 'asc' : 'desc';

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-button');
    }
}
