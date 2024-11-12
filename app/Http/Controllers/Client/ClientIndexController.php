<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class ClientIndexController extends Controller
{
    public function index(){
        $banner = Banner::where('position', 'index')->take(4)->get();
        $bannerSmall = Banner::where('position', 'small')->take(3)->get();
        $bannerBig = Banner::where('position', 'big')->take(1)->get();
        $longString = 90;
        $listProduct = Product::query()->get();
        return view('clients.index', compact('listProduct','longString', 'banner','bannerSmall','bannerBig'));
    }
    public function detail(string $id){
        $longString = 90;
        $product = Product::query()->findOrFail($id);
        $listProduct = Product::query()->get();
        return view('clients.product-detail', compact('product','listProduct','longString'));
    }
}
