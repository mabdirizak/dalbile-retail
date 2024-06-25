<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="/public">
</head>
<body>
    <h1 class="text-center text-info">Order Details</h1>
    Client Name:<h3>{{$order->name}}</h3>
    Client Email:<h3>{{$order->email}}</h3>
    Client: Phone:<h3>{{$order->phone}}</h3>
    Client Address:<h3>{{$order->address}}</h3>

    Product Name:<h3>{{$order->product_title}}</h3>
    Qauntity:<h3>{{$order->quantity}}</h3>
    Price:<h3>{{$order->price}}</h3>
    Payment Status:<h3>{{$order->payment_status}}</h3>
    Delivery Status:<h3>{{$order->delivery_status}}</h3>
    <br><br>
    <!--the image is not visible, solve this-->
    Image:<img height="250" width="450" src="product/{{$order->image}}">
</body>
</html>