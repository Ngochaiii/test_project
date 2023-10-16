@extends('layouts.index')

@section('content')
    <div class="col-12">
        <p>
            <a href="{{route('category.show')}}" class="btn btn-primary">
                <i class="fa fa fa-plus-square-o"></i>
                Tạo mới
            </a>
        </p>
    </div>
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh mục sản phẩm</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục</th>
                                <th>Created</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        @foreach ($cates as $item => $cate)
                        <tbody>
                            <tr>
                                <td>{{$item+1}}</td>
                                <td>{{$cate->name}}</td>
                                <td>{{$cate->note}}</td>
                                <td><a href="{{ route('category.edit', $cate->cate_id) }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Cập nhập</a>
                                    <a href="{{ route('category.delete', $cate->cate_id) }}" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Xóa</a></td>
                            </tr>
                        </tbody>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
