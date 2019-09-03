@extends('churchsite::templates.frontend')

@section('css')
@stop

@section('content')
    <div class="row">
        @if (isset($page['pagewidgets']))
            @foreach ($page['pagewidgets'] as $widget)
                @include('churchsite::widgets.' . $widget['widget'])
            @endforeach
        @endif
    </div>
@stop

@section('js')
@stop