<?php 
	require_once "../db.php";
	if($_SESSION['logged'] == false){
        header("location:../signin.php");
	}

	 //PRODUKTET dhe BRENDET dynamic multilevel menu
	 //create a multidimensional array to hold a list of menu and parent menu
	 //build the array lists with data from the menu table
	// Create the main function to build milti-level menu. It is a recursive function.	
    $result = prep_stmt("SELECT cat_id,cat_title,parent_id,cat_link FROM categories",null,null);
	$menu = array(
		'menus' => array(),
		'parent_menus' => array()
	);
	while ($row = mysqli_fetch_assoc($result)) {
		//creates entry into menus array with current menu id ie. $menus['menus'][1]
		$menu['menus'][$row['cat_id']] = $row;
		//creates entry into parent_menus array. parent_menus array contains a list of all menus with children
		$menu['parent_menus'][$row['parent_id']][] = $row['cat_id'];
	}	
	function buildMenu($parent, $menu) {
        $html = "";
        if (isset($menu['parent_menus'][$parent])) {
            $html .= "<ul>";
            foreach ($menu['parent_menus'][$parent] as $menu_id) {
                if (!isset($menu['parent_menus'][$menu_id])) { //rreshtin posht te brand_prod kam mbet
                    $html .= "
                                 <li>
                                    <a href='" . $menu['menus'][$menu_id]['cat_link'] . "?sub_cat=$menu_id". "'>" . $menu['menus'][$menu_id]['cat_title'] . "</a>
                                 </li>
                                ";
                }
                if (isset($menu['parent_menus'][$menu_id])) {
                    $html .= "<li><span><a href='" . $menu['menus'][$menu_id]['cat_link'] . "'>" . $menu['menus'][$menu_id]['cat_title'] . "</a></span>";
                    $html .= buildMenu($menu_id, $menu);
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
	}
	
	$username = $_SESSION['user']['username']; //USERNAME I PERDORUESITTE KYCUR
	$stmt = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");
	if(mysqli_num_rows($stmt) > 0){
		$stmt_fetch = mysqli_fetch_array($stmt);

		$username = $stmt_fetch['username'];
		$fname = $stmt_fetch['first_name'];//die(var_dump($fname));
		$lname = $stmt_fetch['last_name'];
		$email = $stmt_fetch['email'];
		$tel = $stmt_fetch['tel_nr'];
		$bday = date("d-M-Y", $stmt_fetch['birthday']);
		$city = $stmt_fetch['city'];
		$post_code = $stmt_fetch['postal_code'];
		$address = $stmt_fetch['address'];
		$pid = $stmt_fetch['pid_number'];
    }
    else{
        $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
    }
	
	if(isset($_POST['update_user_data'])){
		$user_usname = $_POST['username'];
		$user_pass = trim($_POST['password']);
		$user_fname = $_POST['fname'];
		$user_lname = $_POST['lname'];
		$user_email = $_POST['email'];
		$user_tel = $_POST['tel'];
		$user_bday =  $_POST['bday'];
		$user_city = $_POST['city'];
		$user_postal = $_POST['post_code'];
		$user_address = $_POST['address'];
		$user_pid = $_POST['pid'];

		if($user_usname == $username && empty($user_pass) && $user_fname == $fname && $user_lname==$lname &&	$user_email==$email && $user_tel == $tel && $user_bday == $bday && $user_city == $city && $user_postal == $post_code && $user_address == $address && $user_pid == $pid){
			die ("ska ndryshim");
		}else{
			die ("ka ndryshim");
		}
	}

	// $stmt_id = $stmt_fetch['user_id'];

	//apply for BUYER
	if(isset($_POST['bank_acc'])){
		$acc_number = str_replace(" ", "", $_POST['number']);
		$acc_full_name = $_POST['name'];
		$acc_expiry = $_POST['expiry'];
		$acc_cvc = $_POST['cvc'];
		$user_id = $_POST['user_id'];//die(var_dump($user_id));
		$euro = rand(10,2000); 
		$centa = rand(0,99); 
		$random = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
		$acc_balance_str = $euro . "." . $random; 
		$acc_balance = floatval($acc_balance_str); 
			 
		//inserting data (bank account)
		if(!prep_stmt("INSERT INTO bank_acc(acc_number,acc_full_name,acc_expiry, acc_cvc, acc_balance, user_id) VALUES(?,?,?,?,?,?)",array($acc_number, $acc_full_name, $acc_expiry, $acc_cvc, $acc_balance, $user_id), "sssisi")){ $_SESSION['insert_bank_acc_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ndodhi një gabim, ju lutem kthehuni më vonë dhe provoni përsëri!</p>"; header("location:index.php"); die();}
		else{
			if(!prep_stmt("UPDATE users SET status=?,user_balance=? WHERE user_id = ?", array(BUYER,0,$user_id), "iii")){
				$_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
			}else { 
				$_SESSION['user']['status'] = BUYER;
				$_SESSION['insert_bank_acc_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Statusi juaj është ndryshuar në <b style='color:#F0AC1A'> BLERËS </b>, bilanci juaj për momentin është <b style='color:#CF2928'>€0.00</b>. Për ta ndryshuar gjendjen e bilancit shikoni <a href='#'>udhëzimet</a> ose ndryshoni menjëher duke shkuar tek <b style='color:#F0AC1A; text-transform:uppercase'>Llogaria Bankare dhe Bilanci </b></p>"; header("location:index.php"); die();
			}
		}
	}
	//apply for seller
	if(isset($_POST['seller_apply'])){
		$id_number = $_POST['id_number'];
		$term_cond = intval($_POST['check_confirm']);

		if(!prep_stmt("UPDATE users SET pid_number = ?, terms_and_conditions =  ?, status=? WHERE username = ?", array($id_number,$term_cond,SELLER, $username), "iiis")){
			$_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
		}else{
			$_SESSION['user']['status'] = SELLER;
			$_SESSION['seller_status_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Statusi juaj është ndryshuar në <b style='color:#5ABC35; font-weight:900;'> SHITËS </b>, tani pos që mund të fitoni ankande si blerës, ju mund edhe të futni produkte tuaja në ankand për shitje. </p>"; header("location:index.php"); die();
		}
	}
	//depozit para
	if(isset($_POST['depozite_btn'])){
        $ter = $_POST['dep_shuma']; 
        $ter_shuma = number_format($ter, 2,'.', '');//die(var_dump($ter_shuma));

        $balance = prep_stmt("SELECT acc_balance FROM bank_acc WHERE user_id=?", $stmt_fetch['user_id'],'i');
        if(mysqli_num_rows($balance) > 0){
            $user_balance = mysqli_fetch_array($balance);
        }else{
            $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM1! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
        }
        
        if($ter_shuma > $user_balance['acc_balance']){
            $_SESSION['user_balance_low'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM2! </h4><p style='color:#E62E2D;'> Ju lutem kontrolloni llogarinë tuaj bankare, nuk keni bilanc të mjaftueshëm! </p>"; header("location:index.php"); die();
        }
        else{
            $sel_curr_balance = prep_stmt("SELECT user_balance FROM users WHERE user_id=?", $stmt_fetch['user_id'],"i");
            if(mysqli_num_rows($stmt) > 0){
                $curr_balance = mysqli_fetch_array($sel_curr_balance); //die(var_dump($curr_balance['user_balance']));
            }else{
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM3! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
            }

            $deal_user_balance = 0;
            $bank_user_balance = 0; //die(var_dump($bank_user_balance));

            $bank_user_balance = $user_balance['acc_balance'] - $ter_shuma;
            $deal_user_balance = $curr_balance['user_balance'] + $ter_shuma;// die(var_dump($deal_user_balance));
            if(!prep_stmt("UPDATE users SET user_balance=? WHERE user_id=?", array($deal_user_balance, $stmt_fetch['user_id']), "di")){
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM4! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
            }else{
              if(!prep_stmt("UPDATE bank_acc SET acc_balance = ? WHERE user_id=?", array($bank_user_balance, $stmt_fetch['user_id']), "di")){ 
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM5! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
               }
               else{
                $_SESSION['user_balance_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> <b style='color:#F0AC1A;font-size:17px;'>". $ter_shuma ."€ </b> janë transferuar në llogarinë tuaj. Bilanci juaj aktual është: <b style='color:#F0AC1A;font-size:17px;'>". number_format($deal_user_balance,2,'.','') ."€ </b></p>"; header("location:index.php"); die();
               }
            }
        }
    }

    //terheq para
    if(isset($_POST['terheq_btn'])){
        $dep = $_POST['ter_shuma'];
        $dep_shuma = number_format($dep, 2,'.', '');//die(var_dump($dep_shuma));
        $sel_current_balance = prep_stmt("SELECT user_balance FROM users WHERE user_id=?", $stmt_fetch['user_id'],"i");
        if(mysqli_num_rows($sel_current_balance) > 0){
            $current_balance = mysqli_fetch_array($sel_current_balance); //die(var_dump($current_balance['user_balance']));
        }else{
            $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
        }
        if($dep_shuma > $current_balance['user_balance']){
            $_SESSION['user_balance_low'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ju lutem kontrolloni bilancin në llogarinë tuaj, nuk keni bilanc të mjaftueshëm! </p>"; header("location:index.php"); die();
        }else{
            $balance_us = prep_stmt("SELECT acc_balance FROM bank_acc WHERE user_id=?", $stmt_fetch['user_id'],'i');
            if(mysqli_num_rows($balance_us) > 0){
                $balance_us_fetch = mysqli_fetch_array($balance_us); //die(var_dump($balance_us_fetch['acc_balance']));
            }else{
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
            }
            $tot_balance_bank = 0;
            $tot_balance_user = 0;

            $tot_balance_bank = $balance_us_fetch['acc_balance'] + $dep_shuma;//die(var_dump($tot_balance));
            $tot_balance_user =  $current_balance['user_balance'] - $dep_shuma;//die(var_dump($tot_balance_user));

            if(!prep_stmt("UPDATE users SET user_balance=? WHERE user_id=?", array($tot_balance_user, $stmt_fetch['user_id']), "di")){
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
            }else{
              if(!prep_stmt("UPDATE bank_acc SET acc_balance = ? WHERE user_id=?", array($tot_balance_bank, $stmt_fetch['user_id']), "di")){ 
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
               }
               else{
                $_SESSION['user_balance_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> <b style='color:#F0AC1A;font-size:17px;'>". $dep_shuma ."€ </b> janë tërhequr nga llogaria juaj. Bilanci juaj aktual është: <b style='color:#F0AC1A;font-size:17px;'>". number_format($tot_balance_user,2,'.','') ."€ </b></p>"; header("location:index.php"); die();
               }
            }
        }
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

    <!-- Favicons-->
    <link href="../css/card.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="../js/jquery.card.js"></script>

    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="../img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="../img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="../img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="../img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link rel="preload" href="../css.css?family=Roboto:300,400,500,700,900&display=swap" as="fetch"
        crossorigin="anonymous">

    <script>
        ! function (e, n, t) {
            "use strict";
            var o = "https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap",
                r = "__3perf_googleFonts_c2536";

            function c(e) {
                (n.head || n.body).appendChild(e)
            }

            function a() {
                var e = n.createElement("link");
                e.href = o, e.rel = "stylesheet", c(e)
            }

            function f(e) {
                if (!n.getElementById(r)) {
                    var t = n.createElement("style");
                    t.id = r, c(t)
                }
                n.getElementById(r).innerHTML = e
            }
            e.FontFace && e.FontFace.prototype.hasOwnProperty("display") ? (t[r] && f(t[r]), fetch(o).then(function (
            e) {
                return e.text()
            }).then(function (e) {
                return e.replace(/@font-face {/g, "@font-face{font-display:swap;")
            }).then(function (e) {
                return t[r] = e
            }).then(f).catch(a)) : a()
        }(window, document, localStorage);
    </script>
        <style>
			
        .jp-card {
            height: 90% !important;
        }
        .form-group1 {
            width: 35%;
        }
        .input-group-bal {
			width:30% !important;
		}
        @media only screen and (max-width: 768px){
            .jp-card{
                margin-left: 25%;
            }
            .form-group1 {
                width: 50%;
            }
            .input-group-bal {
                width:60% !important;
            }
            .btn__1{
                display:flow-root !important;
            }
            
        }
        @media only screen and (max-width: 1199px){
            .checkmark {
                margin-left:0% !important;
            }
            .btn__1{
                display:flow-root !important;
			}
			/* .left{
			width:48% !important;
			}
			.right{
				width:48% !important;
			} */
        }

        .shites {
            font-weight: bold !important;
            background: transparent;
            font-size: 15px !important;
            border: 0;
        }

        .shites:hover {
            color: white !important;
            border:0;
        }
        .shites:focus{
            outline:0;
            color: white !important;
            background: transparent;
            border:0;
        }
        .sukses {
            width:100%;
            padding: 10px 10px 1px 10px;
            background-color:#D4EDDA;
            text-align:center;
            margin-bottom:6px;
        }
        .gabim {
            width:100%;
            padding: 10px 10px 1px 10px;
            background-color:#EFB3AB;
            text-align:center;
            margin-bottom:6px;
        }
        .hide {
            display: none;
		}
		
    </style>
    
    <!-- BASE CSS -->
    <link href="../css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    

    <!-- DatePicker -->
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/datepicker.css" type="text/css">
    <script src="jquery-1.12.0.min.js" type="text/javascript"></script>

    <!-- SPECIFIC CSS -->
    <link href="../css/home_1.css" rel="stylesheet">
    <link href="../css/product_page.css" rel="stylesheet">
    <link href="../css/listing.css" rel="stylesheet">
    <link href="../css/account.css" rel="stylesheet">
    <link href="../css/checkout.css" rel="stylesheet">
    <link href="../css/error_track.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <link rel="stylesheet" href="../css/intlTelInput.css">
    <!-- <link rel="stylesheet" href="css/demo.css"> -->
</head>

<body>

    <div id="page">

        <header class="version_1">
            <div class="layer"></div>
            <!-- Mobile menu overlay mask -->
            <div class="main_header">
                <div class="container">
                    <div class="row small-gutters">
                        <?php  if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){ ?>
                        <div class="col-xl-2 col-lg-2 d-lg-flex align-items-center">
                            <?php } else { ?>
                            <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                                <?php } ?>
                                <div id="logo">
                                    <a href="index.php"><img src="../img/logo.svg" alt="" width="100" height="35"></a>
                                </div>
                            </div>
                            <?php  if(isset($_SESSION['logged']) && $_SESSION['logged'] == true)
                                { ?>
                            <nav class="col-xl-8 col-lg-8">
                                <?php }  else { ?>
                                <nav class="col-xl-7 col-lg-7">
                                    <?php } ?>

                                    <a class="open_close" href="javascript:void(0);">
                                        <div class="hamburger hamburger--spin">
                                            <div class="hamburger-box">
                                                <div class="hamburger-inner"></div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Mobile menu button -->
                                    <div class="main-menu">
                                        <div id="header_menu">
                                            <a href="index.php"><img src="img/logo_black.svg" alt="" width="100"
                                                    height="35"></a>
                                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="../index.php" target="_parent">Ballina</a>
                                            </li>
                                            <li>
                                                <a href="../item/allaia-ecommerce-html-template/25781982.html"
                                                    target="_parent">Të shitura</a>
                                            </li>
                                            <li>
                                                <a href="../item/allaia-ecommerce-html-template/25781982.html"
                                                    target="_parent">Rreth Nesh</a>
                                            </li>
                                            <li>
                                                <a href="../item/allaia-ecommerce-html-template/25781982.html"
                                                    target="_parent">Si funksionon?</a>
                                            </li>
                                            <li>
                                                <a href="../item/allaia-ecommerce-html-template/25781982.html"
                                                    target="_parent">Kontakti</a>
                                            </li>
                                            <?php
                                                if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                                                    if(isset($_SESSION['user']) && $_SESSION['user']['status'] == CONFIRMED){ 
                                                        echo "<li>";
														echo "<a href='index.php?form_buyer' class='shites'>Apliko për blerës</a>";
                                                        echo "</li>";
                                                    }elseif(isset($_SESSION['user']) && $_SESSION['user']['status'] == BUYER){
                                                        echo "<li>";
                                                        echo "<a href='index.php?form_seller' class='shites'>Apliko për shitës</a>";
                                                        echo "</li>";
                                                    }elseif(isset($_SESSION['user']) && $_SESSION['user']['status'] == SELLER){
                                                        echo "<li>";
                                                        echo "";
                                                        echo "</li>";
                                                    }
                                                }
                                            ?>

                                        </ul>
                                    </div>
                                    <!--/main-menu -->
                                </nav>
                                <div
                                    class="col-xl-2 col-lg-1 d-lg-flex align-items-center justify-content-end text-right">
                                    <a class="phone_top" href="tel://9438843343"><strong><span>Kërkoni
                                                ndihmë?</span>+383-44-111-222</strong></a>
                                </div>
                        </div>
                        <!-- /row -->
                    </div>
                </div>
                <!-- /main_header -->

                <div class="main_nav Sticky">
                    <div class="container">
                        <div class="row small-gutters">
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <nav class="categories">
                                    <ul class="clearfix">
                                        <li><span>
                                                <a href="#">
                                                    <span class="hamburger hamburger--spin">
                                                        <span class="hamburger-box">
                                                            <span class="hamburger-inner"></span>
                                                        </span>
                                                    </span>
                                                    Categories
                                                </a>
                                            </span>
                                            <div id="menu">
                                                <!--- CATEGORIES -->
                                                <?php echo buildMenu(0,$menu);?>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                                <div class="custom-search-input">
                                    <input type="text" placeholder="Kërko produkte">
                                    <button type="submit"><i class="header-icon_search_custom"></i></button>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3">
                                <ul class="top_tools">
                                    <li> </li>
                                    
                                        <!-- /dropdown-cart-->
                                    <li>
                                        <div class="dropdown dropdown-access">
                                            <a href="<?php if(isset($_SESSION['logged'])){ echo "profile.php ";} else{ echo "signin.php";} ?>" class="access_link" data-toggle="dropdown"><span>Account</span></a>
                                            <div class="dropdown-menu">
                                                <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){   ?>
                                                <a style="font-size: 15px;font-weight:italic;">Statusi:
                                                    <?php
                                                        if(isset($_SESSION['user'])){
                                                            if($_SESSION['user']['status'] == CONFIRMED){
                                                                echo "<b style='color:#CF2928'> I REGJISTRUAR </b>";
                                                            }elseif($_SESSION['user']['status'] == BUYER){
                                                                echo "<b style='color:#F0AC1A'>BLERËS</b>";
                                                            }else{
                                                                echo "<b style='color:#5ABC35'>SHITËS</b>";
                                                            }
                                                        }
                                                    ?> 
                                                </a>
                                                
                                                <?php if($_SESSION['user']['status'] == BUYER || $_SESSION['user']['status'] == SELLER)
                                                {   
                                                    $st = prep_stmt("SELECT CAST(user_balance as decimal(6,2)) FROM users WHERE username=?", $_SESSION['user']['username'], 's');
                                                    $sql = mysqli_fetch_array($st);
                                                    echo "<hr style='margin:0.4em 0 0.4em 0'>";
                                                    echo "<a style='font-size:15px;font-weight:italic;'>Bilanci:
                                                        <b style='color:green'> €". $sql[0]." </b>
                                                    </a>";
                                                }
                                                ?>
                                                <!-- -->
                                                <ul>
                                                    <li>
                                                        <a href="index.php"><i class="ti-user"></i>Paneli</a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="../logout.php"><i class="ti-shift-left-alt"></i>Ç'kyçu</a>
                                                    </li>
                                                </ul>
                                                <?php } else { ?>
                                                <a href="signin.php" class="btn_1">Kyçu ose Regjistrohu</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <!-- /dropdown-access-->
                                    </li>  
                                  
                                    <!-- <li>
                                        <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                                    </li> -->
                                    <li>
                                        <a href="javascript:void(0);"
                                            class="btn_search_mob_HIDDEN"><span>Search</span></a>
                                    </li>
                                    <li>
                                        <a href="#menu" class="btn_cat_mob">
                                            <div class="hamburger hamburger--spin" id="hamburger">
                                                <div class="hamburger-box">
                                                    <div class="hamburger-inner"></div>
                                                </div>
                                            </div>
                                            Categories
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="search_mob_wp">
                        <input type="text" class="form-control" placeholder="Kërko produkte">
                        <input type="submit" class="btn_1 full-width" value="Search">
                    </div>
                    <!-- /search_mobile -->
                </div>
                <!-- /main_nav -->
        </header>
        <!-- /header -->
<main class="bg_gray">
     <div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Category</a></li>
					<li>Page active</li>
				</ul>
		</div>
    </div>
    <div class="row justify-content-center" style="background:#fff; box-shadow:0px 0px 10px 0px rgb(0 0 0 / 10%);">
        <div class="col-xl-12 col-lg-6 col-md-8">
			<div class="box_account">
              <center>
                <h3 class="new_client">Përshëndetje, <i style="font-weight:bold;"><?php echo " " . $stmt_fetch['first_name'] . " " . $stmt_fetch['last_name']; ?></i></h3> 
				<ul class="nav nav-tabs" role="tablist">
					<?php if(isset($_GET['form_buyer']) && $_SESSION['user']['status'] == CONFIRMED){ echo "<li class='active'><a href='#buyer' role='tab' data-toggle='tab'>Aplikimi për blerës</a></li>";} ?>
					<?php if(isset($_GET['form_seller']) && $_SESSION['user']['status'] == BUYER){ echo "<li class='active'><a href='#seller' role='tab' data-toggle='tab'>Aplikimi për shitës</a></li>";} ?>
					<li class="<?php if(isset($_GET['form_buyer']) || isset($_GET['form_seller'])){ echo "";}else { echo "active";} ?>"><a href="#myprofile" role="tab" data-toggle="tab">Profili im</a></li>
					<?php if($_SESSION['user']['status'] == BUYER || $_SESSION['user']['status'] == SELLER){ echo "<li><a href='#bank_acc' role='tab' data-toggle='tab'>Llogaria Bankare dhe Bilanci</a></li>"; } ?>
					<?php if($_SESSION['user']['status'] == SELLER) {
					echo "<li><a href='#prod_add' role='tab' data-toggle='tab'>Shto një produkt </a></li>";
					echo "<li><a href='#prod_sell' role='tab' data-toggle='tab'>Produktet e shitura </a></li>";
					echo "<li><a href='#prod_sell' role='tab' data-toggle='tab'>Produktet e blera </a></li>";
					} ?>
				</ul>
					<div class="tab-content content-profile">
						<?php if(isset($_GET['form_buyer']) && $_SESSION['user']['status'] == CONFIRMED){ ?>
						<div class="tab-pane fade in active" id="buyer" style="">
                            <!-- BANK ACCOUNT APPLICATION -->
                             <div class="private box" id="showForm" style="display">
                                <div class="divider">
                                    <span style="background-color:#fff">Të dhënat bankare</span>
                                </div>
                                <center>
                                <div class="row no-gutters form-container active" id="">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="acc_form" style="width:100%;">
                                        <div class="col-12 pl-1"> 
                                            <div class="card-wrapper"></div>
                                        </div>
                                        <div class="col-12 pl-1">
                                            <div class="form-group form-group1">
                                                <label> Numri i xhirollogarisë </label>
                                                <input type="text" name="number" id="number" class="form-control" placeholder="xxxx xxxx xxxx xxxx" style="text-align:center;">
                                            </div>
                                        </div>
                                        <div class="col-12 pl-1" >
                                            <div class="form-group form-group1">
                                                <label> Emri dhe Mbiemri </label>
                                                <input type="text" name="name" id="name" class="form-control"  placeholder="Emri dhe Mbiemri" style="text-align:center;">
                                            </div>
                                        </div>
                                        <div class="col-12 pl-1">
                                            <div class="form-group form-group1">
                                                <label> Data skadencës </label>
                                                <input type="tel" name="expiry" id="expiry" class="form-control" placeholder="MM/YY"  style="text-align:center;">
                                            </div>
                                        </div>
                                        <div class="col-12 pl-1">
                                            <div class="form-group form-group1">
                                                <label> CVV Kodi </label>
                                                <input type="number" name="cvc" id="cvc" class="form-control" placeholder="xxx"  style="text-align:center;">
                                            </div>
                                        </div>
                                        <div class="col-12 pl-1" >
                                            <div class="form-group form-group1" >
                                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $stmt_fetch['user_id'] ?>" style="text-align:center;">
                                            </div>
										</div>
										<div class="col-12 pl-1" id="" >
											<div class="text-center btn_center" style="margin-bottom:15px;"><button type="submit" id="apply" name="bank_acc" value="Vazhdo" class="btn_1 ">APLIKO</button></div>
										</div>
                                    </form>
                                </div>	
                                </center>
							</div>
						</div>
						<?php } ?>
						
						<?php if(isset($_GET['form_seller']) && $_SESSION['user']['status'] == BUYER){ ?>
						<div class="tab-pane fade in active" id="seller" style="">	
							<div class="row no-gutters form-container active" id="">
								<form method="POST" action="" id="form_seller" style="width:100%;">
									<small style="color:#000; font-weight:700; font-size:15px;text-align:center !important; text-decoration:underline;"> Aplikimi për tu bërë shitës është i thjeshtë, ju vetëm duhet të shkruani <b style="text-transform:uppercase; color:red;">numrin tuaj identifikues (ID)</b> dhe të pranoni <a href="#"> TERMET DHE KUSHTET </a></small>
									<div class="clearfix add_bottom_15" style="width:42.5%;overflow-wrap: anywhere; text-align:left; background-color:#f9f9f9">
										<div class="checkboxes float-center">
											<br/>
											<small style="color:red; font-weight:700;"><i class="ti-hand-point-right" style="color:black;"></i> Ju lutem lexoni me kujdes <a href="#" style="font-weight:900;"> Termet dhe Kushtet</a>, pas pranimit të tyre përgjegjësia është mbi ju. </small>
										</div>
									</div>
									<div class="clearfix add_bottom_15 " style="margin:0;">
										<div class="checkboxes float-center">
											<div class="form-group form-group1">
												<input type="text" name="id_number" id="id_number" class="form-control"  placeholder="Numri pasaportes (ID identifikuese)" style="text-align:center;">
											</div>
										</div>
									</div>
									<div class="clearfix add_bottom_15">
										<div class="checkboxes float-center">
											<label class="container_check" style="color:black;">Duke klikuar këtu, unë i pranoj <a href="#" style="font-weight:900;"> Termet dhe Kushtet. <b style="color:red">*</b></a>
												<input type="checkbox" value="" name="check_confirm" id="check_confirm" onclick="calc()">
												<span class="checkmark" name="checkmark" id="checkmark" style="margin-left:34%;"></span>
											</label>
										</div>
									</div> 
									<div class="text-center btn_center" style="margin-bottom:15px;"><button type="submit" id="seller_apply" name="seller_apply" value="Vazhdo" class="btn_1 ">APLIKO</button></div>
								</form>
							</div>	
						</div>
						<?php } ?>
						<!-- MY PROFILE -->
						<?php if(isset($_GET['form_buyer']) && $_SESSION['user']['status'] == CONFIRMED || isset($_GET['form_seller']) && $_SESSION['user']['status'] == BUYER){ ?>
                        <div class="tab-pane fade" id="myprofile">
						<?php } else { ?>
						<form method="post" action="index.php">
						<div class="tab-pane fade in active" id="myprofile">
							<?php } ?>
							<?php
								if(isset($_SESSION['prep_stmt_error'])){
									echo "<div class='gabim'>";
									echo $_SESSION['prep_stmt_error'];
									echo "</div>";
								}
								elseif(isset($_SESSION['insert_bank_acc_error'])){
									echo "<div class='gabim'>";
									echo $_SESSION['insert_bank_acc_error'];
									echo "</div>";
								}elseif(isset($_SESSION['insert_bank_acc_correct'])){
									echo "<div class='sukses'>";
									echo $_SESSION['insert_bank_acc_correct'];
									echo "</div>";
								}elseif(isset($_SESSION['user_balance_low'])){
									echo "<div class='gabim'>";
									echo $_SESSION['user_balance_low'];
									echo "</div>";
								}elseif(isset($_SESSION['user_balance_correct'])){
									echo "<div class='sukses'>";
									echo $_SESSION['user_balance_correct'];
									echo "</div>";
								}elseif(isset($_SESSION['seller_status_correct'])){
									echo "<div class='sukses'>";
									echo $_SESSION['seller_status_correct'];
									echo "</div>";
								}
								unset($_SESSION['prep_stmt_error']);
								unset($_SESSION['insert_bank_acc_error']);
								unset($_SESSION['insert_bank_acc_correct']);
								unset($_SESSION['user_balance_correct']);
								unset($_SESSION['user_balance_low']);
								unset($_SESSION['seller_status_correct']);

							?>
						
							<div class="profile-section">
								<h2 class="profile-heading">Profile Photo</h2>
								<div class="media">
									<div class="media-body">
										<img src="../img/facebook_icon.png" class="user-photo media-object" alt="User"style="border:0;">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p>Shto fotografinë tuaj
                                        <br> <em>Foto duhet të jetë të pakten 140x140px</em></p>
                                    <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload Photo</button>
                                    <input type="file" id="filePhoto" class="sr-only">
								</div>
							</div>
							<div class="profile-section">
								<div class="divider"><span style="background-color:#fff">Të dhënat personale</span></div>
								<div class="clearfix" >
									<!-- LEFT SECTION -->
									<div class="left" style="width:48%;">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" value="<?php echo $username; ?>" class="form-control"  name="username" style="text-align:center; font-weight:500">
										</div>
										<div class="form-group">
											<label>Emri</label>
											<input type="text" value="<?php echo $fname; ?>" class="form-control"  name="fname" style="text-align:center;font-weight:500">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="text" value="<?php echo $email; ?>" class="form-control"  name="email" style="text-align:center;font-weight:500">
										</div>
										<div class="form-group">
											<label>Datëlindja</label>
											<input type="text" class="form-control  datepicker-3"  id="datelindja" name="bday" value="<?php echo $bday; ?>"  style="text-align:center;font-weight:500">
										</div>
										<div class="form-group">
											<label>Qyteti</label>
											<input type="text" name="city" value="<?php echo $city; ?>" class="form-control"  style="text-align:center;font-weight:500">
										</div>
									</div>
									<!-- END LEFT SECTION -->
									<!-- RIGHT SECTION -->
									<div class="right" style="width:48%;">
										<div class="form-group">
											<label>Fjalëkalimi</label>
											<input type="password"  value="" name="password"  class="form-control"  style="text-align:center;font-weight:500">
										</div>
										<div class="form-group">
											<label>Mbiemri</label>
											<input type="text" value="<?php echo $lname; ?>" name="lname" class="form-control"  style="text-align:center;font-weight:500">
										</div>
										<div class="form-group">
											<label>Numri telefonit</label>
											<input type="text" value="<?php echo $tel; ?>" name="tel" class="form-control"  style="text-align:center;font-weight:500">
										</div>
										<div class="form-group">
											<label>Adresa</label>
											<input type="text" value="<?php echo $address; ?>"class="form-control" name="address" style="text-align:center;font-weight:500">
										</div>
										<div class="form-group">
											<label>Kodi postar</label>
											<input type="text" value="<?php echo $post_code; ?>"class="form-control" name="post_code" style="text-align:center;font-weight:500">
										</div>
									</div>
									<!-- END RIGHT SECTION -->
								</div>
								<?php if($_SESSION['user']['status'] == SELLER){ ?>
										<div class="form-group">
											<label>ID Identifikuese</label>
											<input type="text" value="<?php echo $pid; ?>"class="form-control" name="pid" style="text-align:center;font-weight:500">
										</div>
									<?php } ?>
								<p class="margin-top-30">
									<input type="submit" class="btn_1" name="update_user_data" value="Ndrysho">
								</p>
							</div>
						</div>
						</form>
						<!-- END MY PROFILE -->
						<!-- BANK ACCOUNT -->
						<?php if($_SESSION['user']['status'] == BUYER || $_SESSION['user']['status'] == SELLER) { 
							$stmt_check_id = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");
							$stmt_fetch = mysqli_fetch_array($stmt_check_id);
							$stmt_id = $stmt_fetch['user_id']; 
							$select_user_bank = prep_stmt("SELECT * FROM bank_acc WHERE user_id=?", $stmt_id, "i");  

							if(mysqli_num_rows($select_user_bank) > 0){
								while($row_bank = mysqli_fetch_array($select_user_bank)){
									$number = $row_bank['acc_number'];
									$name = $row_bank['acc_full_name'];
									$expiry = str_replace(" ", "", $row_bank['acc_expiry']);
									$cvc = $row_bank['acc_cvc']; 
									
								
									$acc_nr = substr($number, 0, 1);$acc_nr2 = substr($number, -1);
									$acc_bank_number = $acc_nr . "*** **** **** ***" . $acc_nr2;

									$name_substr1 = substr($name, 0, 1);
									$name_substr2 = substr($name, -1);
									$name_str = str_repeat("*", strlen($name)-2);
									$acc_bank_name = $name_substr1 . $name_str . $name_substr2;

									$expiry_substr1 = substr($expiry, 0, 1);
									$expiry_substr2 = substr($expiry, -1);
									$expiry_str = str_repeat("*", strlen($expiry)-2);
									$acc_bank_expiry = $expiry_substr1 . $expiry_str . $expiry_substr2;

									$cvc_substr = substr_replace($cvc, "***", 0, strlen($cvc));
								}
							}
								
						?>	
						<div class="tab-pane fade" id="bank_acc">
							<div class="profile-section">
								<div class="clearfix">
									<!-- LEFT SECTION -->
									<div class="left" style="width:48%;">
										<div class="divider" style="margin-bottom:50px;">
											<span style="background-color:#fff; text-decoration:underline;">Të dhënat bankare</span>
										</div>
										<div class="form-group">
											<label>Numri i xhirollogarisë</label>
											<input type="text" class="form-control" value="<?php echo $acc_bank_number; ?>" style="text-align:center; font-weight:500;">
										</div>
										<div class="form-group">
											<label> Emri dhe Mbiemri</label>
											<input type="email" class="form-control" value="<?php echo $acc_bank_name; ?>" style="text-align:center; font-weight:500;">
										</div>
										<div class="form-group">
											<label> Data skadencës</label>
											<input type="email" class="form-control" value="<?php echo $acc_bank_expiry ?>" style="text-align:center; font-weight:500;">
										</div>
										<div class="form-group">
											<label>CVV Kodi </label>
											<input type="text" value="<?php echo $cvc_substr ?>" class="form-control" style="text-align:center; font-weight:500;">
										</div>
										<p class="margin-top-30">
											<button type="button" class="btn_1">Update</button>
										</p>
									</div>
									<!-- END LEFT SECTION -->
									<!-- RIGHT SECTION -->
									<div class="right" style="width:48%;">
									<?php 
										$balan_perdoruesit = prep_stmt("SELECT user_balance FROM users WHERE user_id=?", $stmt_fetch['user_id'],"i");
										$balanci_aktual = mysqli_fetch_array($balan_perdoruesit);
									?>
									<div class="divider" style="margin-bottom:50px;">
                                   	 	<span style="background-color:#fff; text-decoration:underline;">Bilanci juaj për momentin është: <b style='color:#5ABC35; font-size:18px; font-weight: 800; font-size:16px;'> <?php echo number_format($balanci_aktual['user_balance'], 2,'.', '') . "€"; ?> </b></span>
									</div>
									<div class="clearfix add_bottom_15" style="width:90%;overflow-wrap: anywhere; text-align:left; background-color:#f9f9f9">
										<div class="checkboxes float-center">
											<small style="color:#000; font-weight:700; font-size:15px;"><i class="ti-hand-point-right" style="color:black;"></i> &nbsp Më poshtë mund ta ndryshoni gjendjen e bilancit tuaj duke depozituar ose tërhequr para!</small>
										</div>
									</div>
									<!-- <h3 style='color:#000; margin-bottom:25px; text-decoration:underline;'> </h3> -->
										<div class="form-group">
											<div class="custom-select-form" style="width:50%">
												<label> Zgjedhni shërbmin </label>
												<select class="wide add_bottom_10" name="country" id="sherbimi"  onchange="showSherbimin()" >
													<option value="0" selected="">Zgjedhni...</option>
													<option value="1">Depozitë</option>
													<option value="2">Tërheqje</option>
												</select>
											</div>
										</div>
										<div class="form-group" id="depozite_div" style="display:none;">
											<form style="width:100%;background-color:#f8f8f8; float:right;" method="POST" action="" id="dep_form">
												<div style="width:100%;" >
													<ul style="list-style: '\00BB'; color:#000; text-align:left; ">
														<li style="font-weight: 500; padding: 10px 0px 5px 0px; ">
															<i style="font-size:14px;"><b>DEPOZITË PARASH</b> => Paratë që dëshironi t'i fusni në llogarinë tuaj këtu (në DEAL AIM) <b>nga llogaria juaj bankare</b></i>
														</li>
														<li style="font-weight: 500; padding: 5px 0px 10px 0px;">
															<i style="font-size:14px;">Shuma minimale për depozitë është <b style="color: #CF2928; font-size:16px;">5 euro</b>, ndërsa ajo maksimale është <b style="color: #CF2928; font-size:16px;"> 2000 euro </b> </i>
														</li>
														<li style="font-weight: 500; padding: 5px 0px 10px 0px;">
															<i style="font-size:14px;">Shuma duhet të jetë fikse (p.sh: <b style="color: #5ABC35; font-size:16px;">5 euro, 7 euro, 10 euro, 100 euro, 1000 euro... </b>) </i>
														</li>
													</ul>
												</div>
												<label> Shëno shumën </label>
												<div class="input-group input-group-bal mb-3" >
													<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="dep_shuma" id="dep_shuma"  style="height:2.4rem; text-align:center;">
													<div class="input-group-append" style="margin:0;">
														<span class="input-group-text">€</span>
													</div>
												</div>
												<div class="text-center btn_center" style="margin-bottom:20px;" >
													<button type="submit" id="balance_btn_dep" name="depozite_btn" value="Vazhdo" class="btn_1 ">DEPOZITO</button>
												</div>
											</form>
										</div>
										<div class="form-group" id="terheqje_div" style="display:none;">
										<form style="width:100%;background-color:#f8f8f8; float:right;" method="POST" action="" id="ter_form">
											<div style="width:100%">
												<ul style="list-style: '\00BB'; color:#000; text-align:left; ">
													<li style="font-weight: 500; padding: 10px 0px 5px 0px; ">
														<i style="font-size:14px;"><b>TËRHEQJE PARASH</b> => Paratë që dëshironi t'i ktheni në llogarinë tuaj bankare <b>nga llogaria juaj këtu (në DEAL AIM)</b></i>
													</li>
													<li style="font-weight: 500; padding: 5px 0px 10px 0px;">
														<i style="font-size:14px;">Shuma minimale për tërheqje është <b style="color: #CF2928; font-size:16px;">5 euro</b>, ndërsa ajo maksimale është <b style="color: #CF2928; font-size:16px;"> 2000 euro </b> </i>
													</li>
													<li style="font-weight: 500; padding: 5px 0px 10px 0px;">
														<i style="font-size:14px;">Shuma duhet të jetë fikse (p.sh: <b style="color: #2C4EDA; font-size:16px;">5 euro, 7 euro, 10 euro, 100 euro 1000 euro... </b>) </i>
													</li>
												</ul>
											</div>
											<label> Shëno shumën </label>
											<div class="input-group input-group-bal mb-3" >
												<input type="text" name="ter_shuma" id="ter_shuma" class="form-control" aria-label="Amount (to the nearest euro)"  style="height:2.4rem;text-align:center;">
												<div class="input-group-prepend" style="margin:0;">
													<span class="input-group-text">€</span>
												</div>
											</div>
											<div class="text-center btn_center" style="margin-bottom:20px;"><button type="submit" id="balance_btn_ter" name="terheq_btn" value="Vazhdo" class="btn_1 ">TËRHIQ</button></div>
										</form>
										</div>
									</div>
									<!-- END RIGHT SECTION -->
								</div>
							</div>
						</div>
						<?php } ?>
						<!-- END ACCOUNT -->
						
						<!-- END BILLINGS -->
						<!-- PREFERENCES -->
						
						<!-- END PREFERENCES -->
                    </div>
              </center>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
	</div>
	
	<!-- SHOW SHERBIMIN -->
	<script type="text/javascript">
      function showSherbimin(){
            //nese zgjidhet terhejqe, SHOW DIV per terheqje
            var sherbimi = document.getElementById("sherbimi");
            console.log(sherbimi.value);
            if(sherbimi.value == 1){
                document.getElementById("terheqje_div").style.display = "none";
                document.getElementById("depozite_div").style.display = "block"; 
            }else if(sherbimi.value == 2){
                document.getElementById("terheqje_div").style.display = "block";
                document.getElementById("depozite_div").style.display = "none";
            }else{
                document.getElementById("terheqje_div").style.display = "none";
                document.getElementById("depozite_div").style.display = "none";
            }
        } 
	</script>
	<!--- DEPOZIT and TERHEQ --->
	<script type="text/javascript">
        var sh_terheq = false; 
        var sh_depozite = false;
        document.getElementById("ter_shuma").onkeyup = function() 
		{ 
            var terheq_shuma = document.getElementById("ter_shuma");
            if(terheq_shuma.value.match(/^\d+$/))
            {
                if(terheq_shuma.value < 5 || terheq_shuma.value > 2000){
                    sh_terheq = false;
                    terheq_shuma.style.border = "2px solid red";
                }else{
                    terheq_shuma.style.border = "2px solid green";
                    sh_terheq = true; 
                }
            }else{
                terheq_shuma.style.border = "2px solid red";
                sh_terheq = false;
            }
        }

        document.getElementById("dep_shuma").onkeyup = function() 
		{ 
            var depozite_shuma = document.getElementById("dep_shuma");
            if(depozite_shuma.value.match(/^\d+$/))
            {
                if(depozite_shuma.value < 5 || depozite_shuma.value > 2000){
                    sh_depozite = false;
                    depozite_shuma.style.border = "2px solid red";
                }else{
                    depozite_shuma.style.border = "2px solid green";
                    sh_depozite = true;
                }
            }else{
                depozite_shuma.style.border = "2px solid red";
                sh_depozite = false;
            }
        }

        //TERHEQ
        document.querySelector("#balance_btn_ter").addEventListener("click", function(event) {
            if(sh_terheq == true){
                console.log("123");
                document.getElementById("ter_form").submit();
            }else{
                event.preventDefault();
                document.getElementById("ter_shuma").style.border = "2px solid red";
            }
        });

        //DEPOZITO 
        document.querySelector("#balance_btn_dep").addEventListener("click", function(event) {
            if(sh_depozite == true){
                document.getElementById("dep_form").submit();
            }else{ 
                event.preventDefault();
                document.getElementById("dep_shuma").style.border = "2px solid red";
            }
        });
	</script>
	<!-- SELLER APPLICATION -->
   	<script>
		var id_num = false; var is_check = false;
		function calc(){
			var isChecked = document.getElementById("check_confirm");
			if(isChecked.checked){
				isChecked.value = 1;
				is_check = true;
			}else{
				isChecked.value=0;
				is_check = false;
			}
		}
		
		document.getElementById("id_number").onkeyup = function() 
		{
			var id_number = document.getElementById('id_number');
			if(id_number.value.match('^\\d+$')){
				if(id_number.value.length >= 8 && id_number.value.length <= 15){
					id_number.style.borderColor = "green";
					id_number.style.color = "green";
					id_num = true;
				}else{
					id_number.style.borderColor = "red";
					id_number.style.color = "red";
					id_num = false;
				}
			}else{
				id_number.style.borderColor = "red";
				id_number.style.color = "red";
				id_num = false;
			}
		}

		document.querySelector("#seller_apply").addEventListener("click", function(event) {
			if(id_num == true && is_check == true){
				document.getElementById("form_seller").submit();
			}else{
				event.preventDefault();
			}
        });  
	</script>
	<script>

		var acc_nr_valid = false; var acc_name_valid = false; var acc_expiry_valid = false; var acc_cvc_valid = false;
		//CHECKING ACC NUMBER
		document.getElementById("number").onkeyup = function() 
		{
			var acc_number = document.getElementById('number');
			//check if first number is 4
			if(acc_number.value.substring(0,1) == 4 || acc_number.value.substring(0,1) == 5)
			{ 
				if(acc_number.value.length == 19){
					if(acc_number.value.substring(0,1) == 4){
						acc_nr_valid = true;
						document.getElementById("name").focus();
						acc_number.style.borderColor = "green";
						acc_number.style.color = "green";
					}
					else if(acc_number.value.substring(0,1) == 5 && acc_number.value.substring(1,2) == 1 || acc_number.value.substring(1,2) == 2 || acc_number.value.substring(1,2) == 3 || acc_number.value.substring(1,2) == 4 || acc_number.value.substring(1,2) == 5){
						acc_nr_valid = true;
						document.getElementById("name").focus();
						acc_number.style.borderColor = "green";
						acc_number.style.color = "green";
					}
					else {
						// swal("GABIM!", "Kjo xhirollogari nuk është valide!", "error");
						acc_number.style.borderColor = "red";
						acc_number.style.color = "red";
					}
				}
				else{
					// swal("GABIM!", "Kjo xhirollogari nuk është valide!", "error");
					acc_number.style.borderColor = "red";
					acc_number.style.color = "red";
				}
			}else {
				acc_number.style.borderColor = "red";
				acc_number.style.color = "red";
			}
		}
		//CHECKING NAME
		document.getElementById("name").onkeyup = function() 
		{
			var acc_name = document.getElementById('name');
			var letters = /^[a-zA-Z][a-zA-Z\s]*$/;
			//check if name is alphabetic
			if(acc_name.value.match(letters)){
				if(acc_name.value.length > 10){
					acc_name_valid = true;
					acc_name.style.borderColor = "green";
					acc_name.style.color = "green";
				}else{
					acc_name.style.borderColor = "red";
					acc_name.style.color = "red";
				}
			}else{
				acc_name.style.borderColor = "red";
				acc_name.style.color = "red";
			}
		}

		//CHECKING DATE
		document.getElementById("expiry").onkeyup = function() 
		{
			var acc_expiry = document.getElementById('expiry');
			//check 
			if(acc_expiry.value.length == 9){
				if(acc_expiry.value.substring(5,9) == 2021 && acc_expiry.value.substring(0,2) >= 3 &&acc_expiry.value.substring(0,2) <= 12){
					acc_expiry_valid = true;
					document.getElementById("cvc").focus();
					acc_expiry.style.borderColor = "green";
					acc_expiry.style.color = "green";
				}
				else if(acc_expiry.value.substring(0,2) >= 01 && acc_expiry.value.substring(0,2) <= 12 && acc_expiry.value.substring(5,9) >= 2022 && acc_expiry.value.substring(5,9) <= 2031){
					acc_expiry_valid = true;
					document.getElementById("cvc").focus();
					acc_expiry.style.borderColor = "green";
					acc_expiry.style.color = "green";
				}
				else{
					acc_expiry.style.borderColor = "red";
					acc_expiry.style.color = "red";
				}
			}else{
				acc_expiry.style.borderColor = "red";
				acc_expiry.style.color = "red";
			}
		}

		//CHECKING CVC
		document.getElementById("cvc").onkeyup = function() 
		{
			var acc_cvc = document.getElementById('cvc');
			//check 
			if(acc_cvc.value.length == 3){
				acc_cvc_valid = true;
				document.getElementById("apply").focus();
				acc_cvc.style.borderColor = "green";
				acc_cvc.style.color = "green";
			}
			else{
				acc_cvc.style.borderColor = "red";
				acc_cvc.style.color = "red";
			}
		}
        document.querySelector("#apply").addEventListener("click", function(event) {
			if(acc_nr_valid == true && acc_name_valid == true && acc_expiry_valid == true && acc_cvc_valid == true){
				// document.getElementById('cashInput').style.display = "block";
				// event.preventDefault();
				document.getElementById("acc_form").submit();
			}else{
				console.log("KEQ");
				event.preventDefault();
			}
        });  
    </script>
    <script>
        $('form').card({
            ontainer: '.card-wrapper'
        });
        // Vanilla JavaScript
        new Card({
            form: document.querySelector('form'),
            container: '.card-wrapper'
        });

        $('form').card({
            formatting: true,
            formSelectors: {
                numberInput: 'input[name="number"]',
                expiryInput: 'input[name="expiry"]',
                cvcInput: 'input[name="cvc"]',
                nameInput: 'input[name="name"]'
            },
            cardSelectors: {
                cardContainer: '.jp-card-container',
                card: '.jp-card',
                numberDisplay: '.jp-card-number',
                expiryDisplay: '.jp-card-expiry',
                cvcDisplay: '.jp-card-cvc',
                nameDisplay: '.jp-card-name'
            },
            // custom message
            messages: {

                validDate: 'valid\nthru',
                monthYear: 'month/year'
            },

            placeholders: {
                number: '&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;',
                cvc: '&bull;&bull;&bull;',
                expiry: '&bull;&bull;/&bull;&bull;',
                name: 'Full Name'
            },
            masks: {
                cardNumber: false
            },
            classes: {
                valid: 'jp-card-valid',
                invalid: 'jp-card-invalid'
            },
            debug: false

        });
    </script>
</main>
<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_1">Linqe</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="about.html">Ballina</a></li>
                        <li><a href="help.html">Të shitura</a></li>
                        <li><a href="help.html">Rreth Nesh</a></li>
                        <li><a href="account.html">Si funksionon?</a></li>
                        <li><a href="blog.html">Kontakti</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_2">Kategorite</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <li><a href="listing-grid-1-full.html">Vetura</a></li>
                        <li><a href="listing-grid-2-full.html">Motoçikleta (mbi 50cc)</a></li>
                        <li><a href="listing-grid-1-full.html">Moped (nën 50cc)</a></li>
                        <li><a href="listing-grid-3.html">Kompjuterë</a></li>
                        <li><a href="listing-grid-1-full.html">Telefonë</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_3">Kontaktet</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                        <li><i class="ti-headphone-alt"></i>+94 423-23-221</li>
                        <li><i class="ti-email"></i><a href="#0">info@dealaim.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_4">ssssssss</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                        </div>
                    </div>
                    <div class="follow_us">
                        <h5>Na ndiqni</h5>
                        <ul>
                            <li>
                                <a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.png" alt="" class="lazy"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.png" alt="" class="lazy"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.png" alt="" class="lazy"style="width:40px;"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="#0">Kushtet e përdorimit</a></li>
                    <li><a href="#0">Privatësia</a></li>
                    <li><span>© 2020 DealAim</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div>
<!-- Back to top button -->
<!-- COMMON SCRIPTS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/common_scripts.min.js"></script>
<script src="../js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="../js/carousel-home.min.js"></script> <!-- INDEX -->
<script src="../js/carousel_with_thumbs.js"></script> <!-- DETAJET -->
<script src="../js/sticky_sidebar.min.js"></script>
<script src="../js/specific_listing.js"></script> <!-- PRODUKTET ||| e dyta per --->
<script src="assets/scripts/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	// Client type Panel
		$('input[name="client_type"]').on("click", function() {
		    var inputValue = $(this).attr("value");
		    var targetBox = $("." + inputValue);
		    $(".box").not(targetBox).hide();
		    $(targetBox).show();
		});

		$('#image').click(function(){
            $('#myfile').click();
        });

        

        function showFormBuyer() {
            var e = document.getElementById("showForm");
    	   	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
        }

        
    </script>

</body>

</html>