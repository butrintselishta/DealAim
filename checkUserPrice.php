<?php
require_once "db.php";
$price = $_GET['user_price'];die(var_dump(is_float($price) == true));
$uniqid = $_GET['unique_id'];

$sel_prod = prep_stmt("SELECT * FROM products WHERE prod_unique_id = ?", $uniqid, "s");
$prod_fetch = mysqli_fetch_array($sel_prod);

$sel_balance = prep_stmt("SELECT * FROM users WHERE user_id = ?", user_id(), "i");
$balance_fetch = mysqli_fetch_array($sel_balance);

if(!isset($_SESSION['logged'])){
    echo "notLogged";
    die();
}elseif($_SESSION['user']['status'] !== BUYER && $_SESSION['user']['status'] !== SELLER){
    echo "notBuyerSeller";
    die();
}elseif(!is_int($price) && !is_float($price)){
    echo "notNumber";
    die();
}else if($price <= $prod_fetch['prod_price']){
    echo "smallPrice";
    die();
}elseif($balance_fetch['user_balance'] < $price){
    echo "smallBalance";
    die();
}
else {
    echo "ok";
    die();
}