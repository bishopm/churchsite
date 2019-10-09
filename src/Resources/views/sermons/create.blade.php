@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('New sermon',route('sermons.show',$series)) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => 'sermons.store', 'method' => 'post','files'=>'true']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text">
                    </div>
                    <div class="form-group">
                        <label for="tags">Preacher</label>
                        <select class="preachertags form-control" name="preacher">
                            <option></option>
                            @foreach ($preachers as $preacher)
                                <option>{{$preacher->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="servicedate">Service date</label>
                        <div>
                            <input type="text" class="form-control datetimepicker-input" id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker" name="servicedate"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="readings">Readings</label>
                        <input class="form-control" data-slug="source" placeholder="Readings" name="readings" id="readings" type="text">
                    </div>
                    <div class="form-group">
                        <label for="mp3">Mp3 file</label>
                        <input class="form-control" data-slug="source" placeholder="MP3" name="mp3" id="mp3" type="file">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option>Draft</option>
                            <option>Published</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="series_id" value="{{$series}}">
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('sermons.show',$series))}}
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
        $('.preachertags').select2({
            placeholder: 'Select or add preacher',
            tags: true,
            width: '100%'
        });
    </script>
@stop