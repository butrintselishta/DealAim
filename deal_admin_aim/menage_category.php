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
                    <h2 class="section-title"><i class="fa fa-pencil-square-o" style="color:black;"></i>Menaxhimi i kategorive!</h2>
                </div>
                <div class="row" id="confirmed_prod">
                    <div class="col-md-12">
                        <div class="panel-content">
                            <h3 class="heading"> </h3>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <?php
                                    $sel_cat_search = "";
                                    if(isset($_GET['categories_s'])){
                                        $cat_search = $_GET['categories_s'];
                                        $sel_cat_search = prep_stmt("SELECT * FROM categories WHERE cat_id LIKE '%$cat_search%' OR cat_title LIKE '%$cat_search%' OR cat_link LIKE '%$cat_search%' OR parent_id LIKE '%$cat_search%'", null, null);
                                    }elseif(isset($_GET['order_category'])){
                                        $cat_order = $_GET['order_category'];
                                        if($cat_order == "category"){
                                            $sel_cat_search = prep_stmt("SELECT * FROM categories WHERE parent_id = ?", 0, "i");
                                        }else if($cat_order == "subcategory"){
                                            $sel_cat_search = prep_stmt("SELECT * FROM categories WHERE parent_id != ?", 0, "i");
                                        }else if($cat_order == "all"){
                                            $sel_cat_search = prep_stmt("SELECT * FROM categories", null, null);
                                        }else{
                                            $sel_cat_search = prep_stmt("SELECT * FROM categories", null, null);
                                        }
                                    }else{
                                        $sel_cat_search = prep_stmt("SELECT * FROM categories", null, null);
                                    }
                                ?>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <form method='get' action='menage_category.php' id="navbar-search" class="navbar-form search-form" style="margin-left:0;">
                                        <input value="" class="form-control" name="categories_s" placeholder="Kërko këtu..." type="text" <?php if(isset($_GET['categories_s'])){ echo "style='background-color:#ffdd91;'";}?>>
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12" style="text-align:center">
                                    <a href="menage_category.php?add_cat" type="button" class="btn btn-default"><i class="fa fa-plus-square"></i> <span>Shto një të re</span></a>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <form method='get' action='menage_category.php' id="navbar-search2" class="navbar-form search-form" style="float:right;">
                                        <select class="form-control" id="order_category" name="order_category"  <?php if(isset($_GET['order_category'])){ echo "style='background-color:#ffdd91;'";}?>>
                                            <option value="all" <?php if(isset($_GET['order_category'])){if($_GET['order_category'] == "all"){echo "selected"; }} ?>> Rendit sipas... </option>
                                            <option value="category" <?php if(isset($_GET['order_category'])){if($_GET['order_category'] == "category"){echo "selected"; }} ?>> Kategori </option>
                                            <option value="subcategory" <?php if(isset($_GET['order_category'])){if($_GET['order_category'] == "subcategory"){echo "selected"; }} ?>> Nën-kategori </option>
                                        </select>
                                        <button type="submit" class="btn btn-default"></button>
                                    </form>
                                </div>
                                <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="overflow:scroll;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titulli </th>
                                            <th>Linku </th>
                                            <th>PARENT ID (statusi)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(mysqli_num_rows($sel_cat_search) > 0){
                                            while($row = mysqli_fetch_array($sel_cat_search)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['cat_id']; ?></td>
                                            <td><?php echo $row['cat_title']; ?></td>
                                            <td><?php echo $row['cat_link']; ?></td>
                                            <td><?php echo $row['parent_id']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-fw fa-edit"></i></button> 
                                                <button type="button" class="btn btn-danger btn-sm" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button> 
                                            </td>
                                        </tr>
                                        <?php } }?>
                                        <script>
                                            document.getElementById("order_category").onchange = function () {
                                                    var searchUsers = document.getElementById("order_category");
                                                    document.getElementById("navbar-search2").submit();
                                            }
                                        </script>
                                    </tbody>
                                </table>
                            </div>
                           <?php
                             if(isset($_GET['add_cat'])){ ?>
                            <div class="row"> 
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Përdoruesi</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" class="form-control float-left" required data-parsley-minlength="1" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Përdoruesi</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" class="form-control float-left" required data-parsley-minlength="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Përdoruesi</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" class="form-control float-left" required data-parsley-minlength="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Përdoruesi</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" class="form-control float-left" required data-parsley-minlength="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-center btn_center" style="margin-bottom:20px;">
                                            <button type="submit" name="change_user"  value="Vazhdo" class="btn btn-primary ">Konfirmo</button>
                                        </div>
                                    </div>
                                </form>
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