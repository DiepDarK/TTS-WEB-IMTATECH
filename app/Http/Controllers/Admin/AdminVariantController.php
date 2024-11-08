<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductVariantRequest;

class AdminVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductVariantRequest $request)
    {
        if ($request->isMethod("POST")) {
            $params = $request->except('_token');
            //Xử lí hình ảnh đại diện
            if ($request->hasFile('image')) {
                $params['image'] = $request->file('image')->store('uploads/variantProducts', 'public');
            } else {
                $params['image'] = null;
            }
            //Thêm sản phẩm
            Variant::query()->create($params);
            return redirect()->route('admins.variants.show', $params['product_id'])->with('success', 'Thêm biến thể thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = Product::findOrFail($id);
        $variantList = VariantList::all();
        $title = "Biến thể của " . $product->name;
        $variant = $product->variants;
        return view('admins.variants.index',compact('title', 'variant','product','variantList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $params = $request->except('_token','_method');
            $variant = Variant::findOrFail($id);
            if ($request->hasFile('image')) {
                if ($variant->image && Storage::disk('public')->exists($variant->image)) {
                    Storage::disk('public')->delete($variant->image);
                }
                $params['image'] = $request->file('image')->store('uploads/variantProducts', 'public');
            } else {
                $params['image'] = null;
            }
            $variant->update($params);
            return redirect()->route('admins.variants.show', $variant->product_id)->with('success', 'Cập nhật biến thể thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            $variant = Variant::query()->findOrFail($id);
            if ($variant->image && Storage::disk('public')->exists($variant->image)) {
                Storage::disk('public')->delete($variant->image);
            }
            $variant->delete();
            return redirect()->route('admins.variants.show', $variant->product_id)->with('success', 'Xóa biến thể thành công');
        }
    }
}
