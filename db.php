<?php 

session_start();

$db = mysqli_connect("localhost","root","", "dealaim");

if(mysqli_connect_errno($db)){
    die ("Deshtim në lidhjen me databazë: ". mysqli_connect_error());
}

?>