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

            <div class="pt-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                </div>
                <a href="{{ route('admins.banners.create') }}" class="btn btn-success m-1"><i data-feather='plus-square'> </i>
                    <i data-feather='image'> </i> Thêm banner</a>
            </div>

            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                 <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title mb-0 align-content-center">Banner slider index</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                @foreach ($listBanner as $index => $item)
                                    @if ($item->position == 'index')
                                        <tr>
                                            <td style="width: 50%">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="cart">
                                                            <div class="cart-header">
                                                                <img src="{{ Storage::url($item->banner) }}" alt=""
                                                                    style="width: 100%">
                                                            </div>
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admins.banners.destroy', $item->id) }}"
                                                                    method="post" class="d-inline"
                                                                    onsubmit="return confirm('Chắc chắn xóa banner này?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="d-flex justify-content-center">
                                                                        <button type="submit" class="border-0 bg-white"><i
                                                                                class="btn mdi mdi-delete bg-danger text-white fs-18 rounded-2 border p-1">Delete</i></button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card mb-0">

                                                            <div class="card-header">
                                                                <h5 class="card-title mb-0">Banner : {{ $item->title }}
                                                                </h5>
                                                            </div><!-- end card header -->

                                                            <div class="card-body">
                                                                <form action="{{ route('admins.banners.update',$item->id) }}"
                                                                    method="POST" enctype="multipart/form-data" onsubmit="return confirm('Thay đổi thông tin banner này?')">
                                                                    <div class="row">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="title"
                                                                                    class="form-label">Tiêu đề
                                                                                    banner</label>
                                                                                    <input type="text" id="title" name="title"
                                                                                    class="form-control @error('title')
                                                                                    is-invalid
                                                                                @enderror"
                                                                                    value="{{ old('title',$item->title) }}" placeholder="Tiêu đề banner">
                                                                                @error('title')
                                                                                    <p class="text-danger">{{ $message }}
                                                                                    </p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="url"
                                                                                    class="form-label">URL</label>
                                                                                    <input type="text" id="url" name="url"
                                                                                    class="form-control @error('url')
                                                                                    is-invalid
                                                                                @enderror"
                                                                                    value="{{ old('url',$item->url) }}" placeholder="http://">
                                                                                @error('name')
                                                                                    <p class="text-danger">{{ $message }}
                                                                                    </p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="position">Vị
                                                                                    trí</label>
                                                                                    <select name="position" id="position" class="form-select">
                                                                                        @foreach ($listPosition as $itemPosition)
                                                                                        <option value="{{$itemPosition}}" {{$itemPosition == $item->position ? 'selected' : ""}}>{{ucfirst($itemPosition)}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="start_date"
                                                                                    class="form-label">Thời gian bắt
                                                                                    đầu</label>
                                                                                    <input type="date" id="start_date" name="start_date"
                                                                                    class="form-control @error('start_date')
                                                                                    is-invalid
                                                                                @enderror"
                                                                                    value="{{ old('start_date',$item->start_date) }}">
                                                                                @error('start_date')
                                                                                    <p class="text-danger">{{ $message }}
                                                                                    </p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="end_date"
                                                                                    class="form-label">Thời gian kết
                                                                                    thúc</label>
                                                                                    <input type="date" id="end_date" name="end_date"
                                                                                    class="form-control @error('end_date')
                                                                                    is-invalid
                                                                                @enderror"
                                                                                    value="{{ old('end_date',$item->end_date) }}">
                                                                                @error('end_date')
                                                                                    <p class="text-danger">{{ $message }}
                                                                                    </p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-sm-10 pt-4 d-flex gap-2">
                                                                                <label for="is_active"
                                                                                    class="form-label">Trạng thái:</label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="is_active"
                                                                                        id="is_active1" value="1"
                                                                                        {{ $item->is_active == true ? 'checked': '' }}>
                                                                                    <label
                                                                                        class="form-check-label text-success"
                                                                                        for="is_active1">
                                                                                        Hiển thị
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="is_active"
                                                                                        id="is_active2" value="0" {{ $item->is_active == false ? 'checked': '' }}>
                                                                                    <label
                                                                                        class="form-check-label text-danger"
                                                                                        for="is_active2">
                                                                                        Ẩn
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn"><i class="mdi mdi-pencil m-3 bg-success text-white fs-18 rounded-2 border p-1 me-1">Update</i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0 align-content-center">Banner slider body</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <table class="table table-bordered table-striped mb-0">
                            @foreach ($listBanner as $item)
                                @if ($item->position == 'big')
                                <tr>
                                    <td style="width: 50%">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="cart">
                                                    <div class="cart-header">
                                                        <img src="{{ Storage::url($item->banner) }}" alt=""
                                                            style="width: 100%">
                                                    </div>
                                                    <div class="card-body">
                                                        <form
                                                            action="{{ route('admins.banners.destroy', $item->id) }}"
                                                            method="post" class="d-inline"
                                                            onsubmit="return confirm('Chắc chắn xóa banner này?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="d-flex justify-content-center">
                                                                <button type="submit" class="border-0 bg-white"><i
                                                                        class="btn mdi mdi-delete bg-danger text-white fs-18 rounded-2 border p-1">Delete</i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card mb-0">

                                                    <div class="card-header">
                                                        <h5 class="card-title mb-0">Banner : {{ $item->title }}
                                                        </h5>
                                                    </div><!-- end card header -->

                                                    <div class="card-body">
                                                        <form action="{{ route('admins.banners.update',$item->id) }}"
                                                            method="POST" enctype="multipart/form-data" onsubmit="return confirm('Thay đổi thông tin banner này?')">
                                                            <div class="row">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="title"
                                                                            class="form-label">Tiêu đề
                                                                            banner</label>
                                                                            <input type="text" id="title" name="title"
                                                                            class="form-control @error('title')
                                                                            is-invalid
                                                                        @enderror"
                                                                            value="{{ old('title',$item->title) }}" placeholder="Tiêu đề banner">
                                                                        @error('title')
                                                                            <p class="text-danger">{{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="url"
                                                                            class="form-label">URL</label>
                                                                            <input type="text" id="url" name="url"
                                                                            class="form-control @error('url')
                                                                            is-invalid
                                                                        @enderror"
                                                                            value="{{ old('url',$item->url) }}" placeholder="http://">
                                                                        @error('name')
                                                                            <p class="text-danger">{{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="position">Vị
                                                                            trí</label>
                                                                            <select name="position" id="position" class="form-select">
                                                                                @foreach ($listPosition as $itemPosition)
                                                                                <option value="{{$itemPosition}}" {{$itemPosition == $item->position ? 'checked' : ""}}>{{ucfirst($itemPosition)}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                    </div>

                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="start_date"
                                                                            class="form-label">Thời gian bắt
                                                                            đầu</label>
                                                                            <input type="date" id="start_date" name="start_date"
                                                                            class="form-control @error('start_date')
                                                                            is-invalid
                                                                        @enderror"
                                                                            value="{{ old('start_date',$item->start_date) }}">
                                                                        @error('start_date')
                                                                            <p class="text-danger">{{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="end_date"
                                                                            class="form-label">Thời gian kết
                                                                            thúc</label>
                                                                            <input type="date" id="end_date" name="end_date"
                                                                            class="form-control @error('end_date')
                                                                            is-invalid
                                                                        @enderror"
                                                                            value="{{ old('end_date',$item->end_date) }}">
                                                                        @error('end_date')
                                                                            <p class="text-danger">{{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-sm-10 pt-4 d-flex gap-2">
                                                                        <label for="is_active"
                                                                            class="form-label">Trạng thái:</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="is_active"
                                                                                id="is_active1" value="1"
                                                                                {{ $item->is_active == true ? 'checked': '' }}>
                                                                            <label
                                                                                class="form-check-label text-success"
                                                                                for="is_active1">
                                                                                Hiển thị
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="is_active"
                                                                                id="is_active2" value="0" {{ $item->is_active == false ? 'checked': '' }}>
                                                                            <label
                                                                                class="form-check-label text-danger"
                                                                                for="is_active2">
                                                                                Ẩn
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <button type="submit"
                                                                        class="btn"><i class="mdi mdi-pencil m-3 bg-success text-white fs-18 rounded-2 border p-1 me-1">Update</i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
@endsection
