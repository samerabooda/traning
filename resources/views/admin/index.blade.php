@extends('admin.layout.master')
@section('content')

    <!-- Small boxes (Stat box) -->

    <div class="row">
        <div class="col-lg-12col-xs-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 style="text-align: center">Welcome to Admin Control</h3>


                    <p style="font-family: 'sans-serif';font-size: large">Welcome :  {{auth()->guard('admin')->user()->name}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dashboard"></i>
                </div>

            </div>
        </div>



        <div class="col-lg-6 col-xs-9">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{\App\Category::orderBy('id','=','desc')->count()}}</h3>

                    <p>Categories Count</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-9">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{\App\Neww::orderBy('id','=','desc')->count()}}</h3>

                    <p>news Count</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>

            </div>
        </div>
        <!--
        <!-- ./col -->
    </div>
    <!-- /.row -->


@endsection