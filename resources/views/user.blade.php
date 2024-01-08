<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Include Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <h1 class="text-center">Dashboard Pasien</h1>

                <!-- Checkup Registration Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Checkup Registration</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('patient.checkup') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="complaint">Keluhan / Gejala:</label>
                                <textarea class="form-control" name="complaint" id="complaint" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="doctor">Pilih Dokter:</label>
                                <select class="form-control" name="doctor" id="doctorSelect" required>
                                    <option value="">Pilih Doktor..</option>
                                    @foreach ($doctors as $doctor)
                                        <option data-api-route="{{ route('doctor.schedule') }}"
                                            value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                    <!-- Add more doctor options as needed -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="schedule">Jadwal Praktek:</label>
                                <select class="form-control" name="schedule" id="scheduleSelect" disabled required>
                                    <!-- Options will be dynamically added here -->
                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary">Daftar Checkup</button>
                        </form>
                    </div>
                </div>

                <!-- Checkup Histories Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Checkup Histories</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Dokter</th>
                                    <th>Keluhan</th>
                                    <th>No. Antrian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2022-01-01</td>
                                    <td>Dokter 1</td>
                                    <td>Demam dan flu</td>
                                    <td>001
                                    <td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Include Bootstrap 3 JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var doctorSelect = document.getElementById('doctorSelect');
        var scheduleSelect = document.getElementById('scheduleSelect');

        doctorSelect.addEventListener('change', function () {
            var selectedDoctorOption = doctorSelect.options[doctorSelect.selectedIndex];
            var apiRoute = selectedDoctorOption.getAttribute('data-api-route');

            // Get the 'id' variable from the selected option
            var doctorId = selectedDoctorOption.value;

            // Get the CSRF token from the meta tag
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Define the request body data with 'id' and CSRF token
            var requestBody = {
                id: doctorId,
                _token: csrfToken, // Include the CSRF token
                // Add other properties if needed
            };

            // Make an AJAX request to the API with request body
            fetch(apiRoute, {
                method: 'POST', // Adjust the HTTP method as needed
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken, // Include the CSRF token in the headers
                },
                body: JSON.stringify(requestBody),
            })
            .then(response => response.json())
            .then(data => {
                // Update the schedule options in the scheduleSelect dropdown
                scheduleSelect.innerHTML = ''; // Clear existing options

                data.forEach(function (schedule) {
                    var option = document.createElement('option');
                    option.value = schedule.id; // Assuming 'id' is the value for the option
                    option.textContent = schedule.schedule; // Assuming 'schedule' is the text for the option
                    scheduleSelect.appendChild(option);
                });

                // Enable the scheduleSelect
                scheduleSelect.removeAttribute('disabled');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>



</html>
