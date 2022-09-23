<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-success" href="">Course</a>
            </div>
        </div>
        <section>
            <div class="row">
                @foreach ($courses as $item)
                    <div class="col-md-3" style="border: 1px solid gray;padding:10px;margin:10px">
                        <strong>Name: {{$item->name}}</strong><br>
                        <strong>Price: {{$item->amount}} ৳ </strong><br>
                        <a class="btn btn-primary btn-sm" href="{{route('checkout.course',$item->id)}}">Checkout</a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</body>
</html>