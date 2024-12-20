<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientCartController extends Controller
{
    public function listCart()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $orderCount = 0; // Mặc định nếu chưa đăng nhập
        $carts = Cart::where('user_id', Auth::id())->with("items.product", "items.variant")->first();
        // $cart = session()->get('cart', default: []);

        // $tt = $cart['price'] - (($cart['price']  * $cart['discount']) / 100);

        $total = 0;
        $subTotal = 0;
        $shipping = 50;
        if ($carts && $carts->items->count() > 0) {
            foreach ($carts->items as  $item) {
                $price = is_numeric($item['price']) ? $item['price'] : 0;
                $quantity = is_numeric($item['quantity']) ? $item['quantity'] : 0;
                // Kiểm tra nếu các khóa cần thiết tồn tại trong mục giỏ hàng
                // Tính toán tổng phụ
                $subTotal += $price * $quantity;
            }
            $total = $subTotal + $shipping;
        }

        return view('clients.cart', compact('orderCount', 'categories', 'carts', 'subTotal', 'shipping', 'total'));
    }
    public function addCart(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $productId = $request->input('product_id');
        $product = Product::query()->findOrFail($productId);

        if (!$product) {
            return redirect()->with('error', "Sản phẩm không tồn tại");
        }
        // Tính toán giá sản phẩm sau khi áp dụng giảm giácod
        $totalPrice = $product->price - (($product->price * $product->discount) / 100);

        // Check if the product is already in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // If the product already exists in the cart, update the quantity and total
            $cartItem->quantity += $request->quantity; // Update quantity
            $cartItem->total = $totalPrice * $cartItem->quantity; // Update total price
            $cartItem->save(); // Save the updated item
        } else {
            // If it doesn't exist, create a new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'name' => $product->name, // Store product name
                'image' => $product->image, // Store product image
                'price' => $totalPrice, // Store price after discount
                'quantity' => $request->quantity, // Store quantity
                'total' => $totalPrice * $request->quantity // Store total price
            ]);
        }
        return redirect()->back();
    }
    
    public function updateCart(Request $request)
    {
        $items = $request->input('items');

        if (!$items || !is_array($items)) {
            return response()->json(['message' => 'Dữ liệu không hợp lệ'], 400);
        }

        foreach ($items as $id => $item) {
            $quantity = $item['quantity'] ?? null;

            if (is_null($quantity) || !is_numeric($quantity)) {
                return response()->json(['message' => 'ID hoặc số lượng không hợp lệ'], 400);
            }

            $cartItem = CartItem::findOrFail($id);
            $total = $cartItem->price * $quantity;

            // Cập nhật quantity và total
            $cartItem->update([
                'quantity' => $quantity,
                'total' => $total
            ]);
        }

        return response()->json(['message' => 'Giỏ hàng đã được cập nhật thành công'], 200);
    }


    public function removeCart(Request $request)
    {
        $cartItemId = $request->input('id');
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Sản phẩm đã được xóa khỏi giỏ hàng']);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }
}
