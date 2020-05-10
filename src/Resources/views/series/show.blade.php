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
                            <div class="col-md-6"><h4>{{$series->title}}</h4><small>{{$series->startdate}}</small></div>
                            <div class="col-md-6"><a href="{{route('series.edit',$series->id)}}" class="btn btn-primary float-right"><i class="fa fa-pencil"></i> Edit series</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                @if ($series->image)
                                    <img class="img-thumbnail" width="250px" src="{{url('/')}}/storage/sermons/{{$series->image}}">
                                @else
                                    <img class="img-thumbnail" width="250px" src="{{url('/')}}/vendor/bishopm/images/logo.png">
                                @endif
                            </div>
                            <div class="col-sm-9">
                                <table class="table table-sm">
                                    <caption>{{$series->description}}</caption>
                                    <thead>
                                        <tr><th>Service date</th><th>Sermon title</th><th>Preacher</th><th>Status</th><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($series->sermons as $sermon)
                                            <tr>
                                                <td>{{$sermon->servicedate}}</td>
                                                <td>{{$sermon->title}}</td>
                                                <td>{{$sermon->preacher}}</td>
                                                <td>{{$sermon->status}}</td>
                                                <td><a href="{{route('sermons.edit',$sermon->id)}}">Edit</a></td>
                                            </tr>
                                        @empty
                                            <tr><td>No sermons have been added to this series yet.</tr></td>
                                        @endforelse
                                    </tbody>
                                </table>
                                <a href="{{route('sermons.create',$series->id)}}" class="btn btn-primary">Add a new sermon</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
