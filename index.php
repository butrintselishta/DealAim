<?php 
require_once "db.php";

if(isset($_SESSION['user_unconfirmed'])){
    header("location:signin.php");die();
}
?>
<?php require "header.php"; ?>
<main>
    <div id="carousel-home">
        <div class="owl-carousel owl-theme">
        <?php 
                $last_prod = prep_stmt("SELECT prod_id,prod_img,prod_price,prod_title,cat_title FROM products LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id 
                WHERE prod_from <= NOW() AND prod_to > NOW() AND prod_isApproved = 1
                order by prod_id DESC LIMIT 1");
                if(mysqli_num_rows($last_prod) >0){
                    while($row_last = mysqli_fetch_array($last_prod)){
                        $prod_img = explode("|", $row_last['prod_img']);
                        $sel_offer_nr = prep_stmt("SELECT count(offer_id) FROM prod_offers WHERE prod_id = ?", $row_last['prod_id'], "i");
                        $row_offer_nr = mysqli_fetch_array($sel_offer_nr);
                        
            ?>
            <div class="owl-slide cover" style="background-image: url(img/products/<?php if($row_last['cat_title'] == "Laptop"){ echo "laptops"; }elseif($row_last['cat_title'] == "Telefon"){echo "phones";} elseif($row_last['cat_title'] == "Vetura"){echo "cars";} elseif($row_last['cat_title'] == "Template"){echo "templates";} ?>/<?php echo $prod_img[0]; ?>">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-right white">
                                    <h2 class="owl-slide-animated owl-slide-title"><?php echo $row_last['prod_title'] ?></h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        Kategoria: <?php echo "<b style='color:#004dda; text-shadow:0.5px 0.5px; font-size:2rem;'>". $row_last['cat_title']."</b>"; ?>
                                    </p>
                                    <p class="owl-slide-animated owl-slide-subtitle" style="margin-top:-20px;">
                                        <?php echo "Cmimi aktual: " . "<b style='color:#EE9D1E; text-shadow:0.5px 0.5px; font-size:2rem;'>". number_format($row_last['prod_price'],2) ."€</b>"; ?>
                                    </p>
                                    <p class="owl-slide-animated owl-slide-subtitle" style="margin-top:-20px;">
                                        Numri ofertuesve: <?php if($row_offer_nr[0] < 1){echo  "<b style='color:rgb(241, 71, 48); text-shadow:0.5px 0.5px; font-size:2rem;'>". $row_offer_nr[0] ."</b>";} else { echo "<b style='color:#00cf00; text-shadow:0.5px 0.5px; font-size:2rem;'>". $row_offer_nr[0] ."</b>";  }?>
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta">
                                        <a class="btn_1" href="details.php?prod_details=<?php echo $row_last['prod_id']; ?>" role="button">Shiko më shumë</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } }else{ ?>
            <div class="owl-slide cover" style="background-color:#7F7F7F">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-right white">
                                    <h2 class="owl-slide-animated owl-slide-title"> </h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php 
                $last_3_prod = prep_stmt("SELECT prod_id,prod_img,prod_price,prod_title,cat_title FROM products LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_id != (SELECT MAX(prod_id) FROM products) AND prod_from <= NOW() AND prod_to > NOW() AND prod_isApproved = 1 order by prod_id DESC LIMIT 2");
                if(mysqli_num_rows($last_prod) > 0){
                    while($row_last_3 = mysqli_fetch_array($last_3_prod)){
                        $prod_img = explode("|", $row_last_3['prod_img']);
                        $sel_offer_nr = prep_stmt("SELECT count(offer_id) FROM prod_offers WHERE prod_id = ?", $row_last_3['prod_id'], "i");
                        $row_offer_nr = mysqli_fetch_array($sel_offer_nr);
                        
            ?>
            <!--/owl-slide-->
            <div class="owl-slide cover" style="background-image: url(img/products/<?php if($row_last_3['cat_title'] == "Laptop"){ echo "laptops"; }elseif($row_last_3['cat_title'] == "Telefon"){echo "phones";} elseif($row_last_3['cat_title'] == "Vetura"){echo "cars";} elseif($row_last_3['cat_title'] == "Template"){echo "templates";} ?>/<?php echo $prod_img[0]; ?>">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="col-lg-6 static">
                                <div class="slide-text white">
                                <h2 class="owl-slide-animated owl-slide-title"><?php echo $row_last_3['prod_title'] ?></h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        Kategoria: <?php echo "<b style='color:#004dda; text-shadow:0.5px 0.5px; font-size:2rem;'>". $row_last_3['cat_title']."</b>"; ?>
                                    </p>
                                    <p class="owl-slide-animated owl-slide-subtitle" style="margin-top:-20px;">
                                        <?php echo "Cmimi aktual: " . "<b style='color:#EE9D1E; text-shadow:0.5px 0.5px; font-size:2rem;'>". number_format($row_last_3['prod_price'],2) ."€</b>"; ?>
                                    </p>
                                    <p class="owl-slide-animated owl-slide-subtitle" style="margin-top:-20px;">
                                        Numri ofertuesve: <?php if($row_offer_nr[0] < 1){echo  "<b style='color:rgb(241, 71, 48); text-shadow:0.5px 0.5px; font-size:2rem;'>". $row_offer_nr[0] ."</b>";} else { echo "<b style='color:#00cf00; text-shadow:0.5px 0.5px; font-size:2rem;'>". $row_offer_nr[0] ."</b>";  }?>
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta">
                                        <a class="btn_1" href="details.php?prod_details=<?php echo $row_last_3['prod_id']; ?>" role="button">Shiko më shumë</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
            </div>
            <?php } }else{ ?>

            <?php } ?>
        </div>
        <div id="icon_drag_mobile"></div>
    </div>
    <!--/carousel-->

    <!--/banners_grid -->
    <div class="container margin_60_35">
        <?php 
        $hot_prod = prep_stmt("SELECT prod_id,prod_img,prod_title,prod_price,prod_from,prod_to,username, cat_id FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id WHERE products.prod_isApproved = ? AND prod_from <= now() AND prod_to >= now()", 1, 'i');
        $cnt = 0;
        $div_array = array();
        if(mysqli_num_rows($hot_prod) > 0)
        { 
            $prod_hot_id = ""; $prod_hot_title = ""; $prod_hot_img = ""; $prod_hot_price="";$prod_hot_to="";  $hot_seller_user = ""; $hot_cat_id = "";
            while($row_hot_prod = mysqli_fetch_array($hot_prod)){
                $prod_hot_img = explode("|", $row_hot_prod['prod_img']);
                $sel_cnt_off = prep_stmt("SELECT count(prod_id) FROM prod_offers WHERE (offer_time >= now() - INTERVAL 24 HOUR) AND prod_id=?", $row_hot_prod['prod_id'], 'i');
                $cnt_off = mysqli_fetch_array($sel_cnt_off); 
                if($cnt_off[0] >= 5){ 
                    $cnt++;
                    $div_array[] .= "
                    <div class='col-6 col-md-4 col-xl-3'>
                        <div class='grid_item'>
                            <figure>
                                <a href='details.php?prod_details=".$row_hot_prod['prod_id']."'>
                                    <span class='ribbon hot'>E NXEHTË 🔥</span>
                                    <img class='img-fluid lazy' src='img/products/".($row_hot_prod['cat_id'] == 2 ? "laptops" : ($row_hot_prod['cat_id'] == 3 ? "phones" : ($row_hot_prod['cat_id'] == 5 ? "cars" : ($row_hot_prod['cat_id'] == 7 ? "templates" : ""))))."/". $prod_hot_img[0] ."'  alt=''>
                                    <img class='img-fluid lazy' src='img/products/".($row_hot_prod['cat_id'] == 2 ? "laptops" : ($row_hot_prod['cat_id'] == 3 ? "phones" : ($row_hot_prod['cat_id'] == 5 ? "cars" : ($row_hot_prod['cat_id'] == 7 ? "templates" : ""))))."/". $prod_hot_img[0] ."'  alt=''>
                                </a>
                                <div data-countdown='". $row_hot_prod['prod_to']."' class='countdown'></div>
                            </figure>
                            <a href='details.php?prod_details=".$row_hot_prod['prod_id'] ."'>
                                <h3>". $row_hot_prod['prod_title']."</h3>
                            </a>
                            <div class='price_box' style='padding: .5rem 1.1rem .5rem 1.1rem;'>
                                    
                                    <span class='seller' style='color:#d9534f; font-weight:500;'>Shitësi: <a style='font-weight:750;'> $hot_seller_user</a></span><br/>
                            </div>
                            <div class='price_box'>
                                <span>Çmimi aktual është:</span>
                                <span class='new_price' style='font-weight:800; font-size:1rem;'>". number_format($row_hot_prod['prod_price'],2) . "€</span>
                            </div>
                        </div>
                    </div>" ;
                }
            }
        }
        ?>
        <?php if($cnt > 0){ ?>
        <div class="main_title">
            <h2 style="color:#EE9D1E;">TË NXEHTA 🔥</h2>
            <span>Produktet</span>
            <p>Më poshtë gjenden disa nga produktet që kan më shumë se <b style="color:#63CF0F;"> 5 </b> oferta në <b style="color:#63CF0F;"> 24 orët</b> e fundit!</p>
        </div>
        <div class="row small-gutters">
            <?php 
                foreach($div_array as $prod){
                    echo $prod;
                }
            ?>
            <!-- /col -->
        </div>
        <?php } else { 
             $sel_rand_prod = prep_stmt("SELECT prod_id,prod_img,prod_title,prod_price,prod_from,prod_to,username, cat_id FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id WHERE products.prod_isApproved = ? AND prod_from <= now() AND prod_to >= now() ORDER BY rand(prod_id) LIMIT 8", 1, "i"); 
             if(mysqli_num_rows($sel_rand_prod) > 0){ 
        ?>
        <!-- NESE NUK KA PRODUKTE TE NXEHTA SHFAQI DISA PRODUKTE RANDOM -->
        <div class="main_title">
            <h2 style="color:#9933cc;">DISA NGA PRODUKTET AKTIVE Në ANKAND</h2>
            <span>Produktet</span>
            <p>Më poshtë gjenden disa nga produktet të përzgjedhura rastësishtë që janë aktive në ankand!</p>
        </div>
        <div class="row small-gutters">
            <?php 
            while($row_rand = mysqli_fetch_array($sel_rand_prod)){
                $prod_rand_img = explode("|", $row_rand['prod_img']);
                $rand_seller = getWinnSell($row_rand['username']);
            ?>
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <figure>
                        <a href="details.php?prod_details=<?php echo $row_rand['prod_id'] ?>">
                            <span class="ribbon new">E RE</span>
                            <img class="img-fluid lazy" src="img/products/<?php if($row_rand['cat_id'] == 2){ echo "laptops"; }elseif($row_rand['cat_id'] == 3){echo "phones";} elseif($row_rand['cat_id'] == 5){echo "cars";} elseif($row_rand['cat_id'] == 7){echo "templates";} ?>/<?php echo $prod_rand_img[0]; ?>"  alt="">
                            <img class="img-fluid lazy" src="img/products/<?php if($row_rand['cat_id'] == 2){ echo "laptops"; }elseif($row_rand['cat_id'] == 3){echo "phones";} elseif($row_rand['cat_id'] == 5){echo "cars";} elseif($row_rand['cat_id'] == 7){echo "templates";} ?>/<?php echo $prod_rand_img[0]; ?>"  alt="">
                        </a>
                        <div data-countdown="<?php echo $row_rand['prod_to'] ?>" class="countdown"></div>
                    </figure>
                    <a href="details.php?prod_details=<?php echo $row_rand['prod_id'] ?>">
                        <h3><?php echo $row_rand['prod_title']; ?></h3>
                    </a>
                    <div class="price_box" style="padding: .5rem 1.1rem .5rem 1.1rem;">
                            <!-- <span>Çmimi aktual është:</span> -->
                            <span class="seller" style="color:#d9534f; font-weight:500;">Shitësi: <a style="font-weight:750;"><?php  echo $rand_seller;?></a></span><br/>
                    </div>
                    <div class="price_box">
                        <!-- <span>Çmimi aktual është:</span> -->
                        <span class="new_price" style="font-weight:800; font-size:1rem;"><?php echo number_format($row_rand['prod_price'],2) . " €"; ?></span>
                    </div>
                </div>
                <!-- /grid_item -->
            </div>
            <?php } ?>
        </div>
        <?php } } ?>
        <!-- /row -->
    </div>
    <!-- /container -->
     <!-- SELECTING AND SHOWING THE PRODUCTS THAT ARE PUT IN THIS LAST 24 HOURS IN AUCTION -->
    <?php
        $new_prod = prep_stmt("SELECT prod_id,prod_img,prod_title,prod_price,prod_from,prod_to,username, cat_id FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id 
        WHERE NOW() > products.prod_from
        AND products.prod_from > DATE_SUB(NOW(), INTERVAL 1 DAY) 
        AND prod_isApproved=?
        ORDER BY prod_id DESC LIMIT 4", 1,"i");
    ?>
    <div class="container margin_60_35">
    <?php if(mysqli_num_rows($new_prod) > 0){ ?>
        <div class="main_title">
            <h2 style="color:#62CD0E;">TË REJA </h2>
            <span>Produktet</span>
            <p>Më poshtë gjenden disa nga produktet që kan dalur në ankand në 24 orët e fundit!</p>
        </div>
        <div class="row small-gutters">
        <?php 
            while($row_new_prod = mysqli_fetch_array($new_prod)){ 
                    $prod_image = explode("|",$row_new_prod['prod_img']);
                    $seller_usr = $row_new_prod['username'];
                    $seller_user = getWinnSell($seller_usr);
        ?>
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <figure>
                        <a href="details.php?prod_details=<?php echo $row_new_prod['prod_id'] ?>">
                            <span class="ribbon new">E RE</span>
                            <img class="img-fluid lazy" src="img/products/<?php if($row_new_prod['cat_id'] == 2){ echo "laptops"; }elseif($row_new_prod['cat_id'] == 3){echo "phones";} elseif($row_new_prod['cat_id'] == 5){echo "cars";} elseif($row_new_prod['cat_id'] == 7){echo "templates";} ?>/<?php echo $prod_image[0]; ?>"  alt="">
                            <img class="img-fluid lazy" src="img/products/<?php if($row_new_prod['cat_id'] == 2){ echo "laptops"; }elseif($row_new_prod['cat_id'] == 3){echo "phones";} elseif($row_new_prod['cat_id'] == 5){echo "cars";} elseif($row_new_prod['cat_id'] == 7){echo "templates";} ?>/<?php echo $prod_image[0]; ?>"  alt="">
                        </a>
                        <div data-countdown="<?php echo $row_new_prod['prod_to'] ?>" class="countdown"></div>
                    </figure>
                    <a href="details.php?prod_details=<?php echo $row_new_prod['prod_id'] ?>">
                        <h3><?php echo $row_new_prod['prod_title']; ?></h3>
                    </a>
                    <div class="price_box" style="padding: .5rem 1.1rem .5rem 1.1rem;">
							<!-- <span>Çmimi aktual është:</span> -->
							<span class="seller" style="color:#d9534f; font-weight:500;">Shitësi: <a style="font-weight:750;"><?php  echo $seller_user;?></a></span><br/>
                    </div>
                    <div class="price_box">
                        <!-- <span>Çmimi aktual është:</span> -->
                        <span class="new_price" style="font-weight:800; font-size:1rem;"><?php echo number_format($row_new_prod['prod_price'],2) . " €"; ?></span>
                    </div>
                </div>
                <!-- /grid_item -->
            </div>
            <?php } ?>
            <!-- /col -->
            <!-- /col -->
        </div>
        <?php } ?>
        <!-- /row -->
    </div>

    <!-- SELECTING AND SHOWING THE PRODUCTS THAT ARE IN THE LAST 24 HOURS IN AUCTION -->
    <?php
        $closing_prod = prep_stmt("SELECT prod_id,prod_img,prod_title,prod_price,prod_from,prod_to,username, cat_id FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id 
        WHERE (products.prod_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 DAY)) 
        AND prod_isApproved=? 
        ORDER BY prod_id DESC LIMIT 4", 1,"i");
    ?>
    <div class="container margin_60_35">
        <?php if(mysqli_num_rows($closing_prod) > 0) { ?>
        <div class="main_title">
            <h2 style="color:#E7452E;">NË PËRFUNDIM ⏰</h2>
            <span>Produktet</span>
            <p>Më poshtë gjenden disa nga produktet që janë orët e fundit para mbylljes!</p>
        </div>
        <div class="row small-gutters">
            <?php 
                while($row_closing_prod = mysqli_fetch_array($closing_prod)){ 
                    $prod_img = explode("|", $row_closing_prod['prod_img']);
                    $seller_username = $row_closing_prod['username'];
                    $seller = getWinnSell($seller_username);
            ?>
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <figure>
                        <a href="details.php?prod_details=<?php echo $row_closing_prod['prod_id'] ?>">
                            <span class="ribbon off">NË PËRFUNDIM</span>
                            <img class="img-fluid lazy" src="img/products/<?php if($row_closing_prod['cat_id'] == 2){ echo "laptops"; }elseif($row_closing_prod['cat_id'] == 3){echo "phones";} elseif($row_closing_prod['cat_id'] == 5){echo "cars";} elseif($row_closing_prod['cat_id'] == 7){echo "templates";} ?>/<?php echo $prod_img[0]; ?>"  alt="">
                            <img class="img-fluid lazy" src="img/products/<?php if($row_closing_prod['cat_id'] == 2){ echo "laptops"; }elseif($row_closing_prod['cat_id'] == 3){echo "phones";} elseif($row_closing_prod['cat_id'] == 5){echo "cars";} elseif($row_closing_prod['cat_id'] == 7){echo "templates";} ?>/<?php echo $prod_img[0]; ?>"  alt="">
                        </a>
                        <div data-countdown="<?php echo $row_closing_prod['prod_to'] ?>" class="countdown"></div>
                    </figure>
                    
                    <a href="details.php?prod_details=<?php echo $row_closing_prod['prod_id'] ?>">
                        <h3><?php echo $row_closing_prod['prod_title']; ?></h3>
                    </a>
                    <div class="price_box" style="padding: .5rem 1.1rem .5rem 1.1rem;">
							<!-- <span>Çmimi aktual është:</span> -->
							<span class="seller" style="color:#d9534f; font-weight:500;">Shitësi: <a style="font-weight:750;"><?php  echo $seller;?></a></span><br/>
                    </div>
                    <div class="price_box">
                        <!-- <span>Çmimi aktual është:</span> -->
                        <span class="new_price" style="font-weight:800; font-size:1rem;"><?php echo number_format($row_closing_prod['prod_price'],2) . " €"; ?></span>
                    </div>
                </div>
                <!-- /grid_item -->
            </div>
            <?php } ?>
            <!-- /col -->
        </div>
        <?php } ?>
        <!-- /row -->
    </div>
    <!-- /container -->

    
    <!-- /bg_gray -->
    <!-- /container -->
</main>
<!-- /main -->

<?php 
    require "footer.php";
?>