<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>    
            <th>Pending Emails</th>
        </tr>
        @foreach ($data as $email)
        <tr>
            <td>{{$email['email']}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>