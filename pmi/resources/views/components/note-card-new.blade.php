


<form action="{{ route('resource.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Titel..." class="note-card-edit-title">
    <textarea name="description" placeholder="Beschreibung..." class="note-card-edit-description" rows="10"></textarea>
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
            <a class="note-card-edit-save-button" href="{{ route('resource.index') }}">❌cancel</a>
        </div>
    </div>
</form>
