<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Xác thực dữ liệu nhập từ biểu mẫu đăng nhập
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Lấy thông tin email và password từ yêu cầu đăng nhập
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công');
        }

        \Log::error('Đăng nhập không thành công', ['email' => $request->email]);

        return redirect('login')->with('error', 'Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Đăng xuất thành công');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    // Xử lý việc đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Chuyển hướng người dùng sau khi đăng ký thành công
        return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập để tiếp tục.');
    }
}
