<?php 
    require_once "db.php";
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
    <link href="css/card.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="js/jquery.card.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <!-- <link rel="preload" href="../css.css?family=Roboto:300,400,500,700,900&display=swap" as="fetch"
        crossorigin="anonymous"> -->

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
        /* oferto disabled button */
        a.btn__1:disabled,
        .btn__1:disabled,
        .btn__1:hover:disabled{
            background-color: #035af9;
            color: #ff0d0d !important
        }
        /* The actual popup */
        .btn_add_to_cart .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: red;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
        }

        /* Popup arrow */
        .btn_add_to_cart .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: red transparent transparent transparent;
        }

        /* Toggle this class - hide and show the popup */
        .btn_add_to_cart .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
        from {opacity: 0;} 
        to {opacity: 1;}
        }

        @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
        }
        #spec_h3{
           display:none;
       }#spec_laptop, #spec_phone, #spec_cars, #spec_template{
           display:none;
       }
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
                width: 50% !important;
                float:left;
            }
            .input-group-bal {
                width:60% !important;
            }
            .btn__1{
                float:right;
                display:flow-root !important;
            }
            
        }
        @media only screen and (max-width: 1199px){
            .checkmark {
                margin-left:0% !important;
            }
            .form-group1 {
                width: 100%;
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
        .warning {
            width:100%;
            padding: 10px 10px 1px 10px;
            background-color:#f9f9f9;
            text-align:center;
            margin-bottom:6px;
        }
        .col-form-label{
            margin-top:0.5em;
        }
        .hide {
            display: none;
        }
    </style>
    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    

    <!-- DatePicker -->
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/datepicker.css" type="text/css">
    <!-- <script src="jquery-1.12.0.min.js" type="text/javascript"></script> -->

    <!-- SPECIFIC CSS -->
    <link href="css/home_1.css" rel="stylesheet">
    <link href="css/product_page.css" rel="stylesheet">
    <link href="css/listing.css" rel="stylesheet">
    <link href="css/account.css" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">
    <link href="css/error_track.css" rel="stylesheet">
    <link rel="stylesheet" href="css/intlTelInput.css">
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
                                    <a href="index.php"><img src="img/logo/deal_aim_logo-transparent.png" alt="" width="100" height="35"></a>
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
                                                        echo "<a href='user_panel/index.php?form_buyer'  class='shites'>Apliko për blerës</button>";
                                                        echo "</li>";
                                                    }elseif(isset($_SESSION['user']) && $_SESSION['user']['status'] == BUYER){
                                                        echo "<li>";
                                                        echo "<a href='user_panel/index.php?form_seller' class='shites'>Apliko për shitës</a>";
                                                        echo "</li>";
                                                    }elseif(isset($_SESSION['user']) && $_SESSION['user']['status'] == SELLER){
                                                        echo "<li>";
                                                        echo "<a href='myauctions.php' class='shites'>Shto një produkt</a>";
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
                                            <a href="<?php if(isset($_SESSION['logged'])){ echo "user_panel.php ";} else{ echo "signin.php";} ?>" class="access_link" data-toggle="dropdown"><span>Account</span></a>
                                            <div class="dropdown-menu">
                                                <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){   ?>
                                                <a style="font-size: 15px;font-weight:italic;">Statusi:
                                                    <?php
                                                        if(isset($_SESSION['user'])){
                                                            if($_SESSION['user']['status'] == CONFIRMED){
                                                                echo "<b style='color:#CF2928'> I REGJISTRUAR </b>";
                                                            }elseif($_SESSION['user']['status'] == BUYER){
                                                                echo "<b style='color:#F0AC1A'>BLERËS</b>";
                                                            }elseif($_SESSION['user']['status'] == SELLER){
                                                                echo "<b style='color:#5ABC35'>SHITËS</b>";
                                                            }elseif($_SESSION['user']['status'] == MODERATOR){
                                                                echo "<b style='color:#5ABC35'>MODERATOR</b>";
                                                            }else{
                                                                echo "<b style='color:#5ABC35'>ADMINISTRATOR</b>";
                                                            }
                                                        }
                                                    ?> 
                                                </a>
                                                
                                                <?php if($_SESSION['user']['status'] == BUYER || $_SESSION['user']['status'] == SELLER)
                                                {   
                                                    $st = prep_stmt("SELECT CAST(user_balance as decimal(8,2)) FROM users WHERE username=?", $_SESSION['user']['username'], 's');
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
                                                        <?php if($_SESSION['user']['status'] == MODERATOR || $_SESSION['user']['status'] == ADMIN){?>
                                                            <a href="deal_admin_aim/index.php"><i class="ti-user"></i>Paneli</a>
                                                        <?php }else { ?>
                                                            <a href="user_panel/index.php"><i class="ti-user"></i>Paneli</a>
                                                        <?php } ?>
                                                    </li>
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