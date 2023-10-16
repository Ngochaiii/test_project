@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="card-body card-block">

                        <div class="form-group">
                            <label for="name" class=" form-control-label">Tên khách hàng</label>
                            <input type="text" required name="name" value="{{ $form_data->name }}"
                                placeholder="Tên hiển thị" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Email</label>
                                    <input type="text" name="email" value="{{ $form_data->email }}"
                                        placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Số điện thoại</label>
                                    <input type="text" name="phone" value="{{ $form_data->phone }}"
                                        placeholder="Số điện thoại" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Thành phố</label>
                                    <input type="text" name="city" value="{{ $form_data->city }}"
                                        placeholder="Thành phố" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Quận/Huyện</label>
                                    <input type="text" name="district" value="{{ $form_data->district }}"
                                        placeholder="Quận/Huyện" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Địa chỉ cụ thể</label>
                                    <input type="text" name="specific_address" value="{{ $form_data->district }}"
                                        placeholder="Địa chỉ cụ thể" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p class="text-right mb-0">
                            @if ($form_data->id)
                                <button class="btn btn-danger"
                                    formaction="">Xóa</button>
                            @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
