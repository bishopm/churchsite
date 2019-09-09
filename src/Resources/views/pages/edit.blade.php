@extends('churchsite::page')

@section('css')
<link href="{{asset('vendor/bishopm/css/jquery-ui.min.css')}}" rel="stylesheet">
<link href="{{asset('vendor/bishopm/css/gridstack.css')}}" rel="stylesheet">
<style>
.grid-stack-item-content {
    background: #367fa8;
    color: white;
    text-align: center;
    font-size: 20px;
}

.grid-stack-item-content .fa {
    font-size: 64px;
    display: block;
    margin: 20px 0 10px;
}

header a, header a:hover { color: #fff; }

.darklue { background: #2c3e50; color: #fff; }
.darklue hr.star-light::after {
    background-color: #2c3e50;
}
</style>
@stop

@section('content_header')
    {{ Form::pgHeader('Edit page',route('pages.index')) }}
@stop

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a class="active" href="#content" role="tab" data-toggle="tab">Page content</a>
        </li>
        <li>
            <a href="#layout" role="tab" data-toggle="tab">Page layout</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="content" role="tabpanel">
            @include('churchsite::shared.errors')
            {!! Form::open(['route' => array('pages.update', $page->id), 'method' => 'put','files'=>'true']) !!}
            <div class="row" id="unsplash">
                <div class="col-md-12">
                    <div class="box box-primary"> 
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Page name</label>
                                <input class="form-control" data-slug="source" placeholder="Page name" name="title" id="title" type="text" value="{{$page->title}}">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" id="summernote" name="body">{{$page->body}}</textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            {{Form::pgButtons('Update',route('pages.index')) }}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="tab-pane" id="layout" role="tabpanel">
            <div class="grid-stack" data-gs-width="12" data-gs-animate="yes">
                @foreach ($page->pagewidgets as $ndx=>$widget)
                    @if ($widget->zone!=='q')
                        <div class="grid-stack-item" data-gs-x="{{$ndx}}" data-gs-y="0" data-gs-width="{{$widget->width}}" data-gs-height="1">
                            <div class="grid-stack-item-content">{{str_replace('_',' ',ucfirst($widget->widget))}}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{url('/')}}/vendor/bishopm/js/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
    <script src="{{url('/')}}/vendor/bishopm/js/gridstack.js"></script>
    <script src="{{url('/')}}/vendor/bishopm/js/gridstack.jQueryUI.js"></script>
    <link href="{{asset('vendor/bishopm/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/bishopm/summernote.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({height: 200});
        $('.grid-stack').gridstack({
            cellHeight: 80,
            verticalMargin: 10,
            width: 12,
            resizable: {
                handles: 'e, w'
            },
            alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
        });
    });
    </script>
@stop