@props(['note'])

<div class="w3-third w3-container w3-margin-bottom">
    <div class="w3-container w3-white">
        <p><b>{{$note->title}}</b></p>
        <p>{{$note->description}}</p>
        <div class="bottom-Card">
            <div class="bottom-card-left">
                <p>{{$note->created_at}}</p>
                <p>{{$note->updated_at}}</p>
            </div>
            <div class="bottom-card-right">
                <button>edit</button>
            </div>
        </div>
        <button>delete</button>
    </div>
</div>

