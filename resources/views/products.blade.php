@extends('layout')
@section('title', 'SẢN PHẨM - GYMSTER')

@section('content')

<!-- Hero Start -->
<div class="container-fluid bg-primary p-5 bg-hero mb-5">
    <div class="row py-5">
        <div class="col-12 text-center">
            <h1 class="display-2 text-uppercase text-white mb-md-4">Sản Phẩm</h1>
            <a href="{{ route('home') }}" class="btn btn-primary py-md-3 px-md-5 me-3">Trang Chủ</a>
            <a href="{{ route('products') }}" class="btn btn-light py-md-3 px-md-5">Sản Phẩm</a>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Search Form Start -->
<div class="container mb-5">
    <form action="{{ route('products.search') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="query" placeholder="Nhập từ khóa tìm kiếm" required>
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
    </form>
</div>
<!-- Search Form End -->

<!-- Category Start -->
<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-uppercase mb-4">Danh Mục Sản Phẩm</h2>
            <ul class="list-group">
                @foreach($categories as $category)
                    <a href="{{ route('category.products', ['id' => $category->id]) }}" class="list-group-item list-group-item-action">{{ $category->name }}</a>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- Category End -->

<!-- Product List Start -->
<div class="mb-5 text-center">
    <h2 class="text-primary text-uppercase">
        @if(isset($query))
            Kết quả tìm kiếm cho: "{{ $query }}"
        @elseif(isset($currentCategory))
            {{ $currentCategory->name }}
        @else
            Sản Phẩm Của Chúng Tôi
        @endif
    </h2>
</div>

<div class="row g-5">
    @foreach($products as $product)
        <div class="col-lg-3 col-md-6">
            <div class="product-item bg-light text-center rounded">
                <img class="img-fluid" src="{{ asset('uploaded/' . $product->img) }}" alt="{{ $product->name }}">
                <div class="p-4">
                    <h5 class="text-uppercase">
                        <a href="{{ route('detail', ['id' => $product->id]) }}" class="text-dark">
                            {{ \Illuminate\Support\Str::limit($product->name, 20) }}
                        </a>
                    </h5>
                    <p class="text-muted">{{ Illuminate\Support\Str::limit($product->description, 50) }}</p>
                    <h6 class="text-primary">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h6>
                    <a href="{{ route('detail', ['id' => $product->id]) }}" class="btn btn-primary text-uppercase">Mua Ngay</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- Product List End -->
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Pagination Start -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{$products->links('pagination::bootstrap-4')}}
                </ul>
            </nav>
            <!-- Pagination End -->
        </div>
    </div>
</div>

@endsection
