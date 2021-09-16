<?php
include('dbconn.php');
$del=$_GET['delete_id'];
$del1=mysqli_query($conn,"DELETE  FROM gallery WHERE id='$del'");
header('location:gallery.php');
?>