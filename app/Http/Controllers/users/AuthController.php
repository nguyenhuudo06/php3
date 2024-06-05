<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (Auth::id() > 0) {
            return redirect()->route('admin.products');
        }

        return view('users.login');
    }

    public function login(AuthRequest $request)
    {

        $account = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($account)) {
            return redirect()->route('users.home')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->route('auth.login')->with('danger', 'Sai tài khoản hoặc mật khẩu');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
