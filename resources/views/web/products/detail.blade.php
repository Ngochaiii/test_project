@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <form action="{{ route('product.update', $products->product_id) }}" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="wrapper row">
                        @php
                            $dataImageProducts = json_decode($products->pro_image, true);
                            // dd($dataImageProducts);
                        @endphp
                        <div class="preview col-md-6">
                            <div class="preview-pic tab-content">
                                @if (is_array($dataImageProducts) || is_object($dataImageProducts))
                                    @foreach ($dataImageProducts as $item => $image)
                                        <div class="tab-pane active" id="pic-{{ $item }}"><img
                                                src="{{ asset('/files/' . $image) }}" /></div>
                                    @endforeach
                                @endif
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                @if (is_array($dataImageProducts) || is_object($dataImageProducts))
                                    @foreach ($dataImageProducts as $item => $image)
                                        <li class="active"><a data-target="#pic-{{ $item }}" data-toggle="tab"><img
                                                    src="{{ asset('/files/' . $image) }}" /></a></li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="formbold-mb-3 formbold-input-wrapp">
                                <label for="phone" class="formbold-form-label"> Ảnh sản phẩm </label>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="file" name="pro_image[]"
                                                accept="image/png, image/gif, image/jpeg" id="images"
                                                placeholder="Choose images" multiple>
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
                        <div class="details col-md-6">
                            <input class="product-title" value="{{ $products->name }}" name="name">
                            <label for="exampleSelectGender">Danh mục sản phẩm</label>
                            <select class="form-control" id="exampleSelectGender" name="cate_id">
                                <option selected="selected">
                                    {{ $products->category->name }}
                                </option>
                                @foreach ($categories as $cate)
                                    <option selected value="{{ $cate->cate_id }}">{{ $cate->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="rating">
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                                <span class="review-no">41 reviews</span>
                            </div>
                            <label for="description">Mô tả</label>
                            <input class="product-description" value="{{ $products->description }}" name="description">

                            <h6 class="price">sale price: <span><input type="number" name="sale_price"
                                        value="{{ number_format($products->sale_price, 0, '', ',') }}"></span></h6>
                            <h4 class="price">current price: <span><input type="number" name="price"
                                        value="{{ $products->price }}"></span></h4>
                            <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87
                                    votes)</strong>
                            </p>
                            <label for="exampleInputCity1">số lượng sản phẩm</label>
                            <input type="number" class="form-control" value="{{$products->quantity}}" name="quantity" placeholder="quantity">
                            <div class="action">
                                <button class="add-to-cart btn btn-default" type="submit">update</button>
                                <button class="like btn btn-default" type="button"><span
                                        class="fa fa-heart">Delete</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('header_css')
    <style>
        .images-preview-div img {
            width: 250px;
        }

        /*****************globals*************/
        body {
            font-family: 'open sans';
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
        }

        .preview {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px;
            }
        }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px;
        }

        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%;
        }

        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block;
        }

        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0;
        }

        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0;
        }

        .tab-content {
            overflow: hidden;
        }

        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s;
        }

        .card {
            margin-top: 50px;
            background: #eee;
            padding: 3em;
            line-height: 1.5em;
        }

        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
            }
        }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .product-title,
        .price,
        .sizes,
        .colors {
            text-transform: UPPERCASE;
            font-weight: bold;
        }

        .checked,
        .price span {
            color: #ff9f1a;
        }

        .product-title,
        .rating,
        .product-description,
        .price,
        .vote,
        .sizes {
            margin-bottom: 15px;
        }

        .product-title {
            margin-top: 0;
        }

        .size {
            margin-right: 10px;
        }

        .size:first-of-type {
            margin-left: 40px;
        }

        .color {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            height: 2em;
            width: 2em;
            border-radius: 2px;
        }

        .color:first-of-type {
            margin-left: 20px;
        }

        .add-to-cart {
            background: #e3df1d;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
        }

        .like {
            background: #ff1a1a;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
        }

        .add-to-cart:hover,
        .like:hover {
            background: #b36800;
            color: #fff;
        }

        .not-available {
            text-align: center;
            line-height: 2em;
        }

        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff;
        }

        .orange {
            background: #ff9f1a;
        }

        .green {
            background: #85ad00;
        }

        .blue {
            background: #0076ad;
        }

        .tooltip-inner {
            padding: 1.3em;
        }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        /*# sourceMappingURL=style.css.map */
    </style>
@endpush
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
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
@endpush
