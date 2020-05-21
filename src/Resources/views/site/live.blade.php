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
        <div v-if="live.url" style="position: relative;width: 100%;height: 0;padding-bottom: 56.25%;" :title="timenow">
            <iframe :src="'https://www.youtube-nocookie.com/embed/' + live.url + '?&modestbranding=1&playsinline=1&showinfo=0&rel=0&autoplay=true&start=' + late"
                frameborder="0" style="position:absolute;top: 20;left: 0;width: 100%;height: 100%;pointer-events: none;">
            </iframe>
        </div>
        <div v-else :title="timenow">
            <br>
            <div v-if="pending[0]" v-html="'<h4>' + pending[0].message + '</h4>'"></div>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.js"></script>
<script>
var vm1 = new Vue({
    el: '#q-app',
    data: {
        interval: null,
        videos: [],
        completed: [],
        pending: [],
        live: {},
        timenow: null,
        late: 0,
        offset: null
    },
    mounted() {
        this.offset = new Date().getTimezoneOffset() * 60;
        this.videos = <?php echo json_encode($videos);?>;
        this.timenow = Math.floor(new Date()/1000 - this.offset);
        for (var vndx in this.videos) {
            if (this.timenow >= (this.videos[vndx].duration * 60) + this.videos[vndx].broadcasttime) {
                this.completed.push(this.videos[vndx]);
            } else if (this.timenow < this.videos[vndx].broadcasttime) {
                this.pending.push(this.videos[vndx]);
            } else {
                this.live = this.videos[vndx];
            }
        }
        this.interval = setInterval(this.checktime, 1000);
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
        },
        checktime () {
            this.timenow = Math.floor(new Date()/1000 - this.offset);
            if (this.live.broadcasttime) {
                if (this.timenow >= this.live.broadcasttime + (60 * this.live.duration)) {
                    this.completed.push(this.live);
                    this.live = {};
                } else {
                    if (this.late === 0) {
                        this.late = this.timenow - this.live.broadcasttime;
                    }
                    this.live.message = 'Welcome! We started ' + this.convertsec(this.timenow - this.live.broadcasttime) + ' ago';
                }
            }
            for (var pndx in this.pending) {
                this.pending[pndx].message = 'Welcome! We\'re starting in<br>' + this.convertsec(this.pending[pndx].broadcasttime - this.timenow);
                if (this.timenow >= this.pending[pndx].broadcasttime) {
                    this.live = this.pending[pndx];
                    this.pending.splice(pndx, 1);
                    this.late = 0;
                }
            }
        }
    }
});
</script>
@stop
