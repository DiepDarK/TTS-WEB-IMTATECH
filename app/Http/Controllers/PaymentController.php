<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function createMomoPayment(OrderRequest $request)
{
    // Tạo đơn hàng và lưu vào database
    $params = $request->except('_token');
    $params['order_code'] = $this->generateUniqueOrderCode();
    $order = Order::query()->create($params);

    // Thông tin thanh toán MoMo
    $endpoint = env('MOMO_ENDPOINT');
    $partnerCode = env('MOMO_PARTNER_CODE');
    $accessKey = env('MOMO_ACCESS_KEY');
    $secretKey = env('MOMO_SECRET_KEY');
    $orderId = time(); // Mã đơn hàng duy nhất
    $amount = $order->total_amount;
    $orderInfo = "Thanh toán đơn hàng #$order->id";
    $redirectUrl = route('payment.momo.return');
    $ipnUrl = route('payment.momo.return');
    $extraData = "";

    // Tạo signature
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

    // Log dữ liệu gửi đi
    Log::info('Data gửi tới MoMo:', $data);

    // Gửi yêu cầu thanh toán tới MoMo
    $response = Http::post($endpoint, $data);

    // Kiểm tra nếu response trả về là mảng hợp lệ
    $responseData = $response->json();

    if (is_array($responseData)) {
        Log::info('Response từ MoMo:', $responseData);
    } else {
        // Nếu không có dữ liệu hợp lệ, log thông báo lỗi và truyền vào mảng rỗng
        Log::error('Không thể giải mã dữ liệu trả về từ MoMo.', []);
    }

    // Kiểm tra kết quả trả về
    if (isset($responseData['payUrl'])) {
        // Lưu mã đơn hàng MoMo và chuyển hướng người dùng đến URL thanh toán
        $order->update(['momo_order_id' => $orderId]);
        return redirect($responseData['payUrl']);
    }

    // Nếu không có payUrl, log lỗi với mảng rỗng
    Log::error('Không thể tạo yêu cầu thanh toán. Lỗi:', $responseData ?: []);
    
    return redirect()->back()->with('error', 'Không thể tạo yêu cầu thanh toán.');
}

    // Phương thức xử lý phản hồi từ MoMo
    public function handleMomoReturn(Request $request)
    {
        $orderId = $request->get('orderId');
        $resultCode = $request->get('resultCode');

        // Tìm đơn hàng
        $order = Order::where('momo_order_id', $orderId)->first();

        if ($order) {
            if ($resultCode == 0) {
                // Thanh toán thành công
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
    public function generateUniqueOrderCode()
    {
        do {
            $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
        } while (Order::where('order_code', $orderCode)->exists());
        return $orderCode;
    }
}
