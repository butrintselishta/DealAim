<?php 
require_once "db.php";
$prod_id = $_GET['prod_id'];
if(isset($_GET['type'])){
    echo "
        <tr>
            <th scope='col'><b> Koha </b></th>
            <th scope='col'> Ofertuesi </th>
            <th scope='col'> Çmimi </th>
        </tr>";

    $sel_offers = prep_stmt("SELECT username,offer_time,offer_price FROM prod_offers LEFT OUTER JOIN users ON prod_offers.user_id = users.user_id WHERE prod_id=? ORDER BY offer_id DESC LIMIT 5", $prod_id, "i");
    if(mysqli_num_rows($sel_offers) > 0){
        while($row_off = mysqli_fetch_array($sel_offers)){
            echo "<tr>
                    <th scope='col'>". $row_off['offer_time'] ."</th>
                    <th scope='col'>".$row_off['username'] ."</th>
                    <th scope='col' style='color:green'>". $row_off['offer_price'] ."</th>
                  </tr>";
        }
    }
}