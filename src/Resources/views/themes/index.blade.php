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
                            <div class="col-md-6"><h4>Themes</h4></div>
                            <div class="col-md-6"><a href="{{route('themes.create')}}" class="mb-2 btn btn-primary float-right"><i class="fa fa-plus"></i> Add a new theme</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Theme title</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($themes as $theme)
                                    <tr>
                                        <td><a href="{{route('themes.edit',$theme['id'])}}">{{ucfirst($theme->title)}}</a></td>
                                        <td><a href="{{route('themes.edit',$theme['id'])}}">{{ucfirst($theme->description)}}</a></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2">No records have been added yet</td></tr>
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
