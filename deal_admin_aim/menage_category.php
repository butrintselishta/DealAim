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
        $cat_title = $_POST['cat_title'];
        $cat_link = $_POST['cat_link'];
        $cat_type = "";
        if($_POST['cat_type'] == "subcategory"){
            $cat_type = $_POST['parent_id'];
        }else{
            $cat_type = $_POST['cat_type'];
        }

        if($_POST['cat_type'] == "subcategory"){
            if(empty($_POST['parent_id'])){
                $_SESSION['save_title'] = $cat_title;
                $_SESSION['save_link'] = $cat_link;
                $_SESSION['parent_error'] = ""; 
                header("location:menage_category.php?add_cat#add_category");die();
            }
        }

        if(!prep_stmt("INSERT INTO categories(cat_title,cat_link,parent_id) VALUES(?,?,?)", array($cat_title, $cat_link, $cat_type), "ssi")){
            $_SESSION['prep_stmt_error'] = ""; 
            header("location:menage_category.php?add_cat");die();
        }else{
            $_SESSION['data_add_success'] = "";
            header("location:menage_category.php");die();
        }
    }

    //delete_cat
    if(isset($_GET['delete_cat'])){
        $delete_id = $_GET['delete_cat'];
        if(!prep_stmt("DELETE FROM categories WHERE cat_id = ?", $delete_id, "i")){
            $_SESSION['prep_stmt_error'] = ""; 
            header("location:menage_category.php"); die();
        }else{
            $_SESSION['data_deleted_success'] = "";
            header("location:menage_category.php");die();
        }
    }

    //edit_cat
    if(isset($_POST['edit'])){
        $id = $_POST['edit_id'];
        $cat_t = $_POST['cat_title'];
        $cat_l = $_POST['cat_link'];
        $cat_pid = $_POST['cat_type'];

        $sel_cat_e = prep_stmt("SELECT * FROM categories WHERE cat_id = ?",  $id, "i");
        if(mysqli_num_rows($sel_cat_e) > 0){
            while($row_e = mysqli_fetch_array($sel_cat_e)){
                $r_cat_title = $row_e['cat_title'];
                $r_cat_link = $row_e['cat_link'];
                $r_cat_type = $row_e['parent_id'];
            }
        }
        if($cat_t == $r_cat_title && $cat_l == $r_cat_link && $cat_pid == $r_cat_type){
            $_SESSION['no_changes_d'] = "";
            header("location:menage_category.php");die();
        }else{
            if(!prep_stmt("UPDATE categories SET cat_title=?, cat_link = ?, parent_id = ? WHERE cat_id=?", array($cat_t, $cat_l, $cat_pid, $id), "ssii")){
                $_SESSION['prep_stmt_error'] = "";
                header("location:menage_category.php");die();
            }else{
                $_SESSION['data_edited'] = "";
                header("location:menage_category.php");die();
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
                        <?php if(isset($_SESSION['data_add_success'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Kategoria u shtua me sukses!
                            </div>
                        <?php } unset($_SESSION['data_add_success']); ?>
                        <?php if(isset($_SESSION['data_deleted_success'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Kategoria u fshijë me sukses!
                            </div>
                        <?php } unset($_SESSION['data_deleted_success']); ?>
                        <?php if(isset($_SESSION['data_edited'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat për kategorinë përkatëse u modifikuan me sukses!
                            </div>
                        <?php } unset($_SESSION['data_edited']); ?>
                        <?php if(isset($_SESSION['no_changes_d'])){ ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-warning"></i> VËREJTJE, asnjë ndryshim nuk u bë për kategorinë përkatëse
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
                                        <a href="menage_category.php?add_cat#add_category" type="button" class="btn btn-default"><i class="fa fa-plus-square"></i> <span>Shto një të re</span></a>
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
                                                <th>PARENT ID (lloji)</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(mysqli_num_rows($sel_cat_search) > 0){
                                                while($row = mysqli_fetch_array($sel_cat_search)){
                                            ?>
                                            <tr id="<?php echo $row['cat_id']; ?>">
                                                <td><?php echo $row['cat_id']; ?></td>
                                                <td><?php echo $row['cat_title']; ?></td>
                                                <td><?php echo $row['cat_link']; ?></td>
                                                <td><?php echo $row['parent_id']; ?></td>
                                                <td>
                                                    <a href="menage_category.php?edit_cat=<?php echo $row['cat_id'] ?>#edit_category" class="btn btn-info btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-fw fa-edit"></i></a> 
                                                    <td>
                                                        <button type="button" id="delCat" class="btn btn-danger example20" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>
                                                    </td>
                                                </td>
                                                <script type="text/javascript">
                                                    $('.example20').on('click', function(e) {
                                                        e.preventDefault();
                                                        var trid = $(this).closest('tr').attr('id');

                                                        $.confirm({
                                                            title: 'Confirm!',
                                                            content: 'Simple confirm!',
                                                            content: 'Fshirja e kategorisë do të \'anulohet\' për 8 sekonda nëse nuk reagoni.',
                                                            autoClose: 'cancel|8000',
                                                            buttons: {
                                                                confirm:{
                                                                    text: 'Fshije',
                                                                    btnClass: 'btn-red',
                                                                    keys: ['enter', 'shift'],
                                                                    action: function(){
                                                                        window.location.replace("<?php echo "menage_category.php?delete_cat=" ?>"+trid);
                                                                    }
                                                                },
                                                                cancel:{
                                                                    text: 'Anulo',
                                                                    keys: ['enter', 'shift'],
                                                                    action: function(){
                                                                        $.alert('Fshirja e kategorisë u anulua!');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
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
                            </div>
                            <?php if(isset($_GET['add_cat'])){ ?>
                            <div class="row" style="border: 1px solid #ddd" id="add_category"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Shto një kategori të re!</h3>
                                </div>
                                
                                <?php if(isset($_SESSION['parent_error'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> Ju lutem mbushini të gjitha fushat!
                                    </div>
                                <?php }?>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_category.php?add_cat">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Titulli</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" name="cat_title" class="form-control float-left" value="<?php if(isset($_SESSION['save_title'])){echo $_SESSION['save_title'];} ?>" required data-parsley-minlength="2">
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
                                                <input type="url" id="text-input1" name="cat_link"  class="form-control float-left" value="<?php if(isset($_SESSION['save_link'])){echo $_SESSION['save_link'];} ?>" url >
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
                                                <select class="form-control" id="cat_type" name="cat_type" required data-parsley-minlength="1" >
                                                    <option value=""> Zgjedh llojin... </option>
                                                    <option value="0"> Kategori </option>
                                                    <option value="subcategory" <?php if(isset($_SESSION['parent_error'])){ echo "selected"; }?>>Nën-kategori </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12" id="sub_cat" style="display:<?php if(isset($_SESSION['parent_error'])){echo "block";}else{ ?> none; <?php } ?>">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Zgjedh kategorinë</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="parent_id" <?php if(isset($_SESSION['parent_error'])){ echo "style='border-color:red;background-color: #F2DEDE'";} ?>>
                                                    <option value=""> Zgjedh llojin... </option>
                                                    <?php 
                                                        $sel_categories = prep_stmt("SELECT * FROM categories WHERE parent_id=?",0, "i");
                                                        while($row_cat = mysqli_fetch_array($sel_categories)){
                                                    ?>
                                                    <option value="<?php echo $row_cat['cat_id'];?>"> <?php echo $row_cat['cat_title'];?> </option>
                                                    <?php } ?>
                                                </select>
                                                <?php if(isset($_SESSION['parent_error'])){ ?>
                                                <ul class="parsley-errors-list filled" id="parsley-id-7"><li class="parsley-required">Zgjedhe një nga kategoritë.</li></ul>
                                                <?php } ?>
                                                <?php unset($_SESSION['parent_error']); unset($_SESSION['save_title']); unset($_SESSION['save_link']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="text-center btn_center" style="margin-bottom:20px;">
                                            <button type="submit" name="add"  value="Shto" class="btn btn-primary ">Shto</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                           <?php } ?>

                           <!-- EDIT SUB/CATEGORY -->
                            <?php 
                            if(isset($_GET['edit_cat'])){ 
                                $sel_cat_edit = prep_stmt("SELECT * FROM categories WHERE cat_id = ?", $_GET['edit_cat'], "i");
                                if(mysqli_num_rows($sel_cat_edit) > 0){
                                    while($row_edit = mysqli_fetch_array($sel_cat_edit)){
                                        $row_cat_id = $row_edit['cat_id'];
                                        $row_cat_title = $row_edit['cat_title'];
                                        $row_cat_link = $row_edit['cat_link'];
                                        $row_cat_type = $row_edit['parent_id'];
                                    }
                                }
                            ?>
                            <div class="row" style="border: 1px solid #ddd" id="edit_category"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Edito kategorinë: <b style='color:#f0ad4e; font-weight:800;font-size:1.8rem;'><?php echo $row_cat_title; ?></b></h3>
                                </div>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_category.php?edit_cat">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">Titulli</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="text-input1" name="cat_title" class="form-control float-left" value="<?php echo $row_cat_title; ?>" required data-parsley-minlength="2">
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
                                                <input type="url" id="text-input1" name="cat_link"  class="form-control float-left" value="<?php echo $row_cat_link; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="text-input1" style="float:right;">PARENT ID </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" id="text-input1" name="cat_type"  class="form-control float-left" value="<?php echo $row_cat_type; ?>" required integer>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="text-center btn_center" style="margin-bottom:20px;">
                                            <input type="hidden" value="<?php echo $row_cat_id; ?>" name="edit_id">
                                            <button type="submit" name="edit"  value="Edito" class="btn btn-primary ">Ndrysho</button>
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

<script> 
    document.getElementById("cat_type").onchange = function () {
        var cattype = document.getElementById("cat_type");
        console.log(cattype.value);
        if(cattype.value == "subcategory"){
            document.getElementById("sub_cat").style.display = "block";
        }else if(cattype.value == "category"){
            document.getElementById("sub_cat").style.display = "none";
        }else{
            document.getElementById("sub_cat").style.display = "none";
        }
    }
</script>
</body>

</html>