@extends('layouts.index')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm sản phẩm</h4>
                <p class="card-description">
                    Thêm sản phẩm
                </p>
                <form class="forms-sample" action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Danh mục sản phẩm</label>
                        <select class="form-control" id="exampleSelectGender" name="cate_id">
                            @foreach ($categories as $cate)
                                <option selected value="{{ $cate->cate_id }}">{{ $cate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="formbold-mb-3 formbold-input-wrapp">
                            <label for="images" class="formbold-form-label"> Ảnh sản phẩm </label>

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" name="images[]" accept="image/png, image/gif, image/jpeg"
                                            id="images" placeholder="Choose images" multiple>
                                    </div>
                                    @error('images')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="mt-1 text-center">
                                        <div class="images-preview-div d-flex"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">số lượng sản phẩm</label>
                        <input type="number" class="form-control" name="quantity" placeholder="quantity">
                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">giá </label>
                        <input type="number" class="form-control" name="price" placeholder="price" pattern='[0-9]+(\\.[0-9][0-9]?)?'>
                    </div>
                    @if ($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputCity1">giá sale</label>
                        <input type="number" class="form-control" name="sale_price" placeholder="sale_price" pattern='[0-9]+(\\.[0-9][0-9]?)?'>
                    </div>
                    @if ($errors->has('sale_price'))
                        <span class="text-danger">{{ $errors->first('sale_price') }}</span>
                    @endif
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả</label>
                        <textarea name="description" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('footer_js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var previewImages = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                imgPreviewPlaceholder);
                        }
                        console.log(input.files[i]);
                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                previewImages(this, 'div.images-preview-div');
            });
        });
    </script>
@endpush
@push('header_css')
    <style>
        .images-preview-div img {
            width: 250px;
        }
    </style>
@endpush
