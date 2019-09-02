@extends('churchsite::page')

@section('css')
@stop

@section('content_header')
    {{ Form::pgHeader('New blog post',route('blogs.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => 'blogs.store', 'method' => 'post','files'=>'true']) !!}
    <div class="row" id="unsplash">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" data-slug="source" placeholder="Title" name="title" id="title" type="text">
                    </div>
                    <div class="form-group">
                        <label for="tags">Author</label>
                        <select class="authortags form-control" name="author">
                            <option></option>
                            @foreach ($bloggers as $author)
                                <option>{{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="publicationdate">Publication date</label>
                        <div>
                            <input type="text" class="form-control datetimepicker-input" id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker" name="publicationdate"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Subject</label>
                        <select multiple="multiple" class="subjecttags form-control" name="tags[]">
                            @foreach ($subjects as $subject)
                                <option>{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div>
                            <div v-if="chosenpic.thumbnail">
                                <img :src="chosenpic.thumbnail">
                                <a href="#" @click="clearme" class="btn btn-danger">&times; Remove image</a>
                            </div>
                            <button v-else type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-modal">Search unSplash</button>
                            <input name="photographer" id="photographer" type="hidden" v-model="chosenpic.credit">
                            <input name="portfolio" id="portfolio" type="hidden" v-model="chosenpic.crediturl">
                            <input name="image" id="image" type="hidden" v-model="chosenpic.regular">
                            <input name="thumbnail" id="thumbnail" type="hidden" v-model="chosenpic.thumb">
                            <div id="unsplashModal" class="modal fade bd-modal" tabindex="-1" role="dialog" aria-labelledby="unSplash Modal" aria-hidden="true">
                                <div class="modal-dialog" style="width:95%;height=95%;">
                                    <div class="modal-content" style="width:100%;height=100%;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h3 class="text-center">Search for unSplash images</h3>
                                        </div>
                                        <input @blur="searchme" class="form-control" placeholder="search for image" id="search" v-model="search">
                                        <div class="container">
                                           <div class="row">
                                                <div v-for="pic in pics" class="col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
                                                    <img @click="chooseme(pic)" class="img-thumbnail img-fluid" :src="pic.urls.thumb">
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="summernote" name="body"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('blogs.index'))}}
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
                search: 'church',
                chosenpic: {
                    photographer: '',
                    portfolio: '',
                    image: '',
                    thumbnail: ''
                }
            },
            methods: {
                searchme(){
                    axios.get('https://api.unsplash.com/search/photos?per_page=30&orientation=landscape&client_id={{env('UNSPLASH_ACCESS_KEY')}}&query=' + this.search)
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
                    this.chosenpic = {};
                    this.imageJson = '';
                }
            }
        });
    </script>
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
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