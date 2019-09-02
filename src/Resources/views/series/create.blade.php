@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('New series',route('series.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('series.store'), 'method' => 'post','files'=>'true']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Series title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text">
                    </div>
                    <div class="form-group">
                        <label for="publicationdate">Starting date</label>
                        <div>
                            <input placeholder="Starting date" type="text" class="form-control datetimepicker-input" id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker" name="startdate"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fileimage">Image</label>
                        <input type="file" name="seriesimage">
                    </div>
                    <div class="form-group">
                        <label for="body">Description</label>
                        <textarea placeholder="Series description" class="form-control" id="summernote" name="description"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('OK',route('series.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script src="{{asset('vendor/bishopm/js/moment.min.js')}}"></script>
    <script src="{{asset('vendor/bishopm/js/datetimepicker.js')}}"></script>
    <script src="{{asset('vendor/bishopm/css/datetimepicker.css')}}"></script>
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>
@stop