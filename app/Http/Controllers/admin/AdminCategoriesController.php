<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Components\Recusive;
use Illuminate\Support\Str;

class AdminCategoriesController extends Controller
{
    private $categories;

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $data['data']['list'] = Categories::with('parent')->get();
        $data['config']['title'] = 'Admin - Categories';

        return view('admin.categories.index', compact('data'));
    }

    public function create()
    {
        $data['config']['title'] = 'Admin - Categories - Create';
        $data['data']['categories'] = $this->getCategory($parentId = '');

        return view('admin.categories.create', compact('data'));
    }

    public function getCategory($parentId)
    {
        $data = $this->categories->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
        ]);

        $this->categories->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories')->with('success', 'Add success');
    }

    public function edit($id)
    {
        $category = $this->categories->findOrFail($id);
        $data['data']['infor'] = $category;
        $data['data']['categories'] = $this->getCategory($category->parent_id);
        $data['config']['title'] = 'Admin - Categories - Edit';

        return view('admin.categories.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
        ]);

        $this->categories->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories')->with('success', 'Updated success');
    }

    public function delete($id)
    {
        $this->categories->find($id)->delete();

        return redirect()->route('admin.categories')->with('success', 'Delete success');
    }
}
