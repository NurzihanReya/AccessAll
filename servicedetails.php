<?php
if(!isset($_SESSION)) session_start();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <title>Service Details</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_nav.php'; ?>
    <?php
    $service_id = $_GET['sid'];

    $sql = "SELECT services.*, organizations.name AS organization_name FROM services
    JOIN organizations ON services.o_id = organizations.o_id";
$result = mysqli_query($conn, $sql);
$noResult = true;


while ($row = mysqli_fetch_assoc($result)) {
$noResult = false;
$service_id = $row['s_id'];
$service_name = $row['service_name'];
$description = $row['description'];
$organization_name = $row['organization_name'];
$bin =  $row['bin'];
$address =  $row['address'];
$phone_number =  $row['phone_number'];
    echo'
        
    ';
};
    ?>


    <!-- Optional JavaScript 
$sql_notification = "INSERT INTO `notifications` (`recipient_id`, `created_on`, `is_seen`, `message`) VALUES ('$$id', current_timestamp(), '1', 'test');";
       $result2 = mysqli_query($conn, $sql_notification);
    
    -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>