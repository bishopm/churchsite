@extends('churchsite::page')

@section('css')
    <link href="{{ asset('/vendor/bishopm/css/selectize.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content_header')
    {{ Form::pgHeader('Add menuitem','Menuitems',route('menuitems.index',$menu)) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('menuitems.store',$menu), 'method' => 'post']) !!}
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
                    <select class="selectize" name="url" id="url">
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
                {{ Form::bsHidden('menu_id',$menu->id) }}
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('menuitems.index',$menu)) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
<script src="{{ asset('/vendor/bishopm/js/selectize.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.selectize').selectize({
          plugins: ['remove_button'],
          maxOptions: 30,
          dropdownParent: "body",
          create: function(value) {
              return {
                  value: value,
                  text: value
              }
          }
        });
    });
</script>
@stop