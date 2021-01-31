<?php 
    require_once "../db.php";
     //PRODUKTET dhe BRENDET dynamic multilevel menu
    $result = prep_stmt("SELECT cat_id,cat_title,parent_id,cat_link FROM categories",null,null);
    //create a multidimensional array to hold a list of menu and parent menu
	$menu = array(
		'menus' => array(),
		'parent_menus' => array()
	);
 
	//build the array lists with data from the menu table
	while ($row = mysqli_fetch_assoc($result)) {
		//creates entry into menus array with current menu id ie. $menus['menus'][1]
		$menu['menus'][$row['cat_id']] = $row;
		//creates entry into parent_menus array. parent_menus array contains a list of all menus with children
		$menu['parent_menus'][$row['parent_id']][] = $row['cat_id'];
	}
	
	// Create the main function to build milti-level menu. It is a recursive function.	
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
                                                <a href="index.php" target="_parent">Ballina</a>
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
                                                        echo "<a href='profile.php#formL'  class='shites'>Apliko për blerës</button>";
                                                        echo "</li>";
                                                    }elseif(isset($_SESSION['user']) && $_SESSION['user']['status'] == BUYER){
                                                        echo "<li>";
                                                        echo "<a href='profile.php#formBuyer' class='shites'>Apliko për shitës</a>";
                                                        echo "</li>";
                                                    }elseif(isset($_SESSION['user']) && $_SESSION['user']['status'] == SELLER){
                                                        echo "<li>";
                                                        echo "<a href='../item/allaia-ecommerce-html-template/25781982.html' class='shites' target='_parent'>Shto një produkt</a>";
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
                                                        <a href="profile.php"><i class="ti-user"></i>Profili im</a>
                                                    </li>
                                                    <?php if($_SESSION['user']['status'] == BUYER || $_SESSION['user']['status'] == SELLER)
                                                    {  ?>
                                                    <li>
                                                        <a href="balance.php"><i class="ti-money"></i>Bilanci</a>
                                                    </li>
                                                    <?php }?>
                                                    <li>
                                                        <a href="logout.php"><i class="ti-shift-left-alt"></i>Ç'kyçu</a>
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
                            <!-- <div class="col-xl-1 col-lg-2 col-md-3">
                                <ul class="top_tools">
                                    <li>
                                    <a style=""> Bilanci: 222$ </a>
                                                </li>
                                </ul>
                            </div> -->
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
                <h3 class="new_client">Profili im</h3> 
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#myprofile" role="tab" data-toggle="tab">My Profile</a></li>
					<li><a href="#account" role="tab" data-toggle="tab">Account</a></li>
					<li><a href="#billings" role="tab" data-toggle="tab">Billings &amp; Plans</a></li>
					<li><a href="#preferences" role="tab" data-toggle="tab">Preferences</a></li>
				</ul>
				<form>
					<div class="tab-content content-profile">
                            <!-- BANK ACCOUNT APPLICATION -->
                            <?php if(isset($_GET['form_buyer'])){ ?>
                             <div class="private box" id="showForm" style="display:">
                                <div class="divider">
                                    <span style="background-color:#fff">Të dhënat bankare</span>
                                </div>
                                <center>
                                <div class="row no-gutters form-container active" id="">
                                    <form method="POST" action="profile.php" id="acc_form" style="width:100%;">
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
                                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'] ?>" style="text-align:center;">
                                            </div>
                                        </div>
                                        <!-- <div class="col-12 pl-1" id="cashInput" style="display:none;">
                                            <div class="form-group form-group1">
                                                <label> Shuma </label> <small> (Shuma që dëshironi të nxjerrni) </small>
                                                <input type="number" name="shuma" id="shuma" class="form-control" placeholder="xxx"  style="text-align:center;">
                                            </div>
                                        </div> -->
                                        <div class="text-center btn_center" style="margin-bottom:15px;"><button type="submit" id="apply" name="bank_acc" value="Vazhdo" class="btn_1 ">APLIKO</button></div>
                                    </form>
                                </div>	
                                </center>
						    </div>
                            <?php } else{ ?> 
                        <!-- MY PROFILE -->
                        <div class="tab-pane fade in active" id="myprofile">
							<div class="profile-section justify-content-center">
								<h2 class="profile-heading">Profile Photo</h2>
								<div class="media">
									<div class="media-body">
										<img src="assets/img/user.png" class="user-photo media-object" alt="User">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p>Upload your photo.
                                        <br> <em>Image should be at least 140px x 140px</em></p>
                                    <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload Photo</button>
                                    <input type="file" id="filePhoto" class="sr-only">
								</div>
							</div>
							<div class="profile-section">
								<h2 class="profile-heading">Basic Information</h2>
								<div class="clearfix">
									<!-- LEFT SECTION -->
									<div class="left" style="width:48%;">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>Birthdate</label>
											<div class="input-group date" data-date-autoclose="true" data-provide="datepicker">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label>Website</label>
											<input type="text" class="form-control" placeholder="http://">
										</div>
									</div>
									<!-- END LEFT SECTION -->
									<!-- RIGHT SECTION -->
									<div class="right" style="width:48%;">
										<div class="form-group">
											<label>Address Line 1</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>Address Line 2</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>State/Province</label>
											<input type="text" class="form-control">
										</div>
										
									</div>
									<!-- END RIGHT SECTION -->
								</div>
								<p class="margin-top-30">
									<button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
									<button type="button" class="btn btn-default">Cancel</button>
								</p>
                            </div>
                        </div>
                        <?php } ?>
						<!-- END MY PROFILE -->
						<!-- ACCOUNT -->
						<div class="tab-pane fade" id="account">
							<div class="profile-section">
								<div class="clearfix">
									<!-- LEFT SECTION -->
									<div class="left">
										<h2 class="profile-heading">Account Data</h2>
										<div class="form-group">
											<label>Username</label>
											<input type="text" class="form-control" value="austinhoffman" disabled>
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" value="austin.hoffman@yourdomain.com">
										</div>
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" class="form-control">
										</div>
									</div>
									<!-- END LEFT SECTION -->
									<!-- RIGHT SECTION -->
									<div class="right">
										<h2 class="profile-heading">Change Password</h2>
										<div class="form-group">
											<label>Current Password</label>
											<input type="password" class="form-control">
										</div>
										<div class="form-group">
											<label>New Password</label>
											<input type="password" class="form-control">
										</div>
										<div class="form-group">
											<label>Confirm New Password</label>
											<input type="password" class="form-control">
										</div>
									</div>
									<!-- END RIGHT SECTION -->
								</div>
								<p class="margin-top-30">
									<button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
									<button class="btn btn-default">Cancel</button>
								</p>
							</div>
						</div>
						<!-- END ACCOUNT -->
						<!-- BILLINGS -->
						<div class="tab-pane fade" id="billings">
							<div class="clearfix">
								<div class="left">
									<div class="profile-section">
										<h2 class="profile-heading">Choose Your Plan</h2>
										<div class="plan selected-plan">
											<h3 class="plan-title">Basic <span>(current plan) <i class="fa fa-check-circle"></i></span></h3>
											<ul class="list-unstyled list-plan-details">
												<li>1 website growth analytic report</li>
												<li>3 social accounts integration</li>
												<li>Free support</li>
											</ul>
											<button type="button" class="btn btn-success btn-choose-plan">Choose Plan</button>
										</div>
										<div class="plan">
											<h3 class="plan-title">Platinum</h3>
											<ul class="list-unstyled list-plan-details">
												<li>10 website growth analytic report</li>
												<li>20 social accounts integration</li>
												<li>Deep campaign analysis</li>
												<li>Free support</li>
											</ul>
											<button type="button" class="btn btn-success btn-choose-plan">Choose Plan</button>
										</div>
										<div class="plan">
											<h3 class="plan-title">Gold</h3>
											<ul class="list-unstyled list-plan-details">
												<li>Unlimited website growth analytic report</li>
												<li>20 social accounts integration</li>
												<li>Deep campaign analysis</li>
												<li>Unlimited A/B Testing</li>
												<li>Campaign and growth monitor</li>
												<li>Priority support</li>
											</ul>
											<button type="button" class="btn btn-success btn-choose-plan">Choose Plan</button>
										</div>
									</div>
								</div>
								<div class="right">
									<div class="profile-section">
										<h2 class="profile-heading">Payment Method</h2>
										<div class="payment-info">
											<h3 class="payment-name"><i class="fa fa-paypal"></i> PayPal ****6345</h3>
											<span>Next billing charged $24</span>
											<br>
											<em class="text-muted">Autopay on May 12, 2007</em>
											<a href="#" class="edit-payment-info">Edit Payment Info</a>
										</div>
										<p class="margin-top-30"><a href="#"><i class="fa fa-plus-circle"></i> Add Payment Info</a></p>
									</div>
									<div class="profile-section">
										<h2 class="profile-heading">Billing History</h2>
										<table class="table billing-history">
											<thead class="sr-only">
												<tr>
													<th>Plan</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<h3 class="billing-title">Basic Plan <span class="invoice-number">#INV352736</span></h3>
														<span class="text-muted">Charged at April 12, 2017</span>
													</td>
													<td class="amount">$24</td>
													<td class="action"><a href="#">View</a></td>
												</tr>
												<tr>
													<td>
														<h3 class="billing-title">Basic Plan <span class="invoice-number">#INV352846</span></h3>
														<span class="text-muted">Charged at March 12, 2017</span>
													</td>
													<td class="amount">$24</td>
													<td class="action"><a href="#">View</a></td>
												</tr>
												<tr>
													<td>
														<h3 class="billing-title">Platinum Plan <span class="invoice-number">#INV352743</span></h3>
														<span class="text-muted">Charged at Feb 12, 2017</span>
													</td>
													<td class="amount">$75</td>
													<td class="action"><a href="#">View</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<p class="margin-top-30">
								<button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
								<button class="btn btn-default">Cancel</button>
							</p>
						</div>
						<!-- END BILLINGS -->
						<!-- PREFERENCES -->
						<div class="tab-pane fade" id="preferences">
							<div class="clearfix">
								<div class="left">
									<div class="profile-section">
										<h2 class="profile-heading">General</h2>
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>Language</label>
											<select>
												<option value="en_US" lang="en">English (United States)</option>
												<option value="ar" lang="ar">العربية</option>
												<option value="ary" lang="ar">العربية المغربية</option>
												<option value="az" lang="az">Azərbaycan dili</option>
												<option value="azb" lang="az">گؤنئی آذربایجان</option>
												<option value="bel" lang="be">Беларуская мова</option>
												<option value="bg_BG" lang="bg">Български</option>
												<option value="bn_BD" lang="bn">বাংলা</option>
												<option value="bs_BA" lang="bs">Bosanski</option>
												<option value="ca" lang="ca">Català</option>
												<option value="ceb" lang="ceb">Cebuano</option>
												<option value="cs_CZ" lang="cs">Čeština‎</option>
												<option value="cy" lang="cy">Cymraeg</option>
												<option value="da_DK" lang="da">Dansk</option>
												<option value="de_CH_informal" lang="de">Deutsch (Schweiz, Du)</option>
												<option value="de_CH" lang="de">Deutsch (Schweiz)</option>
												<option value="de_DE" lang="de">Deutsch</option>
												<option value="de_DE_formal" lang="de">Deutsch (Sie)</option>
												<option value="el" lang="el">Ελληνικά</option>
												<option value="en_GB" lang="en">English (UK)</option>
												<option value="en_AU" lang="en">English (Australia)</option>
												<option value="en_ZA" lang="en">English (South Africa)</option>
												<option value="en_NZ" lang="en">English (New Zealand)</option>
												<option value="en_CA" lang="en">English (Canada)</option>
												<option value="eo" lang="eo">Esperanto</option>
												<option value="es_CL" lang="es">Español de Chile</option>
												<option value="es_MX" lang="es">Español de México</option>
												<option value="es_GT" lang="es">Español de Guatemala</option>
												<option value="es_AR" lang="es">Español de Argentina</option>
												<option value="es_ES" lang="es">Español</option>
												<option value="es_PE" lang="es">Español de Perú</option>
												<option value="es_CO" lang="es">Español de Colombia</option>
												<option value="es_VE" lang="es">Español de Venezuela</option>
												<option value="et" lang="et">Eesti</option>
												<option value="eu" lang="eu">Euskara</option>
												<option value="fa_IR" lang="fa">فارسی</option>
												<option value="fi" lang="fi">Suomi</option>
												<option value="fr_FR" lang="fr">Français</option>
												<option value="fr_CA" lang="fr">Français du Canada</option>
												<option value="fr_BE" lang="fr">Français de Belgique</option>
												<option value="gd" lang="gd">Gàidhlig</option>
												<option value="gl_ES" lang="gl">Galego</option>
												<option value="haz" lang="haz">هزاره گی</option>
												<option value="he_IL" lang="he">עִבְרִית</option>
												<option value="hi_IN" lang="hi">हिन्दी</option>
												<option value="hr" lang="hr">Hrvatski</option>
												<option value="hu_HU" lang="hu">Magyar</option>
												<option value="hy" lang="hy">Հայերեն</option>
												<option value="id_ID" lang="id">Bahasa Indonesia</option>
												<option value="is_IS" lang="is">Íslenska</option>
												<option value="it_IT" lang="it">Italiano</option>
												<option value="ja" lang="ja">日本語</option>
												<option value="ka_GE" lang="ka">ქართული</option>
												<option value="ko_KR" lang="ko">한국어</option>
												<option value="lt_LT" lang="lt">Lietuvių kalba</option>
												<option value="mk_MK" lang="mk">Македонски јазик</option>
												<option value="mr" lang="mr">मराठी</option>
												<option value="ms_MY" lang="ms">Bahasa Melayu</option>
												<option value="my_MM" lang="my">ဗမာစာ</option>
												<option value="nb_NO" lang="nb">Norsk bokmål</option>
												<option value="nl_NL" lang="nl">Nederlands</option>
												<option value="nl_NL_formal" lang="nl">Nederlands (Formeel)</option>
												<option value="nn_NO" lang="nn">Norsk nynorsk</option>
												<option value="oci" lang="oc">Occitan</option>
												<option value="pl_PL" lang="pl">Polski</option>
												<option value="ps" lang="ps">پښتو</option>
												<option value="pt_BR" lang="pt">Português do Brasil</option>
												<option value="pt_PT" lang="pt">Português</option>
												<option value="ro_RO" lang="ro">Română</option>
												<option value="ru_RU" lang="ru">Русский</option>
												<option value="sk_SK" lang="sk">Slovenčina</option>
												<option value="sl_SI" lang="sl">Slovenščina</option>
												<option value="sq" lang="sq">Shqip</option>
												<option value="sr_RS" lang="sr">Српски језик</option>
												<option value="sv_SE" lang="sv">Svenska</option>
												<option value="th" lang="th">ไทย</option>
												<option value="tl" lang="tl">Tagalog</option>
												<option value="tr_TR" lang="tr">Türkçe</option>
												<option value="ug_CN" lang="ug">Uyƣurqə</option>
												<option value="uk" lang="uk">Українська</option>
												<option value="vi" lang="vi">Tiếng Việt</option>
												<option value="zh_CN" lang="zh">简体中文</option>
												<option value="zh_TW" lang="zh">繁體中文</option>
											</select>
										</div>
										<div class="form-group">
											<label>TimeZone</label>
											<select>
												<optgroup label="Africa">
													<option value="Africa/Abidjan">Abidjan</option>
													<option value="Africa/Accra">Accra</option>
													<option value="Africa/Addis_Ababa">Addis Ababa</option>
													<option value="Africa/Algiers">Algiers</option>
													<option value="Africa/Asmara">Asmara</option>
													<option value="Africa/Bamako">Bamako</option>
													<option value="Africa/Bangui">Bangui</option>
													<option value="Africa/Banjul">Banjul</option>
													<option value="Africa/Bissau">Bissau</option>
													<option value="Africa/Blantyre">Blantyre</option>
													<option value="Africa/Brazzaville">Brazzaville</option>
													<option value="Africa/Bujumbura">Bujumbura</option>
													<option value="Africa/Cairo">Cairo</option>
													<option value="Africa/Casablanca">Casablanca</option>
													<option value="Africa/Ceuta">Ceuta</option>
													<option value="Africa/Conakry">Conakry</option>
													<option value="Africa/Dakar">Dakar</option>
													<option value="Africa/Dar_es_Salaam">Dar es Salaam</option>
													<option value="Africa/Djibouti">Djibouti</option>
													<option value="Africa/Douala">Douala</option>
													<option value="Africa/El_Aaiun">El Aaiun</option>
													<option value="Africa/Freetown">Freetown</option>
													<option value="Africa/Gaborone">Gaborone</option>
													<option value="Africa/Harare">Harare</option>
													<option value="Africa/Johannesburg">Johannesburg</option>
													<option value="Africa/Juba">Juba</option>
													<option value="Africa/Kampala">Kampala</option>
													<option value="Africa/Khartoum">Khartoum</option>
													<option value="Africa/Kigali">Kigali</option>
													<option value="Africa/Kinshasa">Kinshasa</option>
													<option value="Africa/Lagos">Lagos</option>
													<option value="Africa/Libreville">Libreville</option>
													<option value="Africa/Lome">Lome</option>
													<option value="Africa/Luanda">Luanda</option>
													<option value="Africa/Lubumbashi">Lubumbashi</option>
													<option value="Africa/Lusaka">Lusaka</option>
													<option value="Africa/Malabo">Malabo</option>
													<option value="Africa/Maputo">Maputo</option>
													<option value="Africa/Maseru">Maseru</option>
													<option value="Africa/Mbabane">Mbabane</option>
													<option value="Africa/Mogadishu">Mogadishu</option>
													<option value="Africa/Monrovia">Monrovia</option>
													<option value="Africa/Nairobi">Nairobi</option>
													<option value="Africa/Ndjamena">Ndjamena</option>
													<option value="Africa/Niamey">Niamey</option>
													<option value="Africa/Nouakchott">Nouakchott</option>
													<option value="Africa/Ouagadougou">Ouagadougou</option>
													<option value="Africa/Porto-Novo">Porto-Novo</option>
													<option value="Africa/Sao_Tome">Sao Tome</option>
													<option value="Africa/Tripoli">Tripoli</option>
													<option value="Africa/Tunis">Tunis</option>
													<option value="Africa/Windhoek">Windhoek</option>
												</optgroup>
												<optgroup label="America">
													<option value="America/Adak">Adak</option>
													<option value="America/Anchorage">Anchorage</option>
													<option value="America/Anguilla">Anguilla</option>
													<option value="America/Antigua">Antigua</option>
													<option value="America/Araguaina">Araguaina</option>
													<option value="America/Argentina/Buenos_Aires">Argentina - Buenos Aires</option>
													<option value="America/Argentina/Catamarca">Argentina - Catamarca</option>
													<option value="America/Argentina/Cordoba">Argentina - Cordoba</option>
													<option value="America/Argentina/Jujuy">Argentina - Jujuy</option>
													<option value="America/Argentina/La_Rioja">Argentina - La Rioja</option>
													<option value="America/Argentina/Mendoza">Argentina - Mendoza</option>
													<option value="America/Argentina/Rio_Gallegos">Argentina - Rio Gallegos</option>
													<option value="America/Argentina/Salta">Argentina - Salta</option>
													<option value="America/Argentina/San_Juan">Argentina - San Juan</option>
													<option value="America/Argentina/San_Luis">Argentina - San Luis</option>
													<option value="America/Argentina/Tucuman">Argentina - Tucuman</option>
													<option value="America/Argentina/Ushuaia">Argentina - Ushuaia</option>
													<option value="America/Aruba">Aruba</option>
													<option value="America/Asuncion">Asuncion</option>
													<option value="America/Atikokan">Atikokan</option>
													<option value="America/Bahia">Bahia</option>
													<option value="America/Bahia_Banderas">Bahia Banderas</option>
													<option value="America/Barbados">Barbados</option>
													<option value="America/Belem">Belem</option>
													<option value="America/Belize">Belize</option>
													<option value="America/Blanc-Sablon">Blanc-Sablon</option>
													<option value="America/Boa_Vista">Boa Vista</option>
													<option value="America/Bogota">Bogota</option>
													<option value="America/Boise">Boise</option>
													<option value="America/Cambridge_Bay">Cambridge Bay</option>
													<option value="America/Campo_Grande">Campo Grande</option>
													<option value="America/Cancun">Cancun</option>
													<option value="America/Caracas">Caracas</option>
													<option value="America/Cayenne">Cayenne</option>
													<option value="America/Cayman">Cayman</option>
													<option value="America/Chicago">Chicago</option>
													<option value="America/Chihuahua">Chihuahua</option>
													<option value="America/Costa_Rica">Costa Rica</option>
													<option value="America/Creston">Creston</option>
													<option value="America/Cuiaba">Cuiaba</option>
													<option value="America/Curacao">Curacao</option>
													<option value="America/Danmarkshavn">Danmarkshavn</option>
													<option value="America/Dawson">Dawson</option>
													<option value="America/Dawson_Creek">Dawson Creek</option>
													<option value="America/Denver">Denver</option>
													<option value="America/Detroit">Detroit</option>
													<option value="America/Dominica">Dominica</option>
													<option value="America/Edmonton">Edmonton</option>
													<option value="America/Eirunepe">Eirunepe</option>
													<option value="America/El_Salvador">El Salvador</option>
													<option value="America/Fortaleza">Fortaleza</option>
													<option value="America/Glace_Bay">Glace Bay</option>
													<option value="America/Godthab">Godthab</option>
													<option value="America/Goose_Bay">Goose Bay</option>
													<option value="America/Grand_Turk">Grand Turk</option>
													<option value="America/Grenada">Grenada</option>
													<option value="America/Guadeloupe">Guadeloupe</option>
													<option value="America/Guatemala">Guatemala</option>
													<option value="America/Guayaquil">Guayaquil</option>
													<option value="America/Guyana">Guyana</option>
													<option value="America/Halifax">Halifax</option>
													<option value="America/Havana">Havana</option>
													<option value="America/Hermosillo">Hermosillo</option>
													<option value="America/Indiana/Indianapolis">Indiana - Indianapolis</option>
													<option value="America/Indiana/Knox">Indiana - Knox</option>
													<option value="America/Indiana/Marengo">Indiana - Marengo</option>
													<option value="America/Indiana/Petersburg">Indiana - Petersburg</option>
													<option value="America/Indiana/Tell_City">Indiana - Tell City</option>
													<option value="America/Indiana/Vevay">Indiana - Vevay</option>
													<option value="America/Indiana/Vincennes">Indiana - Vincennes</option>
													<option value="America/Indiana/Winamac">Indiana - Winamac</option>
													<option value="America/Inuvik">Inuvik</option>
													<option value="America/Iqaluit">Iqaluit</option>
													<option value="America/Jamaica">Jamaica</option>
													<option value="America/Juneau">Juneau</option>
													<option value="America/Kentucky/Louisville">Kentucky - Louisville</option>
													<option value="America/Kentucky/Monticello">Kentucky - Monticello</option>
													<option value="America/Kralendijk">Kralendijk</option>
													<option value="America/La_Paz">La Paz</option>
													<option value="America/Lima">Lima</option>
													<option value="America/Los_Angeles">Los Angeles</option>
													<option value="America/Lower_Princes">Lower Princes</option>
													<option value="America/Maceio">Maceio</option>
													<option value="America/Managua">Managua</option>
													<option value="America/Manaus">Manaus</option>
													<option value="America/Marigot">Marigot</option>
													<option value="America/Martinique">Martinique</option>
													<option value="America/Matamoros">Matamoros</option>
													<option value="America/Mazatlan">Mazatlan</option>
													<option value="America/Menominee">Menominee</option>
													<option value="America/Merida">Merida</option>
													<option value="America/Metlakatla">Metlakatla</option>
													<option value="America/Mexico_City">Mexico City</option>
													<option value="America/Miquelon">Miquelon</option>
													<option value="America/Moncton">Moncton</option>
													<option value="America/Monterrey">Monterrey</option>
													<option value="America/Montevideo">Montevideo</option>
													<option value="America/Montserrat">Montserrat</option>
													<option value="America/Nassau">Nassau</option>
													<option value="America/New_York">New York</option>
													<option value="America/Nipigon">Nipigon</option>
													<option value="America/Nome">Nome</option>
													<option value="America/Noronha">Noronha</option>
													<option value="America/North_Dakota/Beulah">North Dakota - Beulah</option>
													<option value="America/North_Dakota/Center">North Dakota - Center</option>
													<option value="America/North_Dakota/New_Salem">North Dakota - New Salem</option>
													<option value="America/Ojinaga">Ojinaga</option>
													<option value="America/Panama">Panama</option>
													<option value="America/Pangnirtung">Pangnirtung</option>
													<option value="America/Paramaribo">Paramaribo</option>
													<option value="America/Phoenix">Phoenix</option>
													<option value="America/Port-au-Prince">Port-au-Prince</option>
													<option value="America/Port_of_Spain">Port of Spain</option>
													<option value="America/Porto_Velho">Porto Velho</option>
													<option value="America/Puerto_Rico">Puerto Rico</option>
													<option value="America/Rainy_River">Rainy River</option>
													<option value="America/Rankin_Inlet">Rankin Inlet</option>
													<option value="America/Recife">Recife</option>
													<option value="America/Regina">Regina</option>
													<option value="America/Resolute">Resolute</option>
													<option value="America/Rio_Branco">Rio Branco</option>
													<option value="America/Santa_Isabel">Santa Isabel</option>
													<option value="America/Santarem">Santarem</option>
													<option value="America/Santiago">Santiago</option>
													<option value="America/Santo_Domingo">Santo Domingo</option>
													<option value="America/Sao_Paulo">Sao Paulo</option>
													<option value="America/Scoresbysund">Scoresbysund</option>
													<option value="America/Sitka">Sitka</option>
													<option value="America/St_Barthelemy">St Barthelemy</option>
													<option value="America/St_Johns">St Johns</option>
													<option value="America/St_Kitts">St Kitts</option>
													<option value="America/St_Lucia">St Lucia</option>
													<option value="America/St_Thomas">St Thomas</option>
													<option value="America/St_Vincent">St Vincent</option>
													<option value="America/Swift_Current">Swift Current</option>
													<option value="America/Tegucigalpa">Tegucigalpa</option>
													<option value="America/Thule">Thule</option>
													<option value="America/Thunder_Bay">Thunder Bay</option>
													<option value="America/Tijuana">Tijuana</option>
													<option value="America/Toronto">Toronto</option>
													<option value="America/Tortola">Tortola</option>
													<option value="America/Vancouver">Vancouver</option>
													<option value="America/Whitehorse">Whitehorse</option>
													<option value="America/Winnipeg">Winnipeg</option>
													<option value="America/Yakutat">Yakutat</option>
													<option value="America/Yellowknife">Yellowknife</option>
												</optgroup>
												<optgroup label="Antarctica">
													<option value="Antarctica/Casey">Casey</option>
													<option value="Antarctica/Davis">Davis</option>
													<option value="Antarctica/DumontDUrville">DumontDUrville</option>
													<option value="Antarctica/Macquarie">Macquarie</option>
													<option value="Antarctica/Mawson">Mawson</option>
													<option value="Antarctica/McMurdo">McMurdo</option>
													<option value="Antarctica/Palmer">Palmer</option>
													<option value="Antarctica/Rothera">Rothera</option>
													<option value="Antarctica/Syowa">Syowa</option>
													<option value="Antarctica/Troll">Troll</option>
													<option value="Antarctica/Vostok">Vostok</option>
												</optgroup>
												<optgroup label="Arctic">
													<option value="Arctic/Longyearbyen">Longyearbyen</option>
												</optgroup>
												<optgroup label="Asia">
													<option value="Asia/Aden">Aden</option>
													<option value="Asia/Almaty">Almaty</option>
													<option value="Asia/Amman">Amman</option>
													<option value="Asia/Anadyr">Anadyr</option>
													<option value="Asia/Aqtau">Aqtau</option>
													<option value="Asia/Aqtobe">Aqtobe</option>
													<option value="Asia/Ashgabat">Ashgabat</option>
													<option value="Asia/Baghdad">Baghdad</option>
													<option value="Asia/Bahrain">Bahrain</option>
													<option value="Asia/Baku">Baku</option>
													<option value="Asia/Bangkok">Bangkok</option>
													<option value="Asia/Beirut">Beirut</option>
													<option value="Asia/Bishkek">Bishkek</option>
													<option value="Asia/Brunei">Brunei</option>
													<option value="Asia/Chita">Chita</option>
													<option value="Asia/Choibalsan">Choibalsan</option>
													<option value="Asia/Colombo">Colombo</option>
													<option value="Asia/Damascus">Damascus</option>
													<option value="Asia/Dhaka">Dhaka</option>
													<option value="Asia/Dili">Dili</option>
													<option value="Asia/Dubai">Dubai</option>
													<option value="Asia/Dushanbe">Dushanbe</option>
													<option value="Asia/Gaza">Gaza</option>
													<option value="Asia/Hebron">Hebron</option>
													<option value="Asia/Ho_Chi_Minh">Ho Chi Minh</option>
													<option value="Asia/Hong_Kong">Hong Kong</option>
													<option value="Asia/Hovd">Hovd</option>
													<option value="Asia/Irkutsk">Irkutsk</option>
													<option value="Asia/Jakarta">Jakarta</option>
													<option value="Asia/Jayapura">Jayapura</option>
													<option value="Asia/Jerusalem">Jerusalem</option>
													<option value="Asia/Kabul">Kabul</option>
													<option value="Asia/Kamchatka">Kamchatka</option>
													<option value="Asia/Karachi">Karachi</option>
													<option value="Asia/Kathmandu">Kathmandu</option>
													<option value="Asia/Khandyga">Khandyga</option>
													<option value="Asia/Kolkata">Kolkata</option>
													<option value="Asia/Krasnoyarsk">Krasnoyarsk</option>
													<option value="Asia/Kuala_Lumpur">Kuala Lumpur</option>
													<option value="Asia/Kuching">Kuching</option>
													<option value="Asia/Kuwait">Kuwait</option>
													<option value="Asia/Macau">Macau</option>
													<option value="Asia/Magadan">Magadan</option>
													<option value="Asia/Makassar">Makassar</option>
													<option value="Asia/Manila">Manila</option>
													<option value="Asia/Muscat">Muscat</option>
													<option value="Asia/Nicosia">Nicosia</option>
													<option value="Asia/Novokuznetsk">Novokuznetsk</option>
													<option value="Asia/Novosibirsk">Novosibirsk</option>
													<option value="Asia/Omsk">Omsk</option>
													<option value="Asia/Oral">Oral</option>
													<option value="Asia/Phnom_Penh">Phnom Penh</option>
													<option value="Asia/Pontianak">Pontianak</option>
													<option value="Asia/Pyongyang">Pyongyang</option>
													<option value="Asia/Qatar">Qatar</option>
													<option value="Asia/Qyzylorda">Qyzylorda</option>
													<option value="Asia/Rangoon">Rangoon</option>
													<option value="Asia/Riyadh">Riyadh</option>
													<option value="Asia/Sakhalin">Sakhalin</option>
													<option value="Asia/Samarkand">Samarkand</option>
													<option value="Asia/Seoul">Seoul</option>
													<option value="Asia/Shanghai">Shanghai</option>
													<option value="Asia/Singapore">Singapore</option>
													<option value="Asia/Srednekolymsk">Srednekolymsk</option>
													<option value="Asia/Taipei">Taipei</option>
													<option value="Asia/Tashkent">Tashkent</option>
													<option value="Asia/Tbilisi">Tbilisi</option>
													<option value="Asia/Tehran">Tehran</option>
													<option value="Asia/Thimphu">Thimphu</option>
													<option value="Asia/Tokyo">Tokyo</option>
													<option value="Asia/Ulaanbaatar">Ulaanbaatar</option>
													<option value="Asia/Urumqi">Urumqi</option>
													<option value="Asia/Ust-Nera">Ust-Nera</option>
													<option value="Asia/Vientiane">Vientiane</option>
													<option value="Asia/Vladivostok">Vladivostok</option>
													<option value="Asia/Yakutsk">Yakutsk</option>
													<option value="Asia/Yekaterinburg">Yekaterinburg</option>
													<option value="Asia/Yerevan">Yerevan</option>
												</optgroup>
												<optgroup label="Atlantic">
													<option value="Atlantic/Azores">Azores</option>
													<option value="Atlantic/Bermuda">Bermuda</option>
													<option value="Atlantic/Canary">Canary</option>
													<option value="Atlantic/Cape_Verde">Cape Verde</option>
													<option value="Atlantic/Faroe">Faroe</option>
													<option value="Atlantic/Madeira">Madeira</option>
													<option value="Atlantic/Reykjavik">Reykjavik</option>
													<option value="Atlantic/South_Georgia">South Georgia</option>
													<option value="Atlantic/Stanley">Stanley</option>
													<option value="Atlantic/St_Helena">St Helena</option>
												</optgroup>
												<optgroup label="Australia">
													<option value="Australia/Adelaide">Adelaide</option>
													<option value="Australia/Brisbane">Brisbane</option>
													<option value="Australia/Broken_Hill">Broken Hill</option>
													<option value="Australia/Currie">Currie</option>
													<option value="Australia/Darwin">Darwin</option>
													<option value="Australia/Eucla">Eucla</option>
													<option value="Australia/Hobart">Hobart</option>
													<option value="Australia/Lindeman">Lindeman</option>
													<option value="Australia/Lord_Howe">Lord Howe</option>
													<option value="Australia/Melbourne">Melbourne</option>
													<option value="Australia/Perth">Perth</option>
													<option value="Australia/Sydney">Sydney</option>
												</optgroup>
												<optgroup label="Europe">
													<option value="Europe/Amsterdam">Amsterdam</option>
													<option value="Europe/Andorra">Andorra</option>
													<option value="Europe/Athens">Athens</option>
													<option value="Europe/Belgrade">Belgrade</option>
													<option value="Europe/Berlin">Berlin</option>
													<option value="Europe/Bratislava">Bratislava</option>
													<option value="Europe/Brussels">Brussels</option>
													<option value="Europe/Bucharest">Bucharest</option>
													<option value="Europe/Budapest">Budapest</option>
													<option value="Europe/Busingen">Busingen</option>
													<option value="Europe/Chisinau">Chisinau</option>
													<option value="Europe/Copenhagen">Copenhagen</option>
													<option value="Europe/Dublin">Dublin</option>
													<option value="Europe/Gibraltar">Gibraltar</option>
													<option value="Europe/Guernsey">Guernsey</option>
													<option value="Europe/Helsinki">Helsinki</option>
													<option value="Europe/Isle_of_Man">Isle of Man</option>
													<option value="Europe/Istanbul">Istanbul</option>
													<option value="Europe/Jersey">Jersey</option>
													<option value="Europe/Kaliningrad">Kaliningrad</option>
													<option value="Europe/Kiev">Kiev</option>
													<option value="Europe/Lisbon">Lisbon</option>
													<option value="Europe/Ljubljana">Ljubljana</option>
													<option value="Europe/London">London</option>
													<option value="Europe/Luxembourg">Luxembourg</option>
													<option value="Europe/Madrid">Madrid</option>
													<option value="Europe/Malta">Malta</option>
													<option value="Europe/Mariehamn">Mariehamn</option>
													<option value="Europe/Minsk">Minsk</option>
													<option value="Europe/Monaco">Monaco</option>
													<option value="Europe/Moscow">Moscow</option>
													<option value="Europe/Oslo">Oslo</option>
													<option value="Europe/Paris">Paris</option>
													<option value="Europe/Podgorica">Podgorica</option>
													<option value="Europe/Prague">Prague</option>
													<option value="Europe/Riga">Riga</option>
													<option value="Europe/Rome">Rome</option>
													<option value="Europe/Samara">Samara</option>
													<option value="Europe/San_Marino">San Marino</option>
													<option value="Europe/Sarajevo">Sarajevo</option>
													<option value="Europe/Simferopol">Simferopol</option>
													<option value="Europe/Skopje">Skopje</option>
													<option value="Europe/Sofia">Sofia</option>
													<option value="Europe/Stockholm">Stockholm</option>
													<option value="Europe/Tallinn">Tallinn</option>
													<option value="Europe/Tirane">Tirane</option>
													<option value="Europe/Uzhgorod">Uzhgorod</option>
													<option value="Europe/Vaduz">Vaduz</option>
													<option value="Europe/Vatican">Vatican</option>
													<option value="Europe/Vienna">Vienna</option>
													<option value="Europe/Vilnius">Vilnius</option>
													<option value="Europe/Volgograd">Volgograd</option>
													<option value="Europe/Warsaw">Warsaw</option>
													<option value="Europe/Zagreb">Zagreb</option>
													<option value="Europe/Zaporozhye">Zaporozhye</option>
													<option value="Europe/Zurich">Zurich</option>
												</optgroup>
												<optgroup label="Indian">
													<option value="Indian/Antananarivo">Antananarivo</option>
													<option value="Indian/Chagos">Chagos</option>
													<option value="Indian/Christmas">Christmas</option>
													<option value="Indian/Cocos">Cocos</option>
													<option value="Indian/Comoro">Comoro</option>
													<option value="Indian/Kerguelen">Kerguelen</option>
													<option value="Indian/Mahe">Mahe</option>
													<option value="Indian/Maldives">Maldives</option>
													<option value="Indian/Mauritius">Mauritius</option>
													<option value="Indian/Mayotte">Mayotte</option>
													<option value="Indian/Reunion">Reunion</option>
												</optgroup>
												<optgroup label="Pacific">
													<option value="Pacific/Apia">Apia</option>
													<option value="Pacific/Auckland">Auckland</option>
													<option value="Pacific/Chatham">Chatham</option>
													<option value="Pacific/Chuuk">Chuuk</option>
													<option value="Pacific/Easter">Easter</option>
													<option value="Pacific/Efate">Efate</option>
													<option value="Pacific/Enderbury">Enderbury</option>
													<option value="Pacific/Fakaofo">Fakaofo</option>
													<option value="Pacific/Fiji">Fiji</option>
													<option value="Pacific/Funafuti">Funafuti</option>
													<option value="Pacific/Galapagos">Galapagos</option>
													<option value="Pacific/Gambier">Gambier</option>
													<option value="Pacific/Guadalcanal">Guadalcanal</option>
													<option value="Pacific/Guam">Guam</option>
													<option value="Pacific/Honolulu">Honolulu</option>
													<option value="Pacific/Johnston">Johnston</option>
													<option value="Pacific/Kiritimati">Kiritimati</option>
													<option value="Pacific/Kosrae">Kosrae</option>
													<option value="Pacific/Kwajalein">Kwajalein</option>
													<option value="Pacific/Majuro">Majuro</option>
													<option value="Pacific/Marquesas">Marquesas</option>
													<option value="Pacific/Midway">Midway</option>
													<option value="Pacific/Nauru">Nauru</option>
													<option value="Pacific/Niue">Niue</option>
													<option value="Pacific/Norfolk">Norfolk</option>
													<option value="Pacific/Noumea">Noumea</option>
													<option value="Pacific/Pago_Pago">Pago Pago</option>
													<option value="Pacific/Palau">Palau</option>
													<option value="Pacific/Pitcairn">Pitcairn</option>
													<option value="Pacific/Pohnpei">Pohnpei</option>
													<option value="Pacific/Port_Moresby">Port Moresby</option>
													<option value="Pacific/Rarotonga">Rarotonga</option>
													<option value="Pacific/Saipan">Saipan</option>
													<option value="Pacific/Tahiti">Tahiti</option>
													<option value="Pacific/Tarawa">Tarawa</option>
													<option value="Pacific/Tongatapu">Tongatapu</option>
													<option value="Pacific/Wake">Wake</option>
													<option value="Pacific/Wallis">Wallis</option>
												</optgroup>
												<optgroup label="UTC">
													<option value="UTC">UTC</option>
												</optgroup>
												<optgroup label="Manual Offsets">
													<option value="UTC-12">UTC-12</option>
													<option value="UTC-11.5">UTC-11:30</option>
													<option value="UTC-11">UTC-11</option>
													<option value="UTC-10.5">UTC-10:30</option>
													<option value="UTC-10">UTC-10</option>
													<option value="UTC-9.5">UTC-9:30</option>
													<option value="UTC-9">UTC-9</option>
													<option value="UTC-8.5">UTC-8:30</option>
													<option value="UTC-8">UTC-8</option>
													<option value="UTC-7.5">UTC-7:30</option>
													<option value="UTC-7">UTC-7</option>
													<option value="UTC-6.5">UTC-6:30</option>
													<option value="UTC-6">UTC-6</option>
													<option value="UTC-5.5">UTC-5:30</option>
													<option selected="selected" value="UTC-5">UTC-5</option>
													<option value="UTC-4.5">UTC-4:30</option>
													<option value="UTC-4">UTC-4</option>
													<option value="UTC-3.5">UTC-3:30</option>
													<option value="UTC-3">UTC-3</option>
													<option value="UTC-2.5">UTC-2:30</option>
													<option value="UTC-2">UTC-2</option>
													<option value="UTC-1.5">UTC-1:30</option>
													<option value="UTC-1">UTC-1</option>
													<option value="UTC-0.5">UTC-0:30</option>
													<option value="UTC+0">UTC+0</option>
													<option value="UTC+0.5">UTC+0:30</option>
													<option value="UTC+1">UTC+1</option>
													<option value="UTC+1.5">UTC+1:30</option>
													<option value="UTC+2">UTC+2</option>
													<option value="UTC+2.5">UTC+2:30</option>
													<option value="UTC+3">UTC+3</option>
													<option value="UTC+3.5">UTC+3:30</option>
													<option value="UTC+4">UTC+4</option>
													<option value="UTC+4.5">UTC+4:30</option>
													<option value="UTC+5">UTC+5</option>
													<option value="UTC+5.5">UTC+5:30</option>
													<option value="UTC+5.75">UTC+5:45</option>
													<option value="UTC+6">UTC+6</option>
													<option value="UTC+6.5">UTC+6:30</option>
													<option value="UTC+7">UTC+7</option>
													<option value="UTC+7.5">UTC+7:30</option>
													<option value="UTC+8">UTC+8</option>
													<option value="UTC+8.5">UTC+8:30</option>
													<option value="UTC+8.75">UTC+8:45</option>
													<option value="UTC+9">UTC+9</option>
													<option value="UTC+9.5">UTC+9:30</option>
													<option value="UTC+10">UTC+10</option>
													<option value="UTC+10.5">UTC+10:30</option>
													<option value="UTC+11">UTC+11</option>
													<option value="UTC+11.5">UTC+11:30</option>
													<option value="UTC+12">UTC+12</option>
													<option value="UTC+12.75">UTC+12:45</option>
													<option value="UTC+13">UTC+13</option>
													<option value="UTC+13.75">UTC+13:45</option>
													<option value="UTC+14">UTC+14</option>
												</optgroup>
											</select>
										</div>
										<div class="form-group">
											<label>Date Format</label>
											<div class="fancy-radio">
												<label>
													<input name="dateFormat" value="" type="radio"><span><i></i>May 10, 2017</span></label>
											</div>
											<div class="fancy-radio">
												<label>
													<input name="dateFormat" value="" type="radio" checked><span><i></i>2017-05-10</span></label>
											</div>
											<div class="fancy-radio">
												<label>
													<input name="dateFormat" value="" type="radio"><span><i></i>05/10/2017</span></label>
											</div>
											<div class="fancy-radio">
												<label>
													<input name="dateFormat" value="" type="radio"><span><i></i>10/05/2017</span></label>
											</div>
										</div>
									</div>
									<div class="profile-section">
										<h2 class="profile-heading">Your Login Sessions</h2>
										<ul class="list-unstyled list-login-session">
											<li>
												<div class="login-session">
													<i class="fa fa-laptop device-icon"></i>
													<div class="login-info">
														<h3 class="login-title">Mac - Los Angeles, United States</h3>
														<span class="login-detail">Chrome - <span class="text-success">Active Now</span></span>
													</div>
												</div>
											</li>
											<li>
												<div class="login-session">
													<i class="fa fa-desktop device-icon"></i>
													<div class="login-info">
														<h3 class="login-title">Windows 7 - Los Angeles, United States</h3>
														<span class="login-detail">Firefox - about an hour ago</span>
													</div>
													<button type="button" class="btn btn-link btn-logout" data-container="body" data-toggle="tooltip" title="Close this login session"><i class="fa fa-times-circle text-danger"></i></button>
												</div>
											</li>
											<li>
												<div class="login-session">
													<i class="fa fa-mobile fa-fw device-icon"></i>
													<div class="login-info">
														<h3 class="login-title">Android - Los Angeles, United States</h3>
														<span class="login-detail">Android Browser - yesterday</span>
													</div>
													<button type="button" class="btn btn-link btn-logout" data-container="body" data-toggle="tooltip" title="Close this login session"><i class="fa fa-times-circle text-danger"></i></button>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<div class="right">
									<div class="profile-section">
										<h2 class="profile-heading">Email from DiffDash</h2>
										<p>I'd like to receive the following emails:</p>
										<ul class="list-unstyled list-email-received">
											<li>
												<label class="fancy-checkbox">
													<input type="checkbox" checked><span>Weekly account summary</span></label>
											</li>
											<li>
												<label class="fancy-checkbox">
													<input type="checkbox"><span>Campaign reports</span></label>
											</li>
											<li>
												<label class="fancy-checkbox">
													<input type="checkbox" checked><span>Promotional news such as offers or discounts</span></label>
											</li>
											<li>
												<label class="fancy-checkbox">
													<input type="checkbox" checked><span>Tips for campaign setup, growth and client success stories</span></label>
											</li>
										</ul>
									</div>
									<div class="profile-section">
										<h2 class="profile-heading">Connected Apps &amp; Sites</h2>
										<ul class="list-unstyled list-connected-app">
											<li>
												<div class="connected-app">
													<i class="fa fa-wordpress app-icon"></i>
													<div class="connection-info">
														<h3 class="app-title">WordPress</h3>
														<span class="actions">
												<a href="#">View Permissions</a> <a href="#">Revoke Access</a>
											</span>
													</div>
												</div>
											</li>
											<li>
												<div class="connected-app">
													<i class="fa fa-twitter app-icon"></i>
													<div class="connection-info">
														<h3 class="app-title">Twitter</h3>
														<span class="actions">
												<a href="#">View Permissions</a> <a href="#">Revoke Access</a>
											</span>
													</div>
												</div>
											</li>
											<li>
												<div class="connected-app">
													<i class="fa fa-sellsy app-icon"></i>
													<div class="connection-info">
														<h3 class="app-title">Sellsy</h3>
														<span class="actions">
												<a href="#">View Permissions</a> <a href="#">Revoke Access</a>
											</span>
													</div>
												</div>
											</li>
											<li>
												<div class="connected-app">
													<i class="fa fa-etsy app-icon"></i>
													<div class="connection-info">
														<h3 class="app-title">Etsy</h3>
														<span class="actions">
												<a href="#">View Permissions</a> <a href="#">Revoke Access</a>
											</span>
													</div>
												</div>
											</li>
											<li>
												<div class="connected-app">
													<i class="fa fa-opencart app-icon"></i>
													<div class="connection-info">
														<h3 class="app-title">OpenCart</h3>
														<span class="actions">
												<a href="#">View Permissions</a> <a href="#">Revoke Access</a>
											</span>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- END PREFERENCES -->
                    </div>
                </form>
              </center>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
    </div>
    <script>
		function showFormSeller() {
			var e = document.getElementById("showForm_seller");
    	   	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
        }
        function showFormBuyer() {
            var e = document.getElementById("showForm");
    	   	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
        }


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
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Kyçu</h3>
		</div>
			<div class="sign-in-wrapper">
                <form action="signin.php" method="post">
                    <div class="form-group">
                        <label> Përdoruesi ose Email * </label>
                        <input type="text" class="form-control" name="username" placeholder="përdoruesi ose emaili..." <?php if(isset($_SESSION['user_exist_false'])){ echo "style='border-color:red;'";} ?>>
                    </div>
                    <div class="form-group">
                    <label> Fjalëkalimi * </label>
                        <input type="password" class="form-control" name="password" placeholder="********" <?php if(isset($_SESSION['user_exist_false'])){ echo "style='border-color:red;'";} ?>>
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-left">
                        </div>
                        <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Keni harruar fjalëkalimin?</a></div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Kyçu" name="signin" class="btn_1 full-width">
                        Nuk keni llogari? <a href="signin.php">Regjistrohuni</a>
                    </div>
                    <div id="forgot_pw">
                        <div class="form-group">
                            <label>Ju lutemi konfirmojeni emailin tuaj!</label>
                            <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                            <i class="ti-email"></i>
                        </div>
                        <p>Ju do e pranoni një email që përmban një link ku i'u mundësohet ndryshimi i fjalkalimit në një të ri të dëshiruar.</p>
                        <div class="text-center"><input type="submit" name="change_pass" value="Ndrysho fjalëkalimin" class="btn_1"></div>
                    </div>
                </form>
            </div>
		<!--form -->
	</div>
<!-- COMMON SCRIPTS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/common_scripts.min.js"></script>
<script src="../js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="../js/carousel-home.min.js"></script> <!-- INDEX -->
<script src="../js/carousel_with_thumbs.js"></script> <!-- DETAJET -->
<script src="../js/sticky_sidebar.min.js"></script>
<script src="../js/specific_listing.js"></script> <!-- PRODUKTET ||| e dyta per --->
<script src="assets/vendor/jquery/jquery.min.js"></script>
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