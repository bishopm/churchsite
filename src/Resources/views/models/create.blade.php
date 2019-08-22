@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Add ' . $model, ucfirst(str_plural($model)),route('models.index', $model)) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('models.store',$model), 'method' => 'post','files'=>'true']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    @foreach ($fields as $field)
                        <div class="form-group">
                            <label for="name">{{ucfirst($field)}}</label>
                            <input class="form-control" data-slug="source" placeholder="{{ucfirst($field)}}" name="{{$field}}" id="{{$field}}" type="text">
                        </div>
                    @endforeach
                    <input name="_model" id="_model" type="hidden" value="{{$model}}">
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('models.index',$model)) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
@stop