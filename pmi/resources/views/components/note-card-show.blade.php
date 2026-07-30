@props(['note'])

<div class='note-card-header'>
<form action="{{route('resource.destroy', $note->id)}}" class="note-card-delete" method="POST">
        @csrf
        @method('DELETE')
        <button class="note-card-delete-button" type="submit">❌</button>
    </form>
<div class="note-card-title">
    <p><b class="note-card-title">{{$note->title}}</b></p>
</div>

<form action="{{route('resource.update', $note->id)}}" method="POST" class="note-card-checkbox">
    @csrf
    @method('PUT')
    <input type="hidden" name="title" value="{{$note->title}}" >
    <input type="hidden" name="description" value="{{$note->description}}" >
    <input type="hidden" name="status" value="{{$note->status === 'done' ? 'todo' : 'done'}}" >
    <input type="checkbox" class="note-card-checkbox-box" {{$note->status === 'done' ? 'checked' : ''}} onchange="this.form.submit()">
</form>
</div>


<div class="note-card-description">
<p>{!! nl2br(e($note->description)) !!}</p>

</div>

<div class="note-card-bottom">
<div class="note-card-bottom-left">
    <p>🗓️{{$note->created_at}}</p>
    <p>✏️{{$note->updated_at}}</p>
</div>
<div class="note-card-bottom-right">
    <a href="{{ route('resource.edit', array_merge(['note' => $note->id], request()->query())) }}">
        <button class="note-card-edit-save-button">✒️</button>
    </a>

</div>
</div>
