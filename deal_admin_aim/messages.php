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
                    <li><a href="myprofile.php"><i class="fa fa-user-circle"></i> Profili im</a></li>
                    <li class="active"><a href="messages.php"><i class="fa fa-envelope" style="color:black;"></i> Mesazhet</a></li>
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
                <li><a href="site_data.php"><i class="lnr lnr-database"></i> <span>Të dhënat</span></a></li>
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
                    <h2 class="section-title"><i class="fa fa-envelope" style="color:black;"></i>Mesazhet!</h2>
                </div>
                <div class="row">
                    <div class="panel-content">
                        <?php 
                            if(isset($_GET['message_id'])){
                                $message = $_GET['message_id'];
                                $select_message = prep_stmt("SELECT * FROM messages WHERE message_id=?", $message, "i");
                                $fetch_message = mysqli_fetch_array($select_message);

                                if($fetch_message['status'] === 0){
                                    $update_sts = prep_stmt("UPDATE messages SET status=? WHERE message_id = ?", array(1,$message), "ii");
                                }
                        ?>  
                            <div class="row">
                                <div class="panel-content">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-12 ">
                                            <div class="fieldS">
                                                <a href="messages.php"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size:4rem; padding:5px 5px 5px 0; color:#203D92"><b style="font-size:2rem; text-align:center; font-weight:bold;"> Kthehu prapa</b></i></a>
                                                <fieldset style="background-color: #eeeeee; padding:2%;border: 1px solid #797979;">
                                                    <!-- <legend style="width:25%;background-color: gray; color: white; padding: 5px 5px;">Personalia:</legend> -->
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                        <label for="fname" class="label_fiels">Dërguar nga:</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12  col-12 ">
                                                        <input class="input_field" type="text" value="<?php echo $fetch_message['email']; ?>" readonly>
                                                    </div><br><br>
                                                    <div class="col-lg-3 col-md-3 col-sm-12  col-12">
                                                        <label for="fname" >Dërguar tek:</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                                        <input class="input_field" type="text" value="DealAim COMPANY" readonly >
                                                    </div><br><br>
                                                    <div class="col-lg-3 col-md-3 col-sm-12  col-12">
                                                        <label for="fname">Dërguar më:</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12  col-12">
                                                        <input class="input_field" type="text" value="<?php echo date("d-m-Y H:i:s A", strtotime($fetch_message['received_at'])); ?>" readonly>
                                                    </div><br><br>
                                                </fieldset>
                                                <div style="background-color: #fdfdfd; padding:2%;border: 1px solid #797979; color:#313131">
                                                    <h3 style="font-weight:600; color:#000;"> PËRMBAJTJA </h3>
                                                    <?php 
                                                        $full_message = preg_split("/\n+/", $fetch_message['message']);
                                                        
                                                        foreach($full_message as $msg){
                                                            echo "<p>". $msg . "</p>";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }else{ ?>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table responsive" cellspacing="0" width="100%" style="overflow:scroll;">
                                <thead class="thead-dark" style="background-color:#203D92; color:white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Derguar nga: </th>
                                        <th scope="col">Mesazhi</th>
                                        <th scope="col">Statusi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $select_all_msg = prep_stmt("SELECT * FROM messages order by message_id DESC",null,null);
                                if(mysqli_num_rows($select_all_msg) > 0){
                                    while($all_messages = mysqli_fetch_array($select_all_msg)){
                                        $status = $all_messages['status'];
                                        if($status === 0){
                                          echo " 
                                            <tr class='clickable-row' data-href='messages.php?message_id=".$all_messages['message_id']."' style='background-color:white; color:#000; font-weight:900;'>
                                                <th scope='row'>".$all_messages['message_id'] . "</th>
                                                <td>".$all_messages['full_name'] . "</td>
                                                <td>".substr($all_messages['message'],0,80) . " <small style='color:#5c8ed4;'>(më shumë)</small>" . "</td>
                                                <td>Jo e hapur</td>
                                            </tr>";
                                         } else { 
                                            echo " 
                                            <tr class='clickable-row' data-href='messages.php?message_id=".$all_messages['message_id']."' style='background-color:#F5F7F7; color:#4D4F51'>
                                                <th scope='row'>".chunk_split($all_messages['message_id'],30, "\n") . "</th>
                                                <td>".$all_messages['full_name'] . "</td>
                                                <td>".substr($all_messages['message'],0,80) . " <small style='color:#5c8ed4;'>(më shumë)</small>" . "</td>
                                                <td>E hapur</td> 
                                            </tr> ";
                                         } ?>
                                </tbody>
                                <?php } } ?>
                            </table>
                        </div>
                    <?php } ?>
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
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/scripts/common.js"></script>
<script src="../js/datepicker/jquery-3.3.1.min.js"></script>
<script src="../js/datepicker/jquery-ui.min.js"></script>
<script src="../js/datepicker/jquery.slicknav.js"></script>
<script src="../js/datepicker/main.js"></script>	

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
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