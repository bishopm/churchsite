<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ChurchNet</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('vendor/bishopm/css/bootstrap4.css') }}" rel="stylesheet">

</head>

<body style="background-color:#cccccc;">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><b>Church</b>Net</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        {!!$webmenu!!}
        <ul class="navbar-nav">
          @if(Auth::check())
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @if (Auth::user()->individual)
                  {{Auth::user()->individual->firstname}} 
                @else
                  {{Auth::user()->name}} 
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{url('/')}}/admin"><i class="fa fa-fw fa-cogs"></i> Backend</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                <form id="logout-form" action="{{url('/')}}/logout" method="POST" style="display: none;"><input type="hidden" name="_token" value="{{csrf_token()}}"></form>
              </div>
            </li>
          @else
            <li class="nav-item">
              <a style="color:white;" href="#" title="User login" data-toggle="modal" data-target="#modal-login" data-action-target="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div style="background-color:white;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <div class="text-left pt-2">
        <div class="row mt-3">
          @foreach ($webfooter as $kk=>$wf)
            <div class="col-sm-3"><h4>{{$kk}}</h4>
              <ul class="list-unstyled">
                @foreach ($wf as $wi)
                    <li>{!!$wi!!}</li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bishopm/js/popper.js') }}"></script>
  <script src="{{ asset('vendor/bishopm/js/bootstrap4.js') }}"></script>

</body>

</html>
