@extends('churchsite::templates.frontend')

@section('title','Sermons at UMC')

@section('css')
@stop

@section('plugins.Datatables', true)
@section('content')
<div class="container">
	<h3>UMC preaching series</h3>
	<div class="row mt-3">
		@foreach ($series as $serie)
			<div class="col-sm-4 col-xs-1">
				<a href="{{url('/')}}/sermons/{{$serie->slug}}"><img src="{{url('/')}}/storage/sermons/{{$serie->image}}">
				Started: {{date("Y-m-d",strtotime($serie->created_at))}} Sermons: {{count($serie->sermons)}}
				</a>			
			</div>
		@endforeach
	</div>
</div>
@endsection