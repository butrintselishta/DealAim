<?php
    require_once "db.php";
    if(isset($_GET['prod_details'])){
        $prod_details = $_GET['prod_details'];
        $select_prod_data = prep_stmt("SELECT * FROM products WHERE prod_id=?", $prod_details, "i");
        if(mysqli_num_rows($select_prod_data)>0){
            $select_product = mysqli_fetch_array($select_prod_data); 
        }else{
            die("keq");
        }

        if(strtotime(date("Y-m-d h:i:s",strtotime($select_product['prod_from']))) > time()){
            header("location:index.php");
        }
        //SELECT SPECIFICATIONS
        $select_prod_details = prep_stmt("SELECT * FROM prod_specifications WHERE prod_unique_id = ?", array($select_product['prod_unique_id']), "s");

        //SELECT CAT_ID from CLICKED PRODUCT
        $sel_cat_id = prep_stmt("SELECT cat_id FROM products WHERE prod_unique_id = ? ", $select_product['prod_unique_id'], "s");
        $cat_id_fetch = mysqli_fetch_array($sel_cat_id);
        $cat_id = $cat_id_fetch['cat_id'];

        $cat_ttl = prep_stmt("SELECT cat_title FROM categories WHERE cat_id = ?", $cat_id, "i");
		$cat_title = mysqli_fetch_array($cat_ttl);

        $spec_1 = ""; $spec_2 = ""; $spec_3=""; $spec_4=""; $spec_5 = ""; $spec_6=""; $spec_7=""; $spec_8=""; $spec_9=""; $spec_10="";

        $today = time();
        $get_num_offers = prep_stmt("SELECT offer_id FROM prod_offers WHERE prod_id=?", $prod_details,"i");
        $get_nr = mysqli_num_rows($get_num_offers);
    }
   
	require "header.php";
