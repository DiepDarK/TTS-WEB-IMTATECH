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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý biến thể biến thể</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 style="color: rgb(220, 43, 43)" class="card-title mb-0 align-content-center">
                                {{ $title }}</h5>
                            {{-- <a href="{{route('admins.variants.create')}}" class="btn btn-success m-1"><i data-feather='plus-square'> </i> Thêm danh mục</a> --}}
                        </div><!-- end card header -->
                        <div class="d-flex justify-content-between">
                            <img style="width:15%" src="{{ Storage::url($product->image) }}" alt="">
                            <table class="table">
                                <tr>
                                    <td>Mã biến thể:</td>
                                    <td style="color:rgb(227, 94, 94)">{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <td>Danh mục:</td>
                                    <td style="color:rgb(227, 94, 94)">{{ $product->category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Giá chung bình</td>
                                    <td style="color:rgb(227, 94, 94)">{{ number_format($product->price) }}đ</td>
                                </tr>
                                <tr>
                                    <td>Lượt xem:</td>
                                    <td style="color:rgb(227, 94, 94)">{{ $product->view }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày nhập:</td>
                                    <td style="color:rgb(227, 94, 94)">{{ $product->date_add }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 style="color: rgb(220, 43, 43)">Thêm biến thể</h5>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            <form action="{{ route('admins.variants.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="mb-3">
                                            <label for="variant_list_id" class="form-label">Loại biến thể</label>
                                            <select name="variant_list_id"
                                                class="form-select @error('variant_list_id')
                                            is-invalid
                                        @enderror">
                                                <option value="" selected>--- Chọn danh mục ---</option>
                                                @foreach ($variantList as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('variant_list_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('variant_list_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Giá biến thể</label>
                                            <input type="number" id="price" name="price"
                                                class="form-control @error('price')
                                            is-invalid
                                        @enderror"
                                                value="{{ old('price') }}" placeholder="Giá biến thể">
                                            @error('price')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Số lượng</label>
                                            <input type="number" id="quantity" name="quantity"
                                                class="form-control @error('quantity')
                                            is-invalid
                                        @enderror"
                                                value="{{ old('quantity') }}" placeholder="Số lượng biến thể">
                                            @error('quantity')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Ảnh biến thể</label>
                                            <input type="file" id="image" name="image" class="form-control"
                                                onchange="showImage(event)">
                                            <img class="mt-2" id="image_product" src="" alt="image"
                                                style="width: 150px; display: none">
                                            @error('image')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Thêm biến thể</button>
                                    </div>
                            </form>
                            <div class="table-responsive mt-3">
                                <div class="d-flex justify-content-between">
                                    <h5 style="color: rgb(220, 43, 43)">Danh sách biến thể của {{ $product->name }}</h5>
                                </div>
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Loại biến thể</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Cập nhật</th>
                                            <th scope="col">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($variant as $index => $item)
                                        <tr>
                                            <form action="{{ route('admins.variants.update', $item->id) }}"
                                                method="POST" enctype="multipart/form-data"
                                                onsubmit="return confirm('Bạn chắc chắn muốn sửa biến thể này?')">
                                                @csrf
                                                @method('PUT')
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td style="width:15%">
                                                        <img style="width:100%" src="{{ Storage::url($item->image) }}"
                                                            alt="">
                                                    </td>
                                                    <td>
                                                        <select name="variant_list_id"
                                                            class="form-select @error('variant_list_id') is-invalid @enderror">
                                                            @foreach ($variantList as $vl)
                                                                <option value="{{ $vl->id }}"
                                                                    {{ old('variant_list_id', $item->variantList->id) == $vl->id ? 'selected' : '' }}>
                                                                    {{ $vl->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('variant_list_id')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td style="width:30%">
                                                        <div class="d-flex justify-content-between" > 
                                                            <h6>Giá:</h6>{{number_format($item->price) }}đ
                                                            <h6>Giá mới:</h6>
                                                            <input type="number" id="price" name="price" style="width:40%"
                                                                class="form-control d-inline @error('price') is-invalid @enderror" value="{{ old('price' ) }}" placeholder="Giá biến thể">
                                                        </div>
                                                        </td>
                                                        <td style="width:15%">
                                                            <input type="number" id="quantity" name="quantity"
                                                class="form-control @error('quantity')
                                            is-invalid
                                        @enderror"
                                                value="{{ old('quantity',$item->quantity) }}" placeholder="Số lượng biến thể">
                                                        </td>
                                                        <td style="width:10%">
                                                            <button type="submit" class="btn"><i
                                                                    class="mdi mdi-pencil m-3 bg-success text-white fs-18 rounded-2 border p-1 me-1"></i></button>
                                                        </td>
                                                    </form>
                                                    <td>
                                                        <form action="{{ route('admins.variants.destroy', $item->id) }}"
                                                            method="post"
                                                            class="d-inline d-flex justify-content-center align-items-center"
                                                            onsubmit="return confirm('Chắc chắn xóa biến thể này?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="border-0 bg-white "><i
                                                                    class="mdi mdi-delete bg-warning  text-muted fs-18 rounded-2 border p-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div> <!-- content -->
    @endsection

@section('js')
    <script>
        function showImage(event) {
            const image_product = document.getElementById('image_product');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                image_product.src = reader.result;
                image_product.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file)
            }
        }
    </script>
@endsection
