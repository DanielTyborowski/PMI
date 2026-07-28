

@props(['note', 'editing' => false, 'new' => false])


<div class="w3-third w3-container w3-margin-bottom">
    <div class="w3-container w3-pale-yellow">

        @if($new)
            {{-- NEUE KARTE --}}
            <form action="{{ route('resource.store') }}" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Titel..." class="w3-input">
                <textarea name="description" placeholder="Beschreibung..." class="w3-input"></textarea>
                <div class="bottom-Card">
                    <div class="bottom-card-left">
                        {{-- <p>-</p> --}}
                        {{-- <p>-</p> --}}
                    </div>
                    <div class="bottom-card-right">
                        <button type="submit">save</button>
                        <a href="{{ route('resource.index') }}">cancel</a>
                    </div>
                </div>
            </form>
        @elseif ($editing)
            <form action="{{ route('resource.update', $note->id)}}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="title" id="title" value="{{$note->title}}" class="w3-input">
                <textarea name="description" id="description">{{$note->description}}</textarea>
                <div class="bottom-Card">
                    <div class="bottom-card-left">
                        <p>{{$note->created_at}}</p>
                        <p>{{$note->updated_at}}</p>
                    </div>
                    <div class="bottom-card-right">
                        <button type="submit">save</button>

                    </div>
                </div>
            </form>
        @else
        <p><b>{{$note->title}}</b></p>
        <form action="{{route('resource.update', $note->id)}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="title" value="{{$note->title}}" >
            <input type="hidden" name="description" value="{{$note->description}}" >
            <input type="hidden" name="status" value="{{$note->status === 'done' ? 'todo' : 'done'}}" >
            <input type="checkbox" {{$note->status === 'done' ? 'checked' : ''}} onchange="this.form.submit()">
        </form>

        <p>{{$note->description}}</p>
        <div class="bottom-Card">
            <div class="bottom-card-left">
                <p>{{$note->created_at}}</p>
                <p>{{$note->updated_at}}</p>
            </div>
            <div class="bottom-card-right">
                <a href="{{ route('resource.edit', $note->id) }}">
                <button>edit</button>
                </a>
            </div>
        </div>
        <form action="{{route('resource.destroy', $note->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">delete</button>
        </form>
        @endif
    </div>
</div>
