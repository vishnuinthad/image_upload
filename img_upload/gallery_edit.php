<?php

include "dbconn.php";
if(isset($_POST['button_edit']))
{
     $title=$_POST['product_name']; 
     $id=$_POST['product_id'];
    $uploadDir = 'upload/';
    $allowTypes = array('jpg','png','jpeg','gif');
    
    if(!empty(array_filter($_FILES['product_picture']['name']))){
        foreach($_FILES['product_picture']['name'] as $key=>$val){
            $filename = basename($_FILES['product_picture']['name'][$key]);
            $targetFile = $uploadDir.$filename;
            if(move_uploaded_file($_FILES["product_picture"]["tmp_name"][$key], $targetFile)){
                $success[] = "Uploaded $filename";
                $insertQrySplit[] = "('$filename')";
    
                $sql = "UPDATE gallery SET title='$title',pic='$filename' where id='$id'";
                mysqli_query($conn, $sql);
                header("Location:gallery.php");
            }
            else {
                $errors[] = "Something went wrong- File - $filename";
            }
        }
    }
}

?>


<html>
    <body>

<form action='' method="post" enctype="multipart/form-data" >
    <table>
        <tr>
        <?php
         $id = $_GET['edit_id'];
        $records = mysqli_query($conn,"SELECT * FROM gallery WHERE id='$id'");
        $data = mysqli_fetch_array($records)
        ?>
        <tr><td>Title</td>
        <td><input type="hidden" name="product_id" value="<?php echo $id ?>">
        <input type="text" name="product_name"  value="<?php echo $data['title']?>"></td></tr>
        
        <tr><td>Image</td>
        <td><input type="file" name="product_picture[]" multiple></td></tr>
        <tr><td colspan="2">
        <input type="submit" name="button_edit" value="Edit"></td></tr> </table>
</form>

</body>
</html>
