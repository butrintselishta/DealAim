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
		$_SESSION['prep_stmt_error'] = ""; 
        header("location:index.php"); die();
	}

    //add new add_who
    if(isset($_POST['add_who'])){
        $img_pos = $_POST['about_img_pos'];
        $title = $_POST['about_title'];
        $desc_lead = $_POST['about_desc_lead'];
        $desc = $_POST['about_desc'];
        $layout = $_POST['layout']; 
        if(is_uploaded_file($_FILES['about_img_1']['tmp_name'])) {
            $pic = $_FILES['about_img_1'];
            $picname = "about_img_1" . uniqid(); //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $basename   = $picname . "." . $imageFileType; 
            $target_dir = "../img/{$basename}"; //lokacioni, folderi ku me i bo move fotot
            $check = getimagesize($pic["tmp_name"]);

            if ($check == false) {
                $_SESSION['pic_error'] = "Pranohen vetem fotografitë, jo file tjera!"; header("location:menage_about.php?add_about"); die();
            }
            if ($pic['size'] > 3000000) {
                $_SESSION['pic_error'] = "Foto është shumë e madhe!"; header("location:menage_about.php?add_about"); die();
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['pic_error'] = "Pranohen vetem fotografitë në formatin JPG, JPEG dhe PNG!"; header("location:menage_about.php?add_about"); die();
            }
            $source = $pic["tmp_name"];
        }
        if(empty($img_pos) || !is_uploaded_file($_FILES['about_img_1']['tmp_name']) || empty($title) || empty($desc_lead) || empty($desc) || empty($layout)){
            $_SESSION['empty_error'] = "";
            header("location:menage_about.php?add_about"); die();
        }
        else{
            if (is_uploaded_file($_FILES['about_img_1']['tmp_name'])) {
                if (file_exists($target_dir)) {
                unlink($target_dir); //nese foto ekziston me ate emer, fshije
                move_uploaded_file($source, $target_dir); //ngarko foton e re
                } else {
                move_uploaded_file($source, $target_dir); //nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                }
            }
            if(!prep_stmt("INSERT INTO about (about_img,about_img_pos, about_title, about_desc_lead, about_desc, about_layout) VALUES (?,?,?,?,?,?)", array($basename,$img_pos,$title, $desc_lead, $desc, $layout), "ssssss")){
                $_SESSION['prep_stmt_error'] = ""; 
                header("location:menage_about.php"); die();
            }else{
                $_SESSION['data_add_success'] = "";
                header("location:menage_about.php");die();
            }
        }
    }
    //add new add_why
    if(isset($_POST['add_why'])){
        $img = $_POST['about_img'];
        $title = $_POST['about_title'];
        $desc = $_POST['about_desc'];
        $layout = $_POST['layout'];
        //die($img . " " . $title . " " . $desc . " " . $layout);

        if(empty($img) || empty($title) || empty($desc) || empty($layout)){
            $_SESSION['pic_error'] = "";
            header("location:menage_about.php?add_about"); die();
        }else{
            if(!prep_stmt("INSERT INTO about (about_img, about_title, about_desc, about_layout) VALUES (?,?,?,?)", array($img,$title, $desc, $layout), "ssss")){
                $_SESSION['prep_stmt_error'] = ""; 
                header("location:menage_about.php"); die();
            }else{
                $_SESSION['data_add_success'] = "";
                header("location:menage_about.php");die();
            }
        }
    }

    //delete_cat
    if(isset($_GET['delete_about'])){
        $delete_id = $_GET['delete_about'];
        if(!prep_stmt("DELETE FROM about WHERE about_id = ?", $delete_id, "i")){
            $_SESSION['prep_stmt_error'] = ""; 
            header("location:menage_about.php"); die();
        }else{
            $_SESSION['data_deleted_success'] = "";
            header("location:menage_about.php");die();
        }
    }

    //edit_who_about
    if(isset($_POST['edit_who'])){
        $id = $_POST['id'];
        $img_pos = $_POST['about_img_pos'];
        $title = $_POST['about_title'];
        $desc_lead = $_POST['about_desc_lead'];
        $desc = $_POST['about_desc'];

        $sel_edit = prep_stmt("SELECT * FROM about WHERE about_id = ?", $id, "i");
        if(mysqli_num_rows($sel_edit) > 0){
            while($row_edit_e = mysqli_fetch_array($sel_edit)){
                $edit_about_id = $row_edit_e['about_id'];
                $edit_about_img_pos = $row_edit_e['about_img_pos'];
                $edit_about_title = $row_edit_e['about_title'];
                $edit_about_d_lead = $row_edit_e['about_desc_lead'];
                $edit_about_desc = $row_edit_e['about_desc'];
                $edit_about_layout = $row_edit_e['about_layout'];
            }
        }
        if(empty($img_pos) || empty($title) || empty($desc_lead) || empty($desc)){
            $_SESSION['empty_error_edit'] = "";
            header("location:menage_about.php?edit_about=$id#edit_about"); die();
        }elseif($edit_about_img_pos == $img_pos && $edit_about_title == $title && $edit_about_d_lead == $desc_lead && trim($edit_about_desc) == trim($desc) && !is_uploaded_file($_FILES['about_img']['tmp_name'])){
            $_SESSION['no_changes_d'] = "";
            header("location:menage_about.php"); die();
        }else {
            if(is_uploaded_file($_FILES['about_img']['tmp_name'])) {
                $pic = $_FILES['about_img'];
                $picname = "about_img" . uniqid(); //emri i produktit: lea_1 psh
                $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
                $basename   = $picname . "." . $imageFileType; 
                $target_dir = "../img/{$basename}"; //lokacioni, folderi ku me i bo move fotot
                $check = getimagesize($pic["tmp_name"]);
    
                if ($check == false) {
                    $_SESSION['pic_error'] = "Pranohen vetem fotografitë, jo file tjera!"; header("location:menage_about.php?edit_about=$id#edit_about"); die();
                }
                if ($pic['size'] > 3000000) {
                    $_SESSION['pic_error'] = "Foto është shumë e madhe!"; header("location:menage_about.php?edit_about=$id#edit_about"); die();
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $_SESSION['pic_error'] = "Pranohen vetem fotografitë në formatin JPG, JPEG dhe PNG!"; header("location:menage_about.php?edit_about=$id#edit_about"); die();
                }
                $source = $pic["tmp_name"];

                if (is_uploaded_file($_FILES['about_img']['tmp_name'])) {
                    if (file_exists($target_dir)) {
                    unlink($target_dir); //nese foto ekziston me ate emer, fshije
                    move_uploaded_file($source, $target_dir); //ngarko foton e re
                    } else {
                    move_uploaded_file($source, $target_dir); //nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                    }
                }

                if(!prep_stmt("UPDATE about SET about_img=?,about_img_pos=?, about_title=?, about_desc_lead = ?, about_desc=? WHERE about_id=?", array($basename,$img_pos, $title, $desc_lead, $desc, $id), "sssssi")){
                    $_SESSION['prep_stmt_error'] = ""; 
                    header("location:menage_about.php"); die();
                }else{
                    $_SESSION['data_edited'] = "";
                    header("location:menage_about.php");die();
                }
            }else{
                if(!prep_stmt("UPDATE about SET about_img_pos=?, about_title=?, about_desc_lead = ?, about_desc=? WHERE about_id=?", array($img_pos, $title, $desc_lead, $desc, $id), "ssssi")){
                    $_SESSION['prep_stmt_error'] = ""; 
                    header("location:menage_about.php"); die();
                }else{
                    $_SESSION['data_edited'] = "";
                    header("location:menage_about.php");die();
                }
            }
        }
    }
    //edit_why_about
    if(isset($_POST['edit_why'])){
        $id = $_POST['id'];
        $icon = $_POST['about_img'];
        $title = $_POST['about_title'];
        $desc = $_POST['about_desc'];
        
        $sel_edit = prep_stmt("SELECT * FROM about WHERE about_id = ?", $id, "i");
        if(mysqli_num_rows($sel_edit) > 0){
            while($row_edit_e = mysqli_fetch_array($sel_edit)){
                $edit_about_id = $row_edit_e['about_id'];
                $edit_about_img = $row_edit_e['about_img'];
                $edit_about_title = $row_edit_e['about_title'];
                $edit_about_desc = $row_edit_e['about_desc'];
            }
        }

        if(empty($icon) || empty($title) || empty($desc)){
            $_SESSION['empty_error_edit'] = "";
            header("location:menage_about.php?edit_about=$id#edit_about"); die();
        }elseif($edit_about_title == $title && $edit_about_img == $icon && trim($edit_about_desc) == trim($desc)){
            $_SESSION['no_changes_d'] = "";
            header("location:menage_about.php"); die();
        }else{
            if(!prep_stmt("UPDATE about SET about_img=?, about_title=?, about_desc=? WHERE about_id=?", array($icon, $title, $desc, $id), "sssi")){
                $_SESSION['prep_stmt_error'] = ""; 
                header("location:menage_about.php"); die();
            }else{
                $_SESSION['data_edited'] = "";
                header("location:menage_about.php");die();
            }
        }
    }
?>
<?php require "header.php"; ?>
<script src="assets/confirm/bundled.js"></script> 
<script type="text/javascript"src="assets/confirm/jquery-confirm.js"></script>
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
                    <li class="active"><a href="myprofile.php"><i class="fa fa-user-circle"></i> Profili im</a></li>
                    <li><a href="messages.php"><i class="fa fa-envelope" style="color:black;"></i> Mesazhet</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Çkyçu</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
				<li class=""><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="myprofile.php"><i class="fa fa-user-circle"></i> <span>Profili im</span></a></li>
                <?php if($_SESSION['user']['status'] == ADMIN) { ?>
                    <li><a href="finances.php"><i class="lnr lnr-chart-bars"></i> <span>Financat</span></a></li>
                    <li><a href="users.php"><i class="lnr lnr-users"></i> <span>Përdoruesit</span></a></li>
                <?php } ?>
                <li class="active"><a href="site_data.php"><i class="lnr lnr-database"></i> <span>Të dhënat</span></a></li>
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
            <div class="panel-content">
                <div class="section-heading clearfix">
                    <h2 class="section-title float-left"><i class="fa fa-pencil-square-o" style="color:black;"></i>Menaxhimi i Rreth Nesh!</h2>
                </div>
                <div class="row" id="confirmed_prod">
                    <div class="col-md-12">
                        <div class="panel-content">
                        <?php if(isset($_SESSION['data_add_success'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat e Rreth Nesh u shtuan me sukses!
                            </div>
                        <?php } unset($_SESSION['data_add_success']); ?>
                        <?php if(isset($_SESSION['data_deleted_success'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat nga Rreth Nesh u fshijn me sukses!
                            </div>
                        <?php } unset($_SESSION['data_deleted_success']); ?>
                        <?php if(isset($_SESSION['data_edited'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat për Rreth Nesh u modifikuan me sukses!
                            </div>
                        <?php } unset($_SESSION['data_edited']); ?>
                        <?php if(isset($_SESSION['no_changes_d'])){ ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-warning"></i> VËREJTJE: asnjë ndryshim nuk u bë për kategorinë përkatëse
							</div>
                        <?php } unset($_SESSION['no_changes_d']); ?>
                        <?php if(isset($_SESSION['prep_stmt_error'])){ ?>
                            <div class='alert alert-danger alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <i class='fa fa-times-circle'></i> Diçka shkoi gabim, ju lutem provoni më vonë!
                            </div>
                        <?php } unset($_SESSION['prep_stmt_error']); ?>
                            <h3 class="heading"> </h3>
                            <div class="row" style="margin-bottom:20px;">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <?php
                                        $sel_about_search = "";
                                        if(isset($_GET['about_s'])){
                                            $about_search = $_GET['about_s'];
                                            $sel_about_search = prep_stmt("SELECT * FROM about WHERE about_id LIKE '%$about_search%' OR about_title LIKE '%$about_search%' OR about_img LIKE '%$about_search%' OR about_desc_lead LIKE '%$about_search%' OR about_desc LIKE '%$about_search%'  OR about_img_pos LIKE '%$about_search%' OR about_layout LIKE '%$about_search%' ", null, null);
                                        }elseif(isset($_GET['order_about'])){
                                            $about_order = $_GET['order_about'];
                                            if($about_order == "who"){
                                                $sel_about_search = prep_stmt("SELECT * FROM about WHERE about_layout=?", "kush_jemi_ne", "s");
                                            }else if($about_order == "why"){
                                                $sel_about_search = prep_stmt("SELECT * FROM about WHERE about_layout=?", "pse_ne", "s");
                                            }else if($about_order == "all"){
                                                $sel_about_search = prep_stmt("SELECT * FROM about", null, null);
                                            }
                                        }else{
                                            $sel_about_search = prep_stmt("SELECT * FROM about", null, null);
                                        }
                                    ?>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <form method='get' action='menage_about.php' id="navbar-search" class="navbar-form search-form" style="margin-left:0;">
                                            <input value="" class="form-control" name="about_s" placeholder="Kërko këtu..." type="text" <?php if(isset($_GET['about_s'])){ echo "style='background-color:#ffdd91;'";}?>>
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12" style="text-align:center">
                                        <a href="menage_about.php?add_about#add_about" type="button" class="btn btn-default"><i class="fa fa-plus-square"></i> <span>Shto një të re</span></a>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <form method='get' action='menage_about.php' id="navbar-search2" class="navbar-form search-form" style="float:right;">
                                            <select class="form-control" id="order_about" name="order_about"  <?php if(isset($_GET['order_about'])){ echo "style='background-color:#ffdd91;'";}?>>
                                                <option value="all" <?php if(isset($_GET['order_about'])){if($_GET['order_about'] == "all"){echo "selected"; }} ?>> Rendit sipas layout-it... </option>
                                                <option value="who" <?php if(isset($_GET['order_about'])){if($_GET['order_about'] == "who"){echo "selected"; }} ?>> Kush jemi ne? </option>
                                                <option value="why" <?php if(isset($_GET['order_about'])){if($_GET['order_about'] == "why"){echo "selected"; }} ?>> Pse të na zgjedhni neve? </option>
                                            </select>
                                            <button type="submit" class="btn btn-default"></button>
                                        </form>
                                    </div>
                                    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="overflow:scroll;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Foto </th>
                                                <th>Vendosja foto-s </th>
                                                <th>Titulli </th>
                                                <th>Nën-titulli </th>
                                                <th>Përshkrimi</th>
                                                <th>Layout-i</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(mysqli_num_rows($sel_about_search) > 0){
                                                while($row = mysqli_fetch_array($sel_about_search)){
                                            ?>
                                            <tr id="<?php echo $row['about_id']; ?>">
                                                <td><?php echo $row['about_id']; ?></td>
                                                <td><?php echo $row['about_img']; ?></td>
                                                <td><?php if($row['about_img_pos'] == "left"){echo "Në të majt";}elseif($row['about_img_pos'] == "right"){echo "Në të djatht";} ?></td>
                                                <td><?php echo $row['about_title']; ?></td>
                                                <td><?php echo $row['about_desc_lead']; ?></td>
                                                <td><?php echo $row['about_desc']; ?></td>
                                                <td><?php if($row['about_layout'] == "kush_jemi_ne"){echo "Kush jemi ne?";}elseif($row['about_layout'] == "pse_ne"){echo "Pse të na zgjedhni neve?";} ?></td>
                                                <td>
                                                    <a href="menage_about.php?edit_about=<?php echo $row['about_id'] ?>#edit_about" class="btn btn-info btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-fw fa-edit"></i></a> 
                                                    <td>
                                                        <button type="button" id="delAbout" class="btn btn-danger example20" title="Delete"><span class="sr-only">Fshije</span> <i class="fa fa-trash-o"></i></button>
                                                    </td>
                                                </td>
                                                <script type="text/javascript">
                                                    $('.example20').on('click', function(e) {
                                                        e.preventDefault();
                                                        var trid = $(this).closest('tr').attr('id');

                                                        $.confirm({
                                                            title: 'Konfirmimi!',
                                                            content: 'Simple confirm!',
                                                            content: 'Fshirja e të dhënave e ID-së '+ trid + ' do të \'anulohet\' për 8 sekonda nëse nuk reagoni.',
                                                            autoClose: 'cancel|8000',
                                                            buttons: {
                                                                confirm:{
                                                                    text: 'Fshije',
                                                                    btnClass: 'btn-red',
                                                                    keys: ['enter', 'shift'],
                                                                    action: function(){
                                                                        window.location.replace("<?php echo "menage_about.php?delete_about=" ?>"+trid);
                                                                    }
                                                                },
                                                                cancel:{
                                                                    text: 'Anulo',
                                                                    keys: ['enter', 'shift'],
                                                                    action: function(){
                                                                        $.alert('Fshirja e të dhënave të ID-së ' + trid + ' u anulua!');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </tr>
                                            
                                            <?php } }?>
                                            <script>
                                                document.getElementById("order_about").onchange = function () {
                                                        var searchUsers = document.getElementById("order_about");
                                                        document.getElementById("navbar-search2").submit();
                                                }
                                            </script>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if(isset($_GET['add_about'])){ ?>
                            <div class="row" style="border: 1px solid #ddd" id="add_about"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Shto një të dhënë të re!</h3>
                                </div>
                                <?php if(isset($_SESSION['pic_error'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> <?php echo $_SESSION['pic_error']; ?>
                                    </div>
                                <?php }  unset($_SESSION['pic_error']); ?>
                                <?php if(isset($_SESSION['empty_error'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> Ju lutem mbushini të gjitha fushat e kërkuara!
                                    </div>
                                <?php } ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Titulli</label>
                                            </div>
                                            <div class="col-md-6">
                                                 <select class="form-control" id="layout" name="footer_layout" required data-parsley-minlength="1" onchange="select_layout();">
                                                    <option value=""> Zgjedh llojin e të dhënës... </option>
                                                    <option value="kush_jemi_ne"> Kush jemi ne? </option>
                                                    <option value="pse_ne">Pse të na zgjedhni neve? </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 8rem;"> </div>
                                    <!-- KUSH JEMI NE -->
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_about.php?add_about" enctype="multipart/form-data">
                                    <div id="div_who" style="display:none;">
                                        <input value="kush_jemi_ne" name="layout" type="hidden">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Foto</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" id="text-input1" name="about_img_1"  class="form-control float-left" required  data-parsley-minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Pozicionimi i fotos</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="about_img_pos" name="about_img_pos" required data-parsley-minlength="1" >
                                                        <option value=""> Zgjedh pozicionimin... </option>
                                                        <option value="left"> Në të majt </option>
                                                        <option value="right">Në të djatht </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Titulli</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_title"  class="form-control float-left" required  data-parsley-minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Nën titulli</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_desc_lead"  class="form-control float-left" required  data-parsley-minlength="5">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Përshkrimi</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea rows="5" id="text-input1" name="about_desc"  class="form-control float-left" required  data-parsley-minlength="30"> </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="text-center btn_center" style="margin-bottom:20px;margin-top:20px;">
                                                <button type="submit" name="add_who"  value="Shto" class="btn btn-primary ">Shto</button>
                                            </div>
                                        </div>
                                    </div>  
                                </form>
                                    <!-- PSE NEVE -->
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_about.php?add_about">
                                <div id="div_why" style="display:none;">
                                    <input value="pse_ne" name="layout" type="hidden">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Emri ikonës</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_img"  class="form-control float-left" required  data-parsley-minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Titulli</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_title"  class="form-control float-left" required  data-parsley-minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Përshkrimi</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea rows="2" id="text-input1" name="about_desc"  class="form-control float-left" required  data-parsley-minlength="15"> </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="text-center btn_center" style="margin-bottom:20px;margin-top:20px;">
                                                <button type="submit" name="add_why"  value="Shto" class="btn btn-primary ">Shto</button>
                                            </div>
                                        </div>
                                    </div>  
                                </form>
                                <?php unset($_SESSION['empty_error']);?>
                            </div>
                           <?php } ?>

                           <!-- EDIT SUB/CATEGORY -->
                            <?php 
                            if(isset($_GET['edit_about'])){ 
                                $sel_about_edit = prep_stmt("SELECT * FROM about WHERE about_id = ?", $_GET['edit_about'], "i");
                                if(mysqli_num_rows($sel_about_edit) > 0){
                                    while($row_edit = mysqli_fetch_array($sel_about_edit)){
                                        $row_about_id = $row_edit['about_id'];
                                        $row_about_img = $row_edit['about_img'];
                                        $row_about_img_pos = $row_edit['about_img_pos'];
                                        $row_about_title = $row_edit['about_title'];
                                        $row_about_d_lead = $row_edit['about_desc_lead'];
                                        $row_about_desc = $row_edit['about_desc'];
                                        $row_about_layout = $row_edit['about_layout'];
                                    }
                                }
                            ?>
                            <div class="row" style="border: 1px solid #ddd" id="edit_about"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Edito të dhënat e fundit të faqes: <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>ID - <?php echo $row_about_id; ?></b></h3>
                                </div>
                                <?php if(isset($_SESSION['pic_error'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> <?php echo $_SESSION['pic_error']; ?>
                                    </div>
                                <?php }  unset($_SESSION['pic_error']); ?>
                                <?php if(isset($_SESSION['empty_error_edit'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> Ju lutem mbushini të gjitha fushat e kërkuara!
                                    </div>
                                <?php } ?>
                                <?php if($row_about_layout == "kush_jemi_ne"){ ?>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_about.php?edit_about" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Foto</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" id="text-input1" name="about_img" value="<?php echo $row_about_img ?>"  class="form-control float-left">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Pozicionimi i fotos</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="about_img_pos" name="about_img_pos" required data-parsley-minlength="1" >
                                                        <option value=""> Zgjedh pozicionimin... </option>
                                                        <option value="left" <?php if($row_about_img_pos == "left"){ echo "selected";} ?>> Në të majt </option>
                                                        <option value="right" <?php if($row_about_img_pos == "right"){ echo "selected";} ?>>Në të djatht </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Titulli</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_title" value="<?php echo $row_about_title ?>"    class="form-control float-left" required  data-parsley-minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Nën titulli</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_desc_lead" value="<?php echo $row_about_d_lead ?>"    class="form-control float-left" required  data-parsley-minlength="5">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Përshkrimi</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea rows="5" id="text-input1" name="about_desc" class="form-control float-left" required  data-parsley-minlength="30"> <?php echo $row_about_desc ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="text-center btn_center" style="margin-bottom:20px;margin-top:20px;">
                                                <input type="hidden" name="id" value="<?php echo $row_about_id; ?>">
                                                <button type="submit" name="edit_who"  value="Ndrysho" class="btn btn-primary ">Shto</button>
                                            </div>
                                        </div>
                                    </div>  
                                </form>
                                    <!-- PSE NEVE -->
                                <?php } elseif($row_about_layout == "pse_ne"){ ?>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_about.php?edit_about">
                                <div id="div_why_edit">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Emri ikonës</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_img"  class="form-control float-left" value="<?php echo $row_about_img ?>" required  data-parsley-minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Titulli</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="text-input1" name="about_title" value="<?php echo $row_about_title ?>"  class="form-control float-left" required  data-parsley-minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="text-input1" style="float:right;">Përshkrimi</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea rows="2" id="text-input1" name="about_desc"  class="form-control float-left" required  data-parsley-minlength="15"> <?php echo $row_about_desc ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider" style="padding-top: 5rem;"> </div>
                                        <div class="col-md-12">
                                            <div class="text-center btn_center" style="margin-bottom:20px;margin-top:20px;">
                                                <input type="hidden" value="<?php echo $row_about_id ?>" name="id">
                                                <button type="submit" name="edit_why"  value="Ndrysho" class="btn btn-primary ">Shto</button>
                                            </div>
                                        </div>
                                    </div>  
                                </form>
                                <?php } ?>
                                <?php unset($_SESSION['empty_error_edit']);?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
<script>
    function select_layout(){
        var layout = document.getElementById("layout").value;
        console.log(layout);
        if(layout == "kush_jemi_ne"){
            document.getElementById("div_who").style.display = "block";
            document.getElementById("div_why").style.display = "none";
            document.getElementById("layout").style.borderColor = "rgb(123 195 61);";
            document.getElementById("layout").style.background = "#DFF0D8";
        }else if(layout == "pse_ne"){
            document.getElementById("div_why").style.display = "block";
            document.getElementById("div_who").style.display = "none";
            document.getElementById("layout").style.borderColor = "rgb(123 195 61);";
            document.getElementById("layout").style.background = "#DFF0D8";
        }else{
            document.getElementById("div_why").style.display = "none";
            document.getElementById("div_who").style.display = "none";
            document.getElementById("layout").style.borderColor = "#efd8d8";
            document.getElementById("layout").style.background = "#fbf5f5";
        }
    }

</script>

<!-- <script src="assets/vendor/jquery/jquery.min.js"></script> -->
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
<script src="assets/vendor/markdown/markdown.js"></script>
<script src="assets/vendor/to-markdown/to-markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
</body>

</html>