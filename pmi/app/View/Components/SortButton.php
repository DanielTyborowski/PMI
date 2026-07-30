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
     *
     * Component properties:
     *
     * - column:
     *   Database column used for sorting.
     *
     * - label:
     *   Text displayed inside the button.
     *
     * - currentSortBy:
     *   Currently active sorting column.
     *
     * - currentSortOrder:
     *   Currently active sorting direction.
     *
     * @param string $column Column name used for sorting
     * @param string $label Button display text
     * @param string $currentSortBy Current active sorting column
     * @param string $currentSortOrder Current sorting direction (asc/desc)
     */
    public function __construct(
        public string $column,
        public string $label,
        public string $currentSortBy,
        public string $currentSortOrder,
    )
    {
        /**
         * Determine the sorting direction for the next request.
         *
         * Clicking an already descending sorted column changes it to ascending.
         * All other cases default to descending sorting.
         */
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
