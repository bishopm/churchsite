@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('Edit sermon',route('series.index')) }}
@stop

@section('plugins.Select2', true)
@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('sermons.update', $sermon->id), 'method' => 'put','files'=>'true']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text" value="{{$sermon->title}}">
                    </div>
                    <div class="form-group">
                        <label for="title">Slug</label>
                        <input class="form-control" data-slug="source" placeholder="Slug" name="slug" id="slug" type="text" value="{{$sermon->slug}}">
                    </div>
                <div class="box-footer">
                    {{Form::pgButtons('Update',route('series.index')) }}
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
            format: 'YYYY-MM-DD HH:mm',
            date: '{{$sermon->publicationdate}}'
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
