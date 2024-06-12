<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Components\Recusive;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductsController extends Controller
{
    use StorageImageTrait;
    private $products;
    private $categories;

    public function __construct(Products $products, Categories $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    public function index()
    {
        $data['data']['list'] = Products::with('category')->get();
        $data['config']['title'] = 'Admin - Products';
        return view('admin.products.index', compact('data'));
    }

    public function create()
    {
        $data['config']['title'] = 'Admin - Products - Create';
        $data['data']['categories'] = $this->getCategory($parentId = '');

        return view('admin.products.create', compact('data'));
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
            'price' => 'required|integer',
            'feature_image_path' => 'required|image',
            'quantity' => 'required|integer',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // Insert data to products
            $dataProductCreate = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'category_id' => $request->category_id ?: null,
            ];

            $dataUploadFeatureImage = $this->upload($request, 'feature_image_path');

            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $product = $this->products->create($dataProductCreate);

            DB::commit();

            return redirect()->route('admin.products')->with('success', 'Added success');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return redirect()->route('admin.products')->with('success', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        // Tìm sản phẩm theo ID
        $product = Products::findOrFail($id);

        // Xóa ảnh feature_image_path nếu tồn tại
        if ($product->feature_image_path) {
            $imagePath = str_replace('/storage', '', $product->feature_image_path);
            Storage::delete('public' . $imagePath);
        }

        // Xóa sản phẩm
        $product->delete();

        // Trả về thông báo thành công
        return response()->json(['message' => 'Xóa sản phẩm và ảnh thành công']);
    }
}
