<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClentProductController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo query cơ bản lấy tất cả sản phẩm
        $carts = Cart::where('user_id', Auth::id())->with("items.product", "items.variant")->first();
        $query = Product::query();
        $listCategory = Category::query()->get();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Lọc theo danh mục (nếu có)
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo khoảng giá (nếu có)
        if ($request->has('min_price') && $request->has('max_price')) {
            $min_price = $request->min_price;
            $max_price = $request->max_price;

            if (is_numeric($min_price) && is_numeric($max_price)) {
                $query->whereBetween('price', [$min_price, $max_price]);
            }
        }

        // Sắp xếp theo giá, tên, hoặc tiêu chí khác (nếu có)
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating_high':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'rating_low':
                    $query->orderBy('rating', 'asc');
                    break;
                case 'model_asc':
                    $query->orderBy('model', 'asc');
                    break;
                case 'model_desc':
                    $query->orderBy('model', 'desc');
                    break;
                default:
                    break;
            }
        }


        // Phân trang với số lượng sản phẩm mỗi trang
        $products = $query->paginate(12);

        return view('clients.shop', compact('products', 'listCategory','carts'));
    }
}
