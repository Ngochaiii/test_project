@extends('layouts.index')

@section('content')
    <h4 style="text-align:center">Thông tin cá nhân khách hàng</h4>
    <div class="card">
        <div class="examples" style="padding: 20px;">
            <div class="unstyled">
                <h3>Khách hàng </h3>
                <address>
                    <a>{{ $customer->name }}</a>.<br>

                    Email address : <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>.<br>
                    You may also
                    want to call phone number : <a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a>
                    <br> Địa chỉ khách hàng <br> {{ $customer->city }}<br> {{ $customer->district }}<br>
                    Địa chỉ cụ thể {{ $customer->specific_address }}
                    <br> The World
                </address>
            </div>
        </div>

        <p style="padding: 20px;" class="more">Yêu cầu xác nhận khi hoàn thành liên hệ với khách hàng</p>
        <div class="d-flex flex-row-reverse bd-highlight p-2">
            <a href="{{route('customers.cancel',$customer->id)}}" class="btn btn-danger btn-sm mb-2 mr-2">
                Hủy
            </a>
            <a href="{{route('customers.change',$customer->id)}}" class="btn btn-primary btn-sm mb-2 mr-2">Xác nhận đã gửi </a>
        </div>
    </div>
@endsection
@push('header_css')
    <style>
        * {
            box-sizing: border-box;
        }

        html {
            font-family: 'Lato';
            text-align: justify;
            font-size: 1.25em;
            margin: 20px;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 50px;
        }

        h3 {
            margin-top: 50px;
        }

        .foot-link {
            text-decoration: none;
            color: cornflowerblue;
        }

        .more {
            color: black;
            text-align: right;
            margin-top: 80px;
        }

        .examples .styled address {
            color: #606060;
            text-align: right;
        }

        .examples .styled address a {
            font-color: cornflowerblue;
        }
    </style>
@endpush
