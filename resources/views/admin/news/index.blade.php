@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">news  <small>{{$news->total()}}</small></h3>

                    <form action="{{route('news.index')}}" method="get">
                        <input type="text" name="search" class="pull-right form-control" style="width: 200px" value="{{request()->search}}">
                        <input type="submit" value="search" class="btn btn-primary btn-sm pull-right" style="margin-right: 20px;" />
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($news->count() > 0)
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>news title</th>
                            <th>news title</th>
                            <th>Action</th>
                        </tr>
                        @foreach($news as $index=>$new)
                        <tr>
                          <td>{{$index + 1}}</td>
                          <td>{{$new->title}}</td>
                          <td><img src="{{$new->image_path}}" style="width: 100px;"></td>
                          <td>
                              <a href="{{route('news.edit',$new->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>edit</a>
                             <form action="{{route('news.destroy',$new->id)}}" style="display: inline-block" method="post">
                                 {{csrf_field()}}
                                 {{method_field('delete')}}
                                 <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash"></i>delete</button>
                             </form>
                              <a href="{{route('news.show',$new->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i>show</a>
                          </td>

                        </tr>
                        @endforeach
                    </table>
                        <div style="text-align: center">{{$news->appends(request()->query())->links()}}</div>
                        {{--<div style="text-align: center">{{$news->links()}}</div>--}}
                        @else
                        <h2>sorry no records</h2>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    @endsection