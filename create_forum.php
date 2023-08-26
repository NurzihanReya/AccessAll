<?php
session_start();


// if ($_SESSION['user_type_id'] != 2) {
//     header("Location: index.php");
//     exit();
// }


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'partials/_dbconnect.php';


    $title = $_POST["title"];
    $description = $_POST["description"];
    $mediaType = $_POST["mediaType"]; 
    $mediaUrl = ""; 

    if ($mediaType == "image" || $mediaType == "video") {
        $targetDir = "uploads/";
        $mediaUrl = $targetDir . basename($_FILES["media"]["name"]);
        move_uploaded_file($_FILES["media"]["tmp_name"], $mediaUrl);
    }

 
    $userId = $_SESSION["sno"];
    $sql = "INSERT INTO forums (user_id, title, description, media_type, media_url)
            VALUES ('$userId', '$title', '$description', '$mediaType', '$mediaUrl')";
    $result = mysqli_query($conn, $sql);

   
    header("Location: forums.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path-to-bootstrap-css/bootstrap.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
    }

    .forum-form label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
    }

    .forum-form input[type="text"],
    .forum-form textarea,
    .forum-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .forum-form select {
        appearance: none;
        background-color: #fff;
        background-image: url("dropdown-arrow.png");
        background-position: right center;
        background-repeat: no-repeat;
        padding-right: 30px;
    }

    .forum-form button {
        padding: 12px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .forum-form button:hover {
        background-color: #0056b3;
    }
    </style>
    <title>Create Forum</title>
</head>

<body>
    <?php require 'partials/_nav.php'; ?>
    <div class="container">
        <h2>Create a New Forum</h2>
        <form action="create_forum.php" method="post" enctype="multipart/form-data" class="forum-form">
            <label for="title">Title</label>
            <input type="text" name="title" required class="form-control">
            <label for="description">Description</label>
            <textarea name="description" required class="form-control"></textarea>
            <label for="mediaType">Media Type</label>
            <select name="mediaType" class="form-control">
                <option value="none">None</option>
                <option value="image">Image</option>
                <option value="video">Video</option>
            </select>
            <label for="media">Upload Media (if applicable)</label>
            <input type="file" name="media" class="form-control-file">
            <button type="submit" class="btn btn-primary">Create Forum</button>
        </form>
    </div>

    <script src="path-to-bootstrap-js/bootstrap.min.js"></script>
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