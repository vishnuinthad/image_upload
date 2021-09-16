<?php
include('dbconn.php');
$del=$_GET['delete_id'];
$del1=mysqli_query($conn,"DELETE  FROM blog WHERE id='$del'");
header('location:blogs.php');
?>