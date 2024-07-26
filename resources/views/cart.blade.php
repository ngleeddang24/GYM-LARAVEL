@extends('layout')
@section('title', 'GIỎ HÀNG - GYMSTER')

@section('content')
<!-- Hero Start -->
<div class="container-fluid bg-primary p-5 bg-hero mb-5">
    <div class="row py-5">
        <div class="col-12 text-center">
            <h1 class="display-2 text-uppercase text-white mb-md-4">Giỏ Hàng</h1>
            <a href="{{ route('home') }}" class="btn btn-primary py-md-3 px-md-5 me-3">Trang Chủ</a>
            <a href="{{ route('cart') }}" class="btn btn-light py-md-3 px-md-5">Giỏ Hàng</a>
        </div>
    </div>
</div>
<!-- Hero End -->
<div class="container">
    <div class="row">
        @if($cartItems->isEmpty())
            <div class="alert alert-info" role="alert">
                Giỏ hàng của bạn đang trống. Hãy thêm sản phẩm vào giỏ hàng trước khi thanh toán.
            </div>
        @else
            <!-- Hiển thị sản phẩm trong giỏ hàng -->
            <div class="col-md-8">
                <div class="cart mb-3">
                    <div class="cart-body">
                        <h3 class="cart-title">Sản Phẩm Trong Giỏ Hàng</h3>
                        <ul class="list-group">
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="product-info">
                                        <img src="{{ asset('uploaded/' . $item->product->img) }}" alt="Product Image"
                                            class="product-img" height="150px" width="150px">
                                        <span
                                            class="product-name">{{ \Illuminate\Support\Str::limit($item->product->name, 20) }}</span>
                                    </div>
                                    <form action="{{ route('cart.update', $item->product_id) }}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="quantity"
                                                value="{{ $item->quantity }}" min="1" style="width: 70px; text-align: center;">
                                            <button type="submit" class="btn btn-primary text-uppercase">Cập Nhật</button>
                                        </div>
                                    </form>
                                    <span class="product-price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                                    <form action="{{ route('cart.remove', $item->product_id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirmDelete()">Xóa</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Tổng tiền và thanh toán -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Đơn Hàng:</h5>

                        <!-- Hiển thị tên sản phẩm và giá sản phẩm * số lượng -->
                        @foreach($cartItems as $item) 
                            <p class="cart-item">{{ $item->product->name }} * {{ $item->quantity }}:
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ
                            </p>
                        @endforeach

                        <h5 class="card-title">Tổng Tiền:</h5>
                        <!-- Hiển thị tổng tiền -->
                        <p class="cart-total">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</p>

                        <!-- Phương thức vận chuyển -->


                        <!-- Phương thức thanh toán -->
                        <form action="{{ route('cart.checkout') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <h5>Phương thức vận chuyển:</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method"
                                        id="standard_shipping" value="standard_shipping" required>
                                    <label class="form-check-label" for="standard_shipping">Giao hàng tiêu chuẩn</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method"
                                        id="express_shipping" value="express_shipping" required>
                                    <label class="form-check-label" for="express_shipping">Giao hàng nhanh</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Phương thức thanh toán:</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery"
                                        value="cash_on_delivery" required>
                                    <label class="form-check-label" for="cash_on_delivery">Thanh toán khi nhận hàng</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card"
                                        value="credit_card" required>
                                    <label class="form-check-label" for="credit_card">Thẻ tín dụng</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypal"
                                        value="paypal" required>
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block mt-3">Thanh Toán</button>
                        </form>

                        <!-- Hiển thị thông báo lỗi nếu có -->
                        @if(session('error'))
                            <div class="alert alert-danger mt-3" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <a href="{{ route('transaction.history') }}">Lịch sử giao dịch</a>
    </div>
</div>

@endsection