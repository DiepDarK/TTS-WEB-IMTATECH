@extends('layouts.client')
@section('css')
@endsection
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Uren's Cart Area -->
    <div class="kenne-cart-area">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    @if ($carts && $carts->items->count() > 0)
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="kenne-product-thumbnail">Images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="kenne-product-price">Unit Price</th>
                                            <th class="kenne-product-quantity">Quantity</th>
                                            <th class="kenne-product-subtotal">Total</th>
                                            <th class="kenne-product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts->items as $item)
                                            <tr>
                                                <input type="hidden" name="id" value="{{ $item['id'] }}"
                                                    id="">
                                                <td class="kenne-product-thumbnail"><a
                                                        href="{{ route('detail', $item->product_id) }}"><img
                                                            src="{{ Storage::url($item['image']) }}"
                                                            style="max-width: 150px" alt="Uren's Cart Thumbnail">
                                                        <input type="hidden" name="image" value="{{ $item['img'] }}"
                                                            id="">
                                                    </a></td>
                                                <td class="kenne-product-name"><a
                                                        href="{{ route('detail', $item->product_id) }}">{{ $item['name'] }}</a>
                                                    <input type="hidden" name="name" value="{{ $item['name'] }}"
                                                        id="">
                                                </td>
                                                <td class="kenne-product-price"><span
                                                        class="amount">{{ number_format($item['price'], 0, '', '.') }}đ</span>
                                                    <input type="hidden" name="price" value="{{ $item['price'] }}"
                                                        id="">
                                                </td>
                                                <td class="quantity">
                                                    <div class="cart-plus-minus quantity-container">
                                                        <input class="cart-plus-minus-box quantity-input"
                                                            data-price="{{ $item['price'] }}"
                                                            value="{{ $item['quantity'] }}" type="text"
                                                            name="items[{{ $item['id'] }}][quantity]">
                                                        <div class="dec qtybutton btn-minus"><i
                                                                class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton  btn-plus"><i class="fa fa-angle-up"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span
                                                        class="subtotal">{{ number_format($item['price'] * $item['quantity'], 0, '', '.') }}Đ</span>
                                                </td>
                                                <td class="kenne-product-remove"
                                                    data-item-id="{{ $item['id'] }}">
                                                    <a href=""><i class="fa fa-trash" title="Remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                                placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Subtotal <span
                                                    class="sub-total">{{ number_format($subTotal, 0, '', '.') }}đ</span>
                                            </li>
                                            <li>Shipping <span
                                                    class="shipping">{{ number_format($shipping, 0, '', '.') }}đ</span>
                                            </li>
                                            <li>Total <span class="total">{{ number_format($total, 0, '', '.') }}đ</span>
                                            </li>
                                        </ul>
                                        <a href="{{ route('orders.create') }}">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <h3 style="text-align: center;color: rgb(222, 80, 80)">Giỏ hàng rỗng</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Uren's Cart Area End Here -->
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quản lý tất cả các phần tử nhập số lượng
            document.querySelectorAll('.quantity-container').forEach(function(container) {
                const quantityInput = container.querySelector('.quantity-input');
                const btnPlus = container.querySelector('.btn-plus');
                const btnMinus = container.querySelector('.btn-minus');

                btnPlus.addEventListener('click', function() {
                    event.preventDefault();
                    let currentValue = parseInt(quantityInput.value, 10);
                    quantityInput.value = currentValue + 1;
                    updateSubtotal(container);
                    updateTotal();

                    // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
                    updateCartAjax(); // Pass product ID and new quantity
                });

                btnMinus.addEventListener('click', function() {
                    event.preventDefault();
                    let currentValue = parseInt(quantityInput.value, 10);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                        updateSubtotal(container);
                        updateTotal();

                        // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
                        updateCartAjax(); // Pass product ID and new quantity
                    }
                });

            });

            function updateCartAjax() {
                var formData = $('form').serialize();
                console.log(formData);

                $.ajax({
                    url: '/cart/update', // Đường dẫn xử lý cập nhật giỏ hàng
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Thông báo cập nhật thành công
                        console.log('Cart updated successfully');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                        // Xử lý lỗi khi cập nhật giỏ hàng
                        alert('Error updating cart');
                    }
                });
            }

            function removeCartAjax(cartItemId) {
                $.ajax({
                    url: '/cart/remove',
                    method: 'POST',
                    data: {
                        id: cartItemId, // Pass the cart item ID
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        console.log('Product removed successfully:', response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                        alert('Error removing product');
                    }
                });
            }


            // Cập nhật subtotal cho từng sản phẩm
            function updateSubtotal(container) {
                const quantityInput = container.querySelector('.quantity-input');
                const price = parseFloat(quantityInput.dataset.price);
                const quantity = parseInt(quantityInput.value, 10);
                const subtotal = price * quantity;

                const subtotalElement = container.closest('tr').querySelector('.subtotal');
                subtotalElement.textContent = formatCurrency(subtotal);
            }

            // Định dạng tiền tệ với dấu chấm phân tách hàng nghìn và không có phần thập phân
            function formatCurrency(value) {
                const formatted = value.toFixed(0); // Làm tròn xuống số nguyên
                if (formatted.length > 3) {
                    return formatted.replace(/\B(?=(\d{3})+(?!\d))/g, '.') +
                        ' Đ'; // Thêm dấu chấm phân tách hàng nghìn
                }
                return formatted + ' $'; // Trả về giá trị cho các số dưới 1000
            }

            // Xử lý khi người dùng nhập số âm
            document.querySelectorAll('.quantity-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    event.preventDefault();
                    const value = parseInt(input.value, 10);
                    if (isNaN(value) || value < 1) {
                        alert('Quantity must be a number >= 1');
                        input.value = 1;
                    }
                    updateSubtotal(input.closest('.quantity-container'));
                    updateTotal();
                    updateCartAjax();
                });
            });
            // Xử lý xóa sản phẩm trong giỏ hàng
            document.querySelectorAll('.kenne-product-remove').forEach(function(removeButton) {
                removeButton.addEventListener('click', function(event) {
                    event.preventDefault();

                    const row = this.closest('tr');
                    const cartItemId = this.getAttribute(
                        'data-item-id'); // Get the ID of the item to remove

                    // Remove the product from the UI
                    row.remove();
                    updateTotal();

                    // Call the removeCartAjax function with the cart item ID
                    removeCartAjax(cartItemId); // Pass the item ID to the function
                });
            });

            // Hàm cập nhật tổng số
            function updateTotal() {
                let subTotal = 0;
                // Tính tổng các sản phẩm có trong giỏ hàng
                document.querySelectorAll('.quantity-input').forEach(function(input) {
                    const price = parseFloat(input.dataset.price);
                    const quantity = parseInt(input.value, 10);
                    subTotal += price * quantity;
                });

                // Lấy số tiền vận chuyển
                const shipping = parseFloat(document.querySelector('.shipping').textContent.replace(/\./g, '')
                    .replace(' $', ''));
                const total = subTotal + shipping;

                // Cập nhật giá trị
                document.querySelector('.sub-total').textContent = formatCurrency(subTotal);
                document.querySelector('.total').textContent = formatCurrency(total);
            }

            // Cập nhật tổng số khi trang được tải
            updateTotal();

        });
    </script>
@endsection
