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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.categories.store') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên danh mục</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('name') }}" placeholder="Tên danh mục">
                                            @error('name')
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

                                    {{-- <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input type="file" id="logo" name="logo"
                                                class="form-control" onchange="showLogo(event)">
                                                <img class="mt-2" id="logo_category" src="" alt="Logo" style="width: 150px; display: none">
                                        </div>
                                    </div> --}}
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
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
    
@endsection