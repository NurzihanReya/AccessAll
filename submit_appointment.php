<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}

include 'partials/_dbconnect.php';


$useremail = $_SESSION['useremail'];

$sql = "SELECT id FROM users WHERE useremail = '$useremail'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];


    $phone_number = $_POST['phone_number'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $service_id = $_POST['service_id'];              //to do: handle duplicates

    
    $sql = "INSERT INTO appointments (user_id, service_id, phone_number, appointment_date, appointment_time)
            VALUES ('$user_id', '$service_id', '$phone_number', '$appointment_date', '$appointment_time')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
       
        $last_inserted_id = mysqli_insert_id($conn); //last jei id ta insert hoise

    
        header("Location: appointment_summary.php?appointment_id=$last_inserted_id"); //to do: show in user profile too
        exit();
    } else {
    
        echo "Error creating appointment: " . mysqli_error($conn);
    }
} else {
    echo "User not found.";
}


mysqli_close($conn);
?>