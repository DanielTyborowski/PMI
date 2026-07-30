@props(['note'])

{{-- Editier Modus --}}
<form action="{{ route('notes.update', $note->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" id="title" value="{{ $note->title }}" class="note-card-edit-title">
    <textarea name="description" id="description" class="note-card-edit-description">{{ $note->description }} </textarea>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="note-card-bottom">

        <div class="note-card-bottom-left">
            <button type="submit" class="note-card-edit-save-button">🔒save</button>
        </div>
        <div class="note-card-bottom-right">
            <a class="note-card-edit-save-button" href="{{ route('notes.index', request()->query()) }}">❌cancel</a>
        </div>
    </div>
</form>
