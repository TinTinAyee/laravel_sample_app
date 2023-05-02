<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="">
    <div class="container mt-5">
        <h1>New Blog</h1>

        <form action="{{ route('blogs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1">Description</label>
                <input type="text" name="description" class="form-control" placeholder="Description..">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>


    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
