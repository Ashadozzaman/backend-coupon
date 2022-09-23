<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout Page</title>
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
                <a class="btn btn-success" href="{{ route('course') }}">Course</a>
            </div>
        </div>
        <section>
            <h3><u> Course</u></h3>
            @if (Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('submit.checkout') }}" method="post">
                        @csrf
                        <label for="">Name : {{ $course->name }}</label><br>
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <label for="">Price : {{ $course->amount }}</label><br>
                        <hr>
                        @if (isset($coupon))
                            <label for="">Discount: - {{ $coupon['rate'] }} {{ $coupon['type'] }}</label><br>
                            <label for="">Final Price</label>
                            <input class="form-control" type="text" name="price"
                                value="{{ $coupon['final_price'] }}" readonly>
                            <label for="">Use Coupon</label>
                            <input class="form-control" type="text" name="coupon" value="{{ $coupon['coupon'] }}" readonly>
                        @else
                            <label for="">Final Price</label><br>
                            <input class="form-control" type="text" name="price" value="{{ $course->amount }}"
                                readonly>
                        @endif
                        <button class="btn btn-success" type="submit">Checkout</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('checkout.course', $course->id) }}" method="post">
                        @csrf
                        <label for="">Use Coupon</label>
                        <input type="text" name="coupon" class="form-control" placeholder="Enter coupon">
                        <button class="btn btn-primary btn-sm">Use Coupon</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
