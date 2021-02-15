<?php
if(isset($_GET['type'])) {
    echo rand(10,100);
} else {
$price = (int)$_GET['price'];
if($price < 10) {
    echo "<script>alert('Cmimi shume i vogel!');</script>";
}
echo $price;
}
?>