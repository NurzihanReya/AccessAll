<?php
session_start();

include 'partials/_dbconnect.php';
include 'partials/_nav.php';

if (isset($_GET['id'])) {
    $forumId = $_GET['id'];
    $sql = "SELECT * FROM forums WHERE forum_id = '$forumId'";
    $result = mysqli_query($conn, $sql);
    $forum = mysqli_fetch_assoc($result);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user_name"];
    $comment = $_POST["comment"];
    $mediaType = $_POST["mediaType"]; 
    $mediaUrl = ""; 


    if ($mediaType == "image" || $mediaType == "video") {
        $targetDir = "uploads/";
        $mediaUrl = $targetDir . basename($_FILES["media"]["name"]);
        move_uploaded_file($_FILES["media"]["tmp_name"], $mediaUrl);
    }

 
    $sql = "INSERT INTO comments (forum_id, user_name, comment, media_type, media_url)
            VALUES ('$forumId', '$user_name', '$comment', '$mediaType', '$mediaUrl')";
    $result = mysqli_query($conn, $sql);

    header("Location: view_forum.php?id=$forumId");
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
    <link rel="stylesheet" href="styles.css">
    <style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .forum-card {
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

    .comment-section {
        margin-top: 20px;
    }

    .comment-box {
        margin-top: 10px;
    }

    .comment-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .comment-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .comment-button:hover {
        background-color: #0056b3;
    }

    .comment-media {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
    }
    </style>
    <title>View Forum</title>
</head>

<body>

    <div class="container">

        <div class="forum-card">
            <h2 class="forum-title"><?php echo $forum['title']; ?></h2>
            <p class="forum-description"><?php echo $forum['description']; ?></p>

            <?php
            
            if ($forum['media_type'] == 'image') {
                echo '<img class="forum-media" src="' . $forum['media_url'] . '" alt="Forum Media">';
            } elseif ($forum['media_type'] == 'video') {
                echo '<video class="forum-media" controls>
                        <source src="' . $forum['media_url'] . '" type="video/mp4">
                      </video>';
            }
            ?>
        </div>

        <div class="comment-section">
            <h4>Comments</h4>
            <?php
            
            $sql = "SELECT * FROM comments WHERE forum_id = '$forumId'";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
         
                echo '<div class="forum-card comment-box">';
                echo '<p class="comment-user">' . $row['user_name'] . '</p>';
                echo '<p class="comment-content">' . $row['comment'] . '</p>';
                echo '<p class="comment-timestamp">' . $row['timestamp'] . '</p>';

                if ($row['media_type'] == 'image') {
                    echo '<img class="comment-media" src="' . $row['media_url'] . '" alt="Comment Media">';
                } elseif ($row['media_type'] == 'video') {
                    echo '<video class="comment-media" controls>
                            <source src="' . $row['media_url'] . '" type="video/mp4">
                          </video>';
                }

                echo '</div>';
            }
            ?>


            <div class="forum-card comment-box">
                <form action="view_forum.php?id=<?php echo $forumId; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="forum_id" value="<?php echo $forumId; ?>">
                    <input type="hidden" name="user_name" value="<?php echo $_SESSION['name']; ?>">
                    <textarea class="comment-input" name="comment" placeholder="Add a comment" required></textarea>
                    <br>
                    <label for="mediaType">Media Type</label>
                    <select name="mediaType">
                        <option value="none">None</option>
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                    <br>
                    <label for="media">Attach Media (if applicable)</label>
                    <input type="file" name="media">
                    <button type="submit" class="comment-button">Add Comment</button>
                </form>
            </div>
        </div>
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