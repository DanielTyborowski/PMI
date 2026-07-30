@props(['filter', 'label', 'value'])


<a href="{{ route('notes.index', array_merge(request()->query(), ['filter' => $value])) }}"
    class="filter-button {{ $filter === $value ? 'filter-active' : '' }}">
    {{$label}}
</a>
