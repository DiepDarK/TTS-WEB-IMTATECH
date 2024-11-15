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
                        <div class="card-body">
                            <div class="row mb-4">
                                <h4 class="small-title mx-3">Thông tin đơn hàng: <span class="text-danger">{{ $order->order_code }}</span>
                                </h4>
                                <hr>
                                <div class="col-lg-6">
                                    <div class="footer-widgets mx-4 ">
                                        <ul>
                                            <li>
                                                <h5>Tên người nhận: <span class="text-danger">{{ $order->name_P }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Email người nhận: <span class="text-danger">{{ $order->email_P }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Số điện thoại: <span class="text-danger">{{ $order->phone_P }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Địa chỉ người nhận: <span class="text-danger">{{ $order->address_P }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Ghi chú: <span class="text-danger">{{ $order->note }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Ngày đặt hàng: <span
                                                        class="text-danger">{{ $order->created_at->format('d-m-Y') }}</span></h5>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="footer-widgets mx-4">
                                        <ul>
                                            <li>
                                                <h5>Trạng thái đơn hàng: <span
                                                        class="text-danger">{{ $status_order[$order->status_order] }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Trạng thái thanh toán: <span
                                                        class="text-danger">{{ $status_pay[$order->status_pay] }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Tổng tiền sản phẩm: <span class="text-danger">{{ $order->payment }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Tổng tiền ship: <span class="text-danger">{{ $order->ship }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Tổng tiền thanh toán: <span class="text-danger">{{ $order->total_payment }}</span></h5>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="small-title mx-3">Sản phẩm trong đơn hàng:</h4>
                    <hr>
                    <div class="table-content table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Mã sản phẩm</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetail as $item)
                                    @php
                                        $product = $item->product;
                                    @endphp
                                    <tr>
                                        <td class="kenne-product-thumbnail"><img class="img-fluid" src="{{ Storage::url($product->image) }}"
                                                style="max-width: 150px" alt="">
                                            </a></td>
                                            <td class="kenne-product-name">{{$product->product_code}}
                                            </td>
                                            <td class="kenne-product-price">{{$product->name}}
                                            </td>
                                            <td class="kenne-product-price"><span
                                                class="amount">{{ number_format($item->unit_price, 0, '', '.') }}đ</span>
                                            </td>
                                            <td scope="col">{{$item->quantity}}</td>
                                            <td class="product-subtotal"><span
                                                class="subtotal">{{ number_format($item->into_money, 0, '', '.') }}đ</span>
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
    
@endsection