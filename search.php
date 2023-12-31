<?php
session_start(); 
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
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

    <title>SmartSociety</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>


    <div class="container my-3">
        <h2 class="py-2">Search Results for <em>"<?php echo $_GET['search']?>"</em></h2>

        <?php
        $noresult = true;
        $query = $_GET["search"];
        $sql = "SELECT services.*, organizations.name AS organization_name, organizations.phone_number AS phone_number, organizations.address AS address, organizations.city as city 
        FROM services
        JOIN organizations ON services.o_id = organizations.o_id
        WHERE service_name LIKE '%$query%' OR description LIKE '%$query%'";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $noresult = false;
            


            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $service_id = $row['s_id'];
                $service_name = $row['service_name'];
                $description = $row['description'];
                $organization_name = $row['organization_name'];
                $image_url = $row['image_url'];
                $s_id= $row['s_id'];
                $phone_number= $row['phone_number'];
                $address= $row['address'];
                $city= $row['city'];
                $url = "servicedetails_user.php?sid=". $s_id;
                $truncated_description = substr($description, 0, 120);

            
            echo '<div class="card">
            <h5 class="card-header"><a href="servicedetails_user.php?sid=' . $service_id . '">'.$organization_name.' -  '.$service_name.' </a></h5>
            <div class="card-body">
                <p class="card-title"><b>Description: </b>'.$truncated_description.'... <a href="servicedetails_user.php?sid=' . $service_id . '">Read More</a></p>
                <p class="card-text"><b>Phone Number: </b>'.$phone_number.'</p>
                <p class="card-text"><b>Address: </b>'.$address.'</p>
                <p class="card-text"><b>City: </b>'.$city.'</p>
                <a href="servicedetails_user.php?sid=' . $service_id . '" class="btn btn-primary btn-block">Create Appointment</a>
                <br>'; 
            }}

            if($noresult)
            {
                echo'<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p class="display-4">No Results Found</p>
                    
                </div>
             </div>';
            }
        ?>






        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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