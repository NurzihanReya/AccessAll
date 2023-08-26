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
    <title>AccessAll</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>

    <div class="container mt-5">

        <div class="d-flex justify-content-between mb-3">
            <h3>Your Services:</h3>
            <?php
            $org_id = $_SESSION['sno'];
            echo '<a href="view_appointments.php?org_id=' . $org_id . '" class="btn btn-primary">View All Appointments</a>
            <br>
            <a href="createorg.php" class="class="btn btn-primary">Add New Service</a>';
            ?>
        </div>

        <div class="row">
            <?php
            $org_id = $_SESSION['sno'];

            $sql = "SELECT * FROM services WHERE o_id = '$org_id'";
            $result = mysqli_query($conn, $sql);
            $noResult = true;

            if ($result) {
                $count = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $service_id = $row['s_id'];
                    $service_name = $row['service_name'];
                    $description = $row['description'];
                    $image_url = $row['image_url'];

        
                    $truncated_description = substr($description, 0, 100); 
                  

 
    echo '
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
            <img src="' . $image_url . '" class="card-img-top" alt="' . $service_name . ' Image" style="max-height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">' . $service_name . '</h5>
                <p class="card-text">' . $truncated_description . '... <a href="servicedetails.php?sid=' . $service_id . '">Read More</a></p>
                <a href="servicedetails_org.php?sid=' . $service_id . '"  class="btn btn-dark btn-block">View Organization</a> 
            </div>
        </div>
    </div>
    
    </div>'
    
    ; //to do: edit organization

    


                    $count++;

                    if ($count % 3 === 0) {
                        echo '</div><div class="row">';
                    }

                    $noResult = false;
                }
            }

            mysqli_close($conn);

            if ($noResult) {
                echo '
                <div class="jumbotron" style="width: 100%; height: 40%;">
                    <h1 class="display-4">Nothing to show!</h1>
                    <p class="lead">You have not created any organizations yet. </p>
                    <hr class="my-4">
                    <p>Create organization by clicking the button below. Follow the community standards. </p>
                    <a href="createorg.php" class="btn btn-dark btn-lg active" role="button" aria-pressed="true">Create your organization</a>
                </div>';
            }
            ?>
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