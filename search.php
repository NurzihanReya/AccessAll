<?php
session_start(); //Every page that will use the session information on the website must be identified by the session_start() function. This initiates a session on each PHP page. The session_start function must be the first thing sent to the browser or it won't work properly. 

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

    <title>AccessAll</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>



    <!-- SEARCH REASULT -->

    <div class="container my-3">
        <h2 class="py-2">Search Results for <em>"<?php echo $_GET['search']?>"</em></h2>

        <?php
        $noresult = true;
        $query = $_GET["search"];
        $sql = "SELECT services.*, organizations.name AS organization_name FROM services
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
                $url = "servicedetails.php?sid=". $s_id;

            // Display the search result
            
            echo '<div class="result">
            <img src="' . $image_url . '" class="card-img-top" alt="' . $service_name . ' Image" style="max-height: 200px; object-fit: cover;">
                        <h4><i><a href="'.$url. '" class="text-dark">'. $organization_name. '</a> </i></h4>
                        <p>'. $description .'</p>
                  </div>'; 
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