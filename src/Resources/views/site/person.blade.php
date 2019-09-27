@extends('churchsite::templates.frontend')

@section('title',$person)

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
		  	<h3>{{$person}}</h3>
		</div>
	    @if (count($blogs))
	    	<div class="col-md-4">
			    <h4>Blog posts (News/Article)</h4>
			    <ul class="list-unstyled text-left">
				    @foreach ($blogs as $blog)
				    	<li>{{date("Y-m-d",strtotime($blog->created_at))}} <a href="{{url('/')}}/blog/{{date("Y",strtotime($blog->created_at))}}/{{date("m",strtotime($blog->created_at))}}/{{$blog->slug}}">{{$blog->title}}</a></li>
				    @endforeach
				</ul>
			</div>
		@endif
		@if (count($sermons))
	    	<div class="col-md-4">
			    <h4>Sermons</h4>
			    <ul class="list-unstyled text-left">
				    @foreach ($sermons as $sermon)
				    	<li>{{date("Y-m-d",strtotime($sermon->created_at))}} <a href="{{url('/')}}/sermon/{{date("Y",strtotime($sermon->created_at))}}/{{date("m",strtotime($sermon->created_at))}}/{{$sermon->slug}}">{{$sermon->title}}</a></li>
				    @endforeach
				</ul>
			</div>
		@endif
	</div>
</div>
@endsection