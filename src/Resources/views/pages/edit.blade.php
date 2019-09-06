@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Edit page',route('pages.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('pages.update', $page->id), 'method' => 'put','files'=>'true']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Page name</label>
                        <input class="form-control" data-slug="source" placeholder="Page name" name="title" id="title" type="text" value="{{$page->title}}">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="summernote" name="body">{{$page->body}}</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('pages.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <h3 class="text-center">Page layout</h3>
    <div class="row">
    @foreach ($page->pagewidgets as $widget)
        @if ($widget->zone=='a')
            <div class="col-md-12 text-center"><div class="my-lg-5">
        @else
            <div class="col-md-4 text-center"><div class="my-lg-5">
        @endif
            {{$widget->widget}}
        </div></div>
    @endforeach
    </div>
@stop

@section('js')
    <link href="{{asset('vendor/bishopm/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/bishopm/summernote.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({height: 200});
    });
    </script>
@stop