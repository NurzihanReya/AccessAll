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

    <title>Prediction</title>
</head>

<body>
    <div class="header">
        <h1>Service Predictions</h1>

    </div>
    <div class="container">
        <div class="profile-card">
            <h2>Prediction Results</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Most Visited Service</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db_connection = mysqli_connect("localhost", "root", "", "SmartSociety");
                    if (!$db_connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    // $sql = "SELECT services.*, organizations.name AS organization_name, organizations.phone_number, organizations.address, organizations.city FROM services
                    // JOIN organizations ON services.o_id = organizations.o_id
                    // WHERE services.s_id = '$service_id'";
                    
                    $query = "SELECT * FROM appointments";
                    $result = mysqli_query($db_connection, $query);
                    $user_id = $_SESSION['sno'];
                    // while ($user = mysqli_fetch_assoc($result)) {
                        // $user_id = $user['u_id'];
                        // $user_name = $user['name'];

                        $log_query = "SELECT service_id, COUNT(*) as count FROM appointments WHERE user_id = $user_id GROUP BY service_id ORDER BY count DESC LIMIT 1";
                        //service count
                        $log_result = mysqli_query($db_connection, $log_query);

                        if ($log_result && mysqli_num_rows($log_result) > 0) {
                            $log_row = mysqli_fetch_assoc($log_result);
                            $most_visited_service_id = $log_row['service_id'];

                            $service_query = "SELECT organizations.service_type FROM organizations WHERE s_id = $most_visited_service_id";
                            $service_result = mysqli_query($db_connection, $service_query);

                            if ($service_result && mysqli_num_rows($service_result) > 0) {
                                $service_row = mysqli_fetch_assoc($service_result);
                                $most_visited_service = $service_row['type'];

                                $total_visits = $log_row['count'];

                                $total_entries_query = "SELECT COUNT(*) as total_entries FROM appointments WHERE user_id = $user_id";
                                $total_entries_result = mysqli_query($db_connection, $total_entries_query);

                                if ($total_entries_result) {
                                    $total_entries_row = mysqli_fetch_assoc($total_entries_result);
                                    $total_entries = $total_entries_row['total_entries'];

                                    $percentage = ($total_visits / $total_entries) * 100;
                                    $rounded_percentage = round($percentage);

                                    echo '<tr>';
                                    echo '<td>' . $user_id . '</td>';
                                    echo '<td>' . $user_name . '</td>';
                                    echo '<td>' . $most_visited_service . '</td>';
                                    echo '<td>' . $rounded_percentage . '%</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    

                    mysqli_close($db_connection);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>