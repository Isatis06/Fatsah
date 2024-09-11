<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>LOGIN FORM</title>
   <link rel="stylesheet" href="css/style.css">  

</head>


<body>
   
   <div class="formcontainer">

      <form action="" method="post">

         <?php

         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };

         ?>

   <div class="container d-flex justify-content-center align-items-center min-vh-100">


      <div class="row border rounded-9 p-3 bg-white shadow box-area">

   <div class="left-box col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #FFFFFF;">
           <div class="featured-image mb-3">
            <img src="images/logonaftal.png" class="img-fluid" style="width: 300px;">
           </div>

           <small class="parag text-wrap text-center" style=" ">
           Unlock a world of benefits by joining the Naftal community. Sign in to your customer area to start enjoying a personalized experience.</small>
   </div> 




   <div class="col-md-6 right-box " style="background: ;">

           <div class="featured-image mb-3"> 
               <div class="row align-items-center">
                     <div class="header-text mb-4">
                        <h2>Hello,Again</h2>
                        <p>We are happy to have you back.</p>
                     </div>


      
      
      <div class="input-field mb-3">
    <input type="email" name="email" required spellcheck="false" > 
    <label>Enter your email</label>
  </div> 
  <div class="input-field mb-3">
    <input type="password" name="password" required spellcheck="false" > 
    <label>Enter your password</label>
  </div> 
      
      
     

        <div class="mb-3">
        <input type="submit" name="submit" value="login now" class="form-btn" >
                    
        </div>

      
      <p>don't have an account? <a class="link" href="register_form.php">register now</a></p>
   </form>

   </div>
    </div>
      </div>
    </div>
    </div>
   
</body>
</html>