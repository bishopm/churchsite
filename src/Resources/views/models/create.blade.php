@extends('churchsite::templates.backend')

@section('css')

@stop

@section('content_header')
    {{ Form::pgHeader('Add blog post','Blogs',route('admin.blogs.index')) }}
@stop

@section('content')
    @include('churchsite::shared.errors')
    {!! Form::open(['route' => array('admin.blogs.store'), 'method' => 'post','files'=>'true']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body">
                    @include('churchsite::blogs.partials.create-fields')
                </div>
                <div class="box-footer">
                    {{Form::pgButtons('Create',route('admin.blogs.index')) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script src="{{ asset('/vendor/bishopm/js/selectize.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote-cleaner@1.0.0/summernote-cleaner.min.js" type="text/javascript"></script>
    <script src="{{ asset('/vendor/bishopm/js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/vendor/bishopm/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.input-tags').selectize({
              plugins: ['remove_button'],
              openOnFocus: 0,
              maxOptions: 30,
              dropdownParent: "body",
              create: function(value) {
                  return {
                      value: value,
                      text: value
                  }
              }
            });            
            $('.selectize').selectize({
              plugins: ['remove_button'],
              openOnFocus: 0
            }); 
            $('#created_at').datetimepicker({
                format: 'YYYY-MM-DD HH:mm'
            });           
            $('#body').summernote({ 
              height: 250,
              toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['table', ['table']],
                ['link', ['linkDialogShow', 'unlink']],
                ['view', ['fullscreen', 'codeview']],
                ['para', ['ul', 'ol', 'paragraph']]
              ],
              cleaner:{
                notTime: 2400, // Time to display Notifications.
                action: 'paste', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline: '<p></p>', // Summernote's default is to use '<p><br></p>'
                notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
                icon: '<i class="note-icon">[Your Button]</i>',
                keepHtml: false, // Remove all Html formats
                keepClasses: false, // Remove Classes
                badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'font', 'noscript', 'html'], 
                badAttributes: ['style', 'start','p'] // Remove attributes from remaining tags
              }
            });
            $('#title').on('input', function() {
                var slug = $("#title").val().toString().trim().toLowerCase().replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "");
                $("#slug").val(slug);
            });
        });
    </script>
@stop