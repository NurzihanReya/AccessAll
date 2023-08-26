<?php
include 'partials/_dbconnect.php';
session_start();




if (!isset($_SESSION['useremail'])) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}


$useremail = mysqli_real_escape_string($conn, $_SESSION['useremail']);




$sql = "SELECT * FROM users WHERE useremail='$useremail'";
$result = mysqli_query($conn, $sql);


if (!$result) {
    echo "Error fetching user details: " . mysqli_error($conn);
    exit();
}


$user = mysqli_fetch_assoc($result);


if (isset($_POST['sosreport'])) {
    $sostype = $_POST['sosreport'];
    $keywords = preg_split('/[\s;]+/', $sostype);
    $sostype = $keywords[0];
   
    if (count($keywords) >= 2) {
        $service_id = $keywords[1];
       
        $sql = "INSERT INTO reports (type, r_time, flag, u_id, s_id)
                VALUES ('$sostype', NOW(), 1, '$user[name]', $service_id)";
       
        $result = mysqli_query($conn, $sql);


        if (!$result) {
            echo "Error inserting report: " . mysqli_error($conn);
            exit();
        }


        header("Location: userhome.php");
    } else {
        echo "Invalid sosreport format.";
        exit();
    }
} else {
    echo "sosreport not set in POST.";
    exit();
}
?>