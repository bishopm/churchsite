@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Edit ' . $model,ucfirst(str_plural($model)),route('models.index', $model)) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('models.update',$fields['id']), 'method' => 'put','files'=>'true']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    @foreach ($fields as $key => $val)
                        @if ($key <> 'id')
                            <div class="form-group">
                                <label for="name">{{ucfirst($key)}}</label>
                                <input class="form-control" data-slug="source" placeholder="{{ucfirst($key)}}" name="{{$key}}" id="{{$key}}" type="text" value="{{$val}}">
                            </div>
                        @else
                            <input name="{{$key}}" id="{{$key}}" type="hidden" value="{{$val}}">
                            <input name="_model" id="_model" type="hidden" value="{{$model}}">
                        @endif
                    @endforeach
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('models.index', $model)) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
@stop