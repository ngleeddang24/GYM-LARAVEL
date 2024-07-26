<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    function products(){
        $categories = Category::all();
        $products = Product::orderBy('id', 'DESC')->paginate(8);
        return view('products', compact('categories', 'products'));
    }
    public function detail($id)
    {
        $products = Product::find($id);

        if (!$products) {
            abort(404); // Nếu không tìm thấy sản phẩm, trả về lỗi 404
        }

        return view('detail', compact('products'));
    }
    public function productsByCategory($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->orderBy('id', 'DESC')->paginate(8);
        $currentCategory = Category::find($id);
        
        if (!$currentCategory) {
            abort(404); // Nếu không tìm thấy danh mục, trả về lỗi 404
        }

        return view('products', compact('categories', 'products', 'currentCategory'));
    }
    public function search(Request $request)
    {
        $categories = Category::all();
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orderBy('id', 'DESC')
            ->paginate(8);

        return view('products', compact('categories', 'products'))->with('query', $query);
    }

}
