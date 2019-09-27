@extends('churchsite::templates.frontend')

@section('title','Content tagged ' . $subject)

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
		  	<h3>Content tagged '{{$subject}}'</h3>
		</div>
	    @if (count($blogs))
	    	<div class="col-md-4">
			    <h4>Blog posts (News/Article)</h4>
			    <ul class="list-unstyled text-left">
				    @foreach ($blogs as $blog)
				    	<li>{{date("Y-m-d",strtotime($blog->created_at))}} <a href="{{url('/')}}/blog/{{date("Y",strtotime($blog->created_at))}}/{{date("m",strtotime($blog->created_at))}}/{{$blog->slug}}">{{$blog->title}}</a> <a href="{{url('/')}}/people/{{$blog->author}}"><i>{{$blog->author}}</i></a></li>
				    @endforeach
				</ul>
			</div>
		@endif
	</div>
</div>
@endsection