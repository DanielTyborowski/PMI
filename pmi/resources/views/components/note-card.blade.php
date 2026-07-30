

@props(['note', 'editing' => false, 'new' => false])


<div class="note-card-container {{ $note->status === 'done' ? 'note-card-done' : '' }}">

        @if($new)

            <x-note-card-new />

        @elseif ($editing)

            <x-note-card-edit :note="$note" />

        @else

            <x-note-card-show :note="$note" />

        @endif

</div>
