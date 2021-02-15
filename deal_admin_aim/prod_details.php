<?php 
require_once '../db.php'; 
    if(!isset($_SESSION['logged']) && $_SESSION['user']['status'] !== MODERATOR || $_SESSION['user']['status'] !== ADMIN){
        header("location:../index.php");
    }
    if(!isset($_GET['prod_det'])){
        header("location:index.php");
    }else{
        $prod_id = $_GET['prod_det'];
        $sel_uniqueid = prep_stmt("SELECT prod_unique_id FROM products WHERE prod_id = ?", $prod_id, "i");
        if(mysqli_num_rows($sel_uniqueid) > 0 ){
            $sel_uniqueid_fetch = mysqli_fetch_array($sel_uniqueid);
            $unique_id = $sel_uniqueid_fetch['prod_unique_id'];
        }else{
            header("location:index.php");
        }
        //SELECT Product 
        $stmt_prod = prep_stmt("SELECT prod_id,prod_img, prod_title, prod_price, prod_from, prod_to, prod_description, cat_title, username, prod_isApproved FROM products LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id LEFT OUTER JOIN users ON products.user_id = users.user_id WHERE prod_unique_id = ?", $unique_id, 's');

        while($prod_fetch = mysqli_fetch_array($stmt_prod)){
            $prod_id = $prod_fetch['prod_id'];
            $prod_img = $prod_fetch['prod_img'];
            $prod_title = $prod_fetch['prod_title'];
            $prod_price = $prod_fetch['prod_price'];
            $prod_from = $prod_fetch['prod_from'];
            $prod_to = $prod_fetch['prod_to'];
            $prod_desc = $prod_fetch['prod_description'];
            $prod_cat_title = $prod_fetch['cat_title'];
            $prod_username = $prod_fetch['username'];
            $prod_isApproved = $prod_fetch['prod_isApproved'];
        }
        //SELECT  Product SPECIFICATIONS
        $stmt_prod_spec = prep_stmt("SELECT * FROM prod_specifications WHERE prod_unique_id = ?", $unique_id,'s');
        $spec_1 = ""; $spec_2 = ""; $spec_3 = ""; $spec_4 = ""; $spec_5 = ""; $spec_6 = ""; $spec_7 = ""; $spec_8 = ""; $spec_9 = ""; $spec_10 = "";
        while($spec_fetch = mysqli_fetch_array($stmt_prod_spec)){
            if($prod_cat_title == "Laptop"){
                $spec_1 = $spec_fetch['lap_man'];
                $spec_2 = $spec_fetch['lap_mod'];
                $spec_3 = $spec_fetch['lap_con'];
                $spec_4 = $spec_fetch['lap_dia'];
                $spec_5 = $spec_fetch['lap_col'];
                $spec_6 = $spec_fetch['lap_proc'];
                $spec_7 = $spec_fetch['lap_ram'];
                $spec_8 = $spec_fetch['lap_im'];
                $spec_9 = $spec_fetch['lap_ims'];
                $spec_10 = $spec_fetch['lap_gc'];
            }else if($prod_cat_title == "Telefon"){
                $spec_1 = $spec_fetch['tel_man'];
                $spec_2 = $spec_fetch['tel_mod'];
                $spec_3 = $spec_fetch['tel_cond'];
                $spec_4 = $spec_fetch['tel_col'];
                $spec_5 = $spec_fetch['tel_im'];
                $spec_6 = $spec_fetch['tel_ram'];
                $spec_7 = $spec_fetch['tel_scn'];
                $spec_8 = $spec_fetch['tel_os'];
                $spec_9 = $spec_fetch['tel_op'];
            }else if($prod_cat_title == "Vetura"){
                $spec_1 = $spec_fetch['car_man'];
                $spec_2 = $spec_fetch['car_mod'];
                $spec_3 = $spec_fetch['car_km'];
                $spec_4 = $spec_fetch['car_py'];
                $spec_5 = $spec_fetch['car_type'];
                $spec_6 = $spec_fetch['car_col'];
                $spec_7 = $spec_fetch['car_tra'];
                $spec_8 = $spec_fetch['car_fu'];
                $spec_9 = $spec_fetch['car_cub'];
            }
        }

        //action
        if(isset($_POST['confirm'])){
            $prod_title_pos = $_POST['prod_title'];
            $prod_price_pos = floatval(str_replace(" €", "", $_POST['prod_price']));
            $prod_from_pos = date("Y-m-d h:i:s", strtotime($_POST['prod_from']));
            $prod_to_pos = date("Y-m-d h:i:s", strtotime($_POST['prod_to']));
            $prod_desc_pos = $_POST['prod_desc']; //die($prod_from . '<br/>'. $prod_to . '<br/>' . $prod_desc);
            $prod_isApproved_pos = $_POST['confirmation'];
           
            $today = date("Y-m-d H:i:s");
            $prod_from_upd = ""; $prod_to_upd = "";
            if($prod_from_pos < $today){
                $prod_from_upd = date("Y-m-d 12:00:00", strtotime("+1 day"));
                $prod_to_upd = date("Y-m-d h:i:s",strtotime($prod_to_pos . "+1 day"));
            }else{
                $prod_from_upd = $prod_from_pos;
                $prod_to_upd = $prod_to_pos;
            }
            
            if($prod_cat_title == "Laptop"){
                $lap_man = $_POST['lap_man'];
                $lap_mod = $_POST['lap_mod'];
                $lap_con = $_POST['lap_con'];
                $lap_dis = $_POST['lap_dis'];
                $lap_col = $_POST['lap_col'];
                $lap_proc = $_POST['lap_proc'];
                $lap_ram = $_POST['lap_ram'];
                $lap_im = $_POST['lap_im'];
                $lap_ims = $_POST['lap_ims'];
                $lap_gc = $_POST['lap_gc'];
                
                if($prod_title == $prod_title_pos && $prod_price == $prod_price_pos && $prod_desc == $prod_desc_pos && $spec_1 == $lap_man && $spec_2 == $lap_mod && $spec_3 == $lap_con && $spec_4 == $lap_dis && $spec_5 == $lap_col && $spec_6 == $lap_proc && $spec_7 == $lap_ram && $spec_8 == $lap_im && $spec_9 == $lap_ims && $spec_10 == $lap_gc){
                    if(!prep_stmt("UPDATE products SET prod_from = ?, prod_to = ?, prod_isApproved = ? WHERE prod_id = ?", array($prod_from_upd, $prod_to_upd, $prod_isApproved_pos, $prod_id), "ssii")){
                        $_SESSION['data_not_changed'] = "";
                        header("location:".$_SERVER['HTTP_REFERER']); die();
                    }else{
                        $_SESSION['data_changed'] ="";
                        header("location:index.php"); die();
                    }
                }
                else{
                    if(!prep_stmt("UPDATE products SET prod_from = ?, prod_to = ?, prod_isApproved = ? WHERE prod_id = ?", array($prod_from_upd, $prod_to_upd, $prod_isApproved_pos, $prod_id), "ssii")){
                        $_SESSION['data_not_changed'] = "";
                        header("location:".$_SERVER['HTTP_REFERER']); die();
                    }else{
                        $_SESSION['data_changed'] ="";
                        header("location:index.php"); die();
                    }
                }

            }
        }
    }
