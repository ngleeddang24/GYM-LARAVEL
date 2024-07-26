@extends('admin.layout')
@section('titlepage', 'Chỉnh Sửa Sản Phẩm')
@section('content')
<section>
    <div class="container">
        <h2>Chỉnh Sửa Sản Phẩm</h2>
        <form action="{{ route('productupdate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <select name="category_id" id="">
                <option value="0" selected>Chọn danh mục</option>
                @foreach ($categories as $item)
                <option value="{{$item->id}}" {{ $product->category_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
            </select>
            <input type="text" name="name" value="{{ $product->name }}" placeholder="Tên sản phẩm">
            <input type="text" name="price" value="{{ $product->price }}" placeholder="Giá">
            <input type="text" name="description" value="{{ $product->description }}" placeholder="Mô tả">
            <input type="text" name="quantity" value="{{ $product->quantity }}" placeholder="Số lượng">
            <input type="file" name="img"> <!-- Thêm trường nhập hình ảnh -->
            <input type="submit" value="Cập Nhật">
        </form>
    </div>
</section>
@endsection
