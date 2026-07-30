@props(['column', 'label', 'currentSortBy', 'currentSortOrder', 'nextOrder'])


<a href="{{ route('notes.index', array_merge(request()->query(), ['sort' => $column, 'order' => $nextOrder])) }}"
            class="{{ $currentSortBy === $column ? 'sort-active' : '' }}">
               {{$label}} {{ $currentSortBy === $column ? ($currentSortOrder === 'desc' ? '↓' : '↑') : '' }}
</a>
