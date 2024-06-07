<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class HomeController extends Controller
{
    public function index() {

        $data['data']['list'] = Products::with('category')->get();
        $data['config']['title'] = 'Home';
        return view('users.home.index', compact('data'));
    }
}
