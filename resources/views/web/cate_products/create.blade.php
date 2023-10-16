@extends('layouts.index')

@section('content')
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm danh mục sản phẩm</h4>
                <p class="card-description">
                    Thêm danh mục sản phẩm
                </p>
                <form class="forms-sample" method="POST" action="{{route('category.add')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tên danh mục</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="exampleInputUsername2" placeholder="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Note</label>
                        <div class="col-sm-9">
                            <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
