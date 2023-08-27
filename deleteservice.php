<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];

    include 'partials/_dbconnect.php';

    $delete_appointments_sql = "DELETE FROM appointments WHERE service_id = '$service_id'";
    $delete_appointments_result = mysqli_query($conn, $delete_appointments_sql);

    if ($delete_appointments_result) {
        $delete_service_sql = "DELETE FROM services WHERE s_id = '$service_id'";
        $delete_service_result = mysqli_query($conn, $delete_service_sql);

        if ($delete_service_result) {
            header("location: organizationhome.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    //new profile
}
?>