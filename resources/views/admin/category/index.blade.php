@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Category  <small>{{$caterogries->total()}}</small></h3>

                    <form action="{{route('categories.index')}}" method="get">
                        <input type="text" name="search" class="pull-right form-control" style="width: 200px" value="{{request()->search}}">
                        <input type="submit" value="search" class="btn btn-primary btn-sm pull-right" style="margin-right: 20px;" />
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($caterogries->count() > 0)
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Category name</th>
                            <th>Action</th>
                        </tr>
                        @foreach($caterogries as $index=>$caterogry)
                        <tr>
                          <td>{{$index + 1}}</td>
                          <td>{{$caterogry->name}}</td>
                          <td>
                              <a href="{{route('categories.edit',$caterogry->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>edit</a>
                             <form action="{{route('categories.destroy',$caterogry->id)}}" style="display: inline-block" method="post">
                                 {{csrf_field()}}
                                 {{method_field('delete')}}
                                 <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash"></i>delete</button>
                             </form>
                              <a href="{{route('categories.show',$caterogry->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i>show</a>
                          </td>

                        </tr>
                        @endforeach
                    </table>
                        <div style="text-align: center">{{$caterogries->appends(request()->query())->links()}}</div>
                        {{--<div style="text-align: center">{{$caterogries->links()}}</div>--}}
                        @else
                        <h2>sorry no records</h2>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    @endsection