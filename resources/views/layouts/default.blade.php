<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $siteTitle ?? 'test' }}</title>
    @include('layouts.web.header_css')
    @stack('header_css')
    @stack('header_js')
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel w-100">
                <div class="content-wrapper">
                    @yield('content')

                </div>
                @include('layouts.web.footer')
            </div>
        </div>
    </div>

    @stack('fjs')
</body>

</html>
