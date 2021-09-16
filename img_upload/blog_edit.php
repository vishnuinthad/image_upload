<?php

include "dbconn.php";
if(isset($_POST['edit_blog']))
{
     $title=$_POST['product_name']; 
     $id=$_POST['product_id'];
     $description=$_POST['product_des'];
     $date=$_POST['product_date'];
    $uploadDir = 'uploads/';
    $allowTypes = array('jpg','png','jpeg','gif');
    
    if(!empty(array_filter($_FILES['product_picture']['name']))){
        foreach($_FILES['product_picture']['name'] as $key=>$val){
            $filename = basename($_FILES['product_picture']['name'][$key]);
            $targetFile = $uploadDir.$filename;
            if(move_uploaded_file($_FILES["product_picture"]["tmp_name"][$key], $targetFile)){
                $success[] = "Uploaded $filename";
                $insertQrySplit[] = "('$filename')";
echo                 $sql = "UPDATE blog SET title='$title',description='$description',pic='$filename',date='$date' where id='$id'";
exit(;)                
                $sql = "UPDATE blog SET title='$title',description='$description',pic='$filename',date='$date' where id='$id'";
            
                mysqli_query($conn, $sql);
                
                header("Location:blogs.php");
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
        $records = mysqli_query($conn,"SELECT * FROM blog WHERE id='$id'");
        $data = mysqli_fetch_array($records)
        ?>
        <td><input type="hidden" name="product_id" value="<?php echo $id ?>"></td>
        <tr><td>Title</td>
        <td><input type="text" name="product_name"  value="<?php echo $data['title']?>"></td></tr>
        <tr><td>Description</td>
        <td><input type="text" name="product_des"  value="<?php echo $data['description']?>"></td></tr>

        
        <tr><td>Image</td>
        <td><input type="file" name="product_picture[]" multiple></td></tr>

        <tr><td>Date</td>
        <td><input type="date" name="product_date"  value="<?php echo $data['date']?>"></td></tr>

        <tr><td colspan="2">
        <input type="submit" name="edit_blog" value="Edit"></td></tr> </table>
</form>

</body>
</html>
