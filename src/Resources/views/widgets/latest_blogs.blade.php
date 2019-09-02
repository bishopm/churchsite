<div class="col-md-4 text-left">
    <h3 class="text-center">From our blog</h3>
    @foreach ($blogs as $blog)
        @if ($loop->first)
            <img src="{{$blog->image}}" width="100%">
            {{$blog->title}} <small>{{$blog->author}}</small>
            {!!$blog->body!!}
        @else
            <li>{{$blog->title}}</li>
        @endif
    @endforeach
</div>