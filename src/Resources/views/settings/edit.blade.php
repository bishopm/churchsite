@extends('churchsite::page')

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
                        <label for="setting_key">{{ucfirst($setting->setting_key)}}</label>
                        <input class="form-control" placeholder="{{$setting->setting_key}}" name="{{$setting->setting_key}}" id="{{$setting->setting_key}}" type="text" value="{{$setting->setting_value}}">
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
@stop