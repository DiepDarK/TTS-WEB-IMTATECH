<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách danh mục";
        $listCategory = Category::orderByDesc('is_active')->get();
        return view('admins.categories.index',compact('title', 'listCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm danh mục";
        return view('admins.categories.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            Category::create($param);
            return redirect()->route('admins.categories.index')->with('success','Thêm danh mục thành công');
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
        $title = "Chỉnh sửa danh mục";
        $category = Category::findOrFail($id);
        return view('admins.categories.edit',compact('title','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token','_method');
            $category = Category::findOrFail($id);
            $category->update($param);
            return redirect()->route('admins.categories.index')->with('success','Cập nhật danh mục thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admins.categories.index')->with('success','Xóa danh mục thành công');
    }
}
