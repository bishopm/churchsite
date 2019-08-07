@extends('churchsite::templates.frontend')

@section('title','Sermons at ' . $setting['site_abbreviation'])

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="container">
	<div class="row mt-3">
	  <div class="col-md-12">
			<h3>{{$setting['site_abbreviation']}} preaching series</h3>  
			<div class="table-responsive mt-3">
	  	  <table id="seriesTable" class="table table-striped">
					<thead>
						<tr><th>Starting date</th><th>Series title</th><th>No. of sermons</th><th></th></tr>
					</thead>
					<tbody>
						@foreach ($series as $serie)
							<tr><td><a href="{{url('/')}}/sermons/{{$serie->slug}}">{{date("Y-m-d",strtotime($serie->created_at))}}</a></td><td><a href="{{url('/')}}/sermons/{{$serie->slug}}">{{$serie->title}}</a></td><td><a href="{{url('/')}}/sermons/{{$serie->slug}}">{{count($serie->sermons)}}</a></td><td><a href="{{url('/')}}/sermons/{{$serie->slug}}"><img width="60px" src="{{url('/')}}/storage/series/{{$serie->image}}"></a></td></tr>
						@endforeach
					</tbody>
				</table>
			</div>
	  </div>
	</div>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script language="javascript">
  $(document).ready(function() {
    $('#seriesTable').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
  });
</script>
@stop