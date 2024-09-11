<?php

$conn = mysqli_connect('localhost','root','','choice');
if($conn==false){
    die("connexion error".mysqli_connect_error());
}
?>