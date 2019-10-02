<h5 class="text-center pb-2 theme-secondary"><i class="fa fa-microphone fa-lg pr-3"></i>Last Sunday</h5>
@if ($sermon)
    <img width="250px" src="{{url('/')}}/storage/sermons/{{$sermon->series->image}}">
    <audio controls>
        <source src="{{$sermon->mp3}}">
    </audio>
    <br>{{$sermon->title}}
    {{$sermon->preacher}}
@endif