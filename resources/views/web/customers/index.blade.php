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
                                <th scope="col">#</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Số điện thoại </th>
                                <th scope="col">Email</th>
                                <th scope="col">Địa chỉ cụ thể</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ substr($item->email, 0, 10) . '...' }}</td>
                                    <td>{{ substr($item->specific_address, 0, 10) . '...' }} </td>
                                    <td>{{ $item->statusName }}</td>
                                    <td>
                                        <div style="display:grid;">
                                            <a style="font-size: 10px" href="{{ route('customers.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm mb-2 mr-2">
                                                Chi tiết
                                            </a>
                                            @if ($item->status != 1)
                                                <a style="font-size: 10px" href="{{ route('customers.show', $item->id) }}"
                                                    class="btn btn-primary btn-sm mb-2 mr-2">Gửi mail </a>
                                            @endif
                                        </div>


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
@push('header_css')
    <style>
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            /* table-layout: fixed; */
        }

        .table thead th {
            border-top: 0;
            border-bottom-width: 1px;
            font-weight: 300;
            font-size: 12px;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .10em;
        }

        table th,
        table td {
            padding: .300em;
            text-align: left;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .300em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
                    * aria-label has no advantage, it won't be read inside a table
                    content: attr(aria-label);
                    */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        .table td {
            font-size: 10px;
        }
    </style>
@endpush
