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
                            <div class="col-md-6"><h4>Blog posts</h4></div>
                            <div class="col-md-6"><a href="{{route('blogs.create')}}" class="mb-2 btn btn-primary float-right"><i class="fa fa-pencil"></i> Add a new blog post</a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="indexTable" class="table table-striped" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th><th>Author</th><th>Published</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td><a href="{{route('blogs.edit',$blog['id'])}}">{{$blog->title}}</a></td>
                                        <td><a href="{{route('blogs.edit',$blog['id'])}}">{{$blog->author}}</a></td>
                                        <td><a href="{{route('blogs.edit',$blog['id'])}}">
                                            <?php if ($blog->publicationdate){
                                                    echo date('Y-m-d',strtotime($blog->publicationdate));
                                                  } else {
                                                    echo "Draft";
                                                  }
                                            ?></a></td>
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
