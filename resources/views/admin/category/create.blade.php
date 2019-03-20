@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"> Add New Category </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layout.massege')
                        <form action="{{route('categories.store')}}" method="post">
                            {{csrf_field()}}
                            {{method_field('post')}}

                            <div class="form-group">
                                <label>Category name</label>
                                <input class="form-control" name="name" placeholder="Category name">
                            </div>

                            <div class="form-group">

                                <input type="submit" class="form-control btn btn-info btn-sm"  value="add" />
                            </div>
                        </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection