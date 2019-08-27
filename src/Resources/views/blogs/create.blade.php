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
                        <label for="tags">Tags</label>
                        <select multiple class="form-control" name="tags" id="tags">
                            @foreach ($tags as $tag)
                                <option>{{$tag->name}}</option>
                            @endforeach
                        </select>
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
$('.tags').select2({
  placeholder: 'Select an option'
});
@stop