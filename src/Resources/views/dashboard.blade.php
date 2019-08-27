@extends('adminlte::page')

@section('title','Dashboard')

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
                        <div class="col-md-8">
                            Welcome, {{Auth::user()->name}}
                        </div>
                      <div class="col-md-4">
                          Sidebar
                      </div>
                  </div>
              </div>
              <div class="panel-body">
                  <div class="col-md-8">
                    <div id="searchdata" style="padding-top:15px; padding-bottom: 15px;">
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