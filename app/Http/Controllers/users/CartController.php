<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $data['data']['list'] = Cart::where('user_id', auth()->id())->with('product')->get();
        $data['data']['total'] = $data['data']['list']->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $data['config']['title'] = 'Cart';

        return view('users.cart.index', compact('data'));
    }

    public function addToCart(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa tồn tại, tạo một bản ghi mới
            $cartItem = new Cart;
            $cartItem->user_id = auth()->id();
            $cartItem->product_id = $productId;
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        // Trả về phản hồi cho người dùng
        // return response()->json(['message' => 'Product added to cart successfully']);
        return redirect()->back()->with('success','Added successful');
    }

    public function removeFromCart(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'cart_item_id' => 'required|exists:carts,id',
        ]);

        // Lấy ID của mục trong giỏ hàng cần xóa
        $cartItemId = $request->input('cart_item_id');

        // Xóa mục trong giỏ hàng
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->delete();

        // return response()->json(['message' => 'Product removed successfully']);
        return redirect()->back()->with('success','Removed');
    }
}
