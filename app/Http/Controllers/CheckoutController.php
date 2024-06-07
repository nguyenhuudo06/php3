<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();
        $status = 'pending'; // Trạng thái mặc định

        // Tạo một đơn hàng mới
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_amount = 0; // Sẽ cập nhật sau khi tính toán tổng tiền
        $order->status = $status;
        $order->save();

        // Lấy thông tin giỏ hàng của người dùng
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Tính toán tổng tiền và tạo chi tiết đơn hàng cho mỗi sản phẩm trong giỏ hàng
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->price = $cartItem->product->price * $cartItem->quantity;
            $orderDetail->save();

            $totalAmount += $orderDetail->price;
        }

        // Cập nhật tổng tiền cho đơn hàng
        $order->total_amount = $totalAmount;
        $order->save();

        // Xóa các bản ghi trong giỏ hàng
        Cart::where('user_id', $user->id)->delete();

        // Redirect hoặc trả về response tùy theo yêu cầu của bạn
        return redirect()->route('cart.index')->with('success','Checkouted successfull');
    }
}
