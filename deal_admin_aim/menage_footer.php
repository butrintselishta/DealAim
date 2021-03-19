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

    //add new sub/category
    if(isset($_POST['add'])){
        $footer_link = $_POST['footer_link'];
        $footer_title = $_POST['footer_title'];
        $footer_layout = $_POST['footer_layout'];//die($footer_layout);

        if(empty($footer_link) || empty($footer_title) || empty($footer_layout)){
            $_SESSION['save_title'] = $footer_title;
            $_SESSION['save_link'] = $footer_link;
            $_SESSION['save_layout'] = $footer_layout;
            $_SESSION['empty_error'] = "";
            header("menage_footer.php?add_footer#add_footer");
        }else{
            if(!prep_stmt("INSERT INTO footer(footer_title,footer_link,footer_layout) VALUES (?,?,?)", array($footer_title,$footer_link,$footer_layout), "sss")){
            $_SESSION['prep_stmt_error'] = ""; 
            header("location:menage_footer.php?add_footer");die();
            }else{
                $_SESSION['data_add_success'] = "";
                header("location:menage_footer.php");die();
            }
        }
    }

    //delete_cat
    if(isset($_GET['delete_footer'])){
        $delete_id = $_GET['delete_footer'];
        if(!prep_stmt("DELETE FROM footer WHERE footer_id = ?", $delete_id, "i")){
            $_SESSION['prep_stmt_error'] = ""; 
            header("location:menage_footer.php"); die();
        }else{
            $_SESSION['data_deleted_success'] = "";
            header("location:menage_footer.php");die();
        }
    }

    //edit_footer
    if(isset($_POST['edit'])){
        $footer_edit_id = $_POST['edit_id'];
        $footer_edit_link = $_POST['footer_link'];
        $footer_edit_title = $_POST['footer_title'];

        if(empty($footer_edit_link) || empty($footer_edit_title)){
            $_SESSION['empty_error_edit'] = "";
            header("menage_footer.php?edit_footer#edit_footer");
        }else{
            if(!prep_stmt("UPDATE footer SET footer_title = ?,footer_link = ? WHERE footer_id = ?", array($footer_edit_title,$footer_edit_link,$footer_edit_id), "ssi")){
                $_SESSION['prep_stmt_error'] = ""; 
                header("location:menage_footer.php"); die();
            }else{
                $_SESSION['data_edited'] = "";
                header("location:menage_footer.php");die();
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
                    <h2 class="section-title float-left"><i class="fa fa-pencil-square-o" style="color:black;"></i>Menaxhimi i fundit të faqes!</h2>
                </div>
                <div class="row" id="confirmed_prod">
                    <div class="col-md-12">
                        <div class="panel-content">
                        <?php if(isset($_SESSION['data_add_success'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat e fundit të faqes u shtuan me sukses!
                            </div>
                        <?php } unset($_SESSION['data_add_success']); ?>
                        <?php if(isset($_SESSION['data_deleted_success'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat nga fundi i faqes u fshijn me sukses!
                            </div>
                        <?php } unset($_SESSION['data_deleted_success']); ?>
                        <?php if(isset($_SESSION['data_edited'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat për fundin e faqes u modifikuan me sukses!
                            </div>
                        <?php } unset($_SESSION['data_edited']); ?>
                        <?php if(isset($_SESSION['no_changes_d'])){ ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-warning"></i> VËREJTJE: asnjë ndryshim nuk u krye!
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
                                        $sel_footer_search = "";
                                        if(isset($_GET['footer_s'])){
                                            $cat_search = $_GET['footer_s'];
                                            $sel_footer_search = prep_stmt("SELECT * FROM footer WHERE footer_id LIKE '%$cat_search%' OR footer_title LIKE '%$cat_search%' OR footer_link LIKE '%$cat_search%'", null, null);
                                        }elseif(isset($_GET['order_footer'])){
                                            $footer_order = $_GET['order_footer'];
                                            if($footer_order == "links"){
                                                $sel_footer_search = prep_stmt("SELECT * FROM footer WHERE footer_layout=?", "links", "s");
                                            }else if($footer_order == "contacts"){
                                                $sel_footer_search = prep_stmt("SELECT * FROM footer WHERE footer_layout=?", "contacts", "s");
                                            }else if($footer_order == "icons"){
                                                $sel_footer_search = prep_stmt("SELECT * FROM footer WHERE footer_layout=?", "icons", "s");
                                            }else if($footer_order == "all"){
                                                $sel_footer_search = prep_stmt("SELECT * FROM footer", null, null);
                                            }else{
                                                $sel_footer_search = prep_stmt("SELECT * FROM footer", null, null);
                                            }
                                        }else{
                                            $sel_footer_search = prep_stmt("SELECT * FROM footer", null, null);
                                        }
                                    ?>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <form method='get' action='menage_footer.php' id="navbar-search" class="navbar-form search-form" style="margin-left:0;">
                                            <input value="" class="form-control" name="footer_s" placeholder="Kërko këtu..." type="text" <?php if(isset($_GET['footer_s'])){ echo "style='background-color:#ffdd91;'";}?>>
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12" style="text-align:center">
                                        <a href="menage_footer.php?add_footer#add_footer" type="button" class="btn btn-default"><i class="fa fa-plus-square"></i> <span>Shto një të re</span></a>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <form method='get' action='menage_footer.php' id="navbar-search2" class="navbar-form search-form" style="float:right;">
                                            <select class="form-control" id="order_footer" name="order_footer"  <?php if(isset($_GET['order_footer'])){ echo "style='background-color:#ffdd91;'";}?>>
                                                <option value="all" <?php if(isset($_GET['order_footer'])){if($_GET['order_footer'] == "all"){echo "selected"; }} ?>> Rendit sipas layout-it... </option>
                                                <option value="links" <?php if(isset($_GET['order_footer'])){if($_GET['order_footer'] == "links"){echo "selected"; }} ?>> Linqe </option>
                                                <option value="contacts" <?php if(isset($_GET['order_footer'])){if($_GET['order_footer'] == "contacts"){echo "selected"; }} ?>> Kontakte </option>
                                                <option value="icons" <?php if(isset($_GET['order_footer'])){if($_GET['order_footer'] == "icons"){echo "selected"; }} ?>> Ikona </option>
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
                                                <th>Layout-i </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(mysqli_num_rows($sel_footer_search) > 0){
                                                while($row = mysqli_fetch_array($sel_footer_search)){
                                            ?>
                                            <tr id="<?php echo $row['footer_id']; ?>">
                                                <td><?php echo $row['footer_id']; ?></td>
                                                <td><?php echo $row['footer_title']; ?></td>
                                                <td><?php echo $row['footer_link']; ?></td>
                                                <td><?php echo $row['footer_layout']; ?></td>
                                                <td>
                                                    <a href="menage_footer.php?edit_footer=<?php echo $row['footer_id'] ?>#edit_footer" class="btn btn-info btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-fw fa-edit"></i></a> 
                                                    <td>
                                                        <button type="button" id="delFoot" class="btn btn-danger example20" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>
                                                    </td>
                                                </td>
                                                <script type="text/javascript">
                                                    $('.example20').on('click', function(e) {
                                                        e.preventDefault();
                                                        var trid = $(this).closest('tr').attr('id');

                                                        $.confirm({
                                                            title: 'Konfirmimi!',
                                                            content: 'Simple confirm!',
                                                            content: 'Fshirja e të dhënave të fundit të faqes do të \'anulohet\' për 8 sekonda nëse nuk reagoni.',
                                                            autoClose: 'cancel|8000',
                                                            buttons: {
                                                                confirm:{
                                                                    text: 'Fshije',
                                                                    btnClass: 'btn-red',
                                                                    keys: ['enter', 'shift'],
                                                                    action: function(){
                                                                        window.location.replace("<?php echo "menage_footer.php?delete_footer=" ?>"+trid);
                                                                    }
                                                                },
                                                                cancel:{
                                                                    text: 'Anulo',
                                                                    keys: ['enter', 'shift'],
                                                                    action: function(){
                                                                        $.alert('Fshirja e të dhënave të fundit të faqes u anulua!');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </tr>
                                            
                                            <?php } }?>
                                            <script>
                                                document.getElementById("order_footer").onchange = function () {
                                                        var searchUsers = document.getElementById("order_footer");
                                                        document.getElementById("navbar-search2").submit();
                                                }
                                            </script>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if(isset($_GET['add_footer'])){ ?>
                            <div class="row" style="border: 1px solid #ddd" id="add_footer"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Shto një të dhënë të re!</h3>
                                </div>
                                
                                <?php if(isset($_SESSION['empty_error'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> Ju lutem mbushini të gjitha fushat e kërkuara!
                                    </div>
                                <?php } ?>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_footer.php?add_footer">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Titulli</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" name="footer_title" class="form-control float-left" value="<?php if(isset($_SESSION['save_title'])){echo $_SESSION['save_title'];} ?>" required data-parsley-minlength="2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Linku</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" name="footer_link"  class="form-control float-left" value="<?php if(isset($_SESSION['save_link'])){echo $_SESSION['save_link'];} ?>" required  data-parsley-minlength="2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Lloji kategorisë</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" id="layout" name="footer_layout" required data-parsley-minlength="1" >
                                                    <option value=""> Zgjedh llojin... </option>
                                                    <option value="links"> Linqe </option>
                                                    <option value="contacts">Kontakte </option>
                                                    <option value="icons">Ikona </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="text-center btn_center" style="margin-bottom:20px;">
                                            <button type="submit" name="add"  value="Shto" class="btn btn-primary ">Shto</button>
                                        </div>
                                    </div>
                                    <?php unset($_SESSION['empty_error']);?>
                                </form>
                            </div>
                           <?php } ?>

                           <!-- EDIT SUB/CATEGORY -->
                            <?php 
                            if(isset($_GET['edit_footer'])){ 
                                $sel_foot_edit = prep_stmt("SELECT * FROM footer WHERE footer_id = ?", $_GET['edit_footer'], "i");
                                if(mysqli_num_rows($sel_foot_edit) > 0){
                                    while($row_edit = mysqli_fetch_array($sel_foot_edit)){
                                        $row_footer_id = $row_edit['footer_id'];
                                        $row_footer_link = $row_edit['footer_link'];
                                        $row_footer_title = $row_edit['footer_title'];
                                        $row_footer_layout = $row_edit['footer_layout'];
                                    }
                                }
                            ?>
                            <div class="row" style="border: 1px solid #ddd" id="edit_footer"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Edito të dhënat e fundit të faqes: <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'>Layout - <?php if($row_footer_layout == "icons"){echo "IKONË";}elseif($row_footer_layout == "links"){echo "LINK";}else if($row_footer_layout == "contacts"){echo "KONTAKTE";} ?></b></h3>
                                </div>
                                <?php if(isset($_SESSION['empty_error_edit'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> Ju lutem mbushini të gjitha fushat e kërkuara!
                                    </div>
                                <?php } ?>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_footer.php?edit_footer">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Titulli</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" name="footer_title" class="form-control float-left" value="<?php echo $row_footer_title; ?>" required data-parsley-minlength="2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Linku</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" name="footer_link"  class="form-control float-left" value="<?php echo $row_footer_link; ?>" required data-parsley-minlength="2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Layout-i </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" name="footer_layout"  class="form-control float-left" value="<?php  if($row_footer_layout == "icons"){echo "IKONË";}elseif($row_footer_layout == "links"){echo "LINK";}else if($row_footer_layout == "contacts"){echo "KONTAKTE";} ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="text-center btn_center" style="margin-bottom:20px;">
                                            <input type="hidden" value="<?php echo $row_footer_id; ?>" name="edit_id">
                                            <button type="submit" name="edit"  value="Edito" class="btn btn-primary ">Ndrysho</button>
                                        </div>
                                    </div>
                                    <?php unset($_SESSION['empty_error_edit']);?>
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