<h5 class="text-center pb-2 theme-secondary"><i class="fa fa-pencil fa-lg pr-3 theme-secondary"></i>From our blog</h5>
@foreach ($blogs as $blog)
    @if ($loop->first)
        <img src="{{$blog->image}}" width="100%">
        <a href="{{route('blogs.show',$blog->slug)}}">{{$blog->title}}</a> <small>{{$blog->author}}</small>
        <div class="text-left">{!!$blog->body!!}</div>
    @else
    <ul class="text-left">
        <li><a href="{{route('blogs.show',$blog->slug)}}">{{$blog->title}}</a></li>
    </ul>
    @endif
@endforeach