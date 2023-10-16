@extends('layouts.index')

@section('content')
    <div class="row">

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
                                <th>Chức năng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->is_activeName }} </td>
                                    @if ($item->is_active == 0)
                                        <td>
                                            <a href="{{route('grant_benefits',$item->id)}}" class="btn btn-primary btn-sm mb-2 mr-2">
                                                Cập nhật quyền
                                            </a>
                                        </td>
                                    @endif
                                    @if ($item->is_active == 1 && $item->role == 0)
                                        <td>
                                            <a href="{{route('delete_grant_benefits',$item->id)}}" class="btn btn-primary btn-sm mb-2 mr-2">
                                                Hủy quyền
                                            </a>
                                        </td>
                                    @endif
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
