<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data['data']['list'] = Order::all();
        $data['config']['title'] = 'Admin - Dashboard';

        return view('admin.dashboard.index', compact('data'));
    }

    public function getChartData()
    {
        // Lấy dữ liệu thống kê từ model hoặc các nguồn khác
        $labels = ['Label 1', 'Label 2', 'Label 3']; // Dữ liệu trục x
        $values = [10, 20, 30]; // Dữ liệu trục y

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
