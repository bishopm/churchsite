@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Edit menuitem','Menuitems',route('menuitems.index')) }}
@stop

@section('plugins.Select2', true)
@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('menuitems.update',$menuitem->id), 'method' => 'put']) !!}
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
                <select name="url" id="url" class="form-control">
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
        </div>
        <div class="box-footer">
            {{Form::pgButtons('Update',route('menuitems.index')) }}
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
