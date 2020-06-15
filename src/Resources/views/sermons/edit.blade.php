@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Edit sermon','Series sermons', route('series.show', [$sermon->series_id])) }}
@stop

@section('plugins.Select2', true)
@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('sermons.update', [$sermon->id]), 'method' => 'put','files'=>'true']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text" value="{{$sermon->title}}">
                    </div>
                    <div class="form-group">
                        <label for="tags">Preacher</label>
                        <select class="preachertags form-control" name="preacher">
                            <option></option>
                            @foreach ($preachers as $preach)
                                @if ($preacher == $preach->name)
                                    <option selected>{{$preach->name}}</option>
                                @else
                                    <option>{{$preach->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="servicedate">Service date</label>
                        <div>
                            <input type="text" class="form-control datetimepicker-input" id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker" name="servicedate"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="readings">Readings</label>
                        <input class="form-control" data-slug="source" placeholder="Readings" name="readings" id="readings" type="text" value="{{$sermon->readings}}">
                    </div>
                    <div class="form-group">
                        <label for="mp3">Mp3 file [{{$sermon->mp3}}]</label>
                        <input class="form-control" placeholder="MP3" name="mp3" id="mp3" type="file">
                    </div>
                    <div class="form-group">
                        <label for="mp3">Video</label>
                        <input class="form-control" placeholder="Video url" name="video" id="video" type="text" value="{{$sermon->video}}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            @if ($sermon->status == "Draft")
                                <option selected>Draft</option>
                                <option>Published</option>
                            @else
                                <option>Draft</option>
                                <option selected>Published</option>
                            @endif
                        </select>
                    </div>
                </div>
                <input type="hidden" name="series_id" value="{{$series}}">
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('series.index',$sermon->id)) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <link href="{{asset('vendor/bishopm/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/bishopm/js/moment.min.js')}}"></script>
    <script src="{{asset('vendor/bishopm/js/datetimepicker.js')}}"></script>
    <script src="{{asset('vendor/bishopm/css/datetimepicker.css')}}"></script>
    <script src="{{asset('vendor/bishopm/summernote.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var app=new Vue({
            el: '#unsplash',
            data: {
                pics: [],
                search: '',
                chosenpic: {
                    photographer: '',
                    portfolio: '',
                    image: '',
                    thumbnail: ''
                }
            },
            mounted () {
                if ('{{$sermon->image}}' !== '') {
                    this.chosenpic.photographer = '{{$sermon->photographer}}';
                    this.chosenpic.portfolio = '{{$sermon->portfolio}}';
                    this.chosenpic.image = '{!!$sermon->image!!}';
                    this.chosenpic.thumbnail = '{!!$sermon->thumbnail!!}';
                }
            },
            methods: {
                searchme(){
                    axios.get('https://api.unsplash.com/search/photos?per_page=50&client_id={{env('UNSPLASH_ACCESS_KEY')}}&query=' + this.search)
                    .then(response => {
                        this.pics = response.data.results;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },
                chooseme(pic){
                    this.chosenpic.photographer = pic.user.name;
                    this.chosenpic.portfolio = pic.user.links.portfolio;
                    this.chosenpic.image = pic.urls.regular;
                    this.chosenpic.thumbnail = pic.urls.thumb;
                    $('#unsplashModal').modal('hide');
                },
                clearme() {
                    this.chosenpic.photographer = '';
                    this.chosenpic.portfolio = '';
                    this.chosenpic.image = '';
                    this.chosenpic.thumbnail = '';
                    this.imageJson = '';
                }
            }
        });
    </script>
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            date: '{{$sermon->servicedate}}'
        });
        $('.authortags').select2({
            placeholder: 'Select or add author',
            tags: true,
            width: '100%'
        });
        $('.subjecttags').select2({
            placeholder: 'Select one or more subject tags',
            tags: true,
            width: '100%'
        });
        $(document).ready(function() {
            $('#summernote').summernote({height: 200});
        });
    </script>
@stop
