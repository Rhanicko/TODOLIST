<?php
include("db.php");

$text = $_POST['addtask'];
$taskpending = $_POST['pending'];


if(!empty($text)) {
$insert = mysqli_query($conn, "INSERT INTO tasklist (`task`,`status`) VALUES ('$text','$taskpending')");
// echo"<script>alert('Test'); window.location.href='index.php';</script>"; Testing
}

else {
    echo"<script>alert('Task Cannot be EMPTY!'); window.location.href='index.php';</script>";
    
    exit();

}

header("location: index.php");
exit();


?>