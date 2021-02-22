<?php 

require_once "db.php";

$prod_id = $_GET['prod_id'];
$date_to = $_GET['date_to']; 

$today = time();
$data = strtotime(date("2021-02-20 15:13:35")); 

if($today >= $data){
    echo "down_to_0";die();
}else{
    echo "Asdf";
}