?>
<?php require "header.php"; ?>
<div id="left-sidebar" class="sidebar">
    <button type="button" class="btn btn-xs btn-link btn-toggle-fullwidth">
				<span class="sr-only">Toggle Fullwidth</span>
				<i class="fa fa-angle-left"></i>
			</button>
    <div class="sidebar-scroll">
        <div class="user-account">
            <?php
                $username = $_SESSION['user']['username']; 
                $stmt = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");
                if(mysqli_num_rows($stmt) > 0){
                    $row_adm = mysqli_fetch_array($stmt);
                    $profile_pic = $row_adm['profile_pic'];
                }
                else{
                    $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
                }
            ?>
            <img src="../img/profile_pictures/<?php echo $row_adm['profile_pic']; ?>" class="img-responsive img-circle user-photo" alt="User Profile Picture" style="width:80%; height:20rem;">
            <div class="dropdown">
            <a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Përshëndetje, <strong><?php echo $row_adm['first_name'] . " ". $row_adm['last_name']; ?></strong> <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">Messages</a></li>
                    <li><a href="#">Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
				<li class="active"><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li class=""><a href="myprofile.php"><i class="lnr lnr-user"></i> <span>Profili im</span></a></li>
            </ul>
        </nav>
    </div>
</div>

<div id="main-content">
    <div class="container-fluid">
        <div class="section-heading">
            <h1 class="page-title">Të dhënat për produktin: <b><?php echo $unique_id; ?></b></h1>
        </div>
        <div class="row">
            <div class="profile-section" style="padding: 0 12px;">
                <?php if(isset($_SESSION['data_not_changed'])){ ?>
                <div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Diçka shkoi gabim, ju lutem provoni më vonë
                </div>
                <?php } unset($_SESSION['data_not_changed']); ?>
                <div class="media">
                    <div class="medial">
                        <?php 
                            $pics = ""; 
                            $pics = explode("|", $prod_img);
                        ?>
                        <?php 
                        $category = "";
                        if($prod_cat_title == "Laptop"){
                            $category = "laptops";
                        }else if($prod_cat_title == "Telefon"){
                            $category = "phones";
                        }else if($prod_cat_title == "Vetura"){
                            $category = "cars";
                        }

                        if(count($pics) == 3){
                            echo  "<a href='../img/products/$category/".$pics[0]."' target='_blank'><img src='../img/products/$category/".$pics[0]."'  class='rounded float-left img-res' alt='User' style='width:33%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[1]."' target='_blank'><img src='../img/products/$category/".$pics[1]. "'  class='rounded float-left img-res' alt='User' style='width:33%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[2]."' target='_blank'><img src='../img/products/$category/".$pics[2]. "'  class='rounded float-left img-res' alt='User' style='width:33%; height:20rem; object-fit: contain;'></a>";
                        }elseif(count($pics) == 4){
                            echo  "<a href='../img/products/$category/".$pics[0]."' target='_blank'><img src='../img/products/$category/".$pics[0]."'  class='rounded float-left img-res' alt='User' style='width:25%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[1]."' target='_blank'><img src='../img/products/$category/".$pics[1]. "'  class='rounded float-left img-res' alt='User' style='width:25%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[2]."' target='_blank'><img src='../img/products/$category/".$pics[2]. "'  class='rounded float-left img-res' alt='User' style='width:25%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[3]."' target='_blank'><img src='../img/products/$category/".$pics[3]. "'  class='rounded float-left img-res' alt='User' style='width:25%; height:20rem; object-fit: contain;'></a>";
                        }else{
                            echo  "<a href='../img/products/$category/".$pics[0]."' target='_blank'><img src='../img/products/$category/".$pics[0]."'  class='rounded float-left img-res' alt='User' style='width:20%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[1]."' target='_blank'><img src='../img/products/$category/".$pics[1]. "'  class='rounded float-left img-res' alt='User' style='width:20%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[2]."' target='_blank'><img src='../img/products/$category/".$pics[2]. "'  class='rounded float-left img-res' alt='User' style='width:20%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[3]."' target='_blank'><img src='../img/products/$category/".$pics[3]. "'  class='rounded float-left img-res' alt='User' style='width:20%; height:20rem; object-fit: contain;'></a>";
                            echo  "<a href='../img/products/$category/".$pics[4]."' target='_blank'><img src='../img/products/$category/".$pics[4]. "'  class='rounded float-left img-res' alt='User' style='width:20%; height:20rem; object-fit: contain;'></a>";
                        }
                    ?>
                    </div>
                </div>
                <hr>
                <div class="col-md-4">
                    <div class="panel-content" style="padding-top:0;">
                        <small class="text-muted text-right"> Kërkesa u bë nga: <small class="text-primary text-right" style="font-size:18px; font-weight:800;"><?php echo $username; ?></small> </small>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <div class="panel-content" style="padding-top:0;">
                    <small class="text-muted text-right"> Kategoria: <small class="text-primary text-right" style="font-size:18px; font-weight:800;"><?php echo $prod_cat_title; ?></small> </small>
                    </div>
                </div>
                <div class="col-md-5 text-right">
                    <div class="panel-content" style="padding-top:0;">
                    <small class="text-muted text-right"> Kërkesa u bë më: <small class="text-primary text-right" style="font-size:18px; font-weight:800;"><?php echo date("d-M-Y H:i:s A", strtotime($prod_from)); ?></small> </small>
                    </div>
                </div>
                <div class="col-md-12"> <hr> </div>
                <!-- te dhenat -->
                <form id="advanced-form" data-parsley-validate novalidate method="post" action="">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Titulli i ankandit</label>
                            <input type="text" id="text-input1" class="form-control" name="prod_title" value="<?php echo $prod_title;?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input2">Çmimi fillestar</label>
                            <input type="text" id="text-input2" name="prod_price" class="form-control" value="<?php echo $prod_price . " €" ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Dalja produktit në ankand</label>
                            <input type="text" id="text-input1" name="prod_from" value="<?php echo date("d-M-Y H:i A", strtotime($prod_from)); ?>" readonly class="form-control" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="text-input1">Përfundimi i ankandit për këtë produkt</label>
                            <input type="text" id="text-input1" name="prod_to" value="<?php echo date("d-M-Y H:i A", strtotime($prod_to)); ?>" class="form-control" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel-content" style="padding:0 0 15px 0">
                            <label> Përshkrimi </label>
                            <textarea class="note-codable" id="markdown-editor" name="prod_desc" value="" name="markdown-content" data-provide="markdown" rows="10"><?php echo $prod_desc;?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel-content" >
                            <h2 class="heading text-center">Specifikat e produktit</h2>
                        </div>
                    </div>
                    <?php if($prod_cat_title == "Laptop"){ ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Prodhuesi</label>
                            <input type="text" id="text-input1" name="lap_man" value="<?php echo $spec_1; ?>" class="form-control" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Modeli</label>
                            <input type="text" id="text-input1" name="lap_mod" value="<?php echo $spec_2; ?>" class="form-control" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Gjendja</label>
                            <input type="text" id="text-input1" name="lap_con" value="<?php echo $spec_3; ?>" class="form-control" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Diagonalja e ekranit</label>
                            <input type="text" id="text-input1" name="lap_dis" value="<?php echo $spec_4; ?>" class="form-control" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Ngjyra</label>
                            <input type="text" id="text-input1" name="lap_col" value="<?php echo $spec_5; ?>"class="form-control" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Procesori</label>
                            <input type="text" id="text-input1" name="lap_proc" value="<?php echo $spec_6; ?>" class="form-control" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Memorja RAM</label>
                            <input type="text" id="text-input1" name="lap_ram" value="<?php echo $spec_7; ?>" class="form-control" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Memorja e mbrendshme</label>
                            <input type="text" id="text-input1" name="lap_im" value="<?php echo $spec_8; ?>" class="form-control" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Hapsira e memorjes së mbrendshme</label>
                            <input type="text" id="text-input1"name="lap_ims" value="<?php echo $spec_9; ?>" class="form-control" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Kartela grafike</label>
                            <input type="text" id="text-input1" name="lap_gc" value="<?php echo $spec_10; ?>" class="form-control" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <?php }else if($prod_cat_title == "Telefon") { ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Prodhuesi</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_man" value="<?php echo $spec_1; ?>" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Modeli</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_mod" value="<?php echo $spec_2; ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Gjendja </label>
                            <input type="text" id="text-input1" class="form-control" name="tel_con" value="<?php echo $spec_3; ?>" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Ngjyra</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_col" value="<?php echo $spec_4; ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Memorja e mbrendshme</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_im" value="<?php echo $spec_5; ?>"required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Memorja RAM</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_ram" value="<?php echo $spec_6; ?>"required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Numri i SIM kartelave</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_sim" value="<?php echo $spec_7; ?>"required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Sistemi Operativ</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_os" value="<?php echo $spec_8; ?>"required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="text-input1">Vendi i prodhimit</label>
                            <input type="text" id="text-input1" class="form-control" name="tel_op" value="<?php echo $spec_9; ?>"required data-parsley-minlength="1">
                        </div>
                    </div>
                    <?php }else if($prod_cat_title == "Vetura"){ ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Prodhuesi</label>
                            <input type="text" id="text-input1" class="form-control" name="car_man" value="<?php echo $spec_1; ?>" required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Modeli</label>
                            <input type="text" id="text-input1" class="form-control" name="car_mod" value="<?php echo $spec_2; ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Kilometrazha </label>
                            <input type="text" id="text-input1" class="form-control" name="car_km" value="<?php echo $spec_3; ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Viti i prodhimit</label>
                            <input type="text" id="text-input1" class="form-control" name="car_col" value="<?php echo $spec_4; ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Lloji</label>
                            <input type="text" id="text-input1" class="form-control" name="car_type" value="<?php echo $spec_5; ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Ngjyra</label>
                            <input type="text" id="text-input1" class="form-control" name="car_col" value="<?php echo $spec_6; ?>"required data-parsley-minlength="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Transmisioneri</label>
                            <input type="text" id="text-input1" class="form-control" name="car_trans" value="<?php echo $spec_7; ?>"required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text-input1">Karburanti </label>
                            <input type="text" id="text-input1" class="form-control" name="car_fuels" value="<?php echo $spec_8; ?>"required data-parsley-minlength="1" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="text-input1">Kubikazha</label>
                            <input type="text" id="text-input1" class="form-control" name="car_cub" value="<?php echo $spec_9; ?>" required data-parsley-minlength="1">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <label for="text-input1">Konfirmimi</label>
                            <select class="form-control text-center" name="confirmation" required data-parsley-minlength="1">
                                <option value="">Zgjidh konfirmimin...</option>
                                <option value="1" class="text-success">Prano</option>
                                <option value="2" class="text-danger">Refuzo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center btn_center" style="margin-bottom:20px;">
                            <button type="submit" name="confirm"  value="Vazhdo" class="btn btn-primary ">Konfirmo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <!-- <div class="col-md-6">
                <div class="panel-content">
                    <h2 class="heading"><i class="fa fa-square"></i> Advanced Validation</h2>
                    <form id="advanced-form" data-parsley-validate novalidate>
                        <div class="form-group">
                            <label for="text-input1">Min. 8 Characters</label>
                            <input type="text" id="text-input1" class="form-control" required data-parsley-minlength="8">
                        </div>
                        <div class="form-group">
                            <label for="text-input2">Between 5-10 Characters</label>
                            <input type="text" id="text-input2" class="form-control" required data-parsley-length="[5,10]">
                        </div>
                        <div class="form-group">
                            <label for="text-input3">Min. Number ( >= 5 )</label>
                            <input type="text" id="text-input3" class="form-control" required data-parsley-min="5">
                        </div>
                        <div class="form-group">
                            <label for="text-input4">Between 20-30</label>
                            <input type="text" id="text-input4" class="form-control" required data-parsley-range="[20,30]">
                        </div>
                        <div class="form-group">
                            <label>Select Min. 2 Options</label>
                            <br />
                            <label class="control-inline fancy-checkbox">
                                <input type="checkbox" name="checkbox2" required data-parsley-mincheck="2" data-parsley-errors-container="#error-checkbox2">
                                <span>Option 1</span>
                            </label>
                            <label class="control-inline fancy-checkbox">
                                <input type="checkbox" name="checkbox2">
                                <span>Option 2</span>
                            </label>
                            <label class="control-inline fancy-checkbox">
                                <input type="checkbox" name="checkbox2">
                                <span>Option 3</span>
                            </label>
                            <p id="error-checkbox2"></p>
                        </div>
                        <div class="form-group">
                            <label>Select Between 1-2 Options</label>
                            <br />
                            <label class="control-inline fancy-checkbox">
                                <input type="checkbox" name="checkbox3" required data-parsley-check="[1,2]" data-parsley-errors-container="#error-checkbox3">
                                <span>Option 1</span>
                            </label>
                            <label class="control-inline fancy-checkbox">
                                <input type="checkbox" name="checkbox3">
                                <span>Option 2</span>
                            </label>
                            <label class="control-inline fancy-checkbox">
                                <input type="checkbox" name="checkbox3">
                                <span>Option 3</span>
                            </label>
                            <p id="error-checkbox3"></p>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Validate</button>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>



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
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/parsleyjs/js/parsley.min.js"></script>
<script src="assets/vendor/summernote/summernote.min.js"></script>
<script src="assets/vendor/to-markdown/to-markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
<script>
$(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
<script>
    $(function() {

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
                [200, 380, 350, 480, 410, 450, 550],
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
        // toastr['info']('Përshëndetje, mirë se erdhët në pjesën administrative të Deal AIM');

    });
</script>
</body>

</html>