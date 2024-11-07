<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách sản phẩm';
        $listProduct = Product::orderByDesc('status')->get();
        return view('admins.products.index', compact('title', 'listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm sản phẩm';
        $listCategory = Category::query()->get();

        return view('admins.products.create', compact('title', 'listCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->isMethod("POST")) {
            $params = $request->except('_token');

            // CHuyển đổi checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_sale'] = $request->has('is_sale') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            //Xử lí hình ảnh đại diện
            if ($request->hasFile('image')) {
                $params['image'] = $request->file('image')->store('uploads/products', 'public');
            } else {
                $params['image'] = null;
            }

            //Thêm sản phẩm
            Product::query()->create($params);
            return redirect()->route('admins.products.index')->with('success', 'Thêm sản phẩm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Chỉnh sửa sản phẩm';
        $listCategory = Category::query()->get();
        $product = Product::query()->findOrFail($id);
        return view('admins.products.edit', compact('title', 'listCategory','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $params = $request->except('_token','_method');

            // CHuyển đổi checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_sale'] = $request->has('is_sale') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            $product = Product::query()->findOrFail($id); 

            //Xử lí hình ảnh đại diện
            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $params['image'] = $request->file('image')->store('uploads/products', 'public');
            } else {
                $params['image'] = $product->image;
            }
            $product->update($params);
            return redirect()->route('admins.products.index')->with('success', 'Cập nhật thông tin sản phẩm thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::query()->findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admins.products.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
