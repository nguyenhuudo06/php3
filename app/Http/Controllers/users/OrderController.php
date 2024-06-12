<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function index()
    {
        $data['data']['list'] = Order::where('user_id', auth()->id())->orderBy('id', 'DESC')->get();

        $data['config']['title'] = 'Order';

        return view('users.order.index', compact('data'));
    }
}
