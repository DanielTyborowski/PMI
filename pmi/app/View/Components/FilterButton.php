<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * -----------------------------------------------------------------------------
 * FilterButton Component
 * -----------------------------------------------------------------------------
 *
 * Represents a reusable filter button component.
 *
 * This component is used to create filter controls with a dynamic label,
 * value, and active filter state.
 *
 * It allows views to reuse the same button structure while only changing
 * the provided properties.
 */
class FilterButton extends Component
{
    /**
     * Create a new component instance.
     *
     * Component properties:
     *
     * - filter:
     *   The currently active filter value.
     *   Used to determine whether this button is selected.
     *
     * - label:
     *   The text displayed on the button.
     *
     * - value:
     *   The filter value assigned to this button.
     *
     * @param string|null $filter Current active filter
     * @param string $label Button display text
     * @param string|null $value Filter value represented by this button
     */
    public function __construct(
        public ?string $filter,
        public string $label,
        public ?string $value,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-button');
    }
}
