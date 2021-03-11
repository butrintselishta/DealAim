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
                    <li ><a href="profile.php"><i class="fa fa-user-circle"></i> Profili im</a></li>
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
                <li  class="active"><a href="site_data.php"><i class="lnr lnr-database"></i> <span>Të dhënat</span></a></li>
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
                    <h2 class="section-title"><i class="fa fa-pencil-square-o" style="color:black;"></i>Menaxhimi i të dhënave të faqes!</h2>
                </div>
                
                <div class="row">
                    <div class="panel-content">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-12 ">
                                <h3 class="heading"><i class="fa fa-list-alt" style="color:#989898;"></i>Menaxhimi i kategorive!</h3>
                                <div style="margin:auto; width:50%;"> 
                                    <a href="menage_category.php"><img src="img/edit_category.png" width="250" style="display:block; margin-left:auto; margin-right:auto"></a>
                                    <div class="btn-group btn-group-justified" style="margin-top:5px;">
                                        <a class="btn btn-primary" href="menage_category.php">MENAXHO KATEGORITË</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:30px;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="panel-content">
                            <div class="col-lg-12">
                                <h3 class="heading"><i class="fa fa-list-alt" style="color:#989898;"></i>Menaxhimi i FAQ (Si funksionon)!</h3>
                                <div style="margin:auto; width:50%;"> 
                                    <a href="menage_faq.php"><img src="img/edit_faq.png" width="250" style="display:block; margin-left:auto; margin-right:auto"></a>
                                    <div class="btn-group btn-group-justified" style="margin-top:5px;">
                                        <a class="btn btn-primary" href="menage_faq.php">MENAXHO FAQ-in</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:30px;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="panel-content">
                            <div class="col-lg-12">
                                <h3 class="heading"><i class="fa fa-list-alt" style="color:#989898;"></i>Menaxhimi i footer (fundit të faqes)!</h3>
                                <div style="margin:auto; width:50%;"> 
                                    <a href="menage_footer.php"><img src="img/edit_footer.png" width="250" style="display:block; margin-left:auto; margin-right:auto"></a>
                                    <div class="btn-group btn-group-justified" style="margin-top:5px;">
                                        <a class="btn btn-primary" href="menage_footer.php">MENAXHO FOOTER-in</a>
                                    </div>
                                </div>
                            </div>
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