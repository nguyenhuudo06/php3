<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class AdminRolesController extends Controller
{
    private $permission;
    private $role;
    
    public function __construct(Permission $permission, Role $role)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    public function index()
    {
        $data['data']['list'] = Role::all();
        $data['config']['title'] = 'Admin - Roles';
        return view('admin.roles.index', compact('data'));
    }

    public function create()
    {
        $data['config']['title'] = 'Admin - Roles - Create';
        $data['config']['permissionParent'] = $this->permission->where('parent_id', 0)->get();


        return view('admin.roles.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
        ]);


        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        $role->permissions()->attach($request->permission_id);

        return redirect()->route('admin.roles');
    }
}
