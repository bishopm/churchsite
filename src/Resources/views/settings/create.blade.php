@extends('churchsite::setting')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('New setting',route('settings.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('settings.store'), 'method' => 'post','files'=>'true']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Setting title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text">
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('OK',route('settings.index')) }}
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