<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <title>user page</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>


<nav>


   <img class="logo" src="images/logonaftal.png"></img>

        <ul>
            <li><a href="#top">Dashboard</a></li>
            <li><a href="#about">About us</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="login_form.php" >login</a></li>
            <li><a href="logout.php" >logout</a></li>
        </ul>


</nav>
    
<style>

.logo{
   width:115px;
   height:50px;
   margin-left:40px;
}

nav {
   display: flex; 
  justify-content: space-between; 
  align-items: center; 
  background-color: orange;
  overflow: hidden;
  height:90px;
}


nav a {
  display: flex;
  margin-top:10%;
  margin:auto;
  justify-content:space-between;
  padding: 14px 16px;
   text-decoration: none;
  color: white;
  font-size:18px;
  transition: all 0.3s ease; 
}

nav a:hover {
  
  border-radius:4px;
  padding:12px 17px;
  color:white;
  background-color:#0221bb;
  transform: scale(1); 
}
nav ul {
  list-style: none; 
 
}

nav li {
  display: inline-block; 
  
}


</style>


<form method="POST" action="">
    <label for="wilaya">Select Wilaya :</label>
    <select name="wilaya" id="wilaya">
        <?php
        include 'connexion.php';
        $wilayas = mysqli_query($conn, "SELECT id_wilaya, nom_wilaya FROM wilayas");
        while ($row = mysqli_fetch_assoc($wilayas)) {
            echo '<option value="' . $row['id_wilaya'] . '">' . $row['nom_wilaya'] . '</option>';
        }
        ?>
    </select>

    <label for="date">Select date :</label>
    <input type="date" name="date" id="date">
    <br>
    <br>
<div class="filter">
    <input type="submit" value="filter"></div>
    
</form>


<div class="title" id="top">
<h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
<p >

   NAFTAL, The evolution of our company</p>
</div>

<style>

.title{
   
   margin-left:4%;
   margin-top:4%;

}

</style>
<div class="line"></div>


<style>

   .line{
      width:30%;
     margin-left:2%;
   border-top:2px solid #05278e;
   }
</style>



<?php
require 'connexion.php'; 

