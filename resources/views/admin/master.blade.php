<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{ asset('') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="admin/asset/css/style.css">
    <script src="admin/asset/vendor/js/jquery.min.js"></script>
    <script src="admin/asset/vendor/js/jquery-3.2.1.min.js"></script>
    @yield('style')
    <title> @yield('title') </title>
</head>

<body>
    @if (Route::currentRouteName() !== 'login-admin')
        @php
            $admin = [];
            if (Session::has('adminLogin')) {
                $admin = App\Models\User::where('id', '=', Session::get('adminLogin'))->first();
            }
        @endphp
        @include('admin.layout.header')

        <br><br><br>
    @endif
    <div class="@if (Route::currentRouteName() !== 'login-admin') container-fluid mt-5 pt-sm-3 pt-5 @endif ">
        @yield('main')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#btnMenuClickUserIcon').click(function() {
                $('#boxMenuClickUserIcon').toggleClass('d-none');
            });
        });
    </script>
    @yield('script')
</body>

</html>
