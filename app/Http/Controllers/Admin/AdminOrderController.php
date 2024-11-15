<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $title = "Danh sách danh mục";
        $listOrder = Order::query()->orderByDesc('id')->get();
        $statusOrder = Order::STATUS_ORDER;

        $type_da_huy = Order::DA_HUY;
        return view('admins.orders.index', compact('listOrder', 'statusOrder', 'type_da_huy','title'));
    }
    public function show(string $id)
    {
        $title = "Chi tiết đơn hàng";
        $order = Order::query()->findOrFail($id);
        $status_order = Order::STATUS_ORDER;
        $status_pay = Order::STATUS_PAY;

        return view('admins.orders.show', compact('order', 'status_order', 'status_pay','title'));
    }
    public function update(Request $request, string $id)
    {
        $order = Order::query()->findOrFail($id);

        $currentStatus = $order->status_order;

        $newStatus = $request->input('status_order');

        $status = array_keys(Order::STATUS_ORDER);

        //kiem tra neu order da huy thi ko dc change status
        if ($currentStatus === Order::DA_HUY || $currentStatus === Order::KHACH_HANG_TU_CHOI) {
            return redirect()->route('admins.orders.index')->with('error', 'Cannot change the status of a canceled or refused order');
        }
        //kiem tra neu status moi ko dc nam sau status hien tai
        if (array_search($newStatus, $status) < array_search($currentStatus, $status)) {
            return redirect()->route('admins.orders.index')->with('error', 'New Status must be after current status');
        }
        //     // Cập nhật trạng thái thanh toán thành ĐÃ THANH TOÁN nếu đã giao hàng
        if ($newStatus === Order::DA_GIAO_HANG) {
            $order->status_payment_method = Order::DA_THANH_TOAN;
        }

        $order->status_order = $newStatus;
        $order->save();
        return redirect()->route('admins.orders.index')->with('success', 'Status order has been updated successfully');
    }
}
