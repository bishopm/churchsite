@extends('churchsite::page')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/bishopm/css/datetimepicker.css')}}"/>
@stop

@section('content_header')
    {{ Form::pgHeader('Create video',route('videos.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('videos.store'), 'method' => 'post']) !!}
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
                        <input class="form-control" placeholder="Title" name="title" id="title" type="text"">
                    </div>
                    <div class="form-group">
                        <label for="title">Duration</label>
                        <input class="form-control" placeholder="Duration (minutes)" name="duration" id="duration" type="text">
                    </div>
                    <div class="form-group">
                        <label for="title">YouTube id</label>
                        <input class="form-control" placeholder="Youtube id" name="url" id="url" type="text">
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('videos.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    </script>
@stop
