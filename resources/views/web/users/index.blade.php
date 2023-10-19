@extends('layouts.index')

@section('content')
    <div class="row">
        {{-- {{dd(Auth::user())}} --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('web.users._blocks.filter')
                    <table id="jsElDataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $item)
                                @php
                                    $status = json_decode($item->is_active, true);
                                    $module = json_decode($item->module, true);
                                    // dd(is_null($module['customer']))
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->is_activeName }} </td>
                                    <form action="{{ route('grant_benefits', $item->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <td>
                                            @if ($item->role != 1)
                                                <div class="d-flex">
                                                    <div class="" style="display: grid;">
                                                        <span>
                                                            <input type="checkbox" name="add" value="1"
                                                                @if (isset($status['add'])) checked @endif>

                                                            Thêm</span>
                                                        <span><input style="margin-top:5px" type="checkbox" name="edit"
                                                                value="2"
                                                                @if (isset($status['edit'])) checked @endif>
                                                            Sửa </span>
                                                        <span><input style="margin-top:5px" type="checkbox" name="delete"
                                                                value="3"
                                                                @if (isset($status['delete'])) checked @endif>
                                                            Xóa</span>
                                                    </div>
                                                    <div class=""style="display: grid;padding-left:15px">
                                                        <label for="">Cho tính năng</label>

                                                        <span><input style="margin-top:5px" type="checkbox" name="product"
                                                                value="2" @if (isset($module['product'])) checked @endif>
                                                            QL sản phẩm </span>
                                                        <span><input style="margin-top:5px" type="checkbox" name="customer"
                                                                value="3"@if (isset($module['customer'])) checked @endif>
                                                            QL Khách hàng</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->role != 1)
                                                <button type="submit" class="btn btn-primary btn-sm mb-2 mr-2">
                                                    Cập nhật quyền
                                                </button>
                                            @endif

                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_js')
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
@endpush
