@extends('churchsite::page')

@section('css')
    <link href="{{asset('vendor/bishopm/colourpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
@stop

@section('content_header')
    {{ Form::pgHeader('Edit themes',route('themes.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('themes.update', $theme->id), 'method' => 'put','files'=>'true']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Theme title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text" value="{{$theme->title}}">
                    </div>
                    <div class="form-group">
                        <label for="body">Description</label>
                        <textarea class="form-control" id="summernote" name="description">{{$theme->description}}</textarea>
                    </div>
                    <h3>Settings</h3>
                    @foreach ($theme->settings as $setting)
                        <div class="form-group">
                            <label>{{ucfirst(str_replace('_',' ',$setting->setting_key))}}</label>
                            @if ($setting->widget == 'colour-picker')
                                <div class="input-group colorpicker-component">
                                    <input name="id_{{$setting->id}}" type="text" value="{{$setting->setting_value}}" class="colourpicker form-control" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            @elseif ($setting->widget == 'text')
                                <input class="form-control" placeholder="{{$setting->setting_key}}" name="id_{{$setting->id}}" id="id_{{$setting->id}}" type="text" value="{{$setting->setting_value}}">
                            @elseif ((substr($setting->widget,0,1) == '[') && (substr($setting->widget,-1,1) == ']'))
                                <select class="form-control" name="id_{{$setting->id}}">
                                    @foreach (explode(",",substr($setting->widget,1,-1)) as $val)
                                        @if ($val==$setting->setting_value)
                                            <option selected>{{$val}}</option>
                                        @else
                                            <option>{{$val}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('themes.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script src="{{url('/')}}/vendor/bishopm/colourpicker/js/bootstrap-colorpicker.min.js"></script>
    <script>
        $(function() {
            $('.colorpicker-component').colorpicker();
        });
    </script>
@stop