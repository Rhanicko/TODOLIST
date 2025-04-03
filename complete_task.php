<?php
include("db.php");

$taskid = $_POST['taskid'];
$taskcomplete = $_POST['complete'];
$update = mysqli_query($conn,"UPDATE `tasklist` SET `status`='$taskcomplete' WHERE id=$taskid");

header("location: index.php");
exit();
?>