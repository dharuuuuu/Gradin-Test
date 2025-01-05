<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Couriers</title>
</head>
<body>
    <h1>Courier List</h1>
    <a href="{{ route('couriers.create') }}">Add New Courier</a>
    
    <form action="{{ route('couriers.index') }}" method="GET">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search courier by name">
    
        <label for="level">Level:</label>
        <select id="level" name="level">
            <option value="" {{ request('level') == '' ? 'selected' : '' }}>All Levels</option>
            <option value="2,3" {{ request('level') == '2,3' ? 'selected' : '' }}>Level 2 & 3</option>
        </select>
    
        <label for="sort_by">Sort By:</label>
        <select id="sort_by" name="sort_by">
            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
            <option value="registered_at" {{ request('sort_by') == 'registered_at' ? 'selected' : '' }}>Registered At</option>
        </select>
    
        <button type="submit">Filter</button>

        <a href="{{ route('couriers.index') }}" class="btn-reset" style="margin-left: 10px; text-decoration: none; color: white; background-color: red; padding: 5px 10px; border-radius: 5px;">
            Reset
        </a>
    </form>    

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Level</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($couriers as $courier)
                <tr>
                    <td>{{ $courier->name }}</td>
                    <td>{{ $courier->email }}</td>
                    <td>{{ $courier->phone }}</td>
                    <td>{{ $courier->level }}</td>
                    <td>{{ $courier->created_at }}</td>
                    <td>
                        <a href="{{ route('couriers.show', $courier->id) }}">View</a> |
                        <a href="{{ route('couriers.edit', $courier->id) }}">Edit</a> |
                        <form action="{{ route('couriers.destroy', $courier->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $couriers->links() }}
</body>
</html>
