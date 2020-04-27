<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$settings['site_name']}}</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('vendor/bishopm/css/bootstrap4.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    a.footerlink, a.footerlink:hover {
      color: {{$settings['footer_menu_item_colour']}};
      text-decoration:none;
    }
    .theme-primary {
      color: {{$settings['primary_colour']}}!important;
    }
    .theme-secondary {
      color: {{$settings['secondary_colour']}}!important;
    }
    .bg-theme {
      background-color: {{$settings['menubar_colour']}};
    }
    a {
      color: {{$settings['primary_colour']}};
    }
    a:hover {
      color: {{$settings['secondary_colour']}};
      text-decoration:none;
    }
    .badge-primary {
      background-color: {{$settings['primary_colour']}};
    }
  </style>
</head>

<body style="background-color:{{$settings['body_background_colour']}};">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-{{$settings['menubar']}} bg-theme static-top">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">{!!$settings['site_logo']!!}</a>
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
              <a style="color:white;" title="User login" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div>
    <div class="container pb-3">
      <div class="row">
        <div class="col-lg-12 text-center">
          @yield('content')
        </div>
      </div>
    </div>
    <footer class="footer pb-5" style="background-color:{{$settings['footer_background_colour']}};">
      <div class="container">
        <div class="text-left pt-2">
          <div class="row mt-3">
            @foreach ($webfooter as $kk=>$wf)
              <div class="col-sm-3"><h4 style="color:{{$settings['footer_menu_item_colour']}}">{{$kk}}</h4>
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
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
