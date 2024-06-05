<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use Illuminate\Support\Str;

class AdminBrandsController extends Controller
{
    private $brands;

    public function __construct(Brands $brands)
    {
        $this->brands = $brands;
    }

    public function index()
    {
        $data['data']['list'] = Brands::all();
        $data['config']['title'] = 'Admin - Brands';

        return view('admin.brands.index', compact('data'));
    }

    public function create()
    {
        $data['config']['title'] = 'Admin - Brands - Create';

        return view('admin.brands.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->brands->create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.brands')->with('success', 'Add success');
    }

    public function edit($id)
    {
        $brand = $this->brands->find($id);
        $data['data']['infor'] = $brand;
        $data['config']['title'] = 'Admin - Brands - Edit';

        return view('admin.brands.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->brands->find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.brands')->with('success', 'Updated success');
    }

    public function delete($id)
    {
        $this->brands->find($id)->delete();

        return redirect()->route('admin.brands')->with('success', 'Delete success');
    }
}
