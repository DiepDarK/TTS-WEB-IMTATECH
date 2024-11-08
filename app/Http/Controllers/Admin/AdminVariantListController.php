<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantListRequest;
use App\Models\VariantList;
use Illuminate\Http\Request;

class AdminVariantListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách biến thể";
        $variantList = VariantList::orderByDesc('name')->get();
        return view('admins.variantLists.index',compact('title', 'variantList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm biến thể";
        return view('admins.variantLists.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductVariantListRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            VariantList::create($param);
            return redirect()->route('admins.variantLists.index')->with('success','Thêm biến thể thành công');
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
        $title = "Chỉnh sửa biến thể";
        $variant = VariantList::findOrFail($id);
        return view('admins.variantLists.edit',compact('title','variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductVariantListRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token','_method');
            $variantList = VariantList::findOrFail($id);
            $variantList->update($param);
            return redirect()->route('admins.variantLists.index')->with('success','Cập nhật biến thể thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variantList = VariantList::findOrFail($id);
        $variantList->delete();
        return redirect()->route('admins.variantLists.index')->with('success','Xóa biến thể thành công');
    }
}
