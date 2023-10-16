@extends('layouts.index')

@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Default form</h4>
                <p class="card-description">
                    Basic form layout
                </p>
                <form method="POST" class="forms-sample" action="{{route('category.update',$dataCate->cate_id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Danh mục sản phẩm </label>
                        <input type="text" readonly class="form-control" id="exampleInputUsername1" value="{{$dataCate->cate_id}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục </label>
                        <input type="name" name="name" class="form-control" value="{{$dataCate->name}}" id="exampleInputEmail1" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Chú ý</label>
                        <textarea name="note"  class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <label style="color: brown" for="">Nội dung chú ý trước * : {{$dataCate->note}}</label>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
