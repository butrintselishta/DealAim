
<?php 
require_once "db.php";
$prod_id = $_GET['prod_id'];
if(isset($_GET['type'])){
    $sel_last_offer = prep_stmt("SELECT username,offer_time,offer_price FROM prod_offers LEFT OUTER JOIN users ON prod_offers.user_id = users.user_id WHERE prod_id=? ORDER BY offer_id DESC LIMIT 1", $prod_id, "i");
    //get the last row
    if(mysqli_num_rows($sel_last_offer) > 0){
        while($row_off = mysqli_fetch_array($sel_last_offer)){
                $usname = $row_off['username'];
                $username1 = substr($usname, 0, 1);$username2 = substr($usname, -1);
                $name_str = str_repeat("*", strlen($usname)-2);
                $username = $username1 . $name_str . $username2;
            echo "<tr class='tr_tb' style='color:green; font-size:15px; text-shadow:.3px .25px; width:33%'>
                    <th scope='col'>". date("d-M-Y H:i:s", strtotime($row_off['offer_time']))  ."</th>
                    <th scope='col'>".$username ."</th>
                    <th scope='col'>".  number_format($row_off['offer_price'],2). "€" ."</th>
                  </tr> ";        
            echo"<tr>
                    <th> </th>
                </tr>";
        }
    }else {
        echo "offerError";die();
    }

    $sel_offers = prep_stmt("SELECT username,offer_time,offer_price FROM prod_offers LEFT OUTER JOIN users ON prod_offers.user_id = users.user_id WHERE prod_id=? ORDER BY offer_id DESC LIMIT 4 OFFSET 1;", $prod_id, "i");
    //get the last 4 rows without the last one
    if(mysqli_num_rows($sel_offers) > 0){
        while($row_offers = mysqli_fetch_array($sel_offers)){
            $usname = $row_offers['username'];
            $username1 = substr($usname, 0, 1);$username2 = substr($usname, -1);
            $name_str = str_repeat("*", strlen($usname)-2);
            $username = $username1 . $name_str . $username2;
            echo "<tr style='width:33%'>
                    <th scope='col'>". date("d-M-Y H:i:s", strtotime($row_offers['offer_time'])) ."</th>
                    <th scope='col'>".$username ."</th>
                    <th scope='col'>". number_format($row_offers['offer_price'],2) . "€" ."</th>
                  </tr>";
        }
    }
}