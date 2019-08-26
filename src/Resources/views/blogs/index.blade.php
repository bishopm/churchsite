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
                            <div class="col-md-6"><h4>Blog posts</h4></div>
                            <div class="col-md-6"><a href="{{route('blogs.create')}}" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Add a new blog post</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped table-hover table-condensed table-responsive" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td><a href="{{route('blogs.edit',$blog['id'])}}">{{$blog->title}}</a></td>
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