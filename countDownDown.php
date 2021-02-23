<?php 

require_once "db.php";

$prod_id = $_GET['prod_id'];
$date_to = $_GET['date_to']; 

$today = time();

$get_prod_date = prep_stmt("SELECT prod_to FROM products WHERE prod_id=?", $prod_id, "i");
$get_date = mysqli_fetch_array($get_prod_date);
$date = strtotime($get_date['prod_to']);

$get_num_offers = prep_stmt("SELECT offer_id FROM prod_offers WHERE prod_id=?", $prod_id,"i");
$get_nr = mysqli_num_rows($get_num_offers); //die(var_dump($get_nr === 0));

if($today >= $date && $get_nr !== 0){
    echo "down_to_0";die();
}elseif($today >= $date && $get_nr === 0){
    echo "no_offers_down_to_0";
}
