@extends('churchsite::templates.frontend')

@section('css')
@stop

@section('content')
    @if (isset($header))
        @foreach ($header as $widget)
            @include('churchsite::widgets.' . $widget['widget']['widget'])
        @endforeach
    @endif
    @if (isset($body))
        <div class="row mt-4">
            @foreach ($body as $widget)
                <div class="col-md-{{$widget->width}}">
                    @include('churchsite::widgets.' . $widget['widget']['widget'])
                </div>
            @endforeach
        </div>
    @endif
    @if (isset($footer))
        <footer class="footer">
            @foreach ($footer as $widget)
                @include('churchsite::widgets.' . $widget['widget']['widget'])
            @endforeach
        </footer>
    @endif

@stop

@section('js')
@stop