if (isset($_POST['wilaya']) && isset($_POST['date'])) {
    $wilaya_id = $_POST['wilaya'];
    $date = $_POST['date'];

    $req = mysqli_query($conn, "SELECT d.valeur_quotidien, d.valeur_mensul, c.nom_champ 
                                FROM donnees d 
                                JOIN champs c ON d.id_champ = c.id_champ 
                                WHERE d.id_wilaya = $wilaya_id AND d.dat = '$date'");

    $valeur_quotidien = [];
    $valeur_mensul = [];
    $nom_champ = [];

    while ($row = mysqli_fetch_assoc($req)) {
        $valeur_quotidien[] = $row['valeur_quotidien'];
        $valeur_mensul[] = $row['valeur_mensul'];
        $nom_champ[] = $row['nom_champ'];
    }
}
?>

<div style="width: 480px;" class="chart">
    <canvas id="dailyChart"></canvas>

    <canvas id="monthlyChart"></canvas>
</div>

<style>
    .chart {
      display:flex;
      margin-left:10%; 
      margin-bottom:15%;
        
    }
</style>


<script>

const dailyLabels = <?php echo json_encode($nom_champ) ?>;
const dailyData = {
    labels: dailyLabels,
    datasets: [{
        label: 'Daily Value',
        data: <?php echo json_encode($valeur_quotidien) ?>,
        backgroundColor: [
            '#02009e',
            'orange'
        ],
        
        borderWidth: 1
    }]
};

const dailyConfig = {
    type: 'bar',
    data: dailyData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

var dailyChart = new Chart(
    document.getElementById('dailyChart'),
    dailyConfig
);

const monthlyLabels = <?php echo json_encode($nom_champ) ?>;
const monthlyData = {
    labels: monthlyLabels,
    datasets: [{
        label: 'Monthly Value',
        data: <?php echo json_encode($valeur_mensul) ?>,
        backgroundColor: [
            '#02009e',
            'orange'
        ],
        
        borderWidth: 1
    }]
};

const monthlyConfig = {
    type: 'bar',
    data: monthlyData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

var monthlyChart = new Chart(
    document.getElementById('monthlyChart'),
    monthlyConfig
);

</script>











<br>
<br>
<div class="about" id="about">
        <div class="inner-section">
            <h1>About Us</h1>
            <p class="text">
            Naftal SPA, Béjaïa CBR:<br> Your local energy 
            partner. With our expertise in the hydrocarbon
             sector, Naftal CBR offers a wide range of
              high-quality fuels that meet the most
               demanding standards. Located in the heart 
               of Béjaïa, our teams are here to assist you with all your energy needs.
            </p>
            <div class="skills">
                <button>Contact Us</button>
            </div>
        </div>
    </div>


    <style>

.about {
  background: url('https://i.pinimg.com/564x/1a/be/a2/1abea2635d86fa91cf0a561a8f1c40c4.jpg') no-repeat left;
  
  background-size: 55%; 
  background-color: #fdfdfd;
  overflow: hidden;
  height: 500px;
  padding: 30px 20px; 
  margin-bottom:10rem;
}
.inner-section{
    width: 55%;
    height:100%;
    float: right;
    background-color: #fdfdfd;
    padding: 140px;
    box-shadow: 10px 10px 8px rgba(0,0,0,0.3);
}
.inner-section h1{
   margin-top:-87px;
    margin-bottom: 20px;
    font-size: 30px;
    font-weight: 900;
}
.text{
    font-size: 18px;
    color: #545454;
    line-height: 30px;
    text-align: justify;
    margin-bottom: 40px;
}
.skills button{
    font-size: 20px;
    margin-top:-20px;
    text-align: center;
    letter-spacing: 2px;
    border: none;
    border-radius: 20px;
    padding: 8px;
    width: 180px;
    background-color: orange;
    color: white;
    cursor: pointer;
}
.skills button:hover{
    transition: 1s;
    background-color: blue;
    color: WHITE;
}
@media screen and (max-width: 1000px) {
  .about {
    background-size: cover; /* Or contain */
    padding: 20px 20px; /* Adjust as needed */
  }

  .inner-section {
    width: 80%; /* Or adjust as needed */
    padding: 80px 20px; /* Adjust as needed */
    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3); /* Adjust shadow size */
  }

  .inner-section h1 {
    font-size: 24px; /* Adjust heading size */
  }

  .text {
    font-size: 14px; /* Adjust text size */
    line-height: 24px; /* Adjust line height */
  }

  .skills button {
    font-size: 18px; /* Adjust button size */
    padding: 6px; /* Adjust button padding */
    width: 150px; /* Adjust button width */
  }
}

@media screen and (max-width: 600px) {
  /* Similar adjustments for smaller screens */
}


    </style>



<footer>
    <div class="container">
        <div class="footer-content" id="contact">
            <h3>Contact Us</h3>
            <p>Email: naftal@gmail.com</p>
            <p>Phone: +121 56556 565556</p>
            <p>Address: Bejaia, street 123

            </p>
        </div>
        <div class="footer-content">
            <h3>Quick Links</h3>
             <ul class="list">
                <li><a href="">Dashboard</a></li>
                <li><a href="">About us</a></li>
                <li><a href="">Contact</a></li>
             </ul>
        </div>
        <div class="footer-content">
            <h3>Follow Us</h3>
            <ul class="social-icons">
             <li><a href=""><i class="fab fa-facebook"></i></a></li>
             <li><a href=""><i class="fab fa-twitter"></i></a></li>
             <li><a href=""><i class="fab fa-instagram"></i></a></li>
             <li><a href=""><i class="fab fa-linkedin"></i></a></li>
            </ul>
            </div>
    </div>
    <div class="bottom-bar">
        <p>&copy; 2024 your company . All rights reserved</p>
    </div>
</footer>





<style>

    
footer{

  color:white;
    background: #0221bb;
    padding-bottom: -55px;
   
}
.container{
    width: 1140px;
    
    display: flex;
    padding:0px;
    justify-content: center;
}
.footer-content{
    width: 33.3%;
}
h3{
    font-size: 28px;
    margin-bottom: 15px;
    text-align: center;
}
.footer-content p{
    width:190px;
    margin: auto;
    padding: 7px;
}
.footer-content ul{
    text-align: center;
}
.list{
    padding: 0;
    color:white;
}
.list li{
  color:white;
    width: auto;
    text-align: center;
    list-style-type:none;
    padding: 7px;
    position: relative;
}
.list li::before{
    content: '';
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 100%;
    width: 0;
    height: 2px;
    background: #f18930;
    transition-duration: .5s;
}
.list li:hover::before{
    width: 70px;
}
.social-icons{
    text-align: center;
    padding: 0;
}
.social-icons li{
    display: inline-block;
    text-align: center;
    padding: 5px;
}
.social-icons i{
    color: white;
    font-size: 25px;
}
a{
    text-decoration: none;
}
a:hover{
    color: #f18930;
}
.social-icons i:hover{
    color: #f18930;
}
.bottom-bar{
    background: #f18930;
    text-align: center;
    padding: 10px 0;
    margin-top: 50px;
}
.bottom-bar p{
    color: #343434;
    margin: 0;
    font-size: 16px;
    padding: 7px;
}
</style>






</body>
</html>