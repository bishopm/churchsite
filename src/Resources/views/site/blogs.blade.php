@extends('churchsite::templates.frontend')

@section('title','Blog')

@section('css')
@stop

@section('plugins.Datatables', true)
@section('content')
<div class="container">
	<div class="row">
	  <div class="col-md-12">
		  <h3>{{$setting['site_abbreviation']}} blog</h3>
	  	  <table id="seriesTable" class="table table-responsive table-striped">
	  	  	  <thead>
	  	  	  	<tr><th>Date</th><th>Title</th><th>Author</th><th>Comments</th></tr>
	  	  	  </thead>
	  	  	  <tbody>
			      	@foreach ($blogs as $blog)
			      		<tr>
							<td><a href="{{url('/')}}/blog/{{date("Y",strtotime($blog->created_at))}}/{{date("m",strtotime($blog->created_at))}}/{{$blog->slug}}">{{date("Y-m-d",strtotime($blog->created_at))}}</a></td>
							<td><a href="{{url('/')}}/blog/{{date("Y",strtotime($blog->created_at))}}/{{date("m",strtotime($blog->created_at))}}/{{$blog->slug}}">{{$blog->title}}</a></td>
							<td><a href="{{url('/')}}/blog/{{date("Y",strtotime($blog->created_at))}}/{{date("m",strtotime($blog->created_at))}}/{{$blog->slug}}">{{$blog->individual->firstname}} {{$blog->individual->surname}}</a></td>
							<td><a href="{{url('/')}}/blog/{{date("Y",strtotime($blog->created_at))}}/{{date("m",strtotime($blog->created_at))}}/{{$blog->slug}}">{{count($blog->comments)}}</a></td>
						</tr>
			      @endforeach
			  </tbody>
		  </table>
	  </div>
	</div>
</div>
@endsection

@section('js')
<script language="javascript">
  $(document).ready(function() {
    $('#seriesTable').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
  });
</script>
@stop
