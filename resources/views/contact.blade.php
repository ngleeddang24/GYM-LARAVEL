@extends('layout')
@section('title', 'LIÊN HỆ - GYMSTER')

@section('content')

<!-- Hero Start -->
<div class="container-fluid bg-primary p-5 bg-hero mb-5">
    <div class="row py-5">
        <div class="col-12 text-center">
            <h1 class="display-2 text-uppercase text-white mb-md-4">Liên Hệ</h1>
            <a href="{{ route('home') }}" class="btn btn-primary py-md-3 px-md-5 me-3">Trang Chủ</a>
            <a href="{{ route('contact') }}" class="btn btn-light py-md-3 px-md-5">Liên Hệ</a>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Contact Start -->
<div class="container-fluid p-5">
    <div class="mb-5 text-center">
        <h5 class="text-primary text-uppercase">Liên Hệ Chúng Tôi</h5>
        <h1 class="display-3 text-uppercase mb-0">Liên Lạc</h1>
    </div>
    <div class="row g-5 mb-5">
        <div class="col-lg-4">
            <div class="d-flex flex-column align-items-center bg-dark rounded text-center py-5 px-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3"
                    style="width: 60px; height: 60px;">
                    <i class="fa fa-map-marker-alt fs-4 text-white"></i>
                </div>
                <h5 class="text-uppercase text-primary">Đến Thăm</h5>
                <p class="text-secondary mb-0">31/24 Lê Thị Hồng, Phường 7, Quận Gò Vấp, Tp.HCM</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex flex-column align-items-center bg-dark rounded text-center py-5 px-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3"
                    style="width: 60px; height: 60px;">
                    <i class="fa fa-envelope fs-4 text-white"></i>
                </div>
                <h5 class="text-uppercase text-primary">Gửi Email</h5>
                <p class="text-secondary mb-0">nguyenleduydang@gmail.com</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex flex-column align-items-center bg-dark rounded text-center py-5 px-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3"
                    style="width: 60px; height: 60px;">
                    <i class="fa fa-phone fs-4 text-white"></i>
                </div>
                <h5 class="text-uppercase text-primary">Gọi Chúng Tôi</h5>
                <p class="text-secondary mb-0">0936587415</p>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-6">
            <div class="bg-dark p-5">
                <form>
                    <div class="row g-3">
                        <div class="col-6">
                            <input type="text" class="form-control bg-light border-0 px-4" placeholder="Tên Của Bạn"
                                style="height: 55px;">
                        </div>
                        <div class="col-6">
                            <input type="email" class="form-control bg-light border-0 px-4" placeholder="Email Của Bạn"
                                style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control bg-light border-0 px-4" placeholder="Chủ Đề"
                                style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control bg-light border-0 px-4 py-3" rows="4"
                                placeholder="Nội Dung"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Gửi Tin Nhắn</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.721974338983!2d106.6763650745178!3d10.832575758156587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528ffc77ee22f%3A0x503c19d9706a22cb!2zMjQgTMOqIFRo4buLIEjhu5NuZywgUGjGsOG7nW5nIDcsIEfDsiBW4bqlcCwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1717916513498!5m2!1svi!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection