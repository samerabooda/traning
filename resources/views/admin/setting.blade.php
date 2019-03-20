@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Setting</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                @include('admin.layout.massege')
                <form method="post" action="{{route('post-setting',setting()->id)}}">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Sitename</label>
                            <input type="text" class="form-control" value="{{setting()->sitename}}" name="sitename">
                        </div>
                        <div class="form-group">
                            <label for="">SiteEmailAddress</label>
                            <input type="email" class="form-control" value="{{setting()->siteEmailAddress}}" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">SiteKeywords</label>
                            <textarea type="text" class="form-control" name="keyword">{{setting()->siteKeywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">SiteDescrption</label>
                            <textarea type="text" class="form-control ckeditor" name="descrption" > {{setting()->siteDescription}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Maintanance</label>
                            <select class="form-control" name="maintance">
                                <option value="">maintance</option>
                                <option value="1" {{setting()->maintenance == '1' ? 'selected': ''}}>Enable</option>
                                <option value="0" {{setting()->maintenance == '0' ? 'selected': ''}}>Disable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Maintance massege</label>
                            <textarea type="text" class="form-control ckeditor" name="maintancemassege">{{setting()->maintenance_massage}}</textarea>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>

        </div>

    @endsection