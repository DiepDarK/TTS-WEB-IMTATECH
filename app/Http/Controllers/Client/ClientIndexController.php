<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientIndexController extends Controller
{
    public function index(){
        $banner = Banner::where('position', 'index')->take(4)->get();
        $bannerSmall = Banner::where('position', 'small')->take(3)->get();
        $bannerBig = Banner::where('position', 'big')->take(1)->get();
        $longString = 90;
        $listProduct = Product::query()->get();
        $carts = Cart::where('user_id', Auth::id())->with("items.product", "items.variant")->first();
        return view('clients.index', compact('listProduct','longString', 'banner','bannerSmall','bannerBig','carts'));
    }
    public function detail(string $id){
        $longString = 90;
        $carts = Cart::where('user_id', Auth::id())->with("items.product", "items.variant")->first();
        $product = Product::query()->findOrFail($id);
        $listProduct = Product::query()->get();
        return view('clients.product-detail', compact('product','listProduct','longString','carts'));
    }
}
