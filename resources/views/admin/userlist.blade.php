@extends('admin.layout')
@section('titlepage', 'Danh sách người dùng')
@section('content')

<section>
    <div class="container">
        <div class="col3">
            <h2>Thêm Mới Người Dùng</h2>
            <form action="{{ route('user.create') }}" method="post">
                @csrf
                <select name="role">
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
                <input type="text" name="name" placeholder="Tên" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <input type="submit" value="Thêm">
            </form>
        </div>
        <div class="col12">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Pass</th>
                        <th>Role</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->role == 1 ? 'Admin' : 'User' }}</td>
                            <td class="action-icons">
                                <a href="{{ route('user.edit.form', ['id' => $user->id]) }}">Sửa</a>
                                |
                                <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirmDelete()">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection
