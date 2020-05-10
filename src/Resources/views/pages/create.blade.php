@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('New page',route('pages.index')) }}
@stop

@section('plugins.Select2', true)
@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('pages.store'), 'method' => 'post','files'=>'true']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Page title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text">
                    </div>
                    <div class="form-group">
                        <label for="tags">Subject (optional)</label>
                        <select multiple="multiple" class="subjecttags form-control" name="tags[]">
                            @foreach ($subjects as $subject)
                                <option>{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="summernote" name="body"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('OK',route('pages.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script src="{{asset('vendor/bishopm/js/moment.min.js')}}"></script>
    <script src="{{asset('vendor/bishopm/js/datetimepicker.js')}}"></script>
    <script src="{{asset('vendor/bishopm/css/datetimepicker.css')}}"></script>
    <link href="{{asset('vendor/bishopm/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/bishopm/summernote.min.js')}}"></script>
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $(document).ready(function() {
            $('#summernote').summernote({height: 200});
            $('.subjecttags').select2({
                placeholder: 'Select one or more subject tags',
                tags: true,
                width: '100%'
            });
        });
    </script>
@stop
