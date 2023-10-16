<form method="GET">
    @csrf
    <div class="row mb-3">
        <div class="col-md-2">
            <input type="text" name="name" value="{{ $filters['name'] }}" class="form-control" placeholder="Tên KH">
        </div>
        <div class="col-md-2">
            <input type="text" name="email" value="{{ $filters['email'] }}" class="form-control" placeholder="Email">
        </div>
        <div class="col-md-2">
            <select class="form-control" name="is_active">
                <option disabled selected>-- Trạng thái --</option>
                {!! renderArrayOptions($is_active, $filters['is_active']) !!}
            </select>
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
