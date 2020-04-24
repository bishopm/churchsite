@extends('churchsite::templates.frontend')

@section('css')
@stop

@section('content')
    <div class="row mt-4">
        <div class="col-md-8 text-left">
            <h5><b>{{$video->title}}</b> <small>{{$video->author}}</small></h5>
            @foreach ($subjecttags as $ndx=>$tag)
                <a href="{{url('/')}}/subject/{{$ndx}}"><span class="badge badge-pill badge-primary">{{$tag}}</span></a>
            @endforeach
            <img class="rounded float-right pl-3 pb-3 img-fluid" width="60%" src="{{$video->image}}">
            <br>
            {!!$video->body!!}
        </div>
        <div class="col-md-4">
            @if (count($relatedvideos))
                <h5>Related videos</h5>
                <ul class="list-unstyled">
                    @foreach ($relatedvideos as $rvideo)
                        <li><a href="{{route('videos.show',$rvideo->slug)}}">{{$rvideo->title}}</a></li>
                    @endforeach
                </ul>
            @endif
            @if (count($relatedPages))
                <h5>Related pages</h5>
                <ul class="list-unstyled">
                    @foreach ($relatedPages as $rpage)
                        <li><a href="{{url('/')}}/page/{{$rpage->slug}}">{{$rpage->title}}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@stop

@section('js')
@stop
