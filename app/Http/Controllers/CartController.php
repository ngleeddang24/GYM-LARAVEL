<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Transaction;
use Carbon\Carbon;
use Auth;

class CartController extends Controller
{
    function cart()
    {
        // Lấy giỏ hàng của người dùng hiện tại từ database
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        // Tính toán tổng tiền từ giỏ hàng
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Truyền biến $totalPrice vào view
        return view('cart', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần phải đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart::where('product_id', $id)->where('user_id', auth()->id())->first();

        if ($cartItem) {
            // Nếu đã có, tăng số lượng sản phẩm
            $cartItem->quantity += $quantity;
        } else {
            // Nếu chưa có, thêm sản phẩm vào giỏ hàng
            $cartItem = new Cart([
                'product_id' => $id,
                'user_id' => auth()->id(), // Thêm user_id vào đây
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        // Lưu giỏ hàng vào database
        $cartItem->save();

        // Chuyển hướng về trang chi tiết sản phẩm và thông báo thành công
        return redirect()->route('detail', ['id' => $id])->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function update(Request $request, $id)
    {
        $quantity = $request->input('quantity', 1);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        $cartItem = Cart::where('product_id', $id)->where('user_id', auth()->id())->first();

        if ($cartItem) {
            // Cập nhật số lượng sản phẩm
            $cartItem->quantity = $quantity;
            $cartItem->save();

            // Chuyển hướng về trang giỏ hàng
            return redirect()->route('cart')->with('success', 'Số lượng sản phẩm đã được cập nhật trong giỏ hàng!');
        }

        // Nếu không tìm thấy sản phẩm trong giỏ hàng, chuyển hướng về trang giỏ hàng và thông báo lỗi
        return redirect()->route('cart')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    public function remove($id)
    {
        // Xóa sản phẩm khỏi giỏ hàng
        $cartItem = Cart::where('product_id', $id)->where('user_id', auth()->id())->first();

        if ($cartItem) {
            $cartItem->delete();

            // Chuyển hướng về trang giỏ hàng và thông báo thành công
            return redirect()->route('cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }

        // Nếu không tìm thấy sản phẩm trong giỏ hàng, chuyển hướng về trang giỏ hàng và thông báo lỗi
        return redirect()->route('cart')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            // Kiểm tra xem người dùng đã chọn phương thức thanh toán chưa
            if (!$request->has('payment_method')) {
                // Nếu không chọn phương thức thanh toán, hiển thị thông báo lỗi
                return redirect()->back()->with('error', 'Vui lòng chọn phương thức thanh toán!');
            }
            // Lấy thông tin giỏ hàng từ cơ sở dữ liệu
            $cartItems = Cart::where('user_id', auth()->id())->get();

            // Kiểm tra xem giỏ hàng có sản phẩm không
            if (!$cartItems->isEmpty()) {
                // Kiểm tra số lượng sản phẩm trong giỏ hàng so với số lượng có sẵn trong bảng products
                foreach ($cartItems as $cartItem) {
                    $product = Product::find($cartItem->product_id);

                    // So Sánh số lượng sản phẩm trong giỏ hàng lớn hơn số lượng có sẵn trong bảng products
                    if ($product && $cartItem->quantity > $product->quantity) {
                        return redirect()->route('cart')->with('error', 'Số lượng sản phẩm ' . $product->name . ' trong giỏ hàng vượt quá số lượng có sẵn!');
                    }
                }

                // Tiếp tục quá trình thanh toán nếu không có sản phẩm nào trong giỏ hàng vượt quá số lượng có sẵn
                $current_time = Carbon::now();
                // Tính tổng tiền
                $totalPrice = $cartItems->sum(function ($item) {
                    return $item->price * $item->quantity;
                });

                // Lưu thông tin giao dịch vào bảng Transactions
                $transaction = new Transaction([
                    'user_id' => auth()->id(), // hoặc là id của người dùng hiện tại
                    'total_price' => $totalPrice,
                    'transaction_time' => $current_time,
                ]);
                
                $transaction->save();

                // Trừ số lượng sản phẩm đã thanh toán từ số lượng sản phẩm trong bảng products
                foreach ($cartItems as $cartItem) {
                    $product = Product::find($cartItem->product_id);
                    if ($product) {
                        $product->quantity -= $cartItem->quantity;
                        $product->save();
                    }
                }

                // Xóa tất cả các sản phẩm trong giỏ hàng
                Cart::where('user_id', auth()->id())->delete();

                // Chuyển hướng đến trang thông báo thanh toán thành công
                return redirect()->route('checkout.success')->with('success', 'Thanh toán thành công!');
            }
        }

        // Trả về view checkout nếu không có phương thức POST
        return view('checkout');
    }



    public function transaction_history()
    {
        // Lấy lịch sử giao dịch của người dùng đang đăng nhập
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->get();

        // Trả về view với dữ liệu lịch sử giao dịch
        return view('transaction_history', compact('transactions'));
    }
    public function delete($id)
    {
        // Tìm giao dịch cần xóa
        $transaction = Transaction::findOrFail($id);

        // Xóa giao dịch
        $transaction->delete();

        // Chuyển hướng người dùng và hiển thị thông báo thành công
        return redirect()->route('transaction.history')->with('success', 'Giao dịch đã được xóa thành công.');
    }

}
