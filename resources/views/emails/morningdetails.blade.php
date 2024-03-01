<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         th, td {
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #04AA6D;
  color: white;
}

tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <th>Name</th>    
        <th>Email</th>
        <th>Role</th> <!-- Add this line for the "Role" column -->
    </tr>
    @foreach ($data as $item)
    <tr>
        <td>{{ $item['name'] }}</td>
        <td>{{ $item['email'] }}</td>
        <td>{{ $item['role'] }}</td> <!-- Add this line for the "Role" column -->
    </tr>
    @endforeach
</table>

</body>
</html>