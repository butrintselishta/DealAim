<?php
require_once "db.php";
$price = $_GET['user_price'];
$uniqid = $_GET['unique_id'];

$sel_prod = prep_stmt("SELECT * FROM products WHERE prod_unique_id = ?", $uniqid, "s");
$prod_fetch = mysqli_fetch_array($sel_prod);

$succes = "";
if(!isset($_SESSION['logged'])){
    echo "notLogged";die();
}elseif($_SESSION['user']['status'] !== BUYER && $_SESSION['user']['status'] !== SELLER){
    echo "notBuyerSeller";die();
}else{
    if($price <= $prod_fetch['prod_price']){
        echo "CmimiVogel";die();
    }else{
        echo "ok";die();
    }
}