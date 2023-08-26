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
    <title>Notifications</title>
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
        <h2 class="text-center">Notifications</h2>

        <?php
  
        $sql = "SELECT * FROM reports INNER JOIN services ON reports.s_id=services.s_id WHERE reports.flag=1";
        $result = mysqli_query($conn, $sql);

        //$reports=mysqli_fetch_all($result,MYSQLI_ASSOC);
  
              if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<div class="card mb-3">';
                      echo '<div class="card-header">' . $row['service_name'] . '</div>';
                      echo '<div class="card-body">';
                      echo '<p>There has been a report of <strong>' . $row['type'] . '</strong> at <strong>'.$row['r_time'].'</strong></p>';
                      echo '<p>Reported By: ' . $row['u_id'] . '</p>';
                      echo '</div>';
                      echo '</div>';
                  }
              } else {
                  echo '<center><p class="text-danger">No new notifications</p>';
              }
        $sql = "UPDATE reports SET flag=0 WHERE flag=1";
        $result = mysqli_query($conn, $sql);
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