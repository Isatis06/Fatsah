<?php 
    require 'config.php';
    $id=$_GET['id'];
    $sql="DELETE FROM user_form where id='$id'";
    $query=mysqli_query($conn,$sql);
    if(isset($query)){
       
        header("location:admin_page.php");
    }



?>