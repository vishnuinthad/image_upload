<?php

include "dbconn.php";

$errors = array();
$success = array();
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
     
    $title=$_POST['title'];
    $uploadDir = 'upload/';
    $allowTypes = array('jpg','png','jpeg','gif');

    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            $filename = basename($_FILES['files']['name'][$key]);
            $targetFile = $uploadDir.$filename;
            if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFile)){
                $success[] = "Uploaded $filename";
                $insertQrySplit[] = "('$filename')";

                $sql = "INSERT INTO gallery (title,pic) VALUES ('$title','$filename')";
                mysqli_query($conn, $sql);
                header("Location:gallery.php");
            }
            else {
                $errors[] = "Something went wrong- File - $filename";
            }
        }

        //Inserting to database
        // if(!empty($insertQrySplit)) {
        //     $query = implode(",",$insertQrySplit);
        //     $sql = "INSERT INTO gallery (title,pic) VALUES ('$title','$query')";
        //     mysqli_query($conn, $sql);
        //     header("Location:gallery.php");
        // }
        // else{
        //     echo "Error";
        // }
        
     

    }
    else {
        $errors[] = "No File Selected";
    }

}
?>