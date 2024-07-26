@extends('layout')
@section('title', 'LỊCH SỬ GIA DỊCH - Gymster')

@section('content')

<!-- Hero Start -->
<div class="container-fluid bg-primary p-5 bg-hero mb-5">
    <div class="row py-5">
        <div class="col-12 text-center">
            <h1 class="display-2 text-uppercase text-white mb-md-4">Lịch Sử Giao Dịch</h1>
            <a href="{{ route('home') }}" class="btn btn-primary py-md-3 px-md-5 me-3">Trang Chủ</a>
            <a href="{{ route('transaction.history') }}" class="btn btn-light py-md-3 px-md-5">Lịch Sử Giao Dịch</a>
        </div>
    </div>
</div>
<!-- Hero End -->

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thời gian giao dịch</th>
                <th>Tổng giá trị</th>
                <th>Trạng thái đơn hàng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->total_price }}</td>
                    <td>{{ $transaction->order_status }}</td>
                    <td>
                        <form action="{{ route('transaction.delete', $transaction->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection