<h3 class="text-center">From our blog</h3>
@foreach ($blogs as $blog)
    @if ($loop->first)
        <img src="{{$blog->image}}" width="100%">
        {{$blog->title}} <small>{{$blog->author}}</small>
        <div class="text-left">{!!$blog->body!!}</div>
    @else
    <ul class="text-left">
        <li><a href="{{route('blogs.show',$blog->slug)}}">{{$blog->title}}</a></li>
    </ul>
    @endif
@endforeach