

@props(['note', 'editing' => false, 'new' => false])


<div class="note-card-container {{ $note->status === 'done' ? 'note-card-done' : '' }}">


        @if($new)
            {{-- NEUE KARTE --}}
            <form action="{{ route('resource.store') }}" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Titel..." class="w3-input w3-pale-yellow">
                <textarea name="description" placeholder="Beschreibung..." class="w3-input w3-pale-yellow" rows="10"></textarea>
                <div class="note-card-bottom">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="note-card-bottom-left">
                        {{-- <p>-</p> --}}
                        {{-- <p>-</p> --}}
                    </div>
                    <div class="note-card-bottom-right">
                        <button type="submit">save</button>
                        <a href="{{ route('resource.index') }}">cancel</a>
                    </div>
                </div>
            </form>
        @elseif ($editing)
            {{-- Editier Modus --}}
            <form action="{{ route('resource.update', $note->id)}}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="title" id="title" value="{{$note->title}}" class="w3-input">
                <textarea name="description" id="description">{{$note->description}}</textarea>
                <div class="note-card-bottom">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="note-card-bottom-left">
                        <p>🗓️{{$note->created_at}}</p>
                        <p>✏️{{$note->updated_at}}</p>
                    </div>
                    <div class="note-card-bottom-right">
                        <button type="submit">save</button>
                    </div>
                </div>
            </form>
        @else

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
                <p>{{$note->description}}</p>

            </div>

            <div class="note-card-bottom">
                <div class="note-card-bottom-left">
                    <p>🗓️{{$note->created_at}}</p>
                    <p>✏️{{$note->updated_at}}</p>
                </div>
                <div class="note-card-bottom-right">
                    <a href="{{ route('resource.edit', $note->id) }}">
                        <button class="note-card-edit-button">✒️</button>
                    </a>

                </div>
            </div>


        @endif

</div>
