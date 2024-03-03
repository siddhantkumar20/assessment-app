<!-- Admin Home Dashboard -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>Admin {{$admin->name}}</title>
</head>
<body>
    <div class="container">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1-admin-home" style="margin-top:20px;">
            <a href="/logout-admin">
                <button class="btn btn-success">Logout</button>
                </a>
            <header>Welcome {{$admin->name}}</header>
        <hr>

        <!-- Student's Approval -->
        <a href="{{route('studentapproval') }}">
            <button class="btn btn-success">Student's Approval</button>
        </a>
        <hr>

        <!-- Teacher's Approval -->
        <a href="{{route('teacherapproval' ) }}">
            <button class="btn btn-success">Teacher's Approval</button>
        </a>
        <hr>

        <!-- Notifications -->
        <a href="#">
            <button class="btn btn-success">Notifications</button>
        </a>
        <hr>

            </div>
        </div>
<!--     
        <h3>Notifications:</h3>
        @foreach($admin->notifications as $notification)
            <p>{{ $notification->data['user_name'] }} has registered.</p>
        @endforeach -->
    
    </div>
</body>
</html>