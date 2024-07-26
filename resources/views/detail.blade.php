@extends('layout')
@section('title', 'Chi Tiết Sản Phẩm - GYMSTER')

@section('content')
<!-- Hero Start -->
<div class="container-fluid bg-primary p-5 bg-hero mb-5">
    <div class="row py-5">
        <div class="col-12 text-center">
            <h1 class="display-2 text-uppercase text-white mb-md-4">Chi Tiết Sản Phẩm</h1>
            <a href="{{ route('home') }}" class="btn btn-primary py-md-3 px-md-5 me-3">Trang Chủ</a>
            <a href="{{ route('products') }}" class="btn btn-light py-md-3 px-md-5">Tất Cả Sản Phẩm</a>
        </div>
    </div>
</div>
<!-- Hero End -->

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('uploaded/' . $products->img) }}" class="img-fluid" alt="{{ $products->name }}" height="500px" width="500px">
        </div>
        <div class="col-md-6">
            <h1 class="text-uppercase">{{ $products->name }}</h1>
            <p class="text-muted">{{ $products->description }}</p>
            <h2 class="text-primary">{{ number_format($products->price, 0, ',', '.') }} VNĐ</h2>
            <form action="{{ route('cart.add', $products->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="quantity" class="form-label">Số Lượng</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" style="width: 70px; text-align: center;">
                </div>
                <button type="submit" class="btn btn-primary text-uppercase">Thêm vào Giỏ Hàng</button>
            </form>
        </div>
    </div>
</div>

@endsection