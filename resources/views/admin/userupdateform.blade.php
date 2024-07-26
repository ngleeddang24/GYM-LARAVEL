@extends('admin.layout')
@section('titlepage', isset($user) ? 'Sửa Thông Tin Người Dùng' : 'Thêm Người Dùng Mới')
@section('content')

<section>
    <div class="container">
        <div class="col3">
            <h2>{{ isset($user) ? 'Sửa Thông Tin Người Dùng' : 'Thêm Người Dùng Mới' }}</h2>
            <form action="{{ isset($user) ? route('user.edit', ['id' => $user->id]) : route('user.create') }}" method="post">
                @csrf
                @if (isset($user))
                    @method('POST')
                @endif
                <select name="role">
                    <option value="0" {{ isset($user) && $user->role == 0 ? 'selected' : '' }}>User</option>
                    <option value="1" {{ isset($user) && $user->role == 1 ? 'selected' : '' }}>Admin</option>
                </select>
                <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}" placeholder="Tên" required>
                <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mật khẩu {{ isset($user) ? '(Để trống nếu không đổi)' : '' }}">
                <input type="submit" value="{{ isset($user) ? 'Cập Nhật' : 'Thêm' }}">
            </form>
        </div>
    </div>
</section>

@endsection


