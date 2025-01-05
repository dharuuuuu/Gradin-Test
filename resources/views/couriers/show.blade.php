<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Details</title>
</head>
<body>
    <h1>Courier Details</h1>
    <p><strong>Name:</strong> {{ $courier->name }}</p>
    <p><strong>Email:</strong> {{ $courier->email }}</p>
    <p><strong>Phone:</strong> {{ $courier->phone }}</p>
    <p><strong>Level:</strong> {{ $courier->level }}</p>
    <a href="{{ route('couriers.index') }}">Back to List</a>
</body>
</html>
