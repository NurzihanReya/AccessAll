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
    <title>SmartSociety</title>
</head>




<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>




    <div class="container mt-5">
        <div>
            <?php
            echo"<h3>New Service Request:</h3> <br>";
            $sql = "SELECT * FROM `organizations` WHERE status = 0";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            $number = 0;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $org_id = $row["o_id"];
                $name = $row["name"];
                $bin = $row["bin"];
                $address = $row["address"];
                $city = $row["city"];
                $phone_number = $row["phone_number"];
                $service_type = $row["service_type"];
                $payment_method = $row["payment_method"];
                $transaction_number = $row["transaction_number"];
            


                echo '
                <div class="card">
                    <h5 class="card-header">'.$name.' -  '.$service_type.' </h5>
                    <div class="card-body">
                        <h5 class="card-title">Business Identification Number: '.$bin.'</h5>
                        <p class="card-text">Phone Number: '.$phone_number.'</p>
                        <p class="card-text">Address: '.$address.'</p>
                        <p class="card-text">City: '.$city.'</p>
                        <p class="card-text">Payment Method: '.$payment_method.'</p>
                        <p class="card-text">Transaction ID: '.$transaction_number.'</p>
                        <br>

                        <form method="post" action="">
                            <div class="mb-2">
                                <button class="btn btn-success mx-2 my-2 my-sm-0" type="submit" name="approved">
                                    <a href="approve_service.php?id='.$org_id.'" style="color:#ffffff;">Approve</a>
                                </button>
                                <button class="btn btn-danger mx-2 my-2 my-sm-0" type="submit" name="rejected">
                                    <a href="reject_service.php?id='.$org_id.'" style="color:#ffffff;">Reject</a>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>';
           }


           if($noResult){
           echo '
           <div class="jumbotron jumbotron-fluid">
               <div class="container">
                   <p class="display-4">No New Service Request Found</p>
               </div>
           </div> ';
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