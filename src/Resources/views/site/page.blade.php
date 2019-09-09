@extends('churchsite::templates.frontend')

@section('css')
@stop

@section('content')
    @if (isset($header))
        @foreach ($header as $widget)
            @include('churchsite::widgets.' . $widget['widget'])
        @endforeach
    @endif
    <div class="row">
        @if (isset($body))
            @foreach ($body as $widget)
                @include('churchsite::widgets.' . $widget['widget'])
            @endforeach
        @endif
    </div>
    @if (isset($page))
        <div class="row">
            <div class="col mt-3 text-left">
                {{$page}}
            </div>
        </div>
    @endif

@stop

@section('js')
@stop