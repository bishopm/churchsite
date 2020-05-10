@extends('churchsite::page')

@section('css')
    @parent
@stop

@section('plugins.Datatables', true)
@section('content')
@include('churchsite::shared.errors')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Menus</h4></div>
                            <div class="col-md-6"><a href="{{route('menus.create')}}" class="btn btn-primary float-right"><i class="fa fa-pencil"></i> Add a new menu</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Menu name</th>
                                    <th>Menu description</th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                @forelse ($menus as $menu)
                                    <tr>
                                        <td><a href="{{route('menus.edit',$menu->id)}}">{{$menu->menu}}</a></td>
                                        <td><a href="{{route('menus.edit',$menu->id)}}">{{$menu->description}}</a></td>
                                    </tr>
                                @empty
                                    <tr><td>No menus have been added yet</td></tr>
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
@parent
<script language="javascript">
$(document).ready(function() {
        $('#indexTable').DataTable();
    } );
</script>
@endsection
