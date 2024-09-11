
<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}



include('connexion.php');



$sql = "SELECT d.dat, d.valeur_quotidien, d.valeur_mensul, w.nom_wilaya, c.nom_champ
        FROM donnees d
        INNER JOIN wilayas w ON d.id_wilaya = w.id_wilaya
        INNER JOIN champs c ON d.id_champ = c.id_champ";

$result = mysqli_query($conn, $sql);



if(isset($_POST['submit'])){
    $wilaya=$_POST['wilaya'];
    $champ=$_POST['champ'];
    $date=$_POST['date'];
    $valeur_quotidien=$_POST['valeur_quotidien'];
    $valeur_mensuel=$_POST['valeur_mensuel'];



 $sql_wilaya = "SELECT id_wilaya FROM wilayas WHERE nom_wilaya = '$wilaya'";
 $result_wilaya = mysqli_query($conn, $sql_wilaya);
 $row_wilaya = mysqli_fetch_assoc($result_wilaya);
 $id_wilaya = $row_wilaya['id_wilaya'];

 $sql_champ = "SELECT id_champ FROM champs WHERE nom_champ = '$champ'";
 $result_champ = mysqli_query($conn, $sql_champ);
 $row_champ = mysqli_fetch_assoc($result_champ);
 $id_champ = $row_champ['id_champ'];


 $sql1 = "INSERT INTO champs ( nom_champ) VALUES ('$champ')";
 mysqli_query($conn,$sql1);
 
 $sql2 = "INSERT INTO wilayas ( nom_wilaya) VALUES ('$wilaya')";
 mysqli_query($conn,$sql2);
 



 $sql = "INSERT INTO donnees (id_wilaya, id_champ, dat, valeur_quotidien, valeur_mensul) 
         VALUES ('$id_wilaya', '$id_champ', '$date', '$valeur_quotidien', '$valeur_mensuel')";
 mysqli_query($conn, $sql);



}
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN PAGE</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="css/style.css">
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
</head>

<header>

<nav>


   <img class="logo" src="images/logonaftal.png"></img>

        <ul>
            <li><a href="#top">Dashboard</a></li>
            <li><a href="#members">Members</a></li>
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

</header>



<body>

<div class="title">
<h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
<p id="top" >

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

<br>
<h2>please fill in this form :</h2>

<style>
   h2{
      margin-left:4%;
      margin-TOP:4%;
   }
</style>

<div class="lesform">

<form method="POST" class="formm" >
        <label for="wilaya">Wilaya :</label>
        <select id="wilaya" name="wilaya">
          <option value="Bejaia">bejaia</option>
          <option value="Tahar">tahar</option>
          <option value="BBA">BBA</option>
          <option value="msila">msila</option>
            </select>

        <label for="champ">Champ:</label>
        <select id="champ" name="champ">

        
          <option value="navire">navire</option>
          <option value="cr recu GO">cr recu GO</option>
          <option value="cr_recu_S/P">cr recu S/P</option>
          <option value="wr_recu_GO">wr recu GO</option>
          <option value="wr_recu_S/P">wr recu S/P</option>
          <option value="cr_sortie_GO">cr sortie GO</option>
          <option value="cr_sortie_S/P">cr sortie S/P</option>
            </select>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required value="<?php echo date('Y-m-d'); ?>">

        <label for="valeur_quotidien">Daily amount</label>
        <input type="number" id="valeur_quotidien" name="valeur_quotidien" required>

        <label for="valeur_mensuel">monthly amount</label>
        <input type="number" id="valeur_mensuel" name="valeur_mensuel" required>
        
        <button type="submit" name="submit">Save</button>
    </form>
    
    <style>
form {
    box-shadow: 8px 8px 8px 8px rgba(0, 0, 0, 0.05);
    width:1000px;
    padding: 20px;
}
.formm {
  
  margin-right:5%;
  padding: 20px;

  border-radius: 5px;
  shadow:;
}

label {
  display: block;
  margin-bottom: 5px;
}

select, input {
  width: 100%;
  padding: 10px;
  background-color:  #f3f6fe;
  border-radius: 10px;
}
 input:hover{
    border:1px solid orange;
}
input:active{
    border:1px solid orange;
}

button {
  display: block;
  margin: auto;
  margin-top:10px;
  padding: 5px 30px;
  background-color: orange;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  font-size:18px;
}

        </style>



<form method="POST" action="">
    <label for="wilaya">Select Wilaya :</label>
    <select name="wilaya" id="wilaya">
        <?php
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
      </div>
<style>
 
.lesform{
   margin-top:-8%;
display:flex;

padding:10%;
}
</style>
     


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








     <main class="table" id="customers_table">
         <section class="table__header">
             <h1>Members</h1>

             
            <div class="input-group"> 
                 <input type="search" placeholder="Search Data...">
                
             </div>


             <div class="export__file">
                 <label for="export-file" class="export__file-btn" title="Export File"></label>
                 <input type="checkbox" id="export-file">
                 <div class="export__file-options">
                     <label style="color:white;">Export As &nbsp; &#10140;</label>
                     <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                     <label for="export-file" id="toJSON">JSON <img src="images/json.png" alt=""></label>
                     <label for="export-file" id="toCSV">CSV <img src="images/csv.png" alt=""></label>
                     <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                 </div>
             </div> 

          </section>


<section class="table__body">
   <table id="members">
      <thead>
         <tr>
            <th>name <span class="icon-arrow">&UpArrow;</span></th>
            <th>email<span class="icon-arrow">&UpArrow;</span></th>
            <th>delete </th>
            <th>edit </th>
        </tr>
      </thead>


   <tbody>
                  

   <?php
        require 'config.php';
        $requet="SELECT * from user_form";
        $query=mysqli_query($conn,$requet);
        while($rows=mysqli_fetch_assoc($query)){
            $id=$rows['id'];
            echo"<tr>";
            echo"<td>".$rows['name']."</td>";
            echo"<td>".$rows['email']."</td>";
            echo"<td><a href='delete.php?id=".$id."'>delete</a></td>";
           
            echo"<td><a href='register_form.php?id=".$id."'>edit</a></td>";

            echo"</tr>";
        }
        
   ?>
                     
      </tbody>
   </table>
</section>

</main>
<script src="script.js"></script>
<style>
    
  table{
   margin-bottom:15%;
  }
  
  .table__header .input-group {
      width: 35%;
      height: 110%;
      background-color:  #f1f1f1 ;
      padding: 0 .8rem;
      border-radius: 2rem;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: .2s;
  }
  
  
</style>





<br>
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
    background-size: cover; 
    padding: 20px 20px; 
  }

  .inner-section {
    width: 80%; 
    padding: 80px 20px;
    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3); 
  }

  .inner-section h1 {
    font-size: 24px; 
  }

  .text {
    font-size: 14px;
    line-height: 24px; 
  }

  .skills button {
    font-size: 18px; 
    padding: 6px; 
    width: 150px; 
  }
}

@media screen and (max-width: 600px) {
}


</style>



</body>


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
                    <li><a href="">Members</a></li>
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
  



</html>