<?php 
require "db.php";
 
// function openZip($file_to_open) {
//     global $target;
     
//     $zip = new ZipArchive();
//     $x = $zip->open($file_to_open);
//     if($x === true) {
//         $zip->extractTo($target);
//         $zip->close();
         
//         unlink($file_to_open);
//     } else {
//         die("There was a problem. Please try again!");
//     }
// }
// $trg = "/img/products/templates/allia.rar";
// openZip();
if(isset($_SESSION['user_unconfirmed'])){
    header("location:signin.php");die();
}
?>
<?php require "header.php"; ?>
<main>
    <div id="carousel-home">
        <div class="owl-carousel owl-theme">
        <?php 
                $last_prod = prep_stmt("SELECT prod_id,prod_img,prod_price,prod_title,cat_title FROM products LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id order by prod_id DESC LIMIT 1");
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
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php 
                $last_3_prod = prep_stmt("SELECT prod_id,prod_img,prod_price,prod_title,cat_title FROM products LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_id != (SELECT MAX(prod_id) FROM products) order by prod_id DESC LIMIT 2");
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
        <div class="main_title">
            <h2>TË NXEHTA</h2>
            <span>Produktet</span>
            <p>Më poshtë gjenden disa nga produktet që kan më shumë se 5 oferta në 24 orët e fundit!</p>
        </div>
        <div class="row small-gutters">
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <figure>
                        <span class="ribbon off">Në përfundim</span>
                        <a href="product-detail-1.html">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/1.jpg" alt="">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/1_b.jpg" alt="">
                        </a>
                        <div data-countdown="2021/01/06" class="countdown"></div>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>Armor Air x Fear</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$48.00</span>
                        <span class="old_price">$60.00</span>
                    </div>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /col -->
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <span class="ribbon off">Në përfundim</span>
                    <figure>
                        <a href="product-detail-1.html">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/2.jpg" alt="">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/2_b.jpg" alt="">
                        </a>
                        <div data-countdown="2020/03/15" class="countdown"></div>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>Armor Okwahn II</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$90.00</span>
                        <span class="old_price">$170.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /col -->
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <span class="ribbon off">-50%</span>
                    <figure>
                        <a href="product-detail-1.html">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/3.jpg" alt="">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/3_b.jpg" alt="">
                        </a>
                        <div data-countdown="2020/03/15" class="countdown"></div>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>Armor Air Wildwood ACG</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$75.00</span>
                        <span class="old_price">$155.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /col -->
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <span class="ribbon hot">Hot</span>
                    <figure>
                        <a href="product-detail-1.html">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/8.jpg" alt="">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/8_b.jpg" alt="">
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>Armor Air Max 720</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$120.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

     <!-- SELECTING AND SHOWING THE PRODUCTS THAT ARE PUT IN THIS LAST 24 HOURS IN AUCTION -->
    <?php
        $new_prod = prep_stmt("SELECT * FROM PRODUCTS WHERE products.prod_from > DATE_SUB(NOW(), INTERVAL 1 DAY) AND prod_isApproved=? ORDER BY prod_id DESC LIMIT 4", 1,"i");
    ?>
    <div class="container margin_60_35">
    <?php if(mysqli_num_rows($new_prod) > 0){ ?>
        <div class="main_title">
            <h2>TË REJA</h2>
            <span>Produktet</span>
            <p>Më poshtë gjenden disa nga produktet që kan dalur në ankand në 24 orët e fundit!</p>
        </div>
        <div class="row small-gutters">
        <?php  while($row_new_prod = mysqli_fetch_array($new_prod)){ ?>
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <figure>
                        <span class="ribbon off">Në përfundim</span>
                        <a href="product-detail-1.html">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg"alt="">
                            <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/1_b.jpg" alt="">
                        </a>
                        <div data-countdown="2021/01/06" class="countdown"></div>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>Armor Air x Fear</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$48.00</span>
                        <span class="old_price">$60.00</span>
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
        $closing_prod = prep_stmt("SELECT prod_id,prod_img,prod_title,prod_price,prod_from,prod_to,username, cat_id FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id WHERE products.prod_to > DATE_SUB(NOW(), INTERVAL 1 DAY) AND prod_isApproved=? ORDER BY prod_id DESC LIMIT 4", 1,"i");
    ?>
    <div class="container margin_60_35">
        <?php if(mysqli_num_rows($closing_prod)) { ?>
        <div class="main_title">
            <h2>NË PËRFUNDIM</h2>
            <span>Produktet</span>
            <p>Më poshtë gjenden disa nga produktet që janë orët e fundit para mbylljes!</p>
        </div>
        <div class="row small-gutters">
            <?php 
                while($row_closing_prod = mysqli_fetch_array($closing_prod)){ 
                    $prod_img = explode("|", $row_closing_prod['prod_img']);
                    $seller_username = $row_closing_prod['username'];
                    $seller_u = substr($seller_username, 0, 1);
                    $username_n = substr($seller_username, -1);
                    $usname_str = str_repeat("*", strlen($seller_username)-2);
                    $seller = $seller_u . $usname_str . $username_n;
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
							<span class="new_price" style="font-weight:800; font-size:1rem;"><?php echo $row_closing_prod['prod_price'] . " €"; ?></span>
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