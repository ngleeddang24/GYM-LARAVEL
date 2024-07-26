<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    function index(Request $request)
    {
        // Lấy 8 sản phẩm mới nhất từ cơ sở dữ liệu
        $products = Product::latest()->take(8)->get();
        return view('home', compact('products'));
    }
}
