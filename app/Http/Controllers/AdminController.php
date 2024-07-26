<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 1) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }
        return view('admin.index');
    }
    public function productlist()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->paginate(8);
        return view('admin.productlist', compact('categories', 'products'));
    }
    public function productadd(Request $request)
    {
        // Validate dữ liệu từ request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Xử lý upload ảnh và lưu vào thư mục
        if ($request->hasFile("img")) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploaded'), $imageName);
            $validatedData['img'] = $imageName;
        }

        // Tạo sản phẩm mới từ dữ liệu đã validate
        $products = Product::create($validatedData);

        // Chuyển hướng người dùng sau khi tạo sản phẩm thành công
        return redirect()->route('productlist')->with('success', 'Sản phẩm đã được tạo thành công.');


    }
    public function productdelete($id)
    {
        // Tìm sản phẩm theo ID
        $products = Product::find($id);

        // Lấy đường dẫn của tệp ảnh
        $imgPath = public_path('uploaded/' . $products->img);

        // Kiểm tra xem tệp ảnh có tồn tại không
        if (file_exists($imgPath)) {
            // Nếu có, xóa tệp ảnh
            unlink($imgPath);
        }

        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $products->delete();

        // Chuyển hướng người dùng và thông báo thành công
        return redirect()->route('productlist')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    public function productupdateform($id)
    {
        // Lấy sản phẩm cần sửa từ ID
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();

        // Trả về view hiển thị form chỉnh sửa sản phẩm
        return view('admin.productupdateform', compact('product', 'categories'));
    }

    public function productupdate(Request $request)
    {
        // Validate dữ liệu từ request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Lấy sản phẩm cần sửa từ ID
        $product = Product::findOrFail($request->id);

        // Cập nhật thông tin sản phẩm
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];
        $product->quantity = $validatedData['quantity'];
        $product->category_id = $validatedData['category_id'];

        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile("img")) {
            // Xóa ảnh cũ
            $oldImagePath = public_path('uploaded/' . $product->img);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload ảnh mới
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploaded'), $imageName);
            $product->img = $imageName;
        }

        // Lưu sản phẩm đã sửa vào cơ sở dữ liệu
        $product->save();

        // Chuyển hướng người dùng sau khi sửa sản phẩm thành công
        return redirect()->route('productlist')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    // Hiển thị danh sách người dùng
    public function userlist()
    {
        $users = User::all();
        return view('admin.userlist', compact('users'));
    }

    // Hiển thị form thêm người dùng
    // Hiển thị form thêm người dùng
    public function userCreateForm()
    {
        return view('admin.userupdateform');
    }

    // Xử lý việc thêm người dùng
    public function userCreate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|integer',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('userlist')->with('success', 'Người dùng đã được tạo thành công.');
    }

    // Hiển thị form sửa thông tin người dùng
    public function userEditForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.userupdateform', compact('user'));
    }

    // Xử lý việc cập nhật thông tin người dùng
    public function userEdit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|integer',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('userlist')->with('success', 'Thông tin người dùng đã được cập nhật.');
    }

    // Xử lý việc xóa người dùng
    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('userlist')->with('success', 'Người dùng đã được xóa thành công.');
    }

    public function orderlist()
    {
        $transactions = Transaction::all();
        return view('admin.orderlist', compact('transactions'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        // Tìm đơn hàng cần cập nhật trạng thái
        $transaction = Transaction::findOrFail($id);

        // Validate dữ liệu từ request
        $validatedData = $request->validate([
            'order_status' => 'required|in:Giao dịch thành công,Giao dịch không thành công,Chưa thanh toán,Đang giao hàng,Đã hủy',
        ]);

        // Cập nhật trạng thái đơn hàng
        $transaction->update(['order_status' => $validatedData['order_status']]);

        // Chuyển hướng người dùng và thông báo thành công
        return Redirect::route('orderlist')->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
    }



}

