<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

</head>

<body>
    <div class="container">
        <h1 class="text-center">This is customer create</h1>
        <div class="card-body">
            <form action="{{ route('customer.insert') }}" method="POST">
                @csrf
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your name" required><br>

                <label for="">Address</label>
                <textarea name="address" class="form-control" cols="30" rows="10" placeholder="Enter your address" required></textarea><br>

                <label for="">Phone</label>
                <input type="number" class="form-control" name="phone" placeholder="eg.09777777" required><br>

                <input type="submit" class="btn btn-success" value="Create">
            </form>
        </div>
    </div>
</body>

</html>
