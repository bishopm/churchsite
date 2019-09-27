@extends('churchsite::templates.frontend')

@section('css')
@stop

@section('content')
    <div class="row mt-4">
        <div class="col-md-8 text-left">
            <h5><b>{{$blog->title}}</b> <small>{{$blog->author}}</small></h5>
            @foreach ($subjecttags as $ndx=>$tag)
                <a href="{{url('/')}}/subject/{{$ndx}}"><span class="badge badge-pill badge-primary">{{$tag}}</span></a>
            @endforeach
            <img class="rounded float-right pl-3 pb-3 img-fluid" width="60%" src="{{$blog->image}}">
            <br>
            {!!$blog->body!!}
        </div>
        <div class="col-md-4">
            @if (count($relatedBlogs))
                <h5>Related blogs</h5>
                <ul class="list-unstyled">
                    @foreach ($relatedBlogs as $rblog)
                        <li>{{$rblog->title}}</li>
                    @endforeach
                </ul>
            @endif
            @if (count($relatedPages))
                <h5>Related pages</h5>
                <ul class="list-unstyled">
                    @foreach ($relatedPages as $rpage)
                        <li>{{$rpage->title}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@stop

@section('js')
@stop