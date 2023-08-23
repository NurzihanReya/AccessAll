<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .service-details,
    .user-details {
        padding: 20px;
        border: 1px solid #d3d3d3;
        border-radius: 5px;
        margin-bottom: 20px;
        background-color: #f8f9fa;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    h4 {
        margin-top: 20px;
        color: #333;
    }

    p {
        color: #666;
        margin-bottom: 0.5rem;
    }

    .icon-container {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #28a745;
        font-size: 50px;
        margin-top: 20px;
    }

    .btn-back {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <?php
    include 'partials/_dbconnect.php';
    include 'partials/_nav.php';
    ?>
    <div class="container mt-5">
        <div class="appointment-card">
            <h2 class="text-center">Appointment Summary</h2>
            <!-- for user -->

            <?php

            if (isset($_GET['appointment_id'])) {
                $appointment_id = $_GET['appointment_id'];

                $sql = "SELECT appointments.*, services.service_name, users.name AS user_name, users.useremail AS user_email
                        FROM appointments
                        JOIN services ON appointments.service_id = services.s_id
                        JOIN users ON appointments.user_id = users.id
                        WHERE appointment_id = $appointment_id";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    echo '<div class="service-details">';
                    echo '<h4>Service Details</h4>';
                    echo '<p><strong>Service Name:</strong> ' . $row['service_name'] . '</p>';
                    echo '<p><strong>Appointment Date:</strong> ' . $row['appointment_date'] . '</p>';
                    echo '<p><strong>Appointment Time:</strong> ' . $row['appointment_time'] . '</p>';
                    echo '</div>';

                    echo '<div class="user-details">';
                    echo '<h4>Your Details</h4>';
                    echo '<p><strong>Phone Number:</strong> ' . $row['phone_number'] . '</p>';
                    echo '<p><strong>Name:</strong> ' . $row['user_name'] . '</p>';
                    echo '<p><strong>Email:</strong> ' . $row['user_email'] . '</p>';
                    echo '</div>';

                    echo '<div class="icon-container">';
                    echo '<i class="fas fa-check-circle"></i>';
                    echo '</div>';
                } else {
                    echo '<p class="text-danger">Appointment details not found.</p>';
                }
            } else {
                echo '<p class="text-danger">Invalid appointment ID.</p>';
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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