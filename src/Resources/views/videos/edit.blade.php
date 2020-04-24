@extends('churchsite::page')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/bishopm/css/datetimepicker.css')}}"/>
@stop

@section('content_header')
    {{ Form::pgHeader('Edit video',route('videos.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('videos.update', $video->id), 'method' => 'put']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label for="publicationdate">Broadcast date</label>
                        <div>
                            <input type="text" class="form-control datetimepicker-input" id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker" name="broadcasttime"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" placeholder="Title" name="title" id="title" type="text" value="{{$video->title}}">
                    </div>
                    <div class="form-group">
                        <label for="title">Duration</label>
                        <input class="form-control" placeholder="Duration (minutes)" name="duration" id="duration" type="text" value="{{$video->duration}}">
                    </div>
                    <div class="form-group">
                        <label for="title">YouTube id</label>
                        <input class="form-control" placeholder="Youtube id" name="url" id="url" type="text" value="{{$video->url}}">
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('videos.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <link href="{{asset('vendor/bishopm/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/bishopm/js/moment.min.js')}}"></script>
    <script src="{{asset('vendor/bishopm/js/datetimepicker.js')}}"></script>
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            date: '{{$video->broadcasttime}}'
        });
    </script>
@stop
