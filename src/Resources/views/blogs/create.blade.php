@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('New blog post',route('blogs.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => 'blogs.store', 'method' => 'post','files'=>'true']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text">
                    </div>
                    <div class="form-group">
                        <label for="tags">Author</label>
                        <select class="authortags form-control" name="author">
                            <option></option>
                            @foreach ($bloggers as $author)
                                <option>{{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Subject</label>
                        <select multiple="multiple" class="subjecttags form-control" name="tags[]">
                            @foreach ($subjects as $subject)
                                <option>{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div>
                            <input class="form-control" name="image" id="image" type="file">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-modal">Search unSplash</button>
                            <div class="modal fade bd-modal" id="unsplash" tabindex="-1" role="dialog" aria-labelledby="unSplash Modal" aria-hidden="true">
                                <div class="modal-dialog border" style="width:95%;height=95%;">
                                    <div class="modal-content" style="width:100%;height=100%;padding-top:1%;">
                                        <h3 class="text-center">Search for unSplash images</h3>
                                        <input @blur="searchme" class="form-control" placeholder="search for image" id="search">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="summernote" name="body"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('blogs.index'))}}
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
        $( document ).ready(function() {
            $('#search').on('change', function () {
                $.ajax({ 
                    type: "GET", 
                    url: "https://api.unsplash.com/search/photos?query=church",
                    success: function (pics) {
                        console.log(pics)
                    },
                    error : function(error) {
                        console.log(error);
                    }
                });    
            });
        });
    </script>

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