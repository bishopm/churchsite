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
                            <form id="searchform" action="#" method="get" class="">
                                <div class="input-group">
                                    <input type="text" id="q" name="q" autocomplete="off" class="form-control" placeholder="Start typing to find people...">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                      <div class="col-md-4">
                          Logged in as: 

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