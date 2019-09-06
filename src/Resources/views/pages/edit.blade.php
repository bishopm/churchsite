@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Edit page',route('pages.index')) }}
@stop

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a class="active" href="#content" role="tab" data-toggle="tab">Page content</a>
        </li>
        <li>
            <a href="#layout" role="tab" data-toggle="tab">Page layout</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="content" role="tabpanel">
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
        </div>
        <div class="tab-pane" id="layout" role="tabpanel">
            <div class="row">
                @foreach ($page->pagewidgets as $widget)
                    @if ($widget->zone=='a')
                        <div class="col-md-12 text-center">
                    @else
                        <div class="col-md-4 text-center">
                    @endif
                    <div style="padding:20px;background-color:lightgrey;margin:15px;">{{str_replace('_',' ',ucfirst($widget->widget))}}</div>
                    </div>
                @endforeach
            </div>
        </div>
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