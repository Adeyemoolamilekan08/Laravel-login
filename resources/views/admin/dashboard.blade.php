<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <h1>Welcome To Dashboard</h1> --}}


    {{-- <h1>Welcome /*{{session('username') }} Staff Dashboard</h1> --}}

    <h1>Welcome {{session('logadmin') }} Admin Dashboard</h1>

    <a href="{{ url('logout') }}">Logout</a>

</body>
</html>