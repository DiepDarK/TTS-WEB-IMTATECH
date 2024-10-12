<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách người dùng !";
        $admin = User::ROLE_ADMIN;
        $listUser = User::orderBy('role')->orderBy('status')->get();
        return view('admins.users.index', compact('title', 'listUser', 'admin'));
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
    public function store(Request $request)
    {
        //
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
        $title = "Chỉnh sửa thông tin người dùng";
        $user = User::findOrFail($id);
        return view('admins.users.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            $user = User::findOrFail($id);
            // Kiểm tra và xử lý file avatar nếu có upload mới
            if ($request->hasFile('avatar')) {
                // Xóa avatar cũ nếu tồn tại
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $file_path = $request->file('avatar')->store('uploads/users', 'public');
            } else {
                $file_path = $user->avatar;
            }
            $param['avatar'] = $file_path;
            // dd($param);
            $user->update($param);

            // Chuyển hướng về trang danh sách người dùng với thông báo thành công
            return redirect()->route('admins.users.index')->with('success', 'Cập nhật thành công');
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
