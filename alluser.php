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

    <title>All Users</title>
</head>

<body>
    <?php require 'partials/_nav.php' ?>

    <div class="container">
        <div class="profile-card">
            <br>
            <h2>User Profiles</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                </tbody>
            </table>
        </div>
    </div>
    <script>
    const userTable = document.getElementById('userTable');

    fetch('api.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(user => {
                userTable.innerHTML += `
                        <tr>
                            <td>${user.name}</td>
                            <td>${user.useremail}</td>
                            <td>${user.location}</td>
                        </tr>
                    `;
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    </script>
</body>

</html>