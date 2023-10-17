@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="col-12">
            <p>
                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                    <i class="fa fa fa-plus-square-o"></i>
                    Tạo mới
                </a>
            </p>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('web.customers._blocks.filter')
                    <table id="jsElDataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại </th>
                                <th>Email</th>
                                <th>Thành phố</th>
                                <th>Quận/huyện</th>
                                <th>Địa chỉ cụ thể</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->district }}</td>
                                    <td>{{ $item->specific_address }} </td>
                                    <td>{{ $item->statusName }}</td>
                                    <td>
                                        <a href="{{ route('customers.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm mb-2 mr-2">
                                            Cập nhật
                                        </a>
                                        @if ($item->status != 1)
                                            <a href="{{ route('customers.show', $item->id) }}"
                                                class="btn btn-primary btn-sm mb-2 mr-2">Gửi mail </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    {!! $customers->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
