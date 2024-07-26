@extends('admin.layout')
@section('titlepage', 'Danh sách sản phẩm')
@section('content')

    <section>
        <div class="container">
            <div class="col3">
                <h2>Thêm Mới Sản Phẩm</h2>
                <form action="{{ route('productadd') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <select name="category_id" id="">
                        <option value="0" selected>Chọn danh mục</option>
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <input type="text" name="name" placeholder="Tên sản phẩm">
                    <input type="text" name="price" placeholder="Giá">
                    <input type="text" name="description" placeholder="Mô tả">
                    <input type="text" name="quantity" placeholder="Số lượng">
                    <input type="file" name="img"> <!-- Thêm trường nhập hình ảnh -->
                    <input type="submit" value="Thêm">
                </form>
            </div>
            <div class="col9">
                <h2>Danh Sách Sản Phẩm</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>MÔ Tả</th>
                            <th>Số Lượng</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><img src="{{asset('uploaded/' . $item->img) }}" alt="" height="75px"></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->quantity}}</td>
                                <td class="action-icons">
                                    <a href="{{ route('productupdateform', ['id' => $item->id]) }}">Sửa</a>
                                    |
                                    <a href="{{ route('productdelete', ['id' => $item->id]) }}" onclick="return confirmDelete()">Xóa</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="pagination">
                    {{$products->links('pagination::default')}}
                </div>
            </div>
        </div>
        </secti>
</div>

@endsection