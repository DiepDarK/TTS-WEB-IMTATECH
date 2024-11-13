<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // Tạo đơn hàng và lưu vào database
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $request->total_amount,
            'status' => 'pending'
        ]);

        // Lưu chi tiết đơn hàng vào bảng order_details
        foreach ($request->products as $product) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price']
            ]);
        }

        // Thông tin yêu cầu thanh toán MoMo
        $endpoint = env('MOMO_ENDPOINT');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');
        $orderId = time(); // Mã đơn hàng duy nhất
        $amount = $order->total_amount; // Số tiền thanh toán
        $orderInfo = "Thanh toán đơn hàng #$order->id";
        $redirectUrl = route('payment.momo.return');
        $ipnUrl = route('payment.momo.return');
        $extraData = "";

        // Tạo raw hash và chữ ký
        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$orderId&requestType=captureWallet";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $orderId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature
        ];

        // Gửi yêu cầu thanh toán tới MoMo
        $response = Http::post($endpoint, $data);
        $result = $response->json();

        if (isset($result['payUrl'])) {
            // Lưu momo_order_id vào đơn hàng
            $order->update(['momo_order_id' => $orderId]);
            return redirect($result['payUrl']);
        }

        return redirect()->back()->with('error', 'Không thể tạo yêu cầu thanh toán.');
    }

    // Phương thức xử lý phản hồi từ MoMo
    public function handleMomoReturn(Request $request)
    {
        $orderId = $request->get('orderId');
        $resultCode = $request->get('resultCode');

        // Tìm đơn hàng trong cơ sở dữ liệu
        $order = Order::where('momo_order_id', $orderId)->first();

        if ($order) {
            if ($resultCode == 0) {
                // Cập nhật trạng thái thành công
                $order->update(['status' => 'paid']);
                return view('payment.success', ['order' => $order]);
            } else {
                // Thanh toán thất bại
                $order->update(['status' => 'failed']);
                return view('payment.failure', ['order' => $order]);
            }
        }

        return redirect()->route('home')->with('error', 'Đơn hàng không tồn tại.');
    }
}
