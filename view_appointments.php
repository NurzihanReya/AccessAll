<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}

include 'partials/_dbconnect.php';
include 'partials/_nav.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments for Organization</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    .card {
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }

    .card-body p {
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Appointments for Organization</h2>

        <?php
          
          if (isset($_GET['org_id'])) {
              $org_id = $_GET['org_id'];
  
              $sql = "SELECT appointments.*, services.service_name, users.name AS user_name, users.useremail AS user_email
                      FROM appointments
                      JOIN services ON appointments.service_id = services.s_id
                      JOIN users ON appointments.user_id = users.id
                      WHERE services.o_id = $org_id";
              $result = mysqli_query($conn, $sql);
  
              if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<div class="card mb-3">';
                      echo '<div class="card-header">' . $row['service_name'] . '</div>';
                      echo '<div class="card-body">';
                      echo '<p><strong>Appointment Date:</strong> ' . $row['appointment_date'] . '</p>';
                      echo '<p><strong>Appointment Time:</strong> ' . $row['appointment_time'] . '</p>';
                      echo '<p><strong>User Name:</strong> ' . $row['user_name'] . '</p>';
                      echo '<p><strong>User Email:</strong> ' . $row['user_email'] . '</p>';
                      echo '<p><strong>Extra Information:</strong> ' . $row['extra'] . '</p>';
                      echo '</div>';
                      echo '</div>';
                  }
              } else {
                  echo '<p class="text-danger">No appointments found for this organization.</p>';
              }
          } else {
              echo '<p class="text-danger">Invalid organization ID.</p>';
          }
  
          mysqli_close($conn);
          ?>


    </div>

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