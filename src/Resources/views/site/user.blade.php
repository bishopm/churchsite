@extends('churchsite::templates.frontend')

@section('title','User profile: ' . $user->individual->firstname . ' ' . $user->individual->surname)

@section('content')
<div class="container">
	<div class="row top30">
	  @if (Auth::check())
	  	@if ($user)
		  <div class="col-md-3 centre-xs">
		  	@if ($user->individual->image)
                <img class="img-responsive img-circle img-thumbnail" src="{{url('/')}}/storage/individuals/{{$user->individual->id}}/{{$user->individual->image}}">
            @else
                <img class="img-responsive img-circle img-thumbnail" src="{{asset('/vendor/bishopm/themes/' . $theme . '/images/profile.png')}}">
            @endif
		  </div>
		  <div class="col-md-3">
		    <h3>{{$user->individual->firstname}} {{$user->individual->surname}}</h3>
		    {{$user->bio}}
		    @if (Auth::user()->id == $user->id)
			    <p class="top10"><a href="{{url('/')}}/users/{{$user->individual->slug}}/edit" class="btn btn-xs btn-primary">Edit my public profile</a></p>
			@elseif ($user->allow_messages=="Yes")
				<button class="top10 btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#modal-message"><i class="fa fa-login"></i>Send {{$user->individual->firstname}} a message</button>
			@endif
		  </div>
		  <div class="col-md-3">
		  	<h4>Groups</h4>
		    @forelse ($user->individual->publishedgroups as $group)
		    	@if ($group->publish)
			    	@if (!$loop->last)
			    		<a href="{{url('/')}}/group/{{$group->slug}}">{{$group->groupname}}</a>, 
			    	@else
						<a href="{{url('/')}}/group/{{$group->slug}}">{{$group->groupname}}</a>.
			    	@endif
			    @endif
				@empty
					No group memberships
		    @endforelse
				<h4>Events</h4>
		    @forelse ($user->individual->publishedevents as $event)
		    	@if ($event->publish)
			    	@if (!$loop->last)
			    		<a href="{{url('/')}}/group/{{$event->slug}}">{{$event->groupname}}</a>, 
			    	@else
						<a href="{{url('/')}}/group/{{$event->slug}}">{{$event->groupname}}</a>.
			    	@endif
			    @endif
				@empty
					No recent events
		    @endforelse
				@if ((count($user->individual->sermons)) or (count($user->individual->blogs)))
					<a class="btn btn-primary top10" href="{{url('/')}}/people/{{$user->individual->slug}}">View {{$user->individual->firstname}}'s blogs/sermons</a>
				@endif
				@if ((!$staff) and (isset($user->individual->service_id)))
					<h4>Usual Sunday service</h4>
					{{$user->individual->service->society->society}} {{$user->individual->service->servicetime}}
				@endif
		  </div>
		  <div class="col-md-3">
		  	<h4>Recent comments</h4>
		  	<ul class="list-unstyled">
		  	@foreach ($comments as $comment)
		  	  <li class="text-left">{{date("d M",strtotime($comment->created_at))}}
			  @if (isset($comment->commentable_type))
                @if ($comment->commentable_type=="Bishopm\Churchsite\Models\Blog")
                  (blog) - <a href="{{url('/')}}/blog/{{$comment->commentable->slug}}">
                @elseif ($comment->commentable_type=="Bishopm\Churchsite\Models\Sermon")
                  (sermon) - <a href="{{url('/')}}/sermons/{{$comment->commentable->series->slug}}/{{$comment->commentable->slug}}">
                @elseif ($comment->commentable_type=="Bishopm\Churchsite\Models\Course")
                  (course) - <a href="{{url('/')}}/course/{{$comment->commentable->slug}}">
                @elseif ($comment->commentable_type=="Bishopm\Churchsite\Models\Book")
                  (book) - <a href="{{url('/')}}/book/{{$comment->commentable->slug}}">                
                @endif
                {{substr($comment->commentable->title,0,20)}}
                @if (strlen($comment->commentable->title)>20)
                  ...
                @endif
                </a>
              @else
              	(forum) - 
                @if ($comment->title)
                  posted <a href="{{url('/')}}/forum/posts/{{$comment->id}}">{{$comment->title}}</a>
                @else
                  replied to <a href="{{url('/')}}/forum/posts/{{$comment->thread}}">{{$comment->threadtitle($comment->thread)->title}}</a>
                @endif
              @endif
              </li>
            @endforeach
		  	</ul>
		  	
		  </div>
	  	@else
	  		Sorry! This user has not set up a profile yet.
	  	@endif
	  @else
		<p><a class="btn btn-primary btn-flat" href="{{url('/')}}/register">Register</a> or <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-login" data-action-target="{{ route('login') }}"><i class="fa fa-login"></i>Login</button> to view {{$user->individual->firstname}}'s user profile</p>
	  @endif
	</div>
</div>
@include('churchsite::shared.message-modal')
@endsection

@section('js')
<script type="text/javascript">
	@include('churchsite::shared.message-modal-script')
</script>
@stop