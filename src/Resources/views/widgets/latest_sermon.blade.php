<div class="col-md-4 text-center">
    <h3 class="text-center">Last Sunday</h3>
    @if ($sermon)
        <img width="250px" src="{{url('/')}}/storage/sermons/{{$sermon->series->image}}">
        <audio controls>
            <source src="{{$sermon->mp3}}">
        </audio>
        <br>{{$sermon->title}}
        {{$sermon->preacher}}
    @endif
</div>