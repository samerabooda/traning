@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"> Add New  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layout.massege')
                        <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('post')}}

                            <div class="form-group">
                                <label>title</label>
                                <input type="text" class="form-control" name="title" placeholder="title">
                            </div>

                            <div class="form-group">
                                <label>Upload Main Image</label>
                                <input type="file" class="form-control image" name="mainImage">
                            </div>
                            <div class="form-group">
                                <img src="{{asset('public/upload/default.png')}}" style="width: 120px;" class="image-reviw"/>
                            </div>
                            <div class="form-group">
                                <label>Category name</label>
                                <select name="cat_name" class="form-control">
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>news Content </label>
                                <textarea class="form-control ckeditor" name="content"></textarea>

                            </div>
                            <div class="form-group">
                                <label>Uplode drop zone </label>
                                <div class="dropzone" id="dropZoneFileUpload"></div>

                            </div>

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-info btn-sm"  value="add" />
                            </div>
                        </form>
                    {{--<form action="{{route('news.store')}}"--}}

                          {{--class="dropzone"--}}
                          {{--id="my-awesome-dropzone">{{csrf_field()}}</form>--}}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection
@section('footer')

    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
             $('#dropZoneFileUpload').dropzone({
                url:"{{route('upload-image',1)}}",
                 paramName:'file',
                 uploadMultiple:false,
                 maxFiles:15,
                 maxFilessize:2,
                 acceptedFiles:'image/*',
                 dictDefaultMessage:'يرجي ادراج الملفات',
                params:{
                    _token:'{{csrf_token()}}'
                },



            });
        });



    </script>
    {{--<script>--}}
        {{--Dropzone.options.myDropzone= {--}}
            {{--url: '',--}}
            {{--autoProcessQueue: false,--}}
            {{--uploadMultiple: true,--}}
            {{--parallelUploads: 5,--}}
            {{--maxFiles: 5,--}}
            {{--maxFilesize: 1,--}}
            {{--acceptedFiles: 'image/*',--}}
            {{--addRemoveLinks: true,--}}
            {{--init: function() {--}}
                {{--dzClosure = this; // Makes sure that 'this' is understood inside the functions below.--}}

                {{--// for Dropzone to process the queue (instead of default form behavior):--}}
                {{--document.getElementById("submit-all").addEventListener("click", function(e) {--}}
                    {{--// Make sure that the form isn't actually being sent.--}}
                    {{--e.preventDefault();--}}
                    {{--e.stopPropagation();--}}
                    {{--dzClosure.processQueue();--}}
                {{--});--}}

                {{--//send all the form data along with the files:--}}
                {{--this.on("sendingmultiple", function(data, xhr, formData) {--}}
                    {{--formData.append("firstname", jQuery("#firstname").val());--}}
                    {{--formData.append("lastname", jQuery("#lastname").val());--}}
                {{--});--}}
            {{--}--}}
        {{--}    </script>--}}
    @endsection