@extends('layouts.index')

@section('content')
    <div class="col-12">
        <p>
            <a href="{{ route('product') }}" class="btn btn-primary">
                <i class="fa fa fa-plus-square-o"></i>
                Thêm sản phẩm
            </a>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('web.products._blocks.filter')
                <div class="table-responsive pt-3">
                    <table class="table table-striped project-orders-table">
                        <thead>
                            <tr>
                                <th class="ml-5">ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá </th>
                                <th>Giá sale</th>
                                <th>thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            {{-- {{dd($product->category)}} --}}
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$product->name}} </td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('product.edit', $product->product_id)}}" type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Edit
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </a>
                                            <a href="{{route('product.delete',$product->product_id)}}" type="button" class="btn btn-danger btn-sm btn-icon-text">
                                                Delete
                                                <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
