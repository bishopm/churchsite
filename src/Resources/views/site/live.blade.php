@extends('churchsite::templates.frontend')

@section('title','Streaming video')

@section('css')
<style>
.livevideo {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    position: absolute;
}
</style>
@stop

@section('content')
    <div id="q-app">
        @forelse ($videos as $video)
            <div style="position: relative;width: 100%;height: 0;padding-bottom: 56.25%;">
                <span>{{$video->status}}: {{$video->title}}  ({{$video->readable}}) {{$video->message}}</span>
                <iframe src="https://www.youtube-nocookie.com/embed/{{$video->url}}?&modestbranding=1&playsinline=1&showinfo=0&rel=0&start=0"
                    frameborder="0" style="position: absolute;top: 20;left: 0;width: 100%;height: 100%;">
                </iframe>
            </div>
        @empty
            There are no live events at present
        @endforelse
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.js"></script>
<script>
var vm1 = new Vue({
    el: '#q-app',
    data: {
        intervalHandle: null,
        events: [],
        timenow: {}
    },
    mounted() {
        this.events = <?php echo json_encode($videos);?>;
        this.intervalHandle = setInterval(() => {
        for (var endx in this.events) {
            this.events[endx].timetogo = (Date.now()/1000) - this.events[endx].broadcasttime;
            if (this.events[endx].timetogo > 0) {
                this.events[endx].status = 'PENDING';
                this.events[endx].message = 'We are live in: ' + this.convertsec(this.events[endx].timetogo);
            } else if (this.events[endx].timetogo < -60 * this.events[endx].duration) {
                this.events[endx].status = 'COMPLETED';
                this.events[endx].message = 'Broadcast ended: ' + this.convertsec(-1 * this.events[endx].timetogo) + ' ago';
            } else {
                this.events[endx].status = 'LIVE';
                this.late = -1 * this.events[endx].timetogo;
                this.events[endx].timetogo = this.convertsec(this.late);
                this.events[endx].message = '';
                this.startvideo = true;
            }
        }
        }, 1000);
    },
    methods: {
        convertsec (timetogo) {
            var d = Math.floor(timetogo / (3600 * 24));
            var h = Math.floor(timetogo % (3600 * 24) / 3600);
            var m = Math.floor(timetogo % 3600 / 60);
            var s = Math.floor(timetogo % 60);
            var dDisplay = d > 0 ? d + (d === 1 ? ' day ' : ' days ') : '';
            var hDisplay = h > 0 ? h + (h === 1 ? ' hour ' : ' hours ') : '';
            var mDisplay = m > 0 ? m + (m === 1 ? ' minute ' : ' minutes ') : '';
            var sDisplay = s > 0 ? s + (s === 1 ? ' second' : ' seconds') : '';
            return dDisplay + hDisplay + mDisplay + sDisplay;
        }
    }
});
</script>
@stop
