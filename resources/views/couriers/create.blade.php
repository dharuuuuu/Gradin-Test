<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Courier</title>
</head>
<body>
    <h1>Add New Courier</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('couriers.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <br>
        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>
        <br>
        <label>Level:</label>
        <select name="level" required>
            <option value="1" {{ old('level') == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('level') == 4 ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('level') == 5 ? 'selected' : '' }}>5</option>
        </select>
        <br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
