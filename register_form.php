<?php

@include 'config.php';

if(isset($GET_['id'])){
require 'config.php' ;
   $name=$_POST['name'];
   $email=$_POST['email'];
   $id=$_POST['id'];
   $sql="UPDATE user_form set name='$name',email='$email' where id='$id'";
   $q=mysqli_query($conn,$sql);
   header('location:admin_page.php');

}


if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = md5($_POST['password']);
   $cpassword = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$password' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$password','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<?php 
        require 'config.php';
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sql="SELECT *FROM user_form where id='$id'";
            $q=mysqli_query( $conn,$sql);
            $rows=mysqli_fetch_assoc($q);
            $name=$rows['name'];
            $email=$rows['email'];
        }
   
    
?> 


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="css/style.css">
   <title>REGISTER FORM</title>
</head>


<body>
   
<div class="form-container">

   <form action="  
   <?php
   if(isset($_GET['id'])){
      echo "id=update";
   }?>" method="post">
      <img class="imagos" src="images/logonaftal.png"></img>
      <h3 class="register">register <span class="now">now</span></h3>
      <style>
      h3{
         color:black;
      }
      </style>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>



<style>
   .input-field{
    position: relative;
  }
  .input-field input{
   display:flex;
     width: 300px;
    height: 60px;
    border-radius: 9px;
    padding: 20px 15px;
    background: transparent;
    color: black;
    outline: none;
  }
  .input-field label{
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: rgb(21, 5, 144);
    font-size: 19px;
    pointer-events: none;
    transition: 0.3s;
  }
  input:focus{
    border: 2px solid rgb(21, 5, 144);
  }
  input:focus ~ label,
  input:valid ~ label{
   
    font-size: 16px;
    padding: 0 2px;
    background:white;
   
  } 
  .form-container form select{
    width: 40%;
    padding:10px 15px;
    font-size: 17px;
    margin-left:5%;
    color:rgb(21, 5, 144) ;
    border: 2px solid rgb(21, 5, 144);
    background: white;
    border-radius: 5px;
    display: flex;
    text-align: left;
 }

</style>


<div class="input-field mb-3">
    <input type="text" name="name" required spellcheck="false" value="<?php if (isset($_GET['id'])){
            echo $name;
        } ?>"> 
    <label>Enter your name</label>
</div> 

<div class="input-field mb-3">
    <input type="email" name="email" required spellcheck="false" value="<?php if (isset($_GET['id'])){
            echo $email;
        } ?>">
    <label>Enter your email</label>
</div> 

<div class="input-field mb-3">
    <input type="password" name="password" required spellcheck="false" > 
    <label>Enter your password</label>
</div> 

<div class="input-field mb-3">
    <input type="password" name="cpassword" required spellcheck="false" > 
    <label>Confirm your password</label>
</div> 

<select style="user_type" name="user_type">
   <option value="user">user</option>
   <option value="admin">admin</option>
</select>

<br>

<button type="submit" name="submit" class="form-btnn">

   <?php 
            if(isset($_GET['id'])){
                echo "Edit";
            }else{
                echo"Register now";
            }
   ?>
</button>
     
      <p>already have an account? 
          <a class="link" href="login_form.php">login now</a>
         
         </p>
</form>

</div>

</body>
</html>