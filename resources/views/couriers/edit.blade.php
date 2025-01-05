<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Courier</title>
</head>
<body>
    <h1>Edit Courier</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Courier -->
    <form action="{{ route('couriers.update', $courier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name', $courier->name) }}" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email', $courier->email) }}" required><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $courier->phone) }}" required><br><br>

        <label for="level">Level:</label><br>
        <select id="level" name="level" required>
            <option value="1" {{ old('level', $courier->level) == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('level', $courier->level) == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('level', $courier->level) == 3 ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('level', $courier->level) == 4 ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('level', $courier->level) == 5 ? 'selected' : '' }}>5</option>
        </select><br><br>

        <button type="submit">Update Courier</button>
    </form>

    <br>
    <a href="{{ route('couriers.index') }}">Back to Courier List</a>
</body>
</html>