?>
 
 
 <main>
    <?php
        while($sel_prod_spec = mysqli_fetch_array($select_prod_details)){

            if($cat_id == 2){
                $spec_1 = $sel_prod_spec['lap_man'];
                $spec_2 = $sel_prod_spec['lap_mod'];
                $spec_3 = $sel_prod_spec['lap_con'];
                $spec_4 = $sel_prod_spec['lap_dia'];
                $spec_5 = $sel_prod_spec['lap_col'];
                $spec_6 = $sel_prod_spec['lap_proc'];
                $spec_7 = $sel_prod_spec['lap_ram'];
                $spec_8 = $sel_prod_spec['lap_im'];
                $spec_9 = $sel_prod_spec['lap_ims'];
                $spec_10 = $sel_prod_spec['lap_gc'];
            }else if($cat_id == 3){
                $spec_1 = $sel_prod_spec['tel_man'];
                $spec_2 = $sel_prod_spec['tel_mod'];
                $spec_3 = $sel_prod_spec['tel_cond'];
                $spec_4 = $sel_prod_spec['tel_col'];
                $spec_5 = $sel_prod_spec['tel_im'];
                $spec_6 = $sel_prod_spec['tel_ram'];
                $spec_7 = $sel_prod_spec['tel_scn'];
                $spec_8 = $sel_prod_spec['tel_os'];
                $spec_9 = $sel_prod_spec['tel_op'];
            }else if($cat_id == 5){
                $spec_1 = $sel_prod_spec['car_man'];
                $spec_2 = $sel_prod_spec['car_mod'];
                $spec_3 = $sel_prod_spec['car_km'];
                $spec_4 = $sel_prod_spec['car_py'];
                $spec_5 = $sel_prod_spec['car_type'];
                $spec_6 = $sel_prod_spec['car_col'];
                $spec_7 = $sel_prod_spec['car_tra'];
                $spec_8 = $sel_prod_spec['car_fu'];
                $spec_9 = $sel_prod_spec['car_cub'];
            }
            
        }
    ?>
    
    <?php 
        $sel_winner = prep_stmt("SELECT username, offer_price FROM prod_offers LEFT OUTER JOIN users ON prod_offers.user_id = users.user_id WHERE prod_id=? ORDER BY offer_id DESC LIMIT 1", $prod_details,"i");
        $winner = ""; $winner_price = "";
        if(mysqli_num_rows($sel_winner) > 0){
            while($row_win = mysqli_fetch_array($sel_winner)){
                $winner_username = $row_win['username'];
                $winner_price = $row_win['offer_price'];
                $winner_u = substr($winner_username, 0, 1);
                $username_n = substr($winner_username, -1);
                $usname_str = str_repeat("*", strlen($winner_username)-2);
                $winner = $winner_u . $usname_str . $username_n;
            }
        }
    ?>
    <div class="container margin_30">
        <?php if($today >= strtotime($select_product['prod_to'])){ 
                if($get_nr === 0){
                    echo "
                    <div class='countdown_inner' style='background-color:#EFB3AB;'>
                        <div>
                            <h4 style='color:red; font-size:22px; font-weight:bold;'> ANKANDI ËSHTË MBYLLUR</h4> 
                        </div>
                        <i style='color:red'>Nuk ka pasur asnjë ofertues për këtë produkt, rrjedhimisht produkti nuk është shitur! </i>
                    </div>";
                }else {
                    echo "
                    <div class='countdown_inner' style='background-color:#ddd;'>
                        <div><h4 style='color:green; font-size:22px; font-weight:bold;'> ANKANDI ËSHTË MBYLLUR</h4> </div><i style='color:green'>Fitues i ankandit është:&nbsp;</i> <b style='color:green; font-size:18px; font-weight:bold'>".$winner ."</b> &nbsp; <i style='color:green'> me ofertën prej </i> &nbsp; <b style='color:green; font-size:18px; font-weight:bold'>".$winner_price ."€ </b> 
                    </div>";
                }
        ?>
        <?php }else { ?>
        <div class="countdown_inner" id="main_count_down"><i style="font-size:16px;">Përfundon për:&nbsp; </i>
            <?php 
                $sel_end = prep_stmt("SELECT prod_to FROM products WHERE prod_unique_id = ?", $select_product['prod_unique_id'], "s");
                $sel_end_date = mysqli_fetch_array($sel_end); 
            ?>
            <b style="font-size: 20px;"><div data-countdown="<?php echo $sel_end_date['prod_to']; ?>" class="countdown"></div></b>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <div class="all">
                    <div class="slider">
                        <div class="owl-carousel owl-theme main">
                            <?php 
                                $sel_all_prod_pics = prep_stmt("SELECT prod_img FROM products WHERE prod_unique_id = ?", $select_product['prod_unique_id'], "s");
                                $sel_prod_pics = mysqli_fetch_array($sel_all_prod_pics);
                                $sel_separated_prod_pics = explode("|", $sel_prod_pics['prod_img'],-1);
                                foreach($sel_separated_prod_pics as $value)
                                {
                            ?>
                             <a href="img/products/<?php if($cat_id == 2){echo "laptops";}elseif($cat_id == 3){echo "phones";}elseif($cat_id == 5){echo "cars";}else if($cat_id == 7){ echo "templates";} ?>/<?php echo $value; ?>" target="_blank"> <div style="background-image: url(img/products/<?php if($cat_id == 2){echo "laptops";}elseif($cat_id == 3){echo "phones";}elseif($cat_id == 5){echo "cars";}else if($cat_id == 7){ echo "templates";} ?>/<?php echo $value; ?>); background-repeat: no-repeat;background-size: contain;" class="item-box" ></div></a>
                           <?php } ?>
                        </div>
                        <div class="left nonl"><i class="ti-angle-left"></i></div>
                        <div class="right"><i class="ti-angle-right"></i></div>
                    </div>
                    <div class="slider-two">
                        <div class="owl-carousel owl-theme thumbs">
                            <?php 
                                foreach($sel_separated_prod_pics as $value)
                                { ?>
                                <div style="background-image: url(img/products/<?php if($cat_id == 2){echo "laptops";}elseif($cat_id == 3){echo "phones";}elseif($cat_id == 5){echo "cars";}else if($cat_id == 7){ echo "templates";} ?>/<?php echo $value; ?>);" class="item active"></div>
                                 <?php } ?>
                        </div>
                        <div class="left-t nonl-t"></div>
                        <div class="right-t"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">DealAIM</a></li>
                        <li><a href="#">Kategoria</a></li>
                        <li><?php echo $cat_title['cat_title']; ?></li>
                        <li><a href="#">Faqja aktive</a></li>
                    </ul>
                </div>
                <!-- /page_header -->
                <div class="prod_info">
                    <h1><?php echo $select_product['prod_title']; ?></h1>
                    <!-- <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><em>4 reviews</em></span> -->
                    <p>
                        <div class="col-lg-12">
                            <h5 style="text-decoration: none;">
                                <a>Ofertuesit e fundit</a>
                            </h5>
                            
                            <div class="table-responsive">
                                
                                <table class="table table-sm table-striped">
                                    <tbody>
                                        <?php if($cat_id == 2 || $cat_id == 3){ ?>
                                        <tr>
                                            <td><strong>Prodhuesi</strong></td>
                                            <td><?php echo $spec_1 ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Modeli</strong></td>
                                            <td><?php echo $spec_2 ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gjendja</strong></td>
                                            <td><?php echo $spec_3 ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ngjyra</strong></td>
                                            <td><?php echo $spec_4 ?></td>
                                        </tr>
                                        <!--- VETURA -->
                                        <?php } else if($cat_id == 5){ ?>
                                        <tr>
                                            <td><strong>Prodhuesi</strong></td>
                                            <td><?php echo $spec_1 ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Modeli</strong></td>
                                            <td><?php echo $spec_2 ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kilometrazha</strong></td>
                                            <td><?php echo $spec_3 . " KM" ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Viti i prodhimit</strong></td>
                                            <td><?php echo $spec_4 ?></td>
                                        </tr>
                                        <?php }  else if($car_id == 7){ ?>
                                            <tr>
                                                <td><strong>Kategoria</strong></td>
                                                <td><?php echo $spec_1 ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Teknologjitë e përdorura</strong></td>
                                                <td><?php echo $spec_2 ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Layout-i</strong></td>
                                                <td><?php echo $spec_3 ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Dukomentimi</strong></td>
                                                <td><?php echo $spec_4 ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /table-responsive -->
                        </div>
                    </p>
                    
                    <div class="row">
                    <script type="text/javascript">
                        //let only one decimal point
                        function isNumberKey(txt, evt) {
                        var charCode = (evt.which) ? evt.which : evt.keyCode;
                        if (charCode == 46) {
                            //Check if the text already contains the . character
                            if (txt.value.indexOf('.') === -1) {
                            return true;
                            } else {
                            return false;
                            }
                        } else {
                            if (charCode > 31 &&
                            (charCode < 48 || charCode > 57))
                            return false;
                        }
                        return true;
                        }
                    </script>
                        <script>
                            //popup message edhe disabled input
                            function verifyUser() {
                                document.getElementById("get_price").style.borderColor = "red";
                                document.getElementById("get_price").style.background = "#EFB3AB";
                                document.getElementById("oferto").disabled= true;
                                var popup = document.getElementById("myPopup");
                                popup.classList.toggle("show");
                               
                            }
                            function getPrice() {
                                var given_price = document.getElementById('get_price').value;
                                var uniqid = document.getElementById('get_uniqid').value;
                                var inputOferto = document.getElementById('oferto').value;
                                updatePrice(given_price,uniqid,inputOferto);
                            }
                            function updatePrice(price,id,input) { //tento per me shtu bid
                                $.ajax({
                                    url: "checkUserPrice.php",
                                    type: "get",
                                    data: {
                                        'user_price': price, 
                                        'unique_id': id,
                                        'ofert_input': input
                                        //get value : vlera inputit userit 
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        if(response == "notLogged"){
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }else if(response == "notBuyerSeller"){
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }else if(response == "sameUser"){
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }else if(response == "notNumber"){
                                            $('#statusi').html("<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Cmimi dhënë nuk është në fromatin e duhur!</small>");
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }else if(response == "smallPrice"){
                                            $('#statusi').html("<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Oferta duhet të jetë të paktën <b>1€ </b>mbi çmimin aktual!</small>");
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }else if(response == "smallBalance"){
                                            $('#statusi').html("<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Nuk keni balanc të mjaftushëm!</small>");
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }else if(response == "expiredDateTime"){
                                            $('#statusi').html("<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Ankandi për këtë produkt është mbyllur!</small>");
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }else if(response == "prepError"){
                                            $('#statusi').html("<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Diçka shkoi gabim, ju lutem provoni më vonë!</small>");
                                            $('#get_price').css("border-color", 'red');
                                            $('#get_price').css("background-color", '#EFB3AB');
                                        }
                                        else if(response == "ok"){
                                            $('#statusi').html("<small class='form-text text-muted' style='font-weight:bold; color:green !important;'>Ju ofertuat me sukses shumën prej <b style='font-size: 14px; text-shadow: 1px 0.1px 0.3px #5ee062;'>"+ parseFloat(price).toFixed(2) +"€ </b> !</small> <span style='font-size:14px;font-weight:bold;color:green'>&#10004;</span> ");
                                            $('#get_price').css("border-color", 'green');
                                            $('#get_price').css("background-color", '#D4EDDA');
                                         }
                                    },
                                    error: function(xhr) {
                                        console.log("ERROR!");
                                    }
                                });
                             }
                        </script>
                        <div class="col-lg-12 col-md-6">
                            <div class="price_main">
                                    <div class="col-lg-6 col-md-6  float-left">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend" style="width:100%;">
                                                <input type="text" class="form-control form-group1" id="get_price" value="<?php echo number_format($select_product['prod_price'], 2,'.',''); ?>" onkeypress="return isNumberKey(this, event);" >
                                                <span class="input-group-text">€</span>
                                                <input type="hidden" id="get_uniqid" value="<?php echo $select_product['prod_unique_id']; ?>">
                                            </div>
                                            <p id="statusi" style="margin-top:0;"> </p> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 float-right" >
                                        <div class="btn_add_to_cart">
                                            <input type="button" id="oferto" class="btn_1 btn__1" style="padding:4px 25px; font-size:26px;" value="OFERTO" onclick="getPrice(); <?php if(!isset($_SESSION['logged']) || $select_product['user_id'] == user_id() || $_SESSION['user']['status'] == CONFIRMED){ echo 'verifyUser();'; } ?>">
                                            <?php 
                                                if(!isset($_SESSION['logged'])){ echo "<span class='popuptext' id='myPopup'>Nuk mund të ofertoni pa pasur llogari!</span>"; 
                                                }elseif($_SESSION['user']['status'] == CONFIRMED){
                                                    echo "<span class='popuptext' id='myPopup'>Së pari duhet të aplikoni për blerës, pastaj mund të bëni ofertat tuaja!</span>"; 
                                                }elseif($select_product['user_id'] == user_id()){
                                                    echo "<span class='popuptext' id='myPopup'>Nuk mund të ofertoni për <b> produktin tuaj </b>!</span>";
                                                } 
                                               ?> 
                                        </div> 
                                    </div>

                                    <script> 
                                        var winner = "<?php echo  $winner; ?>"; 
                                        var winner_price = "<?php echo  $winner_price; ?>"; 
                                        var product_id = <?php echo  $prod_details; ?>;   
                                        var date_to = <?php echo strtotime($select_product['prod_to']); ?>;
                                        function countdownTo00() { 
                                        //shiko count down, kur bie ne 00 bej disable inputin dhe butonin
                                            $.ajax({
                                                url: "countDownDown.php",
                                                type: "get",
                                                data: {
                                                    "prod_id":product_id,
                                                    "date_to":date_to
                                                },
                                                success: function(response) {
                                                    if(response == "no_offers_down_to_0"){
                                                        $('#gabimOferte').hide();
                                                        $('#get_price').css("color", "red");
                                                        $('#get_price').css("font-weight", "800");
                                                        $('#get_price').attr("disabled",true);
                                                        $('#oferto').val("I MBYLLUR");
                                                        $('#oferto').css("background-color", "#ddd");
                                                        $('#oferto').attr("disabled",true);

                                                        $("#count_down").html("<i style='color:red'>Nuk ka pasur asnjë ofertues për këtë produkt! &nbsp; </i>");
                                                        $('#main_count_down').css("background-color", "#EFB3AB");
                                                        $("#main_count_down").html("<div><h4 style='color:red; font-size:22px; font-weight:bold;'> ANKANDI ËSHTË MBYLLUR</h4> </div><i style='color:red'>Nuk ka pasur asnjë ofertues për këtë produkt, rrjedhimisht produkti nuk është shitur! </i> ")
                                                    }
                                                    else if(response == "down_to_0"){
                                                        $('#get_price').css("color", "green");
                                                        $('#get_price').css("font-weight", "800");
                                                        $('#get_price').attr("disabled",true);
                                                        $('#oferto').val("I MBYLLUR");
                                                        $('#oferto').css("background-color", "#ddd");
                                                        $('#oferto').attr("disabled",true);

                                                        $("#count_down").html("<i style='color:green'>Fitues i ankandit është:&nbsp;</i> <b style='color:green; font-size:18px; font-weight:bold'>"+ winner +"</b> &nbsp; <i style='color:green'> me ofertën prej </i> &nbsp; <b style='color:green; font-size:18px; font-weight:bold'>"+ parseFloat(winner_price).toFixed(2) +"€ </b> ");
                                                        $('#main_count_down').css("background-color", "#ddd");
                                                        $("#main_count_down").html("<div><h4 style='color:green; font-size:22px; font-weight:bold;'> ANKANDI ËSHTË MBYLLUR</h4> </div><i style='color:green'>Fitues i ankandit është:&nbsp;</i> <b style='color:green; font-size:18px; font-weight:bold'>"+winner +"</b> &nbsp; <i style='color:green'> me ofertën prej </i> &nbsp; <b style='color:green; font-size:18px; font-weight:bold'>"+ parseFloat(winner_price).toFixed(2) +"€ </b> ")
                                                    }
                                                    else{
                                                        console.log("bbb")
                                                    }
                                                    setTimeout(countdownTo00, 1000);
                                                },
                                                error: function(xhr) {
                                                    console.log("ERROR!");
                                                }
                                            });
                                        }
                                        setTimeout(countdownTo00, 1000);
                                    </script>
                            </div>
                        </div>
                    </div>
                    <?php if($today >= strtotime($select_product['prod_to'])){ 
                              if($get_nr === 0){
                                echo "
                                    <div class='countdown_inner' style='background:#f3f3f3;color:red'>
                                     <i style='color:red'>Nuk ka pasur asnjë ofertues për këtë produkt! &nbsp; </i>
                                    </div>
                                ";
                              }else {
                                  echo "<div class='countdown_inner' style='background:#f3f3f3;color:red'>
                                             <i style='color:green'>Fitues i ankandit është:&nbsp;</i> <b style='color:green; font-size:18px; font-weight:bold'>".$winner."</b> &nbsp; <i style='color:green'> me ofertën prej </i> &nbsp; <b style='color:green; font-size:18px; font-weight:bold'>".$winner_price ."€ </b> 
                                        </div>";
                              }
                    ?>
                    <?php } else { ?>
                    <div class="countdown_inner" id="count_down" style="background:#f3f3f3;color:red"><i style="font-size:16px;">Përfundon për:&nbsp; </i>
                        <?php 
                            $sel_end = prep_stmt("SELECT prod_to FROM products WHERE prod_unique_id = ?", $select_product['prod_unique_id'], "s");
                            $sel_end_date = mysqli_fetch_array($sel_end); 
                        ?>
                        <b style="font-size: 20px;"><div data-countdown="<?php echo $sel_end_date['prod_to']; ?>" class="countdown" style="background:#f3f3f3; color:red; font-weight:900"></div></b>
                    </div>
                    <?php } ?>
                </div>
                <!-- /prod_info -->
                <div class="product_actions">
                    <div class="col-lg-12">
                        <h5 style="text-align: center; padding-top: 1em;">Ofertuesit e fundit</h5>
                        <div class="table-responsive">
                            <script>  
                                var prod_id = <?php echo  $prod_details; ?>   
                                    
                                function updateCmimiFundit() { 
                                   //update tabelen e ofertuesve te fundit
                                    $.ajax({
                                        url: "checkLatestOffers.php",
                                        type: "get",
                                        data: {
                                            "type": "cmimiFundit",
                                            "prod_id": prod_id
                                        },
                                        success: function(response) {
                                            if($.trim(response) == "offerError"){
                                                $('#gabimOferte').html("<div class='gabim'  style='margin-top:-3%;'><p style='font-weight:bold; color:red;'> Momentalisht nuk ka asnjë ofertë për këtë produkt! </p></div>");
                                            }else{
                                                $('#gabimOferte').hide();
                                                $('#cmimiFundit').html(response);
                                            }
                                            setTimeout(updateCmimiFundit, 1000);
                                        },
                                        error: function(xhr) {
                                            console.log("ERROR!");
                                        }
                                    });
                                }
                                setTimeout(updateCmimiFundit, 1000);
                            </script>
                            <table class="table table-sm table-striped">
                                <thead id="" style="background-color: #2d2d2d;color: white;">
                                    <tr style="width:33%">
                                        <th scope='col'><b> Koha </b></th>
                                        <th scope='col'> Ofertuesi </th>
                                        <th scope='col'> Çmimi </th>
                                    </tr>
                                </thead>
                                <thead id="cmimiFundit">   
                                        <!-- here are shown the 4 last rows without the least one --->
                                </thead>
                            </table>
                            <div id="gabimOferte">
                                
                            </div>
                        </div>
                        <!-- /table-responsive-->
                    </div>
                </div>
                <!-- /product_actions -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Përshkrimi</a>
                </li>
                <!-- <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
                </li> -->
            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper" id="specifikat">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                            Përshkrimi
                        </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <h3>Detajet</h3>
                                    <?php 
                                        $prod_description = preg_split("/\n+/", $select_product['prod_description']);
                                        
                                        foreach($prod_description as $p){
                                            echo "<p>". $p . "</p>";
                                        }?>
                                </div>
                                <div class="col-lg-5">
                                    <h3>Të gjitha specifikat</h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <tbody>
                                                <?php if($cat_id == 2){ ?>
                                                    <tr>
                                                        <td><strong>Prodhuesi</strong></td>
                                                        <td><?php echo $spec_1;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Modeli</strong></td>
                                                        <td><?php echo $spec_2;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Gjendja</strong></td>
                                                        <td><?php echo $spec_3;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Diagonalja e ekranit (e shprehur në inch) </strong></td>
                                                        <td><?php echo $spec_4. " inch";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Ngjyra</strong></td>
                                                        <td><?php echo $spec_5;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Procesori</strong></td>
                                                        <td><?php echo $spec_6;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Memorja RAM (e shprehur në GB) </strong></td>
                                                        <td><?php echo $spec_7 . " GB";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Memorja e brendshme</strong></td>
                                                        <td><?php echo $spec_8;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Hapsira e memorjes së brendshme (e shprehur në GB)</strong></td>
                                                        <td><?php echo $spec_9 . " GB";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kartela Grafike</strong></td>
                                                        <td><?php echo $spec_10;?></td>
                                                    </tr>
                                                <?php }else if($cat_id==3){ ?>
                                                    <tr>
                                                        <td><strong>Prodhuesi</strong></td>
                                                        <td><?php echo $spec_1;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Modeli</strong></td>
                                                        <td><?php echo $spec_2;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Gjendja</strong></td>
                                                        <td><?php echo $spec_3;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Ngjyra</strong></td>
                                                        <td><?php echo $spec_4;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Memorja e brendshme (e shprehur në GB)</strong></td>
                                                        <td><?php echo $spec_5  . " GB";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Memorja RAM (e shprehur në GB)</strong></td>
                                                        <td><?php echo $spec_6 . " GB";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Numri i vendeve për SIM kartela</strong></td>
                                                        <td><?php echo $spec_7?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Sistemi Operativ</strong></td>
                                                        <td><?php echo $spec_8;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Vendi Prodhimit</strong></td>
                                                        <td><?php echo $spec_9;?></td>
                                                    </tr>
                                                <?php }else if($cat_id == 5){ ?>
                                                    <tr>
                                                        <td><strong>Prodhuesi</strong></td>
                                                        <td><?php echo $spec_1;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Modeli</strong></td>
                                                        <td><?php echo $spec_2;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kilometrazha (të kaluara)</strong></td>
                                                        <td><?php echo $spec_3;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Viti i prodhimit</strong></td>
                                                        <td><?php echo $spec_4;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tipi i veturës</strong></td>
                                                        <td><?php echo $spec_5  . " GB";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Ngjyra</strong></td>
                                                        <td><?php echo $spec_6 . " GB";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Transmisioneri</strong></td>
                                                        <td><?php echo $spec_7?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Lloji karburanti</strong></td>
                                                        <td><?php echo $spec_8;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kubikazha </strong></td>
                                                        <td><?php echo $spec_9;?></td>
                                                    </tr>  
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Të fundit</h2>
            <span>Produktet</span>
            <p>bllah bllah bllah bllah</p>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            <?php
                // $select_latest = prep_stmt("SELECT * FROM products WHERE prod_isApproved = ? ORDER BY prod_id DESC", 0, "i");   
                // while($sel_latest_prod = mysqli_fetch_array($select_latest))
                // {
                //         $latest_prod_img = explode("|", $sel_latest_prod['prod_img'], -1);
            ?>
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon new">New</span><!-- class="ribbon new , ribbon hot, ribbon off"-->
                    <figure>
                        <a href="product-detail-1.html">
                            <img class="owl-lazy" src="img/products/<?php if($cat_id == 2){ echo "laptops";}elseif($cat_id == 3){ echo "phones";} elseif($cat_id == 5){echo "cars";}else if($cat_id == 7){echo "templates";} ?>/<?php echo $latest_prod_img[0]; ?>" alt="">
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3><?php echo $select_latest['prod_title']; ?></h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price"><?php echo $select_latest['prod_price']; ?></span>
                    </div>
                </div>
                <!-- /grid_item -->
            </div>
            <?php //} ?>
            <!-- /item -->
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->

    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>Free Shipping</h3>
                            <p>For all oders over $99</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>Secure Payment</h3>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>24/7 Support</h3>
                            <p>Online top support</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--/feat-->
</main>
<!-- /main -->

<?php require "footer.php";?>