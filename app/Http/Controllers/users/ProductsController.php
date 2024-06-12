<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {

        $data['data']['list'] = Products::with('category')->orderBy('id', 'DESC')->paginate(8);
        $data['config']['title'] = 'Products';
        return view('users.products.index', compact('data'));
    }

    public function details($id)
    {

        $data['data']['details'] = Products::find($id);
        $data['config']['title'] = 'Product details';

        return view('users.products.details', compact('data'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Products::query();

        if (!empty($query)) {
            $searchTerms = explode('-', $query);

            foreach ($searchTerms as $term) {
                $products->orWhere('name', 'like', "%$term%");
            }
        }

        $products = $products->get();

        return response()->json($products);



        // $query = $request->input('query');

        // // Tìm kiếm sản phẩm theo tên, có thể là nhiều từ khóa
        // $products = Products::where('name', 'LIKE', "%{$query}%")->get();

        // foreach ($products as $product) {
        //     $product->url = route('users.products.details', ['id' => $product->id]);
        // }

        // // Trả về kết quả tìm kiếm dưới dạng JSON
        // return response()->json($products);
    }
}
