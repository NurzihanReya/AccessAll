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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Profile</title>
</head>


<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>


    <div class="container my-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>User Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td><?php echo $_SESSION['name']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $_SESSION['useremail']; ?></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    <?php
                                    if ($_SESSION['user_type_id'] == 1) {
                                        echo "Organization";
                                    } else if ($_SESSION['user_type_id'] == 2) {
                                        echo "User";
                                    } else if ($_SESSION['user_type_id'] == 0) {
                                        echo "Admin";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Appointments</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM appointments INNER JOIN services ON services.s_id=appointments.service_id WHERE user_id=$_SESSION[sno]";
                                $result = mysqli_query($conn, $sql);
                                $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);


                                foreach ($appointments as $appointment) {
                                    echo "<tr>";
                                    echo "<td>" . $appointment['service_name'] . "</td>";
                                    echo "<td>" . $appointment['appointment_date'] . "</td>";
                                    echo "<td>" . $appointment['appointment_time'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-4">

                <?php
                        if ($_SESSION['user_type_id'] == 0) {
                            echo '<a href="alluser.php" class="btn btn-dark btn-block mb-2">View All Users</a>';
                        }
                        if ($_SESSION['user_type_id'] == 1) {
                            echo '<a href="edit_service.php" class="btn btn-dark btn-block mb-2">Edit Your Service</a>';
                        }
                        ?>
            </div>
        </div>
    </div>
    </div>
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