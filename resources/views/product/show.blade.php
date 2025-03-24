<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['title'] }}</title>
</head>
<body>
    <h1>{{ $product['title'] }}</h1>
    <p>Price: {{ $product['price']['currency'] }} {{ $product['price']['value'] }}</p>
    <img src="{{ $product['images'][0]['link'] }}" alt="{{ $product['title'] }}">
    <p><a href="{{ $product['url'] }}">View on Amazon</a></p>
</body>
</html>
