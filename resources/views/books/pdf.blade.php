<!DOCTYPE html>
<html>

<head>
    <title>Books List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Books List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Cover Image Path</th>
                <th>File Path</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->category_name }}</td>
                <td>{{ $book->quantity }}</td>
                <td>{{ $book->cover_image_path }}</td>
                <td>{{ $book->file_path }}</td>
                <td>{{ $book->user_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
