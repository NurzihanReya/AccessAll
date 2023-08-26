<?php
session_start();


include 'partials/_dbconnect.php';
include 'partials/_nav.php';

// if ($_SESSION['user_type_id'] != 2) {
//     header("Location: index.php");
//     exit();
// }

$sql = "SELECT * FROM forums";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .forum-card {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f7f7f7;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .forum-title {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .forum-description {
        margin-bottom: 10px;
    }

    .forum-media {
        max-width: 100%;
        height: auto;
    }

    .view-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .view-button:hover {
        background-color: #0056b3;
    }
    </style>
    <title>Forums</title>
</head>

<body>
    <div class="container">
        <div class="container ">
            <h2 class="mb-4">Community Forums</h2>
            <a href="create_forum.php" class="btn btn-dark btn-lg active" role="button" aria-pressed="true">Create new
                post</a>
            <br>
        </div>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div>
            <div class="forum-card">
                <h3 class="forum-title">' . $row['title'] . '</h3>
                <p class="forum-description">' . $row['description'] . '</p>';

            if ($row['media_type'] == 'image') {
                echo '<img class="forum-media" src="' . $row['media_url'] . '" alt="Forum Media" width="400" 
                height="500">';
            } elseif ($row['media_type'] == 'video') {
                echo '<video class="forum-media" controls>
                        <source src="' . $row['media_url'] . '" type="video/mp4">
                      </video>
                      <br>';
            }
            
            echo '<div><button class="view-button" onclick="window.location.href=\'view_forum.php?id=' . $row['forum_id'] . '\'">View Forum</button></div></div>';
        }
        ?>

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