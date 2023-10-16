<form method="GET">
    @csrf
    <div class="row mb-3">
        <div class="col-md-2">
            <input type="text" name="name" value="{{ $filters['name'] }}" class="form-control" placeholder="Tên KH">
        </div>
        <div class="col-md-2">
            <input type="text" name="phone" value="{{ $filters['phone'] }}" class="form-control" placeholder="Số điện thoại">
        </div>
        <div class="col-md-2">
            <input type="text" name="email" value="{{ $filters['email'] }}" class="form-control" placeholder="Email">
        </div>
        <div class="col-md-2">
            <input type="text" name="city" value="{{ $filters['city'] }}" class="form-control" placeholder="Thành phố">
        </div>
        <div class="col-md-2">
            <input type="text" name="district" value="{{ $filters['district'] }}" class="form-control" placeholder="Quận/Huyện">
        </div>
        <div class="col-md">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search mr-1"></i> Tìm kiếm
            </button>
            <a href="{{ url()->current() }}" class="btn btn-defautl">
                <i class="fa fa-rotate-left mr-1"></i> Xóa tìm kiếm
            </a>
        </div>
    </div>
</form>
