@extends('churchsite::templates.frontend')

@section('title',$book->title)
@section('page_image',url('/') . '/storage/books/' . $book->image)
@section('page_description', strip_tags($book->description))

@section('css')
  <meta id="token" name="token" value="{{ csrf_token() }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.css" rel="stylesheet">
@stop

@section('content')  
    <div class="container">
      @include('churchsite::shared.errors') 
      <h3>{{$book->title}} <small>
      @foreach ($authors as $author)
        @if (!$loop->last)
          <a href="{{url('/')}}/author/{{urlencode(trim($author))}}">{{trim($author)}}</a>, 
        @else
          <a href="{{url('/')}}/author/{{urlencode(trim($author))}}">{{trim($author)}}</a>
        @endif
      @endforeach
      </small></h3>
        <div class="row">
          <div class="col-md-3">
            @if ($book->image)
                <img width="250px" class="img-responsive" src="{{url('/')}}/storage/books/{{$book->image}}">
            @else
                <img width="250px" class="img-responsive" src="{{url('/')}}/vendor/bishopm/images/book.png">
            @endif
            <ul class="mt-2 list-unstyled">
            <li>
              Price: R{{$book->saleprice}} 
              <button class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#modal-message"><i class="fa fa-login"></i>Buy this book</button>
            </li> 
            @if ($book->stock)
              <li>Copies in stock: {{$book->stock}}</li>
            @else
              <li><small>To order stock, expect a delay of 2-5 days</small></li>
            @endif 
            </ul>
            @foreach ($book->tags as $tag)
              <a class="badge badge-primary" href="{{url('/')}}/subject/{{$tag->name}}">{{$tag->name}}</a></b>&nbsp;
            @endforeach
          </div>
          <div class="col-md-9">
            {!!$book->description!!}
            @if ($book->sample)
              <p><a href="{{$book->sample}}" target="_blank">View a free sample of the book</a></p>
            @endif
            @include('churchsite::shared.comments', ['rating' => true])
          </div> 
        </div>
    </div>
    @include('churchsite::shared.buybook-modal')
@stop

@section('js')
@if (Auth::check())
  <script src="{{url('/')}}/vendor/bishopm/rater/rater.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $( document ).ready(function() {
      var options = {
        max_value: 5,
        step_size: 1,
        initial_value: 0,
        selected_symbol_type: 'utf8_star', // Must be a key from symbols
        cursor: 'default',
        readonly: false,
        change_once: false, // Determines if the rating can only be set once
      }
      var optionsro = {
        max_value: 5,
        step_size: 1,
        selected_symbol_type: 'utf8_star', // Must be a key from symbols
        cursor: 'default',
        readonly: true,
      }
      $(".rating").rate(options);    
      $(".ratingro").rate(optionsro);    
    });
    @include('churchsite::shared.buybook-modal-script')
  </script>
@endif
@include('churchsite::shared.ratercommentsjs', ['url' => route('admin.books.addcomment',$book->id)])
@stop