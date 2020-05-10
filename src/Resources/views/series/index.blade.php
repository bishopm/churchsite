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
                            <div class="col-md-6"><h4>Sermon series</h4></div>
                            <div class="col-md-6"><a href="{{route('series.create')}}" class="btn btn-primary float-right mb-2"><i class="fa fa-plus"></i> Add a new sermon series</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th><th>Start date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($series as $series)
                                    <tr>
                                        <td><a href="{{route('series.show',$series['id'])}}">{{$series->title}}</a></td>
                                        <td><a href="{{route('series.show',$series['id'])}}">{{$series->startdate}}</a></td>
                                    </tr>
                                @empty
                                    <tr><td>No records have been added yet</td></tr>
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
