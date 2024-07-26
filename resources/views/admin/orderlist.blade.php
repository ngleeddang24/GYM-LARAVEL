@extends('admin.layout')
@section('titlepage', 'Đơn hàng')
@section('content')


<section>
    <table class="container">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người Dùng</th>
                <th>Tổng Giá</th>
                <th>Thời Gian Tạo</th>
                <th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user_id }}</td>
                    <td>{{ $transaction->total_price }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>
                        <form action="{{ route('order.update.status', $transaction->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('PATCH') <!-- Sử dụng PATCH method -->

                            <input type="radio" id="success" name="order_status" value="Giao dịch thành công" {{ $transaction->order_status == 'Giao dịch thành công' ? 'checked' : '' }}>
                            <label for="success">Giao dịch thành công</label><br>

                            <input type="radio" id="failed" name="order_status" value="Giao dịch không thành công" {{ $transaction->order_status == 'Giao dịch không thành công' ? 'checked' : '' }}>
                            <label for="failed">Giao dịch không thành công</label><br>

                            <input type="radio" id="pending" name="order_status" value="Chưa thanh toán" {{ $transaction->order_status == 'Chưa thanh toán' ? 'checked' : '' }}>
                            <label for="pending">Chưa thanh toán</label><br>

                            <input type="radio" id="shipping" name="order_status" value="Đang giao hàng" {{ $transaction->order_status == 'Đang giao hàng' ? 'checked' : '' }}>
                            <label for="shipping">Đang giao hàng</label><br>

                            <input type="radio" id="cancel" name="order_status" value="Đã hủy" {{ $transaction->order_status == 'Đã hủy' ? 'checked' : '' }}>
                            <label for="cancel">Đã hủy</label><br>

                            <button type="submit" class="btn btn-primary" onclick="showSuccessMessage()">Cập Nhật</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</section>

@endsection