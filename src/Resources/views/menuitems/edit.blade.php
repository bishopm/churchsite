@extends('churchsite::page')

@section('css')
    <link href="{{ asset('/vendor/bishopm/css/selectize.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content_header')
    {{ Form::pgHeader('Edit menuitem','Menuitems',route('menuitems.index',$menu)) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('menuitems.update',$menu,$menuitem->id), 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-6">
            <a href="{{route('menuitems.create',$menu)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add a new menuitem item</a>
        </div>
        <div class="col-md-6">
            <div class="box box-primary"> 
                <div class="box-body">
                {{ Form::bsText('title','Menu item','Menu item',$menuitem->title) }}
                <div class="form-group">
                    <label for="target">Target</label>
                    <select class="form-control" name="target" id="target">
                        @if ($menuitem->target=="_self")
                            <option selected value="_self">Same tab</option>
                            <option value="_blank">New tab</option>
                        @else
                            <option value="_self">Same tab</option>
                            <option selected value="_blank">New tab</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="target">Url</label>
                    <select class="selectize" name="url" id="url">
                        <optgroup label="--- Custom URL ---">
                            <option value="{{strtolower($menuitem->url)}}">{{strtolower($menuitem->url)}}</option>
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
                        @foreach ($items as $item)
                            @if ($menuitem->parent_id==$item->id)
                                <option selected value="{{$item->id}}">{{$item->title}}</option>
                            @else
                                <option value="{{$item->id}}">{{$item->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{ Form::bsHidden('menu_id',$menu) }}
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('menuitems.index',$menu)) }}
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
          openOnFocus: 1,
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