
@extends('layout')
@section('title', 'Thanh Toán Thành Công - GYMSTER')

@section('content')
<div class="container">
    <h1 class="my-4">Thanh Toán Thành Công</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <p>Cảm ơn bạn đã mua hàng! Đơn hàng của bạn đã được xử lý thành công.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Trở về Trang Chủ</a>
</div>
@endsection
