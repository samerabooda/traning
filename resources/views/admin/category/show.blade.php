@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"> show this Category </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="info">
                            <h2 style="text-align: center">
                               {{$category->name}}
                            </h2>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection