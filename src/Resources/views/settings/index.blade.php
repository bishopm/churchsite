@extends('churchsite::page')

@section('css')
    @parent    
@stop

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Settings</h4></div>
                            <div class="col-md-6"><a href="{{route('settings.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add a new setting</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped table-hover table-condensed table-responsive" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Setting</th><th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($settings as $setting)
                                    <tr>
                                        <td><a href="{{route('settings.edit',$setting['id'])}}">{{ucfirst(str_replace('_',' ',$setting->setting_key))}}</a></td>
                                        <td><a href="{{route('settings.edit',$setting['id'])}}">{{$setting->setting_value}}</a></td>
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