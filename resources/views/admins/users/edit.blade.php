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
                    <h4 class="fs-18 fw-semibold m-0">Chỉnh sửa tài khoản</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.users.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên người dùng</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('name', $user->name) }}" placeholder="Tên người dùng">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <input type="text" id="address" name="address"
                                                class="form-control @error('address')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('address', $user->address) }}" placeholder="Địa chỉ">
                                            @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <label for="status" class="form-label">Trạng thái:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1"
                                                    value="Active" {{ $user->status === 'Active' ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="status1">
                                                    Hiển thị
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status2"
                                                    value="Inactive" {{ $user->status === 'Inactive' ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="status2">
                                                    Ẩn
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="text" id="phone" name="phone"
                                                class="form-control @error('phone')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('phone', $user->phone) }}" placeholder="Số điện thoại">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Avatar</label>
                                            <input type="file" id="avatar" name="avatar"
                                                class="form-control @error('avatar')
                                                is-invalid
                                            @enderror">
                                            @error('avatar')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Thay đổi</button>
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
