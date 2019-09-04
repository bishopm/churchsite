@extends('churchsite::page')

@section('content_header')
    {{ Form::pgHeader('Add menu','Menus',route('menus.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('menus.store'), 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    {{ Form::bsText('menu','Menu name','Menu name') }}
                    {{ Form::bsText('description','Description','Description') }}
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('menus.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop