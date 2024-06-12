<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestEmail;
use App\Models\User;

class PaymentController extends Controller
{
    public function vnpay_payment($id, $total)
    {
        // Cấu hình - lấy từ email đăng ký
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay_php/vnpay_return";
        $vnp_TmnCode = "LPXSD65T";
        $vnp_HashSecret = "HFU9MOYWK6B2SX6694D4ZHDWIJ729IZ5";

        // Thông tin đơn hàng
        $vnp_TxnRef = $id;
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "Do Style";
        $vnp_Amount = (int)$total * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo

    }

    public function vnpay_return(Request $request)
    {
        $vnp_HashSecret = "HFU9MOYWK6B2SX6694D4ZHDWIJ729IZ5"; // Secret key từ VNPay

        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = trim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công
                $orderId = $inputData['vnp_TxnRef'];
                $order = Order::findOrFail($orderId); // Tìm đơn hàng trong cơ sở dữ liệu
                $order->payment_status = 'paid'; // Cập nhật trạng thái đơn hàng
                $order->save(); // Lưu thay đổi

                $user = User::findOrFail($order->user_id);
                    $data = [
                        'name' => $user->name,
                        'email' => $user->email,
                    ];
                Mail::to('nguyenhuudo1206@gmail.com')->send(new MyTestEmail($data, 'mails.test-email', 'test mail'));
                return view('payment_success', ['order' => $inputData]);
            } else {
                // Thanh toán không thành công
                return view('payment_failed', ['order' => $inputData]);
            }
        } else {
            // Sai chữ ký
            return view('payment_failed', ['message' => 'Invalid signature']);
        }
    }
}
