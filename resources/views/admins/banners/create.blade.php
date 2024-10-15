@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý Banner</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.banners.store') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Tiêu đề banner</label>
                                            <input type="text" id="title" name="title"
                                                class="form-control @error('title')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('title') }}" placeholder="Tiêu đề banner">
                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="url" class="form-label">URL</label>
                                            <input type="text" id="url" name="url"
                                                class="form-control @error('url')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('url') }}" placeholder="http://">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="position">Vị trí</label>
                                            <select name="position" id="position" class="form-select">
                                                @foreach ($listPosition as $item)
                                                <option value="{{$item}}">{{ucfirst($item)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Thời gian bắt đầu</label>
                                            <input type="date" id="start_date" name="start_date"
                                                class="form-control @error('start_date')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">Thời gian kết thúc</label>
                                            <input type="date" id="end_date" name="end_date"
                                                class="form-control @error('end_date')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <label for="is_active" class="form-label">Trạng thái:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active" id="is_active1" value="1" checked>
                                                <label class="form-check-label text-success" for="is_active1">
                                                    Hiển thị
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active" id="is_active2" value="0">
                                                <label class="form-check-label text-danger" for="is_active2">
                                                    Ẩn
                                                </label>
                                            </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="banner" class="form-label">Banner</label>
                                            <input type="file" id="banner" name="banner"
                                                class="form-control" onchange="showbanner(event)">
                                                <img class="mt-2" id="banner_show" src="" alt="banner" style="width: 575px; display: none">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Tạo banner</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection
@section('js')
<script>
    function showbanner(event) {
        const banner = document.getElementById('banner_show');
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(){
            banner.src = reader.result;
            banner.style.display = 'block';
        }
        if (file) {
            reader.readAsDataURL(file)
        }
    }
</script>
@endsection