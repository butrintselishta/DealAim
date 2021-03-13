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
        $data = $_POST['editordata'];

        if(!prep_stmt("INSERT INTO faq(faq_data) VALUES(?)", $data,"s")){
            $_SESSION['prep_stmt_error'] = ""; 
            header("location:menage_faq.php?add_faq");die();
        }else{
            $_SESSION['data_add_success'] = "";
            header("location:menage_faq.php");die();
        }
    }

    //delete_faq
    if(isset($_GET['delete_faq'])){
        $delete_id = $_GET['delete_faq'];
        if(!prep_stmt("DELETE FROM faq WHERE faq_id = ?", $delete_id, "i")){
            $_SESSION['prep_stmt_error'] = ""; 
            header("location:menage_faq.php"); die();
        }else{
            $_SESSION['data_deleted_success'] = "";
            header("location:menage_faq.php");die();
        }
    }

    //edit_faq
    if(isset($_POST['edit'])){
        $id = $_POST['edit_id'];
        $faq_d = $_POST['editordata'];

        $sel_faq_e = prep_stmt("SELECT * FROM faq WHERE faq_id = ?",  $id, "i");

        if(mysqli_num_rows($sel_faq_e) > 0){
            while($row_e = mysqli_fetch_array($sel_faq_e)){
                $faq_data = $row_e['faq_data'];
            }
        }
        if($faq_d == $faq_data){
            $_SESSION['no_changes_d'] = "";
            header("location:menage_faq.php");die();
        }else{
            if(!prep_stmt("UPDATE faq SET faq_data=? WHERE faq_id=?", array($faq_d,$id), "si")){
                $_SESSION['prep_stmt_error'] = "";
                header("location:menage_faq.php");die();
            }else{
                $_SESSION['data_edited'] = "";
                header("location:menage_faq.php");die();
            }
        }
    }
