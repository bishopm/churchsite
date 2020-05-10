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
                            <div class="col-md-6"><h4>Pages</h4></div>
                            <div class="col-md-6"><a href="{{route('pages.create')}}" class="mb-2 btn btn-primary float-right"><i class="fa fa-plus"></i> Add a new page</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $page)
                                    <tr>
                                        <td><a href="{{route('pages.edit',$page['id'])}}">{{$page->title}}</a></td>
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
