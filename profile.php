<?php
session_start(); //Every page that will use the session information on the website must be identified by the session_start() function. This initiates a session on each PHP page. The session_start function must be the first thing sent to the browser or it won't work properly. 

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
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

    <title>Profile</title>
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>
    <div>
        <div class="mx-auto mt-3" style="width: 1200px;">
            <div class="container-fluid  mx-1 my-2">
                <h4>User Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>

                    <?php
                echo "<tr>";
                echo "<td>"; echo $_SESSION['name'] ; echo "</td>";
                echo "<td>"; echo $_SESSION['useremail'];  echo "</td>";
                if($_SESSION['user_type_id'] == 1)
                {
                    echo "<td>"; echo "Organization";  echo "</td>";   
                }
                else if($_SESSION['user_type_id'] == 2)
                {
                    echo "<td>"; echo "User";  echo "</td>";
                }
                echo "</tr>";
                    ?>


            </div>
        </div>
    </div>
    <div>

        <a href="edit_service.php" class="btn btn-dark btn-block">Edit Your Service</a>
    </div>



    <!-- <div style="width: 1500px;"> -->
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