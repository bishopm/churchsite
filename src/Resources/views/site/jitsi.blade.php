@extends('churchsite::templates.frontend')

@section('title','Meeting room')

@section('css')
@stop

@section('content')
    <div id="jitsi" style="width:100%;">
    </div>
    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
    const domain = 'meet.jit.si';
    const options = {
        roomName: '{{$setting['setting_value']}}',
        width: '100%',
        height: 700,
        parentNode: document.querySelector('#jitsi')
    };
    const api = new JitsiMeetExternalAPI(domain, options);
    </script>
@stop

@section('js')

@stop
