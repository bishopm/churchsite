@extends('churchsite::page')

@section('css')
    @parent
@stop

@section('plugins.Datatables', true)
@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Simulated live videos</h4></div>
                            <div class="col-md-6"><a href="{{route('videos.create')}}" class="mb-2 btn btn-primary float-right"><i class="fa fa-pencil"></i> Add a new video</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th><th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($videos as $video)
                                    <tr>
                                        <td><a href="{{route('videos.edit',$video['id'])}}">{{$video->title}}</a></td>
                                        <td><a href="{{route('videos.edit',$video['id'])}}">{{date('Y-m-d H:i:s',$video->broadcasttime)}}</a></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2">No videos have been added yet</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.table').dataTable();
    });
    </script>
@endsection
