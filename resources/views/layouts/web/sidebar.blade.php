<nav class="sidebar sidebar-offcanvas" id="sidebar" style="width:300px">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                <div class="badge badge-danger">new</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Quản lý sản phẩm </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('product')}}">Thêm sản phẩm</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('product.list')}}">Danh sách sản phẩm</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="">Typography</a> --}}
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="typcn typcn-user-add-outline menu-icon"></i>
                <span class="menu-title">Quản lý người dùng</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('customers')}}"> Khách hàng </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('users')}}"> Người dùng </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('category')}}">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Quản lý danh mục </span>
            </a>
        </li>
    </ul>
</nav>
