@if (count($blogs))
<h4 class="text-center">Related blogs</h4>
<ul class="list-unstyled">
@foreach ($blogs as $blog)
    <li><a href="{{route('blogs.show',$blog->slug)}}">{{$blog->title}}</a></li>
@endforeach
</ul>
@endif
@if (count($pages))
<h4 class="text-center">Related pages</h4>
<ul class="list-unstyled">
@foreach ($pages as $rpage)
    <li><a href="{{url('/')}}/page/{{$rpage->slug}}">{{$rpage->title}}</a></li>
@endforeach
</ul>
@endif