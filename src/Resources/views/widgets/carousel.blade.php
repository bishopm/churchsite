<div id="myCarousel" class="carousel slide carousel-fade hidden-xs-up mb-3" data-ride="carousel">
  @if (count((json_decode($widget->data)->slides))>11)
    <ol class="carousel-indicators">
      @foreach ($sslides as $counter)
        @if ($loop->first)
          <li data-target="#myCarousel" data-slide-to="{{$loop->index}}" class="active"></li>
        @else
          <li data-target="#myCarousel" data-slide-to="{{$loop->index}}"></li>
        @endif
      @endforeach
    </ol>
  @endif
  <div class="carousel-inner">
    @foreach (json_decode($widget->data)->slides as $slide)
      @if ($loop->first)
        <div class="carousel-item active">
      @else
        <div class="carousel-item">
      @endif
      <img src="{{url('/')}}/storage/slides/{{$slide}}" class="d-block w-100">
      <div class="container">
        <div class="carousel-caption">
          <h1>Title</h1>
          <p></p>
        </div>
      </div>
      </div>
    @endforeach
  </div>
  @if (count((json_decode($widget->data)->slides))>1)
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> 
  @endif
</div>