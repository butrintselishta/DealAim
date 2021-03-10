<?php 
require_once '../db.php'; 

    if(!isset($_SESSION['logged']) && $_SESSION['user']['status'] !== MODERATOR && $_SESSION['user']['status'] !== ADMIN){
        header("location:../index.php");
    }

    $username = $_SESSION['user']['username']; 
	$stmt = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");
	if(mysqli_num_rows($stmt) > 0){
		$row_adm = mysqli_fetch_array($stmt);

		$username = $row_adm['username'];
		$profile_pic = $row_adm['profile_pic'];
		$fname = $row_adm['first_name'];//die(var_dump($fname));
		$lname = $row_adm['last_name'];
		$email = $row_adm['email'];
		$tel = $row_adm['tel_nr'];
		$bday = date("d-M-Y", strtotime($row_adm['birthday']));    
		$city = $row_adm['city'];
		$post_code = $row_adm['postal_code'];
		$address = $row_adm['address'];
		$pid = $row_adm['pid_number'];
	}
	else{
		$_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
	}

    $select_all = prep_stmt("SELECT * FROM income_ratio");
    $dataIncome = array();
    $dataDate = array();
    for($i = 1; $i <= mysqli_num_rows($select_all); $i++){
        $row = mysqli_fetch_array($select_all);
        //$data = date("d-M", strtotime($row['date_time']));
        $dataIncome[] = $row['profit'];
        $dataDate[] = date("d-M", strtotime($row['date_time']));
    }
    $profits = "";
    $dateIncome = "";
    foreach($dataIncome as $price) {
        $profits .= $price.",";
    }
    foreach($dataDate as $date){
        $dateIncome .= $date . ",";
    }
    $profits = rtrim($profits, ",");
    $dateIncome =rtrim($dateIncome,",");//die($dateIncome);



?>
<?php require "header.php"; ?>
<!-- LEFT SIDEBAR -->
<div id="left-sidebar" class="sidebar">
    <button type="button" class="btn btn-xs btn-link btn-toggle-fullwidth">
				<span class="sr-only">Toggle Fullwidth</span>
				<i class="fa fa-angle-left"></i>
			</button>
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="../img/profile_pictures/<?php echo $row_adm['profile_pic']; ?>" class="img-responsive img-circle user-photo" alt="User Profile Picture" style="width:80%; height:20rem;">
            <div class="dropdown">
            <a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Përshëndetje, <strong><?php echo $row_adm['first_name'] . " ". $row_adm['last_name']; ?></strong> <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="myprofile.php"><i class="fa fa-user-circle"></i> Profili im</a></li>
                    <li><a href="messages.php"><i class="fa fa-envelope" style="color:black;"></i> Mesazhet</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Çkyçu</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
				<li class="active"><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li class=""><a href="myprofile.php"><i class="fa fa-user-circle"></i> <span>Profili im</span></a></li>
                <?php if($_SESSION['user']['status'] == ADMIN) { ?>
                    <li><a href="finances.php"><i class="lnr lnr-chart-bars"></i> <span>Financat</span></a></li>
                    <li><a href="users.php"><i class="lnr lnr-users"></i> <span>Përdoruesit</span></a></li>
                <?php } ?>
                <li class=""><a href="site_data.php"><i class="lnr lnr-database"></i> <span>Të dhënat</span></a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
