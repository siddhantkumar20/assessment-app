<!-- User-Type Page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>User Type</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center two-button" style="height: 100vh;">
            
            <!-- Admin Button -->
            <div class="d-flex col-xs col-lg-4 col-sm-12 justify-content-center">
            <a href="admin">
            <button class="btn1">Admin</button>
            </a>
            </div>

            <!-- Teacher Button -->
            <div class="d-flex col-xs col-lg-4 col-sm-6 justify-content-center">
            <a href="teacherlogin">
            <button class="btn1">Teacher</button>
            </a>
            </div>

            <!-- Student Button -->
            <div class="d-flex col-xs col-lg-4 col-sm-6 justify-content-center">
            <a href="studentlogin">
            <button class="btn1">Student</button>
            </a>
            </div>

        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>