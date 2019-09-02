@extends('churchsite::templates.frontend')

@section('css')
@stop

@section('content')
    <div class="row">
        @foreach ($page['pagewidgets'] as $widget)
            @include('churchsite::widgets.' . $widget['widget'])
        @endforeach
    </div>
@stop

@section('js')
@stop