?>
<?php require "header.php"; ?>
<script src="assets/confirm/bundled.js"></script> 
<script type="text/javascript"src="assets/confirm/jquery-confirm.js"></script>
<!-- <script src="assets/vendor/jquery/jquery.min.js"></script> -->
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
                                <i class="fa fa-check-circle"></i> Të dhenat u shtuan me sukses!
                            </div>
                        <?php } unset($_SESSION['data_add_success']); ?>
                        <?php if(isset($_SESSION['data_deleted_success'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhenat u fshijn me sukses!
                            </div>
                        <?php } unset($_SESSION['data_deleted_success']); ?>
                        <?php if(isset($_SESSION['data_edited'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> Të dhënat për të dhënat përkatëse u modifikuan me sukses!
                            </div>
                        <?php } unset($_SESSION['data_edited']); ?>
                        <?php if(isset($_SESSION['no_changes_d'])){ ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-warning"></i> VËREJTJE, asnjë ndryshim nuk u bë për të dhënat përkatëse
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
                                        $sel_faq_search = "";
                                        if(isset($_GET['faq_s'])){
                                            $faq_search = $_GET['faq_s'];
                                            $sel_faq_search = prep_stmt("SELECT * FROM faq WHERE faq_id LIKE '%$faq_search%' OR faq_data LIKE '%$faq_search%'", null, null);
                                        }elseif(isset($_GET['order_faq'])){
                                            $faq_order = $_GET['order_faq'];
                                            if($faq_order == "new"){
                                                $sel_faq_search = prep_stmt("SELECT * FROM faq order by faq_id DESC", null, null);
                                            }else if($faq_order == "old"){
                                                $sel_faq_search = prep_stmt("SELECT * FROM faq order by faq_id ASC", null, null);
                                            }else if($faq_order == "all"){
                                                $sel_faq_search = prep_stmt("SELECT * FROM faq", null, null);
                                            }else{
                                                $sel_faq_search = prep_stmt("SELECT * FROM faq", null, null);
                                            }
                                        }else{
                                            $sel_faq_search = prep_stmt("SELECT * FROM faq", null, null);
                                        }
                                    ?>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <form method='get' action='menage_faq.php' id="navbar-search" class="navbar-form search-form" style="margin-left:0;">
                                            <input value="" class="form-control" name="faq_s" placeholder="Kërko këtu..." type="text" <?php if(isset($_GET['faq_s'])){ echo "style='background-color:#ffdd91;'";}?>>
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12" style="text-align:center">
                                        <a href="menage_faq.php?add_faq#add_faq" type="button" class="btn btn-default"><i class="fa fa-plus-square"></i> <span>Shto një të re</span></a>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <form method='get' action='menage_faq.php' id="navbar-search2" class="navbar-form search-form" style="float:right;">
                                            <select class="form-control" id="order_faq" name="order_faq"  <?php if(isset($_GET['order_faq'])){ echo "style='background-color:#ffdd91;'";}?>>
                                                <option value="all" <?php if(isset($_GET['order_faq'])){if($_GET['order_faq'] == "all"){echo "selected"; }} ?>> Rendit sipas... </option>
                                                <option value="old" <?php if(isset($_GET['order_faq'])){if($_GET['order_faq'] == "old"){echo "selected"; }} ?>> ID më të vogël </option>
                                                <option value="new" <?php if(isset($_GET['order_faq'])){if($_GET['order_faq'] == "new"){echo "selected"; }} ?>> ID më të madhe </option>
                                            </select>
                                            <button type="submit" class="btn btn-default"></button>
                                        </form>
                                    </div>
                                    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="overflow:scroll;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Të dhënat </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(mysqli_num_rows($sel_faq_search) > 0){
                                                while($row = mysqli_fetch_array($sel_faq_search)){
                                            ?>
                                            <tr id="<?php echo $row['faq_id']; ?>">
                                                <td><?php echo $row['faq_id']; ?></td>
                                                <td><?php echo substr($row['faq_data'],0,500). "<a href='menage_faq.php?edit_faq=".$row['faq_id']."#edit_faq' style='color:#5c8ed4;'>...(më shumë)</a>"?>.</td>
                                                <td>
                                                    <a href="menage_faq.php?edit_faq=<?php echo $row['faq_id'] ?>#edit_faq" class="btn btn-info btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-fw fa-edit"></i></a> 
                                                    <td>
                                                        <button type="button" id="delFaq" class="btn btn-danger example20 btn-sm" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>
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
                                                                        window.location.replace("<?php echo "menage_faq.php?delete_faq=" ?>"+trid);
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
                                                document.getElementById("order_faq").onchange = function () {
                                                        var searchUsers = document.getElementById("order_faq");
                                                        document.getElementById("navbar-search2").submit();
                                                }
                                            </script>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if(isset($_GET['add_faq'])){ ?>
                            <div class="row" style="border: 1px solid #ddd" id="add_faq"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Shto të dhëna të reja <b style='color:#f0ad4e; font-weight:800;font-size:2rem;'>(Si funksionon?)</b></h3>
                                </div>
                                
                                <?php if(isset($_SESSION['parent_error'])){ ?>
                                    <div class='alert alert-danger alert-dismissible' role='alert' style="margin-left:20px; margin-right:20px; text-align:center;">
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <i class='fa fa-times-circle'></i> Ju lutem mbushini të gjitha fushat!
                                    </div>
                                <?php }?>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_faq.php?add_faq">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="panel-content">
                                                    <textarea class="summernote" name="editordata"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top:7rem;">    </div> 
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
                            if(isset($_GET['edit_faq'])){ 
                                $sel_faq_edit = prep_stmt("SELECT * FROM faq WHERE faq_id = ?", $_GET['edit_faq'], "i");
                                if(mysqli_num_rows($sel_faq_edit) > 0){
                                    while($row_edit = mysqli_fetch_array($sel_faq_edit)){
                                        $row_faq_id = $row_edit['faq_id'];
                                        $row_faq_data = $row_edit['faq_data'];
                                    }
                                }
                            ?>
                            <div class="row" style="border: 1px solid #ddd" id="edit_faq"> 
                                <div class="panel-content text-center">
                                    <h3 class="heading">Edito të dhënat e FAQ (Si funksionon?):<b style='color:#f0ad4e; font-weight:800;font-size:2rem;'> <?php echo $row_faq_id; ?> </b></h3>
                                </div>
                                <form id="advanced-form" data-parsley-validate novalidate method="post" action="menage_faq.php?edit_faq">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="panel-content">
                                                    <textarea class="summernote" name="editordata"><?php echo $row_faq_data; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="padding-top: 5rem;"> </div>
                                    <div class="col-md-12">
                                        <div class="text-center btn_center" style="margin-bottom:20px;">
                                            <input type="hidden" value="<?php echo $row_faq_id; ?>" name="edit_id">
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
<script src="assets/vendor/summernote/summernoteMenage.min.js"></script>
<script src="assets/vendor/markdown/markdown.js"></script>
<script src="assets/vendor/to-markdown/to-markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
<script>
    $(function() {
        // summernote editor
        $('.summernote').summernote({
            height: 300,
            focus: true,
            onpaste: function() {
                alert('You have pasted something to the editor');
            }
        });

        // markdown editor
        var initContent = '<h4>Hello there</h4> ' +
            '<p>How are you? I have below task for you :</p> ' +
            '<p>Select from this text... Click the bold on THIS WORD and make THESE ONE italic, ' +
            'link GOOGLE to google.com, ' +
            'test to insert image (and try to tab after write the image description)</p>' +
            '<p>Test Preview And ending here...</p> ' +
            '<p>Click "List"</p> Enjoy!';

        $('#markdown-editor').text(toMarkdown(initContent));
    });
</script>

</body>

</html>