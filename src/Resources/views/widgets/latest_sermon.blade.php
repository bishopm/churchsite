<h5 class="text-center pb-2 theme-secondary"><i class="fa fa-microphone fa-lg pr-3"></i>Last Sunday</h5>
@if ($sermon)
@push('childcss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.2/plyr.css">
@endpush
<div>
    <ul class="nav nav-pills mb-3" style="display:inline-block;" role="tablist">
        @if ($sermon->mp3)
        <li class="nav-item" style="display:inline;">
            <a class="nav-link active float-left" href="#audioTab" data-toggle="pill">Audio</a>
        </li>
        @endif
        @if($sermon->video)
        <li class="nav-item" style="display:inline;">
            <a class="nav-link float-left" href="#videoTab" data-toggle="pill">Video</a>
        </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        @if ($sermon->mp3)
        <div class="tab-pane fade show active bg-dark text-white" id="audioTab" role="tabpanel" style="border-radius: 8px 8px;">
            <div class="small">{{date("d M Y",strtotime($sermon->servicedate))}}: {{$sermon->readings}}</div>
            <img width="82px" style="float:left;" src="{{url('/')}}/storage/sermons/{{$sermon->series->image}}" style="border-radius: 8px">
            <div style="background-color: {{json_decode($widget->data)->background}};padding:3px;" class="text-left text-dark">
                <audio id="aplayer" controls style="--plyr-color-main: {{json_decode($widget->data)->colour}}; --plyr-audio-controls-background: {{json_decode($widget->data)->background}};">
                    <source src="{{$sermon->mp3}}">
                </audio>
                <span class="pl-3">{{$sermon->title}} | <a href="{{route('site.people',[$sermon->preacher])}}">{{$sermon->preacher}}</a></span>
            </div>
            <div class="text-justify p-2" style="line-height:0.8rem;">
                <span class="small"><b>{{$sermon->series->title}}</b> <i>({{$sermon->series->description}})</i></span>
            </div>
            <a href="{{route('series.index')}}">More sermons</a>
        </div>
        @endif
        @if ($sermon->video)
        <div class="tab-pane fade" id="videoTab" role="tabpanel">
            <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{$sermon->video}}"></div>
        </div>
        @endif
    </div>
</div>
@push('childjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.2/plyr.min.js">
    </script>
    <script>
        const aplayer = new Plyr('audio', {});
        window.aplayer = aplayer;
        const player = new Plyr('#player', {});
        window.player = player;
    </script>
@endpush
@endif