@extends('churchsite::page')

@section('css')
<link href="{{asset('vendor/bishopm/css/jquery-ui.min.css')}}" rel="stylesheet">
<link href="{{asset('vendor/bishopm/css/gridstack.css')}}" rel="stylesheet">
<style>
.grid-stack-item-content {
    color: white;
    text-align: center;
    font-size: 20px;
    background-color: #367fa8;
}

.btn-primary {
    background-color: #367fa8;
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

@section('plugins.Select2', true)
@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active">
            <a class="nav-link active" href="#content" role="tab" data-toggle="tab">Page content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#layout" role="tab" data-toggle="tab">Page layout</a>
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
                                <label for="tags">Subject (optional)</label>
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
            <div class="text-center"><h4>Add, delete, move or resize widgets <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#widget-modal">Add widget</button></h4>
            @forelse ($widgets as $zone=>$zones)
                <br>
                <div class="text-center bg-black">
                    {{ucfirst(substr($zone,1))}}
                </div>
                <br>
                <div class="grid-stack" id="grid-stack-{{$zone}}" data-gs-width="12" data-gs-animate="yes">
                </div>
            @empty
                No widgets have been added to this page
            @endforelse
        </div>
    </div>
    <div class="modal fade" id="widget-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add a new widget</h4>
                </div>
                <div class="modal-body">
                    <div class="row my-3">
                        <div class="col-md-4 text-bold">
                            Widget
                        </div>
                        <div class="col-md-8">
                            <select id="newwidget" class="form-control" name="newwidget">
                                @foreach ($widgetnames as $widgetname)
                                    <option value="{{$widgetname->id}}">{{$widgetname->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top:10px;">
                        <div class="col-md-4 text-bold">
                            Zone
                        </div>
                        <div class="col-md-8">
                            <select id="newzone" class="form-control" name="newzone">
                                <option value="1header">Header</option>
                                <option selected value="2body">Body</option>
                                <option value="3footer">Footer</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="buttonrow" style="padding-top:10px;">
                        <div class="col-md-offset-4 col-md-8">
                            <button onclick="addWidget()" data-dismiss="modal" class="form-control btn btn-primary">Add widget to page</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="settings-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Widget settings</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div id="settings" class="modal-body">
                </div>
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
        $('.subjecttags').select2({
            placeholder: 'Select one or more subject tags',
            tags: true,
            width: '100%'
        });
        $('#grid-stack-1header').gridstack({
            verticalMargin: 10,
            width: 12,
            resizable: {
                handles: 'e, w'
            },
            alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
        });
        $('#grid-stack-2body').gridstack({
            verticalMargin: 10,
            width: 12,
            resizable: {
                handles: 'e, w'
            },
            alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
        });
        $('#grid-stack-3footer').gridstack({
            verticalMargin: 10,
            width: 12,
            resizable: {
                handles: 'e, w'
            },
            alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
        });
        var headerData = {!!json_encode($widgets['1header'])!!};
        var headerGrid = $('#grid-stack-1header').data('gridstack');
        for (var hndx in headerData) {
            headerGrid.addWidget($('<div><div class="grid-stack-item-content"><small>' + headerData[hndx].widget.label + ' <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#settings-modal" href="#" onclick="editSettings(' + headerData[hndx].id + ')"><i class="fa fa-cog"></i></a> <a href="#" onclick="deleteWidget(' + headerData[hndx].id + ')" class="btn btn-primary btn-xs float-right"><i class="fa fa-times"></i></a></small></div></div>'),
                headerData[hndx].col, headerData[hndx].row, headerData[hndx].width, 80, false, 1, 12, 1, 1, headerData[hndx].id);
        }
        var bodyData = {!!json_encode($widgets['2body'])!!};
        var bodyGrid = $('#grid-stack-2body').data('gridstack');
        for (var bndx in bodyData) {
            bodyGrid.addWidget($('<div><div id="widget-' + bodyData[bndx].id + '" class="grid-stack-item-content"><small>' + bodyData[bndx].widget.label + ' <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#settings-modal" href="#" onclick="editSettings(' + bodyData[bndx].id + ')"><i class="fa fa-cog"></i></a> <a href="#" onclick="deleteWidget(' + bodyData[bndx].id + ')" class="btn btn-primary btn-xs float-right"><i class="fa fa-times"></i></a></small></div></div>'),
                bodyData[bndx].col, bodyData[bndx].row, bodyData[bndx].width, 80, false, 1, 12, 1, 1, bodyData[bndx].id);
        }
        var footerData = {!!json_encode($widgets['3footer'])!!};
        var footerGrid = $('#grid-stack-3footer').data('gridstack');
        for (var fndx in footerData) {
            footerGrid.addWidget($('<div><div id="widget-' + footerData[fndx].id + '" class="grid-stack-item-content"><small>' + footerData[fndx].widget.label + ' <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#settings-modal" href="#" onclick="editSettings(' + footerData[hndx].id + ')"><i class="fa fa-cog"></i></a> <a href="#" onclick="deleteWidget(' + footerData[fndx].id + ')" class="btn btn-primary btn-xs float-right"><i class="fa fa-times"></i></a></small></div></div>'),
                footerData[fndx].col, footerData[fndx].row, footerData[fndx].width, 80, false, 1, 12, 1, 1, footerData[fndx].id);
        }
        $('.grid-stack').on('change', function(event, items) {
            var widgets = [];
            for (var indx in items) {
                var newitem = {
                    id: items[indx].id,
                    x: items[indx].x,
                    y: items[indx].y,
                    width: items[indx].width
                };
                widgets.push(newitem);
            }
            $.ajax({
                type : 'POST',
                url : '{{route('pagewidgets.update',1)}}',
                data: {
                    _token: '{{ csrf_token() }}',
                    items: JSON.stringify(widgets)
                }
            });
        });
    });
    function addWidget () {
        $.ajax({
            type : 'POST',
            url : '{{route('pagewidgets.store',$page->id)}}',
            data: {
                _token: '{{ csrf_token() }}',
                widget: $('#newwidget').val(),
                zone: $('#newzone').val()
            }
        }).then(response => {
            var grid = $('#grid-stack-' + response.zone).data('gridstack');
            grid.addWidget($('<div><div class="grid-stack-item-content"><small>' + response.widget.label + '<a href="#" onclick="deleteWidget(' + response.id + ')" class="btn btn-primary btn-xs float-right">X</a></small></div></div>'),
                    response.col, response.row, response.width, 80, false, 1, 12, 1, 1, response.id);
        });
    }
    function deleteWidget (item) {
        $('#widget-' + item).remove();
        $.ajax({
            type : 'POST',
            url : '{{route('pagewidgets.update',$page->id)}}',
            data: {
                _token: '{{ csrf_token() }}',
                delete: item
            }
        });
    }
    function editSettings (id) {
        $('#settings').html('Loading ...');
        var sbox = '';
        $.ajax({
            type : 'GET',
            url : '{{url('/')}}/admin/pages/{{$page->id}}/widgets/' + id
        }).then(response => {
            if (response.data === 'null') {
                sbox = 'This widget has no additional settings';
            } else {
                sbox = '<form id="widgetsettings">';
                $.each(JSON.parse(response.data), function( index, value ) {
                    sbox = sbox + '<div class="row" style="padding-bottom:5px;"><div class="col-md-3">' + index.toUpperCase() + '</div><div class="col-md-9">';
                    if (index === 'files') {
                        for (var fndx in value) {
                            if (value[fndx] !== '.' && value[fndx] !== '..') {
                                sbox = sbox + '<div onclick="toggleImage(\'' + value[fndx]+ '\')" class="col-sm-6 text-center" style="margin-top:10px;"><img class="img-thumbnail" src="{{url('/') . '/storage/slides/'}}' + value[fndx] +'"><br>' + value[fndx] + '</div>';
                            }
                        }
                    } else {
                        sbox = sbox + '<input id="' + index +'" class="form-control" name="' + index +'" value="' + value + '"></div></div>';
                    }
                });
                sbox = sbox + '<div class="row"><div class="col-md-offset-3 col-md-9" style="margin-top:15px;"><a href="#" onclick="updateSettings(' + id + ')" class="btn btn-primary float-right" data-dismiss="modal">Update</a></div></div></form>';
            }
            $('#settings').html(sbox);
        });
    }
    function toggleImage(img) {
        var images = $('#images').val();
        if (!images) {
            images=img;
        } else if (images.includes(img)) {
            images = images.replace(',' + img,'');
            images = images.replace(img + ',','');
            images = images.replace(img,'');
        } else {
            images=images + ',' + img;
        }
        $('#images').val(images);
    }

    function updateSettings (id) {
        $.ajax({
            type : 'POST',
            url : '{{route('pagewidgets.update',$page->id)}}',
            data: {
                _token: '{{ csrf_token() }}',
                data: $('#widgetsettings').serialize(),
                widget_id: id
            }
        });
    }
    </script>
@stop
