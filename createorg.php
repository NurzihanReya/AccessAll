<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'partials/_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $bin = $_POST["bin"];
    $address = $_POST["inputAddress"];
    $city = $_POST["inputCity"];
    $phone_number = $_POST["inputZip"];
    $service_type = $_POST["inputServiceType"];
    $payment_method = $_POST["inputPaymentMethod"];
    $transaction_number = $_POST["transaction"];
    $description = $_POST["description"];
    $mediaUrl = "";

    // Check if a file was uploaded
    if (isset($_FILES["media"]) && $_FILES["media"]["error"] === 0) {
        $targetDir = "uploads/";
        $mediaUrl = $targetDir . basename($_FILES["media"]["name"]);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["media"]["tmp_name"], $mediaUrl)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
        }
    }

    $user_id = $_SESSION['sno'];

    $sql = "INSERT INTO organizations (name, bin, address, city, phone_number, service_type, payment_method, transaction_number, user_id, status, description, image_url) 
            VALUES ('$name', '$bin', '$address', '$city', '$phone_number', '$service_type', '$payment_method', '$transaction_number', '$user_id', 0, '$description', '$mediaUrl')";

    $result = mysqli_query($conn, $sql);
    $showAlert = true;

    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your service request has been successful! Please wait for admin to approve.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
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


    <div class="container my-4">

        <form method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Name of the Service</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group col-md-6">
                    <label for="bin">Business Identification Number</label>
                    <input type="text" class="form-control" id="bin" name="bin">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress"
                    placeholder="1234 Main St">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Phone Number</label>
                    <input type="text" class="form-control" id="inputZip" name="inputZip">
                </div>
            </div>
            <div class="form-group">
                <label for="inputState">Type of Service</label>
                <select id="inputState" class="form-control" name="inputServiceType">
                    <option selected>Choose...</option>
                    <option value='hospital'>Hospital</option>
                    <option value='fire'>Fire Service</option>
                    <option value='police'>Police Station</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputState">Payment Method</label>
                    <select id="inputState" class="form-control" name="inputPaymentMethod">
                        <option selected>Choose...</option>
                        <option value='bkash'>Bkash</option>
                        <option value='nagad'>Nagad</option>
                        <option value='rocket'>Rocket</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="transaction">Transaction Number</label>
                    <input type="text" class="form-control" id="transaction" name="transaction">
                </div>
                <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <input type="textarea" class="form-control" id="description" name="description">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        I agree to the terms and conditions
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="media">Upload Media (if applicable)</label>
                <input type="file" name="media" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>





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