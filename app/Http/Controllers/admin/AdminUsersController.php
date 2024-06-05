<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    public function index() {

        $data['data']['list'] = User::all();
        $data['config']['title'] = 'Admin - Users';
        return view('admin.users.index', compact('data'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:8',
        ]);


        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];

        User::create($data);
        return redirect()->route('admin.users')->with('success', 'Added success');
    }
}
