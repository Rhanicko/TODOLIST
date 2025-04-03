<?php
include("db.php");

$taskid = $_POST['taskid'];

$getid = mysqli_query($conn,"DELETE FROM `tasklist` WHERE id=$taskid");

header("location: index.php");
exit();

?>