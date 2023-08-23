<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>AccessAll - Service Details</title>
    <style>
    <style>body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 20px;
    }

    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
        margin-top: 10px;
    }

    .card-text {
        font-size: 18px;
        line-height: 1.5;
    }

    .form-label {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        font-weight: bold;
        font-size: 20px;
    }

    .card-body {
        padding: 20px;
    }

    .mt-3 {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .col-md-8 {
            margin-bottom: 20px;
        }
    }
    </style>

    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                if (isset($_GET['sid'])) {
                    $service_id = $_GET['sid'];

                    // Fetch service and organization details
                    $sql = "SELECT services.*, organizations.name AS organization_name, organizations.phone_number, organizations.address, organizations.city FROM services
                            JOIN organizations ON services.o_id = organizations.o_id
                            WHERE services.s_id = '$service_id'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $service_name = $row['service_name'];
                            $description = $row['description'];
                            $image_url = $row['image_url'];
                            $organization_name = $row['organization_name'];
                            $phone_number = $row['phone_number'];
                            $address = $row['address'];
                            $city = $row['city'];

                            // Display service details
                            echo '<div class="card mb-4">';
                            echo '<img src="' . $image_url . '" class="card-img-top" alt="' . $service_name . ' Image">';
                            echo '<div class="card-body">';
                            echo '<h2 class="card-title">' . $service_name . '</h2>';
                            echo '<p class="card-text">' . $description . '</p>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<div class="jumbotron"><h1 class="display-4">Details not found</h1></div>';
                        }
                    } else {
                        echo '<div class="jumbotron"><h1 class="display-4">Error executing the query: ' . mysqli_error($conn) . '</h1></div>';
                    }
                } else {
                    echo '<div class="jumbotron"><h1 class="display-4">Invalid request</h1></div>';
                }

                mysqli_close($conn);
                ?>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Organization Details</div>
                    <div class="card-body">
                        <p><span class="form-label">Organization Name:</span> <?php echo $organization_name; ?></p>
                        <p><span class="form-label">Phone Number:</span> <?php echo $phone_number; ?></p>
                        <p><span class="form-label">Address:</span> <?php echo $address; ?></p>
                        <p><span class="form-label">City:</span> <?php echo $city; ?></p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Take an Appointment</div>
                    <div class="card-body">
                        <form action="submit_appointment.php" method="post">
                            <div class="form-group">
                                <label for="phone_number" class="form-label">Phone Number:</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                            </div>
                            <div class="form-group">
                                <label for="appointment_date" class="form-label">Date:</label>
                                <input type="date" class="form-control" id="appointment_date" name="appointment_date"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="appointment_time" class="form-label">Time:</label>
                                <input type="time" class="form-control" id="appointment_time" name="appointment_time"
                                    required>
                            </div>
                            <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
                            <button type="submit" class="btn btn-primary btn-block">Book Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>