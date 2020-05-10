@extends('churchsite::templates.webmaster')

@if (isset($titletagtitle))
	@section('title',$titletagtitle)
@endif

@section('css')
    @yield('css')
@stop

@section('content')
	@yield('content')
@stop

@section('js')
    @yield('js')
@stop
