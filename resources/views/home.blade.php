@extends('layout')
@section('title', 'Trang Chủ - GYMSTER')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/carousel-1.jpg" alt="Hình ảnh">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase">Trung Tâm Gym Tốt Nhất</h5>
                        <h1 class="display-2 text-white text-uppercase mb-md-4">Xây Dựng Cơ Thể Khỏe Mạnh Với Gymster
                        </h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 me-3">Tham Gia</a>
                        <a href="{{ route('contact') }}" class="btn btn-light py-md-3 px-md-5">Liên Hệ</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/carousel-2.jpg" alt="Hình ảnh">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase">Trung Tâm Gym Tốt Nhất</h5>
                        <h1 class="display-2 text-white text-uppercase mb-md-4">Phát Triển Sức Mạnh Với Huấn Luyện Viên
                            Của Chúng Tôi</h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 me-3">Tham Gia</a>
                        <a href="{{ route('contact') }}" class="btn btn-light py-md-3 px-md-5">Liên Hệ</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Trước</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sau</span>
        </button>
    </div>
</div>
<!-- Carousel End -->


<!-- Programe Start -->
<div class="container-fluid programe position-relative px-5 mt-5" style="margin-bottom: 135px;">
    <div class="row g-5 gb-5">
        <div class="col-lg-4 col-md-6">
            <div class="bg-light rounded text-center p-5">
                <i class="flaticon-six-pack display-1 text-primary"></i>
                <h3 class="text-uppercase my-4">Xây Dựng Cơ Thể</h3>
                <p>Sed amet tempor amet sit kasd sea lorem dolor ipsum elitr dolor amet kasd elitr duo vero amet amet
                    stet</p>
                <a class="text-uppercase" href="">Xem Thêm <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="bg-light rounded text-center p-5">
                <i class="flaticon-barbell display-1 text-primary"></i>
                <h3 class="text-uppercase my-4">Nâng Tạ</h3>
                <p>Sed amet tempor amet sit kasd sea lorem dolor ipsum elitr dolor amet kasd elitr duo vero amet amet
                    stet</p>
                <a class="text-uppercase" href="">Xem Thêm <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="bg-light rounded text-center p-5">
                <i class="flaticon-bodybuilding display-1 text-primary"></i>
                <h3 class="text-uppercase my-4">Xây Dựng Cơ Bắp</h3>
                <p>Sed amet tempor amet sit kasd sea lorem dolor ipsum elitr dolor amet kasd elitr duo vero amet amet
                    stet</p>
                <a class="text-uppercase" href="">Xem Thêm <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-12 col-md-6 text-center">
            <h1 class="text-uppercase text-light mb-4">Giảm Giá 30% Mùa Hè Này</h1>
            <a href="" class="btn btn-primary py-3 px-5">Trở Thành Thành Viên</a>
        </div>
    </div>
</div>
<!-- Programe End -->

<!-- Products Start -->
<div class="container-fluid p-5">
    <div class="mb-5 text-center">
        <h5 class="text-primary text-uppercase">Sản Phẩm Của Chúng Tôi</h5>
        <h1 class="display-3 text-uppercase mb-0">Sản Phẩm Mới Nhất</h1>
    </div>
    <div class="row g-5">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-6">
                <div class="product-item bg-light text-center rounded">
                    <img class="img-fluid" src="{{ asset('uploaded/' . $product->img) }}" alt="{{ $product->name }}">
                    <div class="p-4">
                        <h5 class="text-uppercase">
                            <a href="{{ route('detail', ['id' => $product->id]) }}" class="text-dark">
                                {{ $product->name }}
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
</div>
<!-- Products End -->

<!-- Products End -->



<!-- Team Start -->
<div class="container-fluid p-5">
    <div class="mb-5 text-center">
        <h5 class="text-primary text-uppercase">Đội Ngũ</h5>
        <h1 class="display-3 text-uppercase mb-0">Huấn Luyện Viên Chuyên Nghiệp</h1>
    </div>
    <div class="row g-5">
        <div class="col-lg-4 col-md-6">
            <div class="team-item position-relative">
                <div class="position-relative overflow-hidden rounded">
                    <img class="img-fluid w-100" src="img/team-1.jpg" alt="">
                    <div class="team-overlay">
                        <div class="d-flex align-items-center justify-content-start">
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4"
                    style="background: rgba(34, 36, 41, .9);">
                    <h5 class="text-uppercase text-light">John Deo</h5>
                    <p class="text-uppercase text-secondary m-0">Huấn Luyện Viên</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="team-item position-relative">
                <div class="position-relative overflow-hidden rounded">
                    <img class="img-fluid w-100" src="img/team-2.jpg" alt="">
                    <div class="team-overlay">
                        <div class="d-flex align-items-center justify-content-start">
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4"
                    style="background: rgba(34, 36, 41, .9);">
                    <h5 class="text-uppercase text-light">James Taylor</h5>
                    <p class="text-uppercase text-secondary m-0">Huấn Luyện Viên</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="team-item position-relative">
                <div class="position-relative overflow-hidden rounded">
                    <img class="img-fluid w-100" src="img/team-3.jpg" alt="">
                    <div class="team-overlay">
                        <div class="d-flex align-items-center justify-content-start">
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4"
                    style="background: rgba(34, 36, 41, .9);">
                    <h5 class="text-uppercase text-light">Adam Phillips</h5>
                    <p class="text-uppercase text-secondary m-0">Huấn Luyện Viên</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Blog Start -->
<div class="container-fluid p-5">
    <div class="mb-5 text-center">
        <h5 class="text-primary text-uppercase">Blog Của Chúng Tôi</h5>
        <h1 class="display-3 text-uppercase mb-0">Bài Viết Mới Nhất</h1>
    </div>
    <div class="row g-5">
        <div class="col-lg-4">
            <div class="blog-item">
                <div class="position-relative overflow-hidden rounded-top">
                    <img class="img-fluid" src="img/blog-1.jpg" alt="">
                </div>
                <div class="bg-dark d-flex align-items-center rounded-bottom p-4">
                    <div class="flex-shrink-0 text-center text-secondary border-end border-secondary pe-3 me-3">
                        <span>01</span>
                        <h6 class="text-light text-uppercase mb-0">Tháng Một</h6>
                        <span>2045</span>
                    </div>
                    <a class="h5 text-uppercase text-light" href="">Sed amet tempor amet sit kasd sea lorem</h4></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="blog-item">
                <div class="position-relative overflow-hidden rounded-top">
                    <img class="img-fluid" src="img/blog-2.jpg" alt="">
                </div>
                <div class="bg-dark d-flex align-items-center rounded-bottom p-4">
                    <div class="flex-shrink-0 text-center text-secondary border-end border-secondary pe-3 me-3">
                        <span>01</span>
                        <h6 class="text-light text-uppercase mb-0">Tháng Một</h6>
                        <span>2045</span>
                    </div>
                    <a class="h5 text-uppercase text-light" href="">Sed amet tempor amet sit kasd sea lorem</h4></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="blog-item">
                <div class="position-relative overflow-hidden rounded-top">
                    <img class="img-fluid" src="img/blog-3.jpg" alt="">
                </div>
                <div class="bg-dark d-flex align-items-center rounded-bottom p-4">
                    <div class="flex-shrink-0 text-center text-secondary border-end border-secondary pe-3 me-3">
                        <span>01</span>
                        <h6 class="text-light text-uppercase mb-0">Tháng Một</h6>
                        <span>2045</span>
                    </div>
                    <a class="h5 text-uppercase text-light" href="">Sed amet tempor amet sit kasd sea lorem</h4></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->
@endsection