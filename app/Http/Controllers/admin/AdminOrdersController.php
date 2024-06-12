<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrdersController extends Controller
{
       public function index() {

        $data['data']['list'] = Order::with('user')->get();
        $data['config']['title'] = 'Admin - Order';
        return view('admin.orders.index', compact('data'));
    }
}
