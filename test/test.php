<?php
if(isset($_GET['type'])) {
    echo rand(10,100);
} else {
$price = (int)$_GET['priceeeee'];
if($price < 10) {
    echo "<p>Cmim keq</p>";
}
echo $price;
}
?>