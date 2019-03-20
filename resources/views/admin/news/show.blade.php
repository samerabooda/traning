@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"> show this new </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="info">
                            <div class="col-lg-4">
                                <label>Title :</label><br>
                               {{$news->title}}
                            </div>
                        <div class="col-lg-4">
                            <label>Image Uploade Main :</label><br>
                           <img src=" {{$news->image_path}}" width="100px;">
                        </div>
                        <div class="col-lg-4">
                            <label>Category :</label><br>
                            {{$news->category->name}}
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <label>New Content :</label><br>
                            {!! $news->content !!}
                        </div>

                    </div>



                </div>

                {{--<form action="{{route('upload-image',$news->id)}}" method="post" class="dropzone" id="dropZoneFileUpload" >--}}
                        {{--{{csrf_field()}}--}}
                    {{--{{method_field('post')}}--}}
                 {{----}}
                {{--</form>--}}
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection
@section('footer')

    {{--<script>--}}
        {{--Dropzone.autoDiscover = false;--}}
        {{--$(document).ready(function () {--}}
            {{--$('#dropZoneFileUpload').dropzone({--}}
                {{--url:"{{route('upload-image',$news->id)}}",--}}
                {{--paramName:'file',--}}
                {{--uploadMultiple:false,--}}
                {{--maxFiles:15,--}}
                {{--maxFilessize:2,--}}
                {{--acceptedFiles:'image/*',--}}
                {{--dictDefaultMessage:'يرجي ادراج الملفات',--}}
                {{--params:{--}}
                    {{--_token:'{{csrf_token()}}'--}}
                {{--},--}}



            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection