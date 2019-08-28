@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Edit blog post',route('blogs.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('blogs.update', $blog->id), 'method' => 'put','files'=>'true']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text" value="{{$blog->title}}">
                    </div>
                    <div class="form-group">
                        <label for="tags">Author</label>
                        <select class="authortags form-control" name="author">
                            <option></option>
                            @foreach ($bloggers as $blogger)
                                @if ($author == $blogger->name)
                                    <option selected>{{$blogger->name}}</option>
                                @else
                                    <option>{{$blogger->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Subject</label>
                        <select multiple="multiple" class="subjecttags form-control" name="tags[]">
                            @foreach ($subjects as $subject)
                                @if (in_array($subject->name,$subjecttags))
                                    <option selected>{{$subject->name}}</option>
                                @else
                                    <option>{{$subject->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="summernote" name="body">{{$blog->body}}</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('blogs.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <link href="{{asset('vendor/bishopm/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/bishopm/summernote.min.js')}}"></script>
    <script>
        $('.authortags').select2({
            placeholder: 'Select or add author',
            tags: true,
            width: '100%'
        });
        $('.subjecttags').select2({
            placeholder: 'Select one or more subject tags',
            tags: true,
            width: '100%'
        });
        $(document).ready(function() {
            $('#summernote').summernote({height: 200});
        });
    </script>
@stop