@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"> edit New  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layout.massege')
                    <form action="{{route('news.update',$editnew->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}

                        <div class="form-group">
                            <label>title</label>
                            <input type="text" class="form-control" name="title" placeholder="title" value="{{$editnew->title}}">
                        </div>

                        <div class="form-group">
                            <label>Upload Main Image</label>
                            <input type="file" class="form-control image" name="mainImage">
                        </div>
                        <div class="form-group">
                            <img src="{{$editnew->image_path}}" style="width: 120px;" class="image-reviw"/>
                        </div>
                        <div class="form-group">
                            <label>Category name</label>
                            <select name="cat_name" class="form-control">
                                @foreach($category as $cat)
                                    <option value="{{$cat->id}}" {{$cat->id == $editnew->category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>news Content </label>
                            <textarea class="form-control ckeditor" name="content">{{$editnew->content}}</textarea>

                        </div>
                        <div class="form-group">
                            <label>Uplode drop zone </label>
                            <div class="dropzone" id="dropZoneFileUpload"></div>

                        </div>
                        <div class="form-group">

                            <input type="submit" class="form-control btn btn-info btn-sm"  value="edit" />
                        </div>
                    </form>
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
                url:"{{route('upload-image',$editnew->id)}}",
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


    @endsection