@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Add menu item','Menuitems',route('menuitems.index')) }}
@stop

@section('plugins.Select2', true)
@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('menuitems.store'), 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    {{ Form::bsText('title','Menu item','Menu item') }}
                    <div class="form-group">
                        <label for="target">Target</label>
                        <select class="form-control" name="target" id="target">
                            <option value="_self">Same tab</option>
                            <option value="_blank">New tab</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="target">Url</label>
                        <select class="form-control" name="url" id="url">
                            <optgroup label="--- Custom URL ---">
                                <option></option>
                            </optgroup>
                            <optgroup label="--- Pages ---">
                            @foreach ($pages as $page)
                                <option value="{{$page->slug}}">{{$page->title}}</option>
                            @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="target">Parent menu item</label>
                        <select class="form-control" name="parent_id" id="parent_id">
                            <option value="0">Root</option>
                            @foreach ($itemsformenu as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('menuitems.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
<script type="text/javascript">
    $( document ).ready(function() {
        $('#url').select2({
            placeholder: 'Add a custom url',
            tags: true,
            width: '100%'
        });
    });
</script>
@stop
