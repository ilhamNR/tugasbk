<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital System</title>
    <!-- Include Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <h1 class="text-center">Sistem Poli</h1>

                <!-- Register Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Registrasi Pasien</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('patient.register')}}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Alamat:</label>
                                <input type="text" class="form-control" name="address" id="address" required>
                            </div>
                            <div class="form-group">
                                <label for="email">No KTP:</label>
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" required>
                            </div>
                            <div class="form-group">
                                <label for="email">No. HP:</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Pasien</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('patient.login')}}" method="GET">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="login_email">No. KTP</label>
                                <input type="number" class="form-control" name="no_ktp" id="login_email" required>
                            </div>


                            <button type="submit" class="btn btn-success">Login</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Include Bootstrap 3 JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
