<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('LayoutAdmin/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <header>
        <h1>@yield('titlepage')</h1>
    </header>

    @include('admin.header')

    @yield('content')


    <script>
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa không?');
        }
        function showSuccessMessage() {
            alert('Đã cập nhật thành công!');
        }
    </script>
</body>

</html>