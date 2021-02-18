<?php
require_once "db.php";
$price = floatval($_GET['user_price']);
$pri = CAST(($price) AS DECIMAL(12,2)) 
$uniqid = $_GET['unique_id']; ;
$input = $_GET['ofert_input']; 
$sel_prod = prep_stmt("SELECT * FROM products WHERE prod_unique_id = ?", $uniqid, "s");
$prod_fetch = mysqli_fetch_array($sel_prod);

$sel_balance = prep_stmt("SELECT * FROM users WHERE user_id = ?", user_id(), "i");
$balance_fetch = mysqli_fetch_array($sel_balance); 
$today = date("Y-m-d H:i:s");

if(!isset($_SESSION['logged'])){
    echo "notLogged";
    die();
}elseif($_SESSION['user']['status'] !== BUYER && $_SESSION['user']['status'] !== SELLER){
    echo "notBuyerSeller";
    die();
}elseif($prod_fetch['user_id'] === user_id()){
    echo "sameUser";
    die();
}elseif(!is_numeric($price)){
    echo "notNumber";
    die();
}else if($price <= $prod_fetch['prod_price']+1){
    echo "smallPrice";
    die();
}elseif($balance_fetch['user_balance'] < $price){
    echo "smallBalance";
    die();
}elseif(strtotime($prod_fetch['prod_to']) <= time()){
    echo "expiredDateTime";
    die();
}
else{
    if(isset($_GET['ofert_input'])){
        if(!prep_stmt("INSERT INTO prod_offers(user_id, offer_time, offer_price,prod_id) VALUES(?,?,?,?)", array(user_id(), $today,$price,$prod_fetch['prod_id']), "issi")){
                echo "prepError";die();
        }else{
            $user_balance = $balance_fetch['user_balance'] - $price;
            if(!prep_stmt("UPDATE users SET user_balance=? WHERE user_id=?", array($user_balance, user_id()),"si")){
                echo "prepError"; die();
            }else{
                if(!prep_stmt("UPDATE products SET CAST(prod_price as DECIMAL(6,2))=? WHERE user_id=?", array($price, $prod_fetch['prod_id']),"si")){
                    echo "prepError"; die();
                }else{
                    echo "ok";
                    die();
                }
            }
        }
    }else{
        echo "keq";
        die();
    }
}