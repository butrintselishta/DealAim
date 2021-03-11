<?php
    require_once "../db.php";
    if(!isset($_SESSION['logged'])){
        header("location:../index.php");
    }else if($_SESSION['user']['status'] !== ADMIN){
        header("location:index.php");
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


    // if(isset($_GET['change_status'])){ 
    //     $status = $_GET['change_status'];
    //     $us_id = $_GET['us_id'];die(var_dump($status));
    //     $user_name = $_GET['usname'];
    //     $st = "";
    //     if($status == 1){ 
    //         $st = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Statusi i". $user_name ." është ndryshuar në <b style='#d9534f'> I KONFIRMUAR </b></p>";
    //     }elseif($status == 100){
    //         $st = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Statusi i". $user_name ." është ndryshuar në <b style='#481df5'> MODERATOR </b></p>";
    //     }elseif($status == 101){
    //         $st = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Statusi i". $user_name ." është ndryshuar në <b style='#4d1d7d'> ADMINISTRATOR </b></p>";
    //     }elseif($status == 50){
    //         $st = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Llogaria e $user_name është bllokuar! </p>";
    //     }
    //     if(!prep_stmt("UPDATE users SET status=? WHERE user_id = ?", array($status, $us_id), 'ii')){
    //         $_SESSION['prep_stmt_error'] = ""; header("location:users.php"); die();
    //     }else{
    //         $_SESSION['user_data_changed'] = $st; 
    //         header("location:users.php"); die(); 
    //     }
    // }
    
    //change user_data
    if(isset($_POST['change_user'])){
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname=$_POST['lname'];
        $email = $_POST['email'];
        $tel_nr = $_POST['tel_nr'];
        $adr = $_POST['address'];
        $city = $_POST['city'];
        $post = $_POST['postal_code'];
        $sts = $_POST['status_ch'];
        
        $all_data = prep_stmt("SELECT * FROM users WHERE user_id =?", $user_id, "i");
        if(mysqli_num_rows($all_data) > 0){
                $row_data = mysqli_fetch_array($all_data);
        }
        if(empty($password) && $fname == $row_data['first_name'] && $lname==$row_data['last_name'] && $email == $row_data['email'] && $tel_nr == $row_data['tel_nr'] && $adr == $row_data['address'] && $city == $row_data['city'] && $post == $row_data['postal_code'] && empty($sts)){
            $_SESSION['no_changes']="Ju nuk keni bërë asnjë përditsim për përdoruesin: <b style='color:#f0ad4e; font-weight:800; font-size:2rem;'>$username </b>";
            header("location:users.php");die();
        }
        else{
            $pass_hash = password_hash($password, PASSWORD_ARGON2I);
            $user_balance = 0;
            $acc_balance = "";
            if($sts == 50 && $row_data['user_balance'] != NULL){
                $sel_bal = prep_stmt("SELECT * FROM bank_acc WHERE user_id = ?", $user_id, "i");
                if(mysqli_num_rows($sel_bal) > 0){
                    $sel_balance = mysqli_fetch_array($sel_bal);
                }
                $acc_balance = $row_data['user_balance'] + $sel_balance['acc_balance'];
                $user_balance = NULL;
            }
        //   /  die(var_dump($user_balance));
            $pid = NULL; $terms= NULL;
            if(!empty($sts) && empty($password)){
                if($sts == 50 && $row_data['user_balance'] != NULL){
                    if(!prep_stmt("UPDATE users SET first_name=?,last_name=?,email=?,tel_nr=?,city=?,postal_code=?,address=?,pid_number=?,terms_and_conditions=?,status=?, user_balance=? WHERE user_id=?", array($fname,$lname,$email,$tel_nr,$city,$post,$adr,$pid,$terms,$sts,$user_balance,$user_id), "sssssisssisi")){
                        $_SESSION['data_changed_declined']="";
                        header("location:users.php?user=".$username."#profile");die();
                    }else{
                        if(!prep_stmt("UPDATE bank_acc SET acc_balance=? WHERE user_id=?", array($acc_balance, $user_id), "si")){
                            $_SESSION['data_changed_declined']="";
                            header("location:users.php?user=".$username."#profile");die();
                        }else{
                            $_SESSION['data_changed_success']="Të dhënat e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u përditësuan me sukses. <a style='color:#fff; font-weight:800;font-size:1.8rem;'> Statusi i tij u përditsua në </a>". ($sts == 1 ? " <b style='color:#d9534f; font-size:2rem;'> I KONFIRMUAR </b>" : ($sts == 2 ? "<b style='color:#F0AC1A; font-size:2rem;'> BLERËS!</b>" :  ($sts == 50 ? "<b style='color:#a31615; font-size:2rem;'>I Ç'REGJISTRUAR</b><b style='color:#a31615'>,ky përdorues më nuk do të ketë qasje ne web aplikacion! </b>" : ($sts == 100 ? "<b style='color:#2a1f54; font-size:2rem;'> !</b>" : ($sts == 101 ? "<b style='color:#4d1d7d; font-size:2rem;'> ADMINISTRATOR!</b>" : "")))))."";
                            header("location:users.php");die();
                        }
                    }
                }else{
                    if(!prep_stmt("UPDATE users SET first_name=?,last_name=?,email=?,tel_nr=?,city=?,postal_code=?,address=?,status=? WHERE user_id=?", array($fname,$lname,$email,$tel_nr,$city,$post,$adr,$sts,$user_id), "sssssisii")){
                        $_SESSION['data_changed_declined']="";
                        header("location:users.php?user=".$username."#profile");die();
                    }else{
                        $_SESSION['data_changed_success']="Të dhënat e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u përditësuan me sukses. <a style='color:#fff; font-weight:800;font-size:1.8rem;'> Statusi i tij u përditsua në </a>". ($sts == 1 ? " <b style='color:#d9534f; font-size:2rem;'> I KONFIRMUAR! </b>" : ($sts == 2 ? "<b style='color:#F0AC1A; font-size:2rem;'> BLERËS!</b>" : ($sts == 50 ? "<b style='color:#a31615; font-size:2rem;'>I Ç'REGJISTRUAR</b><b style='color:#a31615'>,ky përdorues më nuk do të ketë qasje ne web aplikacion! </b>" : ($sts == 100 ? "<b style='color:#2a1f54; font-size:2rem;'> MODERATOR!</b>" : ($sts == 101 ? "<b style='color:#4d1d7d; font-size:2rem;'> ADMINISTRATOR!</b>" : "")))))."";
                        header("location:users.php");die();
                        }
                }
            }else if(empty($sts) && !empty($password)){
                if(!prep_stmt("UPDATE users SET password=?,first_name=?,last_name=?,email=?,tel_nr=?,city=?,postal_code=?,address=? WHERE user_id=?", array($pass_hash,$fname,$lname,$email,$tel_nr,$city,$post,$adr,$user_id), "ssssssisi")){
                    $_SESSION['data_changed_declined']="";
                    header("location:users.php?user=".$username."#profile");die();
                }else{
                    $_SESSION['data_changed_success']="Të dhënat e përdoruesit <b style='color:#f0ad4e'>$username </b> u përditësuan me sukses!";
                    header("location:users.php");die();
                }
            }else if(!empty($sts) && !empty($password)){
                if($sts == 50 && $row_data['user_balance'] != NULL){
                    if(!prep_stmt("UPDATE users SET password=?,first_name=?,last_name=?,email=?,tel_nr=?,city=?,postal_code=?,address=?,pid_number=?,terms_and_conditions=?,status=?,user_balance=? WHERE user_id=?", array($pass_hash,$fname,$lname,$email,$tel_nr,$city,$post,$adr,$pid,$terms,$sts,$user_balance,$user_id), "ssssssisssisi")){
                        $_SESSION['data_changed_declined']="";
                        header("location:users.php?user=".$username."#profile");die();
                    }else{
                        if(!prep_stmt("UPDATE bank_acc SET acc_balance=? WHERE user_id=?", array($acc_balance, $user_id), "si")){
                            $_SESSION['data_changed_declined']="";
                            header("location:users.php?user=".$username."#profile");die();
                        }else{
                            $_SESSION['data_changed_success']="Të dhënat e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u përditësuan me sukses. <a style='color:#fff; font-weight:800;font-size:1.8rem;'> Statusi i tij u përditsua në </a>". ($sts == 1 ? " <b style='color:#d9534f; font-size:2rem;'> I KONFIRMUAR! </b>" : ($sts == 2 ? "<b style='color:#F0AC1A; font-size:2rem;'> BLERËS!</b>" : ($sts == 50 ? "<b style='color:#a31615; font-size:2rem;'>I Ç'REGJISTRUAR</b><b style='color:#a31615'>,ky përdorues më nuk do të ketë qasje ne web aplikacion! </b>" : ($sts == 100 ? "<b style='color:#2a1f54; font-size:2rem;'> MODERATOR!</b>" : ($sts == 101 ? "<b style='color:#4d1d7d; font-size:2rem;'> ADMINISTRATOR!</b>" : "")))))."";
                            header("location:users.php");die();
                        }
                    }
                }else{
                    if(!prep_stmt("UPDATE users SET password=?,first_name=?,last_name=?,email=?,tel_nr=?,city=?,postal_code=?,address=?,status=? WHERE user_id=?", array($pass_hash,$fname,$lname,$email,$tel_nr,$city,$post,$adr,$sts,$user_id), "ssssssisii")){
                        $_SESSION['data_changed_declined']="";
                        header("location:users.php?user=".$username."#profile");die();
                    }else{
                        $_SESSION['data_changed_success']="Të dhënat e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u përditësuan me sukses. <a style='color:#fff; font-weight:800;font-size:1.8rem;'> Statusi i tij u përditsua në </a>". ($sts == 1 ? " <b style='color:#d9534f; font-size:2rem;'> I KONFIRMUAR! </b>" : ($sts == 2 ? "<b style='color:#F0AC1A; font-size:2rem;'> BLERËS!</b>" : ($sts == 50 ? "<b style='color:#a31615; font-size:2rem;'>I Ç'REGJISTRUAR</b><b style='color:#a31615'>,ky përdorues më nuk do të ketë qasje ne web aplikacion! </b>" : ($sts == 100 ? "<b style='color:#2a1f54; font-size:2rem;'> MODERATOR!</b>" : ($sts == 101 ? "<b style='color:#4d1d7d; font-size:2rem;'> ADMINISTRATOR!</b>" : "")))))."";
                        header("location:users.php");die();
                    }
                }
            }
            else{
                if($sts == 50 && $row_data['user_balance'] != NULL){
                    if(!prep_stmt("UPDATE users SET first_name=?,last_name=?,email=?,tel_nr=?,city=?,postal_code=?,address=?,pid_number=?,terms_and_conditions=?,status=?, user_balance=? WHERE user_id=?", array($fname,$lname,$email,$tel_nr,$city,$post,$adr,$pid,$terms,$sts,$user_balance,$user_id), "sssssisssisi")){
                        $_SESSION['data_changed_declined']="";
                        header("location:users.php?user=".$username."#profile");die();
                    }else{
                        if(!prep_stmt("UPDATE bank_acc SET acc_balance=? WHERE user_id=?", array($acc_balance, $user_id), "si")){
                            $_SESSION['data_changed_declined']="";
                            header("location:users.php?user=".$username."#profile");die();
                        }else{
                            $_SESSION['data_changed_success']="Të dhënat e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u përditësuan me sukses. <a style='color:#fff; font-weight:800;font-size:1.8rem;'> Statusi i tij u përditsua në </a>". ($sts == 1 ? " <b style='color:#d9534f; font-size:2rem;'> I KONFIRMUAR! </b>" : ($sts == 2 ? "<b style='color:#F0AC1A; font-size:2rem;'> BLERËS!</b>" : ($sts == 50 ? "<b style='color:#a31615; font-size:2rem;'>I Ç'REGJISTRUAR</b><b style='color:#a31615'>,ky përdorues më nuk do të ketë qasje ne web aplikacion! </b>" : ($sts == 100 ? "<b style='color:#2a1f54; font-size:2rem;'> MODERATOR!</b>" : ($sts == 101 ? "<b style='color:#4d1d7d; font-size:2rem;'> ADMINISTRATOR!</b>" : "")))))."";
                            header("location:users.php");die();
                        }
                    }
                }else{
                    if(!prep_stmt("UPDATE users SET first_name=?,last_name=?,email=?,tel_nr=?,city=?,postal_code=?,address=? WHERE user_id=?", array($fname,$lname,$email,$tel_nr,$city,$post,$adr,$user_id), "sssssisi")){
                        $_SESSION['data_changed_declined']="";
                        header("location:users.php?user=".$username."#profile");die();
                    }else{
                        $_SESSION['data_changed_success']="Të dhënat e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u përditësuan me sukses!";
                        header("location:users.php");die();
                    }
                }
            }
        }
    }

    if(isset($_GET['delete'])){
        $usr_delete = $_GET['delete'];die("asdf");

        $sel_dlt_user = prep_stmt("SELECT * FROM users WHERE user_id = ?", $usr_delete, "i");
        if(mysqli_num_rows($sel_dlt_user) > 0){    
            $fetch_dlt_user = mysqli_fetch_array($sel_dlt_user);
        }

        $sel_bal_bank = prep_stmt("SELECT * FROM bank_acc WHERE user_id = ?", $usr_delete, "i");
        if(mysqli_num_rows($sel_bal_bank) > 0){
            $fetch_bank = mysqli_fetch_array($sel_bal_bank);
        }//die(var_dump($fetch_dlt_user['user_balance']));

        if($fetch_dlt_user['user_balance'] !== NULL){
            $full_bank_bal = $fetch_dlt_user['user_balance'] + $fetch_bank['acc_balance'];
            //die($full_bank_bal);
            if(!prep_stmt("UPDATE bank_acc SET acc_balance=? WHERE user_id = ?", array($full_bank_bal, $usr_delete), "si")){
                $_SESSION['data_changed_declined']="";
                header("location:users.php?user=".$username."#profile");die();
            }else{
                if(!prep_stmt("DELETE FROM users WHERE user_id = ?",$usr_delete, "i")){
                    $_SESSION['data_changed_declined']="";
                    header("location:users.php?user=".$username."#profile");die();
                }else{
                    $_SESSION['data_changed_success']="Llogarija e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u fshijë me sukses!";
                    header("location:users.php");die();
                }
            }
        }else{
            if(!prep_stmt("DELETE FROM users WHERE username = ?",$usr_delete, "s")){
                $_SESSION['data_changed_declined']="";
                header("location:users.php?user=".$username."#profile");die();
            }else{
                $_SESSION['data_changed_success']="Llogarija e përdoruesit <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>$username </b> u fshijë me sukses!";
                header("location:users.php");die();
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
            <img src="../img/profile_pictures/<?php echo $row_adm['profile_pic']; ?>" class="img-responsive img-circle user-photo" alt="User Profile Picture" style="width:80%; height:20rem;">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Përshëndetje, <strong><?php echo $row_adm['first_name'] . " ". $row_adm['last_name']; ?></strong> <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li ><a href="myprofile.php"><i class="fa fa-user-circle"></i> Profili im</a></li>
                    <li><a href="messages.php"><i class="fa fa-envelope" style="color:black;"></i> Mesazhet</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Çkyçu</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
				<li class=""><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li ><a href="myprofile.php"><i class="fa fa-user-circle"></i> <span>Profili im</span></a></li>
                <?php if($_SESSION['user']['status'] == ADMIN) { ?>
                    <li><a href="finances.php"><i class="lnr lnr-chart-bars"></i> <span>Financat</span></a></li>
                    <li class="active"><a href="users.php"><i class="lnr lnr-users"></i> <span>Përdoruesit</span></a></li>
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
                    <?php if(isset($_SESSION['no_changes'])){ ?>
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-info-circle"></i> <?php echo $_SESSION['no_changes'];?>
                        </div>
                    <?php } unset($_SESSION['no_changes']); ?>
                    <?php if(isset($_SESSION['data_changed_declined'])){ ?>
                        <div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <i class='fa fa-times-circle'></i> Diçka shkoi gabim, ju lutem provoni më vonë!
                        </div>
                    <?php } unset($_SESSION['data_changed_declined']); ?>
                    <?php if(isset($_SESSION['data_changed_success'])){ ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle"></i> <?php echo $_SESSION['data_changed_success']; ?>
                        </div>
                    <?php } unset($_SESSION['data_changed_success']); ?>
                        <h3 class="heading"><i class="fa fa-square"></i>Të gjithë përdoruesit</h3>
                        <?php 
                            $sel_all_users = "";
                            if(isset($_GET['user_status'])){ 
                                $usr = $_GET['user_status'];
                                if($usr == 'admin'){
                                    $sel_all_users = prep_stmt("SELECT * FROM users WHERE status = ?",101,'i');
                                }elseif($usr == 'moderator'){
                                    $sel_all_users = prep_stmt("SELECT * FROM users WHERE status = ?",100,'i');
                                }elseif($usr == 'seller'){
                                    $sel_all_users = prep_stmt("SELECT * FROM users WHERE status = ?",3,'i');
                                }elseif($usr == 'buyer'){
                                    $sel_all_users = prep_stmt("SELECT * FROM users WHERE status = ?",2,'i');
                                }elseif($usr == 'confirmed'){
                                    $sel_all_users = prep_stmt("SELECT * FROM users WHERE status = ?",1,'i');
                                }elseif($usr == 'not_confirmed'){
                                    $sel_all_users = prep_stmt("SELECT * FROM users WHERE status = ?",0,'i');
                                }elseif($usr == 'banned'){
                                    $sel_all_users = prep_stmt("SELECT * FROM users WHERE status = ?",50,'i');
                                }elseif($usr == "all"){
                                    $sel_all_users = prep_stmt("SELECT * FROM users order by status desc",null,null);
                                }
                            }else {
                                $sel_all_users = prep_stmt("SELECT * FROM users order by status desc",null,null);
                            }
                        ?>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <div class="float-left">
                                <?php 
                                    if(isset($_SESSION['prep_stmt_error'])){ ?>
                                        <div class='alert alert-danger alert-dismissible' role='alert'>
                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <i class='fa fa-times-circle'></i> Diçka shkoi gabim, ju lutem provoni më vonë!
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($_SESSION['user_data_changed'])){ ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <i class="fa fa-check-circle"></i> <?php echo $_SESSION['user_data_changed']; ?>
                                        </div>
                                    <?php } ?>
                                   <?php unset($_SESSION['prep_stmt_error']);
                                    unset($_SESSION['user_data_changed']);?>
                            </div>
                            <form method='get' action='users.php' id="navbar-search2" class="navbar-form search-form" style="float:right;">
                                <select class="form-control" id="search_users" name="user_status">
                                    <option value="all">Kërko sipas statusit të përdoruesit...</option>
                                    <option value="admin" <?php if(isset($_GET['user_status']) && $_GET['user_status'] == 'admin'){echo "selected";} ?>>Administrator</option>
                                    <option value="moderator" <?php if(isset($_GET['user_status']) && $_GET['user_status'] == 'moderator'){echo "selected";} ?>>Moderator</option>
                                    <option value="seller" <?php if(isset($_GET['user_status']) && $_GET['user_status'] == 'seller'){echo "selected";} ?>>Shitës</option>
                                    <option value="buyer" <?php if(isset($_GET['user_status']) && $_GET['user_status'] == 'buyer'){echo "selected";} ?>>Blerës</option>
                                    <option value="confirmed" <?php if(isset($_GET['user_status']) && $_GET['user_status'] == 'confirmed'){echo "selected";} ?>>I Konfirmuar</option>
                                    <option value="not_confirmed" <?php if(isset($_GET['user_status']) && $_GET['user_status'] == 'not_confirmed'){echo "selected";} ?>>Jo i konfirmuar</option>
                                    <option value="banned" <?php if(isset($_GET['user_status']) && $_GET['user_status'] == 'banned'){echo "selected";} ?>>I ç'regjistruar</option>
                                </select>
                                <button type="button" name='search_user' class="btn btn-default"><i class="fa fa-search"></i></button>
                            </form>
                            <script>
                                document.getElementById("search_users").onchange = function () {
                                    var searchUsers = document.getElementById("search_users");
                                    document.getElementById("navbar-search2").submit();
                                }
                            </script>
                            <table class="table table-bordered table-striped mb-0" style="margin:0;"> 
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Përdoruesi </th>
                                        <th>Emri dhe Mbiemri </th>
                                        <th>Nr.Tel </th>
                                        <th>Statusi</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php 
                                        $user_name = "";
                                        if(mysqli_num_rows($sel_all_users) > 0){
                                            while($row_users = mysqli_fetch_array($sel_all_users)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row_users['user_id']; ?></td>
                                        <td><b style=' color:#f0ad4e;'><?php echo $row_users['username']; ?></b></td>
                                        <td><?php echo $row_users['first_name'] . " " . $row_users['last_name']; ?></td>
                                        <td><?php echo $row_users['tel_nr']; ?></td>
                                        <td><?php if($row_users['status'] == 0){ echo "<span class='label' style='color:white; background-color:#a31615;'>JO I KONFIRMUAR</span>";}elseif($row_users['status'] == 1){echo "<span class='label' style='color:white; background-color:#d9534f;'>I KONFIRMUAR</span>";}elseif($row_users['status'] == 2){ echo "<span class='label' style='color:white; background-color:#F0AC1A;'>BLERËS</span>";}elseif($row_users['status'] == 3){echo "<span class='label' style='color:white; background-color:#5ABC35;'>SHITËS<span>";}elseif($row_users['status'] == 50){echo "<span class='label' style='color:white; background-color:red;'>I Ç'REGJISTRUAR<span>";}elseif($row_users['status'] == 100){echo "<span class='label' style='color:white; background-color:#481df5;'>MODERATOR</span>";}elseif($row_users['status'] == 101){echo "<span class='label' style='color:white; background-color:#4d1d7d;'>ADMINISTRATOR</span>";} ?></td>
                                        <!-- <td>
                                            <form method='get' id="status_changed_to" action='users.php'>
                                                <select class="form-control" id="change_status_<?php echo $row_users['user_id']; ?>" name="change_status" onchange="show_value('change_status_<?=$row_users['user_id']?>')">
                                                    <option value="" style="color:#d9534f; font-weight:bold">Zgjedhe statusin</option>
                                                    <?php if($row_users['status'] == 0){?><option value="1" style="color:#d9534f; font-weight:bold">I konfirmuar</option><option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php } ?>
                                                    <?php if($row_users['status'] == 1){ ?><option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option><?php } ?>
                                                    <?php if($row_users['status'] == 2){ ?>
                                                    <option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php }?>
                                                    <?php if($row_users['status'] == 3){ ?><option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php } ?>
                                                    <?php if($row_users['status'] == 100){ ?><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php } ?> 
                                                    <?php if($row_users['status'] == 101){ ?><option value="101" style="color:#481df5;font-weight:bold">Moderator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php } ?>
                                                    <input type="hidden" name="us_id" value="<?php echo $row_users['user_id']; ?>">
                                                    <input type="hidden" name='usname' value="<?php echo $row_users['username']; ?>">
                                                </select>
                                            </form>
                                        </td> -->
                                        <td><a class="btn btn-info btn-sm" href="users.php?user=<?php echo $row_users['username'];?>#profile"><i class="fa fa-file-text-o"></i>SHIKO DETAJET</a></td>
                                        <td><a href="users.php?delete=<?php echo $row_users['user_id']?>" class="btn btn-danger btn-sm example20" title="Delete"><span class="sr-only">Fshije</span> <i class="fa fa-trash-o"></i></a></td>
                                        <script type="text/javascript">
                                            $('.example20').on('click', function() {
                                                $.confirm({
                                                    title: 'Delete user?',
                                                    content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
                                                    autoClose: 'cancelAction|8000',
                                                    buttons: {
                                                        deleteUser: {
                                                            text: 'delete user',
                                                            action: function() {
                                                                $.alert('Deleted the user!');
                                                            }
                                                        },
                                                        cancelAction: function() {
                                                            $.alert('action is canceled');
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                    </tr>
                                    <?php } } else { ?>
                                        </tbody>
                                        </table>
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <i class="fa fa-info-circle"></i> Nuk ka përdorues me këtë status!
                                        </div>
                                    <?php } ?>
                                    <?php  
                                        $sel_count = prep_stmt("SELECT count(user_id) as totali FROM users",null,null); 
                                        $count_tot = mysqli_fetch_array($sel_count);
                                        $count = $count_tot['totali'];
                                    ?>
                                   <script>    
                                        function show_value(input_id) {
                                            selected_value = document.getElementById(input_id).value;    
                                            if(confirm("A jeni të sigurtë që dëshironi të ndryshoni statusin e përdoruesit")){
                                                document.getElementById("status_changed_to").submit();
                                            }else{
                                                window.location.reload();
                                            }
                                        }
                                    </script>
                                    <?php 
                                     ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php 
                    if(isset($_GET['user']))
                    { 
                        $user = $_GET['user'];
                        $user_profile = prep_stmt("SELECT * FROM users WHERE username=?", $user, "s");
                        if(mysqli_num_rows($user_profile) > 0){
                            $row_user_profile = mysqli_fetch_array($user_profile);
                        }

                        $sel_bal = prep_stmt("SELECT * FROM bank_acc WHERE user_id = ?", $row_user_profile['user_id'], "i");
                        if(mysqli_num_rows($sel_bal) > 0){
                            $sel_balance = mysqli_fetch_array($sel_bal);
                        }
                    ?>
                    <div class="panel-content text-center">
                        <h3 class="heading">Të dhënat e përdoruesit: <b style="color:#f0ad4e"><?php echo $row_user_profile['username'];?></b></h3>
                    </div>
                    <div class="tab-content content-profile" id="profile">
                        <!-- MY PROFILE -->
                        <div class="tab-pane fade in active" id="myprofile">
                            <div class="profile-section" style="margin:0;">
                                    <div class="media">
                                        <div class="media" style="width:20%; margin:auto;">
                                            <img src="../img/profile_pictures/<?php echo $row_user_profile['profile_pic']; ?>" class="user-photo media-object" alt="User" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content text-center">
                                    <h3 class="heading"><?php if($row_user_profile['user_balance'] !== NULL){echo "Bilanci: <b style='color:darkgreen; font-size:larger;'>".number_format($row_user_profile['user_balance'],2)."€ </b>";}   ?></h3>
                                </div>
                            <form id="advanced-form" data-parsley-validate novalidate method="post" action="">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Përdoruesi</label>
                                        <input type="text" id="text-input1" value="<?php echo $row_user_profile['username']; ?>" class="form-control" required data-parsley-minlength="1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Fjalëkalimi</label>
                                        <input type="text" name="password" id="text-input1" value="" class="form-control" data-parsley-minlength="8">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Emri</label>
                                        <input type="text" id="text-input1" name="fname" value="<?php echo $row_user_profile['first_name']; ?>" class="form-control" required data-parsley-minlength="1" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Mbiemri</label>
                                        <input type="text" id="text-input1" name="lname" value="<?php echo $row_user_profile['last_name']; ?>" class="form-control" required data-parsley-minlength="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Email</label>
                                        <input type="text" id="text-input1" name="email" value="<?php echo $row_user_profile['email']; ?>"class="form-control" required data-parsley-minlength="1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Numri telefonit</label>
                                        <input type="text" id="text-input1" name="tel_nr" value="<?php echo $row_user_profile['tel_nr']; ?>" class="form-control" required data-parsley-minlength="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Datëlindja</label>
                                        <input type="text" id="text-input1" name="bday" value="<?php echo date("d-M-Y", strtotime($row_user_profile['birthday'])); ?>" class="form-control" required data-parsley-minlength="1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Adresa</label>
                                        <input type="text" id="text-input1" name="address" value="<?php echo $row_user_profile['address']; ?>" class="form-control" required data-parsley-minlength="1" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Qyteti</label>
                                        <input type="text" id="text-input1" name="city" value="<?php echo $row_user_profile['city']; ?>" class="form-control" required data-parsley-minlength="1" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text-input1">Kodi Postar</label>
                                        <input type="text" id="text-input1" name="postal_code" value="<?php echo $row_user_profile['postal_code']; ?>" class="form-control" required data-parsley-minlength="3" >
                                    </div>
                                </div>
                                <?php if($row_user_profile['status'] == 3){ ?>
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align-last:center;">
                                        <label for="text-input1">ID Identifikuese</label>
                                        <input type="text" id="text-input1" value="<?php echo $row_user_profile['pid_number']; ?>" class="form-control" required data-parsley-minlength="1" readonly>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align-last:center;">
                                        <label for="text-input1">Statusi</label>
                                        <select class="form-control" name="status_ch">
                                            <option value="">Ndrysho statusin</option>
                                            <?php if($row_user_profile['status'] == 0){?><option value="1" style="color:#d9534f; font-weight:bold">I konfirmuar</option><option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php } ?>
                                            <?php if($row_user_profile['status'] == 1){ ?><option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option><?php } ?>
                                            <?php if($row_user_profile['status'] == 2){ ?>
                                            <option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php }?>
                                            <?php if($row_user_profile['status'] == 3){ ?><option value="100"  style="color:#481df5;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php } ?>
                                            <?php if($row_user_profile['status'] == 50){ ?><option value="1" style="color:#481df5;font-weight:bold">I konfirmuar</option><?php if(mysqli_num_rows($sel_bal) > 0){ ?><option value="2" style="color:#F0AC1A;font-weight:bold">Blerës</option><?php } ?><option value="100" style="color:red;font-weight:bold">Moderator</option><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option> <?php } ?>
                                            <?php if($row_user_profile['status'] == 100){ ?><option value="101" style="color:#4d1d7d;font-weight:bold">Administrator</option><option value="50" style="color:red;font-weight:bold">BAN</option> <?php } ?> 
                                            <?php if($row_user_profile['status'] == 101){ ?><option value="100" style="color:#481df5;font-weight:bold">Moderator</option><option value="50" style="color:red;font-weight:bold" >BAN</option> <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align-last:center;">
                                        <input type="hidden" name="user_id" id="text-input1" value="<?php echo $row_user_profile['user_id']; ?>" class="form-control" required data-parsley-minlength="1" readonly>
                                        <input type="hidden" name="username" id="text-input1" value="<?php echo $row_user_profile['username']; ?>" class="form-control" required data-parsley-minlength="1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center btn_center" style="margin-bottom:20px;">
                                        <button type="submit" name="change_user"  value="Vazhdo" class="btn btn-primary ">Konfirmo</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
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
<!-- <script src="../js/datepicker/jquery-3.3.1.min.js"></script>
<script src="../js/datepicker/jquery-ui.min.js"></script>
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