<!-- MAIN CONTENT -->
<div id="main-content">
    <div class="container-fluid">
        <h1 class="sr-only">Dashboard</h1>
        <!-- WEBSITE ANALYTICS -->
        <div class="dashboard-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-content">
                        <?php if(isset($_SESSION['data_changed'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> Konfirmimi i produktit u krye me sukses. <?php if($_SESSION['data_changed'] == 1) { echo "<b style='text-transform:uppercase;'>Produkti doli në ankand! </b>";}else if($_SESSION['data_changed'] == 2){ echo "<b style='text-transform:uppercase;color:#9c1e08;'>Produkti nuk u lejua të dal në ankand! </b>";} ?>
							</div>
                         <?php } unset($_SESSION['data_changed']);?>
                        <h3 class="heading"><i class="fa fa-square"></i>Produkte në pritje!</h3>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Shitësi </th>
                                        <th>Kategoria </th>
                                        <th>Titulli ankandit</th>
                                        <th>Çmimi fillestar</th>
                                        <th>Fillimi ankandit</th>
                                        <th>Statusi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php 
                                        $sel_prod = prep_stmt("SELECT prod_id, username, cat_title,prod_title,prod_price, prod_from FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 0, 'i');
                                        if(mysqli_num_rows($sel_prod) > 0){
                                            while($row_prod = mysqli_fetch_array($sel_prod)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row_prod['prod_id']; ?></td>
                                        <td><b style=' color:#f0ad4e;'><?php echo $row_prod['username']; ?></b></td>
                                        <td><?php echo $row_prod['cat_title']; ?></td>
                                        <td><?php echo $row_prod['prod_title']; ?></td>
                                        <td><?php echo $row_prod['prod_price'] . " €"; ?></td>
                                        <td><?php echo date("d-M-Y", strtotime($row_prod['prod_from'])); ?></td>
                                        <td><span class="label label-warning">Në pritje</span></td>
                                        <td><a class="btn btn-info btn-sm" href="prod_details.php?prod_det=<?php echo $row_prod['prod_id'];?>"><i class="fa fa-file-text-o"></i>SHIKO DETAJET</a></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                                <?php if(mysqli_num_rows($sel_prod) == 0){ ?>
                                   <div class="alert alert-info alert-dismissible" role="alert" style="margin-top:-20px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <i class="fa fa-info-circle"></i> Për momentin nuk ka asnjë produkt në pritje.
                                    </div>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $sel_prod = "";
                if(isset($_GET['product_s'])){
                    $prod = $_GET['product_s']; 
                    $sel_prod = prep_stmt("SELECT  prod_id, username, cat_title,prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE (prod_title LIKE '%$prod%' OR prod_id LIKE '%$prod%' OR prod_price LIKE '%$prod%' OR cat_title LIKE '%$prod%' OR username LIKE '%$prod%') AND (prod_isApproved = ? OR prod_isApproved = ?)", array(1,2), "ii");
                }elseif(isset($_GET['product_confirmation'])){
                    $prod = $_GET['product_confirmation']; 
                    if($prod == "confirmed"){
                        $sel_prod = prep_stmt("SELECT  prod_id, username, cat_title,prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 1, "i");
                    }else if($prod == "not_confirmed"){
                        $sel_prod = prep_stmt("SELECT  prod_id, username, cat_title,prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 2, "i");
                    }else if($prod == "all"){
                        $sel_prod = prep_stmt("SELECT  prod_id, username, cat_title,prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ? OR prod_isApproved = ?", array(1,2), "ii");
                    }
                }
                else{
                    $sel_prod = prep_stmt("SELECT prod_id, username, cat_title,prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ? OR prod_isApproved = ?  ORDER BY prod_id DESC", array(1,2) , 'ii');
                }
            ?>
            <div class="row" id="confirmed_prod">
                <div class="col-md-12">
                    <div class="panel-content">
                        <h3 class="heading"><i class="fa fa-square"></i>Produktet të konfirmuara </h3>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <form method='get' action='index.php#confirmed_prod' id="navbar-search" class="navbar-form search-form">
                                <input value="" class="form-control" name="product_s" placeholder="Kërko këtu..." type="text">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </form>
                            <form method='get' action='index.php#confirmed_prod' id="navbar-search2" class="navbar-form search-form" style="float:right;">
                                <select class="form-control" id="product_confirmation" name="product_confirmation" >
                                    <option value="all"> Rendit sipas llojit të konfirmimit... </option>
                                    <option value="confirmed" <?php if(isset($_GET['product_confirmation']) && $_GET['product_confirmation'] == 'confirmed'){echo "selected";} ?>> I pranuar </option>
                                    <option value="not_confirmed" <?php if(isset($_GET['product_confirmation']) && $_GET['product_confirmation'] == 'not_confirmed'){echo "selected";} ?>> Jo i pranuar </option>
                                </select>
                                <button type="submit" class="btn btn-default"></button>
                            </form>
                          <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="overflow:scroll;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Shitësi </th>
                                        <th>Kategoria </th>
                                        <th>Titulli ankandit</th>
                                        <th>Çmimi fillestar</th>
                                        <th>Statusi</th>
                                        <th>Administratori</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    // $sel_prod = prep_stmt("SELECT prod_id, username, cat_title,prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ? or prod_isApproved = ? ORDER BY prod_id DESC", array(1,2) , 'ii');
                                    if(mysqli_num_rows($sel_prod) > 0){
                                        while($row_prod = mysqli_fetch_array($sel_prod)){
                                ?>
                                    <tr>
                                        <td><?php echo $row_prod['prod_id']; ?></td>
                                        <td><b style=' color:#f0ad4e;'><?php echo $row_prod['username']; ?></b></td>
                                        <td><?php echo $row_prod['cat_title']; ?></td>
                                        <td><?php echo $row_prod['prod_title']; ?></td>
                                        <td><?php echo $row_prod['prod_price'] . " €"; ?></td>
                                        <td><span class="label label-<?php if($row_prod['prod_isApproved'] == 1){echo "success";} elseif($row_prod['prod_isApproved'] == 2){echo "danger";} ?>"><?php if($row_prod['prod_isApproved'] == 1){echo "I pranuar";} elseif($row_prod['prod_isApproved'] == 2){echo "Jo i pranuar";}?></span></td>
                                        <td><b><?php echo $username; ?></b></td>
                                        <td><a class="btn btn-info btn-sm" href="prod_details.php?prod_det=<?php echo $row_prod['prod_id'];?>"><i class="fa fa-file-text-o"></i>SHIKO DETAJET</a></td>
                                    </tr>
                                <?php } } ?>
                                <script>
                                        document.getElementById("product_confirmation").onchange = function () {
                                            var searchUsers = document.getElementById("product_confirmation");
                                                document.getElementById("navbar-search2").submit();
                                        }
                                    </script>
                                </tbody>
                            </table>
                        </div>
                        <?php if(mysqli_num_rows($sel_prod) == 0){ ?>
                            <div class="alert alert-info alert-dismissible" role="alert" style="margin-top:-20px;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-info-circle"></i> <?php if(isset($_GET['product_s'])){ echo "Nuk ka produkte që ngjasojnë me atë që kërkoni: <b style='color:darkred; font-size:1.8rem;'>". $_GET['product_s'] ."!</b>";}elseif(isset($_GET['product_confirmation'])){ if($_GET['product_confirmation'] == "confirmed"){ echo "Nuk ka produkte <b style='color:#5cb85c; font-size:1.8rem;'>TË PRANUARA!</b>";}elseif($_GET['product_confirmation'] == "not_confirmed"){echo "Nuk ka produkte <b style='color:#d9534f; font-size:1.8rem;'>TË PA PRANUARA!</b>";}else { echo "Nuk ka produkte të konfirmuara!";}}else{ echo "Nuk ka produkte të konfirmuara!";} ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
            //SOLDEN PRODUCTS
            $solden_products = "";
            if(isset($_GET['solden_products'])){
                $sold_prod = $_GET['solden_products'];
                if($sold_prod == "smallest"){
                    $solden_products = prep_stmt("SELECT username,cat_title,prod_id,prod_price, prod_title,prod_price prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE  prod_isApproved = ? ORDER BY prod_price ASC", 3, "i");//die(var_dump(mysqli_fetch_array($sel_prod_det)));
                }elseif($sold_prod == "highest"){
                    $solden_products = prep_stmt("SELECT username,cat_title,prod_id,prod_price, prod_title, prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?  ORDER BY prod_price DESC", 3, "i");//die(var_dump(mysqli_fetch_array($sel_prod_det)));
                }else {
                    $solden_products = prep_stmt("SELECT username,cat_title,prod_id,prod_price, prod_title, prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 3, "i");
                }
            }else{
                $solden_products = prep_stmt("SELECT username,cat_title,prod_id, prod_title, prod_price,prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 3, "i");
            }
            ?>
            <div class="row"  >
                <div class="col-md-12">
                    <div class="panel-content" id="solden">
                        <h3 class="heading"><i class="fa fa-square"></i>Ankandet e mbyllura <b style="color:#5CB85C">(TË SHITURA) </b></h3>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <form method='get' action='index.php#solden' id="navbar-search5" class="navbar-form search-form" style="float:right;">
                            <select class="form-control" id="solden_products" name="solden_products" >
                                <option value="" <?php if(isset($_GET['solden_products'])){ if($_GET['solden_products'] == ""){ echo "selected"; }} ?>> Rendit sipas çmimit... </option>
                                <option value="smallest" <?php if(isset($_GET['solden_products'])){ if($_GET['solden_products'] == "smallest"){ echo "selected"; }} ?>> Më i vogli </option>
                                <option value="highest" <?php if(isset($_GET['solden_products'])){ if($_GET['solden_products'] == "highest"){ echo "selected"; }} ?>> Më i madhi </option>
                            </select>
                            <button type="submit" class="btn btn-default"></button>
                        </form>
                          <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"  style="overflow:scroll;">
                                <thead>
                                    <tr>
                                        <th>Titulli ankandit</th>
                                        <th>Shitësi </th>
                                        <th>Blerësi </th>
                                        <th>Çmimi</th>
                                        <th>Kategoria </th>
                                        <th>Statusi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php   
                                    if(mysqli_num_rows($solden_products) > 0){
                                    while($row_sold = mysqli_fetch_array($solden_products)){
                                        $seller = $row_sold['username'];
                                        $category = $row_sold['cat_title'];
                                            $sel_winn = prep_stmt("SELECT offer.offer_id,usr.username, offer.offer_price, prod.prod_title,prod.cat_id FROM prod_offers AS offer LEFT OUTER JOIN users usr ON offer.user_id = usr.user_id LEFT OUTER JOIN products prod ON offer.prod_id = prod.prod_id WHERE offer.prod_id = ? order by offer.offer_id DESC LIMIT 1", $row_sold['prod_id'], "i");
                                            if(mysqli_num_rows($sel_winn) > 0){
                                            while($row_sold_prod = mysqli_fetch_array($sel_winn)){
                                ?>
                                    <tr style="font-weight:800;">
                                        <td><?php echo $row_sold_prod['prod_title']; ?></td>
                                        <td><a style='color:#f0ad4e; font-weight:900; font-size:larger;'><?php echo $seller; ?></td>
                                        <td><a style='color:#5cb85c; font-weight:900; font-size:larger;'><?php echo $row_sold_prod['username']; ?></a></td>
                                        <td><?php echo number_format($row_sold['prod_price'],2) . " €"; ?></td>
                                        <td><?php echo $category; ?></td>
                                         <td><span class="label label-success">I MBYLLUR</span></td>
                                      
                                        <td><a class="btn btn-info btn-sm" href="prod_details.php?prod_det=<?php echo $row_sold['prod_id'];?>"><i class="fa fa-file-text-o"></i>SHIKO DETAJET</a></td>
                                    </tr>
                                <?php } } } }  ?>
                                    <script>
                                        document.getElementById("solden_products").onchange = function () {
                                            var searchUsers = document.getElementById("solden_products");
                                                document.getElementById("navbar-search5").submit();
                                        }
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            //NOT SOLDEN PRODUCTS
            $not_solden_products = "";
            if(isset($_GET['not_solden_procucts'])){
                $not_sold_prod = $_GET['not_solden_procucts'];
                if($not_sold_prod == "smallest"){
                    $not_solden_products = prep_stmt("SELECT username,cat_title,prod_id,prod_price, prod_title, prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE  prod_isApproved = ? ORDER BY prod_price ASC", 3, "i");//die(var_dump(mysqli_fetch_array($sel_prod_det)));
                }elseif($not_sold_prod == "highest"){
                    $not_solden_products = prep_stmt("SELECT username,cat_title,prod_id,prod_price, prod_title, prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?  ORDER BY prod_price DESC", 3, "i");//die(var_dump(mysqli_fetch_array($sel_prod_det)));
                }else {
                    $not_solden_products = prep_stmt("SELECT username,cat_title,prod_id,prod_price, prod_title, prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 3, "i");
                }
            }else{
                $not_solden_products = prep_stmt("SELECT username,cat_title,prod_id, prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users on products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 3, "i");
            }
            ?>
            <div class="row"  >
                <div class="col-md-12">
                    <div class="panel-content" id="notsolden">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <h3 class="heading"><i class="fa fa-square"></i>Ankandet e mbyllura <b style="color:#D9534F">(JO TË SHITURA) </b></h3>
                        <form method='get' action='index.php#notsolden' id="navbar-search6" class="navbar-form search-form" style="float:right;">
                            <select class="form-control" id="not_solden_procucts" name="not_solden_procucts" >
                                <option value="" <?php if(isset($_GET['not_solden_procucts'])){ if($_GET['not_solden_procucts'] == ""){ echo "selected"; }} ?>> Rendit sipas çmimit... </option>
                                <option value="smallest" <?php if(isset($_GET['not_solden_procucts'])){ if($_GET['not_solden_procucts'] == "smallest"){ echo "selected"; }} ?>> Më i vogli </option>
                                <option value="highest" <?php if(isset($_GET['not_solden_procucts'])){ if($_GET['not_solden_procucts'] == "highest"){ echo "selected"; }} ?>> Më i madhi </option>
                            </select>
                            <button type="submit" class="btn btn-default"></button>
                        </form>
                          <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"  style="overflow:scroll;">
                                <thead>
                                    <tr>
                                        <th>Titulli ankandit</th>
                                        <th>Shitësi </th>
                                        <th>Çmimi</th>
                                        <th>Kategoria </th>
                                        <th>Statusi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php   
                                    if(mysqli_num_rows($not_solden_products) > 0){
                                    while($row_not_sold = mysqli_fetch_array($not_solden_products)){
                                        $seller = $row_not_sold['username'];
                                        $category = $row_not_sold['cat_title'];
                                        $sel_count = prep_stmt("SELECT count(offer_id) FROM prod_offers WHERE prod_id = ?", $row_not_sold['prod_id'], "i");
                                        $row_not_sold_prod = mysqli_fetch_array($sel_count);
                                        if($row_not_sold_prod[0] == 0){
                                ?>
                                    <tr style="font-weight:800;">
                                        <td><?php echo $row_not_sold['prod_title']; ?></td>
                                        <td><a style='color:#f0ad4e; font-weight:900; font-size:larger;'><?php echo $seller; ?></td>
                                        <td><?php echo number_format($row_not_sold['prod_price'],2) . " €"; ?></td>
                                        <td><?php echo $category; ?></td>
                                         <td><span class="label label-danger">I MBYLLUR</span></td>
                                      
                                        <td><a class="btn btn-info btn-sm" href="prod_details.php?prod_det=<?php echo $row_not_sold['prod_id'];?>"><i class="fa fa-file-text-o"></i>SHIKO DETAJET</a></td>
                                    </tr>
                                <?php } } } ?>
                                    <script>
                                        document.getElementById("not_solden_procucts").onchange = function () {
                                            var searchUsers = document.getElementById("not_solden_procucts");
                                                document.getElementById("navbar-search6").submit();
                                        }
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END WEBSITE ANALYTICS -->
        <!-- SALES SUMMARY --> 
    </div>
</div>
<!-- END MAIN CONTENT -->
<div class="clearfix"></div>
<footer>
    <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
</footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/metisMenu/metisMenu.js"></script>
<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js"></script>
<script src="assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>
<script src="assets/vendor/chartist/js/chartist.min.js"></script>
<script src="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>
<script src="assets/vendor/chartist-plugin-axistitle/chartist-plugin-axistitle.min.js"></script>
<script src="assets/vendor/chartist-plugin-legend-latest/chartist-plugin-legend.js"></script>
<script src="assets/vendor/toastr/toastr.js"></script>
<script src="assets/scripts/common.js"></script>
<!-- MDBootstrap Datatables  -->

<script>
    $(function() {
        var options;
        var data = {
            labels: ["mon", "tues", "wed"],
            series: [
                [<?php echo $profits; ?>],
            ]
        };

        // line chart
        options = {
            height: "300px",
            showPoint: true,
            axisX: {
                showGrid: false
            },
            lineSmooth: false,
            plugins: [
                Chartist.plugins.tooltip({
                    appendToBody: true
                }),
            ]
        };

        new Chartist.Line('#demo-line-chart', data, options);

         // bar chart
         options = {
                height: "300px",
                axisX: {
                    showGrid: false
                },
                plugins: [
                    Chartist.plugins.tooltip({
                        appendToBody: true
                    }),
                ]
            };

            new Chartist.Bar('#demo-bar-chart', data, options);

        // sparkline charts
        var sparklineNumberChart = function() {

            var params = {
                width: '140px',
                height: '30px',
                lineWidth: '2',
                lineColor: '#20B2AA',
                fillColor: false,
                spotRadius: '2',
                spotColor: false,
                minSpotColor: false,
                maxSpotColor: false,
                disableInteraction: false
            };

            $('#number-chart1').sparkline('html', params);
            $('#number-chart2').sparkline('html', params);
            $('#number-chart3').sparkline('html', params);
            $('#number-chart4').sparkline('html', params);
        };

        sparklineNumberChart();


        // traffic sources
        var dataPie = {
            series: [45, 25, 30]
        };

        var labels = ['Direct', 'Organic', 'Referral'];
        var sum = function(a, b) {
            return a + b;
        };

        new Chartist.Pie('#demo-pie-chart', dataPie, {
            height: "270px",
            labelInterpolationFnc: function(value, idx) {
                var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
                return labels[idx] + ' (' + percentage + ')';
            }
        });


        // progress bars
        $('.progress .progress-bar').progressbar({
            display_text: 'none'
        });

        // line chart
        var data = {
            labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            series: [
                [100, 380, 350, 480, 410, 450, 550],
            ]
        };

        var options = {
            height: "200px",
            showPoint: true,
            showArea: true,
            axisX: {
                showGrid: false
            },
            lineSmooth: false,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 30,
                left: 30
            },
            plugins: [
                Chartist.plugins.tooltip({
                    appendToBody: true
                }),
                Chartist.plugins.ctAxisTitle({
                    axisX: {
                        axisTitle: 'Day',
                        axisClass: 'ct-axis-title',
                        offset: {
                            x: 0,
                            y: 50
                        },
                        textAnchor: 'middle'
                    },
                    axisY: {
                        axisTitle: 'Reach',
                        axisClass: 'ct-axis-title',
                        offset: {
                            x: 0,
                            y: -10
                        },
                    }
                })
            ]
        };

        new Chartist.Line('#demo-line-chart', data, options);


        // sales performance chart
        var sparklineSalesPerformance = function() {

            var lastWeekData = [142, 164, 298, 384, 232, 269, 211];
            var currentWeekData = [352, 267, 373, 222, 533, 111, 60];

            $('#chart-sales-performance').sparkline(lastWeekData, {
                fillColor: 'rgba(90, 90, 90, 0.1)',
                lineColor: '#5A5A5A',
                width: '' + $('#chart-sales-performance').innerWidth() + '',
                height: '100px',
                lineWidth: '2',
                spotColor: false,
                minSpotColor: false,
                maxSpotColor: false,
                chartRangeMin: 0,
                chartRangeMax: 1000
            });

            $('#chart-sales-performance').sparkline(currentWeekData, {
                composite: true,
                fillColor: 'rgba(60, 137, 218, 0.1)',
                lineColor: '#3C89DA',
                lineWidth: '2',
                spotColor: false,
                minSpotColor: false,
                maxSpotColor: false,
                chartRangeMin: 0,
                chartRangeMax: 1000
            });
        }

        sparklineSalesPerformance();

        var sparkResize;
        $(window).on('resize', function() {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineSalesPerformance, 200);
        });


        // top products
        var dataStackedBar = {
            labels: ['Q1', 'Q2', 'Q3'],
            series: [
                [800000, 1200000, 1400000],
                [200000, 400000, 500000],
                [100000, 200000, 400000]
            ]
        };

        new Chartist.Bar('#chart-top-products', dataStackedBar, {
            height: "250px",
            stackBars: true,
            axisX: {
                showGrid: false
            },
            axisY: {
                labelInterpolationFnc: function(value) {
                    return (value / 1000) + 'k';
                }
            },
            plugins: [
                Chartist.plugins.tooltip({
                    appendToBody: true
                }),
                Chartist.plugins.legend({
                    legendNames: ['Phone', 'Laptop', 'PC']
                })
            ]
        }).on('draw', function(data) {
            if (data.type === 'bar') {
                data.element.attr({
                    style: 'stroke-width: 30px'
                });
            }
        });


        // notification popup
        // toastr.options.closeButton = true;
        // toastr.options.positionClass = 'toast-bottom-right';
        // toastr.options.showDuration = 1000;
        // toastr['info']('Hello, welcome to DiffDash, a unique admin dashboard.');

    });
</script>
</body>

</html>