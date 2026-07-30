<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * -----------------------------------------------------------------------------
 * SortButton Component
 * -----------------------------------------------------------------------------
 *
 * Represents a reusable sorting button component.
 *
 * This component generates a button that allows users to sort data by a
 * specific column. It automatically determines the next sorting direction
 * based on the currently active sorting state.
 *
 * Example:
 *
 * - Current sorting: created_at DESC
 * - Click action: changes to created_at ASC
 */

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
