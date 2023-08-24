<?php include 'partials/_dbconnect.php'; ?>
<?php include 'partials/_nav.php'; ?>
<?php

$id = $_GET["id"];
$sql = "UPDATE `organizations` SET `status` = -1 WHERE `o_id` = $id";
 $sql2 = mysqli_query($conn,$sql);
?>

<?php
echo("<script LANGUAGE='JavaScript'>
        window.alert('Post has been rejected successfully!'); window.location.href = 'http://localhost/accessall/adminhome.php';
</script>");
?>