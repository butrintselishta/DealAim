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
		$_SESSION['prep_stmt_error'] = ""; header("location:index.php"); die();
	}


	if(isset($_POST['update_user_data'])){
		$user_usname = $_POST['username'];
		$user_pass = $_POST['password'];
		$user_fname = $_POST['fname'];
		$user_lname = $_POST['lname'];
		$user_email = $_POST['email'];
		$user_tel = $_POST['phone'];
		$user_bday =  date("Y-m-d", strtotime($_POST['bday'])); 
		$user_city = $_POST['city'];
		$user_postal = $_POST['post_code'];
		$user_address = $_POST['address'];
        if($_SESSION['user']['status'] == SELLER){
		    $user_pid = $_POST['pid'];
        }

        if(is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {
            $pic = $_FILES['profile_pic'];
            $picname = "profile_pic_" . $username; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $basename   = $picname . "." . $imageFileType; 
            $target_dir = "../img/profile_pictures/{$basename}"; //lokacioni, folderi ku me i bo move fotot
            $check = getimagesize($pic["tmp_name"]);

            if ($check == false) {
                $_SESSION['profile_pic_error'] = "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Pranohen vetem fotografitë, jo file tjera!</small>"; header("location:myprofile.php"); die();
            }
            if ($pic['size'] > 3000000) {
                $_SESSION['profile_pic_error'] = "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Foto është shumë e madhe!</small>"; header("location:myprofile.php"); die();
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['profile_pic_error'] = "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Pranohen vetem fotografitë në formatin JPG, JPEG dhe PNG!</small>"; header("location:myprofile.php"); die();
            }
            $source = $pic["tmp_name"];
        }

		if($user_usname == $username && empty($user_pass) && $user_fname == $fname && $user_lname==$lname &&	$user_email==$email && $user_tel == $tel && $user_bday == date("Y-m-d",strtotime($bday)) && $user_city == $city && $user_postal == $post_code && $user_address == $address && !is_uploaded_file($_FILES['profile_pic']['tmp_name'])){
            $_SESSION['no_changes_error'] = "<a style='color:#fff;'> Ju nuk keni ndryshuar asgjë nga të dhënat tuaja! </a>"; header("location:myprofile.php"); die();
		}else{
            
            $passwordError = false; $fnameError = false; $lnameError = false; $emailError = false; $phoneError = false; $cityError=false; $postnrError = false; $addressError = false; $bdayError = false; $pidError = false;
            $_SESSION['user_data_errors'] = array();

            if (!empty($user_pass) && strlen($user_pass) < 8) { $passwordError = true; $_SESSION['user_data_errors'] += ["passwordError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Fjalëkalimi duhet ti ketë të pakten 8 karaktere</small>"]; } elseif(!empty($user_pass) && strlen($user_pass) > 50) { $passwordError = true; $_SESSION['user_data_errors'] += ["passwordError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Fjalëkalimi mund ti ketë më së shumti 50 karaktere</small>"]; } elseif(!empty($user_pass) && !preg_match('#(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+#', $user_pass)) { $passwordError = true; $_SESSION['user_data_errors'] += ["passwordError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Fjalëkalimi nuk është i shkruar në formatin e duhur!</small>"]; } if (empty($user_fname)) { $fnameError = true; $_SESSION['user_data_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; } elseif(strlen($user_fname) < 2) { $fnameError = true; $_SESSION['user_data_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Emri është shumë i shkurtë</small>"]; } elseif(strlen($user_fname) > 15) { $fnameError = true; $_SESSION['user_data_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Emri është shumë i gjatë</small>"]; } elseif(!ctype_alpha($user_fname) && !((strpos($user_fname, 'ë')) || (strpos($user_fname, 'Ë')) || (strpos($user_fname, 'ç')) || (strpos($user_fname, 'Ç')))) { $fnameError = true; $_SESSION['user_data_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Emri duhet të jetë në rangun A-ZH</small>"]; } if (empty($user_lname)) { $lnameError = true; $_SESSION['user_data_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; } elseif(strlen($user_lname) < 2) { $lnameError = true; $_SESSION['user_data_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Mbiemri është shumë i shkurtë</small>"]; } elseif(strlen($user_lname) > 15) { $lnameError = true; $_SESSION['user_data_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Mbiemri është shumë i gjatë</small>"]; } elseif(!ctype_alpha($user_lname) && !((strpos($user_lname, 'ë')) || (strpos($user_lname, 'Ë')) || (strpos($user_lname, 'ç')) || (strpos($user_lname, 'Ç')))) { $lnameError = true; $_SESSION['user_data_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Mbiemri duhet të jetë në rangun A-ZH</small>"]; } if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) { $emailError = true; $_SESSION['user_data_errors'] += ["emailError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Email nuk është shkruar në formatin e duhur</small>"]; } if (empty($user_city)) { $cityError = true; $_SESSION['user_data_errors'] += ["cityError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; } elseif(!ctype_alpha($user_city)) { $cityError = true; $_SESSION['user_data_errors'] += ["cityError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Qyteti duhet të jetë në rangun A-ZH</small>"]; } elseif((strlen($user_city) < 4) || (strlen($user_city) > 15)) { $cityError = true; $_SESSION['user_data_errors'] += ["cityError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen 4 deri në 15 shkronja</small>"]; } if (empty($user_postal)) { $postnrError = true; $_SESSION['user_data_errors'] += ["postnrError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; } elseif(!is_numeric($user_postal)) { $postnrError = true; $_SESSION['user_data_errors'] += ["postnrError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen vetëm numra</small>"]; } elseif(strlen($user_postal) !== 5) { $postnrError = true; $_SESSION['user_data_errors'] += ["postnrError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen vetëm 5 numra</small>"]; } if (empty($user_address)) { $addressError = true; $_SESSION['user_data_errors'] += ["addressError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; }
            if($_SESSION['user']['status'] == SELLER){
                if (empty($user_pid)) {
                    $pidError = true;
                    $_SESSION['user_data_errors'] += ["pidError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"];
                }
                elseif(!is_numeric($user_pid)) {
                    $pidError = true;
                    $_SESSION['user_data_errors'] += ["pidError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen vetëm numra</small>"];
                }
                elseif(strlen($user_pid) < 8) {
                    $pidError = true;
                    $_SESSION['user_data_errors'] += ["pidError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>ID Identifikuese nuk është në formatin e duhur</small>"];
                }
                elseif(strlen($user_pid) > 16) {
                    $pidError = true;
                    $_SESSION['user_data_errors'] += ["pidError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>ID Identifikuese nuk është në formatin e duhur</small>"];
                }
            }
            if($passwordError || $fnameError || $lnameError || $emailError || $cityError || $postnrError || $addressError || $pidError){
			    header("location:myprofile.php"); die();
            }
          else{
                // if(isset($_POST['pid'])){
                //     die($user_pid);
                // }
                $password_hash = password_hash($user_pass, PASSWORD_ARGON2I); //die($password_hash);
                if (is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {
                    if (file_exists($target_dir)) {
                    unlink($target_dir); //nese foto ekziston me ate emer, fshije
                    move_uploaded_file($source, $target_dir); //ngarko foton e re
                    } else {
                    move_uploaded_file($source, $target_dir); //nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                    }
                }

                if(empty($user_pass) && empty($basename)){
                    if(isset($_POST['pid'])){
                        if(!prep_stmt("UPDATE users SET first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=?,pid_number=? WHERE user_id=?", array($user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address,$user_pid,$row_adm['user_id']), "ssssssisii")){
                            $_SESSION['prep_stmt_error'] = ""; 
                            header("location:myprofile.php"); die();
                        }else{
                            $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                        }
                    }else{
                        if(!prep_stmt("UPDATE users SET first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=? WHERE user_id=".$row_adm['user_id'], array($user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address), "ssssssis")){
                            $_SESSION['prep_stmt_error'] = ""; 
                            header("location:myprofile.php"); die();
                        }else{
                            $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                        }
                    }
                }
                elseif(empty($user_pass) && !empty($basename)){
                    if(isset($_POST['pid'])){
                        if(!prep_stmt("UPDATE users SET profile_pic=?,first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=?,pid_number=? WHERE user_id=?", array($basename, $user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address,$user_pid,$row_adm['user_id']), "sssssssisii")){
                            if($basename == $row_adm['profile_pic']){
                                $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                            }else{
                                $_SESSION['prep_stmt_error'] = ""; 
                                header("location:myprofile.php"); die();
                            }
                        }else{
                            $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                        }
                    }else{
                        if(!prep_stmt("UPDATE users SET profile_pic=?,first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=? WHERE user_id=?", array($basename, $user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address, $row_adm['user_id']), "sssssssisi")){
                            if($basename == $row_adm['profile_pic']){
                                $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                            }else{
                                $_SESSION['prep_stmt_error'] = ""; 
                                header("location:myprofile.php"); die();
                            }
                        }else{
                            $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                        }
                    }
                }elseif(!empty($user_pass) && empty($basename)){
                    if(isset($_POST['pid'])){
                        if(!prep_stmt("UPDATE users SET password=?,first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=?,pid_number=? WHERE user_id=?", array($password_hash, $user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address,$user_pid,$row_adm['user_id']), "sssssssisii")){
                            $_SESSION['prep_stmt_error'] = ""; 
                            header("location:myprofile.php"); die();
                        }else{
                            $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                        }
                    }else {
                        if(!prep_stmt("UPDATE users SET password=?,first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=? WHERE user_id=?", array($password_hash, $user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address,$row_adm['user_id']), "sssssssisi")){
                            $_SESSION['prep_stmt_error'] = ""; 
                            header("location:myprofile.php"); die();
                        }else{
                            $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                        }
                    }
                }
                else{
                    if(isset($_POST['pid'])){
                        if(!prep_stmt("UPDATE users SET password=?,profile_pic=?,first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=?,pid_number=? WHERE user_id=?", array($password_hash,$basename, $user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address,$user_pid,$row_adm['user_id']), "ssssssssisii")){
                            if($basename == $row_adm['profile_pic']){
                                $_SESSION['user_data_changed'] ="<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                            }else{
                                $_SESSION['prep_stmt_error'] = ""; 
                                header("location:myprofile.php"); die();
                            }
                        }else{
                            $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                        }
                    }else{
                        if(!prep_stmt("UPDATE users SET password=?,profile_pic=?,first_name=?,last_name=?,email=?,tel_nr=?,birthday=?,city=?,postal_code=?,address=? WHERE user_id=?", array($password_hash,$basename, $user_fname,$user_lname,$user_email,$user_tel,$user_bday,$user_city,$user_postal,$user_address,$row_adm['user_id']), "ssssssssisi")){
                            if($basename == $row_adm['profile_pic']){
                                $_SESSION['user_data_changed'] = "<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die(); 
                            }else{
                                $_SESSION['prep_stmt_error'] = ""; 
                                header("location:myprofile.php"); die();
                            }
                        }else{
                            $_SESSION['user_data_changed'] ="<a style='color:#fff;'> Të dhënat tuaja janë ndryshuar me sukses.</a>"; header("location:myprofile.php"); die();  
                        }
                    }
                }
            }
        }
	}

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
                <li class="active"><a href="myprofile.php"><i class="fa fa-user-circle"></i> <span>Profili im</span></a></li>
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
        <div class="section-heading">
            <h1 class="page-title">Profili i <b><?php echo $row_adm['first_name'] . " " . $row_adm['last_name']; ?></b><small><?php if($_SESSION['user']['status'] == MODERATOR){ echo (" (Moderator)");} elseif($_SESSION['user']['status'] == ADMIN){ echo " (Administrator)";} ?> </small></h1>
        </div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#myprofile" role="tab" data-toggle="tab">My Profile</a></li>
            <!-- <li><a href="#account" role="tab" data-toggle="tab">Account</a></li>
            <li><a href="#billings" role="tab" data-toggle="tab">Billings &amp; Plans</a></li>
            <li><a href="#preferences" role="tab" data-toggle="tab">Preferences</a></li> -->
        </ul>
            <div class="tab-content content-profile">
                <!-- MY PROFILE -->
                <div class="tab-pane fade in active" id="myprofile">
				<?php
					if(isset($_SESSION['prep_stmt_error'])){ ?>
                        <div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <i class='fa fa-times-circle'></i> Diçka shkoi gabim, ju lutem provoni më vonë!
                        </div>
					<?php } ?>
					<?php if(isset($_SESSION['no_changes_error'])){ ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-warning""></i> <?php echo $_SESSION['no_changes_error'];?>
                        </div>
					<?php } ?>
					<?php if(isset($_SESSION['user_data_changed'])){?>
						<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle"></i> <?php echo $_SESSION['user_data_changed']; ?>
                        </div>
					<?php }?>
					<?php unset($_SESSION['prep_stmt_error']);	
					unset($_SESSION['no_changes_error']);
					unset($_SESSION['user_data_changed']);?>
					<form method="post" action="" enctype="multipart/form-data">
						<div class="profile-section">
							<h2 class="profile-heading">Foto Profilit</h2>
							<div class="media">
								<div class="media-left">
									<img src="../img/profile_pictures/<?php echo $row_adm['profile_pic']; ?>" class="user-photo media-object" alt="User">
								</div>
								<div class="media-body">
									<p>Ndrysho foton e profilit
										<br> <em>Foto duhet të jetë të paktën 140px x 140px</em></p>
										<?php if(isset($_SESSION['profile_pic_error'])){
											echo $_SESSION['profile_pic_error'];
										} ?>
									<button type="button" class="btn btn-default-dark" id="btn-upload-photo" style="<?php if(isset($_SESSION['profile_pic_error'])){ echo "border:1px solid red;";} unset($_SESSION['profile_pic_error']); ?>">Ngarko Foton</button>
									<input type="file" name="profile_pic" id="filePhoto" class="sr-only">
								</div>
							</div>
						</div>
						<div class="profile-section">
							<h2 class="profile-heading">Të dhënat personale</h2>
							<div class="clearfix">
								<!-- LEFT SECTION -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Përdoruesi</label>
										<input type="text" value="<?php echo $username; ?>"
                                        class="form-control" name="username"
                                        style="text-align:center; font-weight:500" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if(isset($_SESSION['user_data_errors']) && array_key_exists("passwordError", $_SESSION['user_data_errors'])){ echo $_SESSION['user_data_errors']['passwordError']; } else{ echo "Fjalëkalimi"; } ?></label>
										<input type="password" value="" name="password"
                                        class="form-control"
                                        style="text-align:center;font-weight:500; <?php if(isset($_SESSION['user_data_errors'])){ if(array_key_exists('passwordError', $_SESSION['user_data_errors'])){ echo "border:1px solid red;";}} ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if(isset($_SESSION['user_data_errors']) && array_key_exists("fnameError", $_SESSION['user_data_errors'])){ echo $_SESSION['user_data_errors']['fnameError']; } else{ echo "Emri"; } ?></label>
                                        <input type="text" value="<?php echo $fname; ?>"
                                        class="form-control" name="fname"
                                        style="text-align:center;font-weight:500; <?php if(isset($_SESSION['user_data_errors'])){ if(array_key_exists('fnameError', $_SESSION['user_data_errors'])){ echo "border:1px solid red;";}} ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if(isset($_SESSION['user_data_errors']) && array_key_exists("lnameError", $_SESSION['user_data_errors'])){ echo $_SESSION['user_data_errors']['lnameError']; } else{ echo "Mbiemri"; } ?></label>
                                        <input type="text" value="<?php echo $lname; ?>" name="lname"
                                        class="form-control"
                                        style="text-align:center;font-weight:500; <?php if(isset($_SESSION['user_data_errors'])){ if(array_key_exists('lnameError', $_SESSION['user_data_errors'])){ echo "border:1px solid red;";}} ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if(isset($_SESSION['user_data_errors']) && array_key_exists("emailError", $_SESSION['user_data_errors'])){ echo $_SESSION['user_data_errors']['emailError']; } else{ echo "Email"; } ?></label>
										<input type="text" value="<?php echo $email; ?>"
                                        class="form-control" name="email"
                                        style="text-align:center;font-weight:500; <?php if(isset($_SESSION['user_data_errors'])){ if(array_key_exists('emailError', $_SESSION['user_data_errors'])){ echo "border:1px solid red;";}} ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numri telefonit <span id="valid-msg" class="hide" style="text-align:center">(✓ Valid)</span><span id="error-msg" class="hide" style="text-align:center"></span></label>
                                        <input id="phone" type="tel" name="phone" class="form-control" value="<?php echo $tel; ?>" style="text-align:center;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Datëlindja</label>
										<input type="text" class="form-control datepicker-3"
                                        id="datelindja" name="bday" value="<?php echo $bday; ?>"
                                        style="text-align:center;font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if(isset($_SESSION['user_data_errors']) && array_key_exists("addressError", $_SESSION['user_data_errors'])){ echo $_SESSION['user_data_errors']['addressError']; } else{ echo "Adresa"; } ?></label>
										<input type="text" value="<?php echo $address; ?>"
                                        class="form-control" name="address"
                                        style="text-align:center;font-weight:500; <?php if(isset($_SESSION['user_data_errors'])){ if(array_key_exists('addressError', $_SESSION['user_data_errors'])){ echo "border:1px solid red;";}} ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if(isset($_SESSION['user_data_errors']) && array_key_exists("cityError", $_SESSION['user_data_errors'])){ echo $_SESSION['user_data_errors']['cityError']; } else{ echo "Qyteti"; } ?></label>
										<input type="text" name="city" value="<?php echo $city; ?>"
                                        class="form-control"
                                        style="text-align:center;font-weight:500; <?php if(isset($_SESSION['user_data_errors'])){ if(array_key_exists('cityError', $_SESSION['user_data_errors'])){ echo "border:1px solid red;";}} ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if(isset($_SESSION['user_data_errors']) && array_key_exists("postnrError", $_SESSION['user_data_errors'])){ echo $_SESSION['user_data_errors']['postnrError']; } else{ echo "Kodi Postar"; } ?></label>
										<input type="text" value="<?php echo $post_code; ?>"
                                        class="form-control" name="post_code"
                                        style="text-align:center;font-weight:500; <?php if(isset($_SESSION['user_data_errors'])){ if(array_key_exists('postnrError', $_SESSION['user_data_errors'])){ echo "border:1px solid red;";}} ?>">
                                    </div>
                                </div>
							</div>
							<p class="margin-top-30 text-center" >
								<input type="submit" class="btn btn-primary" id="update_user_data" name="update_user_data" value="Ndrysho">
							</p>
						</div>
					</form>
                </div>
                <!-- END MY PROFILE -->
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
<script src="assets/vendor/markdown/markdown.js"></script>
<script src="assets/vendor/to-markdown/to-markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
<!-- <script src="../js/datepicker/jquery-3.3.1.min.js"></script> -->
<!-- <script src="../js/datepicker/jquery-ui.min.js"></script>
<script src="../js/datepicker/jquery.slicknav.js"></script>
<script src="../js/datepicker/main.js"></script>	 -->
<script>
    $(function() {
        // photo upload
        $('#btn-upload-photo').on('click', function() {
            $(this).siblings('#filePhoto').trigger('click');
        });

        // plans
        $('.btn-choose-plan').on('click', function() {
            $('.plan').removeClass('selected-plan');
            $('.plan-title span').find('i').remove();

            $(this).parent().addClass('selected-plan');
            $(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
        });
    });
</script>
</body>

</html>