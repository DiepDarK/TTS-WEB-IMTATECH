<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Quản lí Banner";
        $listBanner = Banner::all();
        $listPosition = ['index','big','small'];
        return view('admins.banners.index',compact('title','listBanner','listPosition'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm Banner Mới";
        $listPosition = ['index','big','small'];
        return view('admins.banners.create',compact('title','listPosition'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token");
            if ($request->hasFile('banner')) {
                $param['banner'] = $request->file('banner')->store('uploads/banners','public');
            } else {
                $param['banner'] = null;
            }
            $banner = Banner::query()->create($param);
            return redirect()->route('admins.banners.index')->with('success',"Thêm banner thành công");
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
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token','_method');
            $banner = Banner::findOrFail($id);
            $banner->update($param);
            return redirect()->route('admins.banners.index')->with('success','Cập nhật banner thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
