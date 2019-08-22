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
                            <div class="col-md-6"><h4>{{ucfirst($model)}}</h4></div>
                            <div class="col-md-6"><a href="{{route('models.create',$model)}}" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Add a new {{$model}}</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped table-hover table-condensed table-responsive" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    @foreach ($headers as $header)
                                        <th>{{ucfirst($header)}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    @foreach ($headers as $header)
                                        <th>{{ucfirst($header)}}</th>
                                    @endforeach
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($rows as $row)
                                    <tr>
                                        @foreach ($row as $ndx=>$col)
                                            @if ($ndx <> 'id')
                                                <td><a href="{{route('models.edit',array($model,$row['id']))}}">{{$col}}</a></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr><td>No posts have been added yet</td></tr>
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
@endsection