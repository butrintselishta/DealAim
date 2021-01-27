<?php 
	require "db.php";
    if($_SESSION['logged'] == false){
        header("location:signin.php");
    }
    $user = prep_stmt("SELECT user_id FROM users WHERE username=?", $_SESSION['user']['username'],"s");
    if(mysqli_num_rows($user) > 0){
        $user_id = mysqli_fetch_array($user);
    }
    else{
        $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
    }

    $balance = prep_stmt("SELECT acc_balance FROM bank_acc WHERE user_id=?", $user_id['user_id'],'i');
    if(mysqli_num_rows($balance) > 0){
        $user_balance = mysqli_fetch_array($balance);
    }else{
        $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
    }
 
    if(isset($_POST['terheq_btn'])){
        $ter_shuma = floatval($_POST['ter_shuma']); //die(var_dump($ter_shuma));
        if($ter_shuma > $user_balance['acc_balance']){
            $_SESSION['user_balance_low'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ju lutem kontrolloni llogarinë tuaj bankare, nuk keni bilanc të mjaftueshëm! </p>"; header("location:balance.php"); die();
        }
        else{
            $sel_curr_balance = prep_stmt("SELECT user_balance FROM users WHERE user_id=?", $user_id['user_id'],"i");
            if(mysqli_num_rows($user) > 0){
                $curr_balance = mysqli_fetch_array($sel_curr_balance); //die(var_dump($curr_balance['user_balance']));
            }else{
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
            }

            $deal_user_balance = 0;
            $bank_user_balance = $user_balance['acc_balance']; //die(var_dump($bank_user_balance));

            $bank_user_balance = $bank_user_balance - $ter_shuma;
            $deal_user_balance = $curr_balance['user_balance'] + $ter_shuma;// die(var_dump($deal_user_balance));
            if(!prep_stmt("UPDATE users SET user_balance=? WHERE user_id=?", array($deal_user_balance, $user_id['user_id']), "di")){
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
            }else{
              if(!prep_stmt("UPDATE bank_acc SET acc_balance = ? WHERE user_id=?", array($bank_user_balance, $user_id['user_id']), "di")){ 
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
               }
               else{
                $_SESSION['user_balance_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> <b style='color:#F0AC1A;font-size:17px;'>". $ter_shuma ."€ </b> janë transferuar në llogarinë tuaj. Bilanci juaj aktual është: <b style='color:#F0AC1A;font-size:17px;'>". $deal_user_balance ."€ </b></p>"; header("location:balance.php"); die();
               }
            }
        }
    }
?>

<?php require 'header.php'; ?>
<main class="bg_gray">
    <div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Category</a></li>
					<li>Page active</li>
				</ul>
		</div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-6 col-md-8">
			<div class="box_account" style="background-color:#fff;">
                <ul style="list-style: '\00BB'; padding-right:10px; ">
                    <li style="font-weight: 500; padding: 10px 0px 5px 0px;">
                        <i style="padding-left:8px; font-size:13px;">Këtu mund ta ndryshoni gjendjen e bilancit tuaj duke nxjerrë para nga llogaria juaj në këtë web aplikacion ose duke i tërhequr paratë prapa në llogarinë tuaj bankare.</i>
                    </li>
                    <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                        <i style="padding-left:8px; font-size:13px;">Së pari zgjedheni shërbimin që dëshironi ta kryeni në inputin e më poshtëm, pastaj ju hapet forma varësisht prej opsionit të zgjedhur</i>
                    </li>
                </ul>
                <div class="form_container" style="box-shadow:none;">
                    <div class="private box" >
                        <center>
                            <div class="row no-gutters">
                                <?php
                                     if(isset($_SESSION['prep_stmt_error'])){
                                        echo "<div class='gabim'>";
                                        echo $_SESSION['prep_stmt_error'];
                                        echo "</div>";
                                    }
                                    elseif(isset($_SESSION['user_balance_low'])){
                                        echo "<div class='gabim'>";
                                        echo $_SESSION['user_balance_low'];
                                        echo "</div>";
                                    }elseif(isset($_SESSION['user_balance_correct'])){
                                        echo "<div class='sukses'>";
                                        echo $_SESSION['user_balance_correct'];
                                        echo "</div>";
                                    } unset($_SESSION['user_balance_low']);unset($_SESSION['prep_stmt_error']);unset($_SESSION['user_balance_correct']);
                                ?>
                                <form style="width:100%; float:right;" >
                                    <div class="custom-select-form" style="width:50%">
                                         <label> Zgjedhni shërbmin </label>
                                        <select class="wide add_bottom_10" name="country" id="sherbimi"  onchange="showSherbimin()" >
                                            <option value="" selected="">Zgjedhni...</option>
                                            <option value="terheqje">Tërheqje</option>
                                            <option value="depozite">Depozitë</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>

                <div class="form_container" id="terheqje_div" style="box-shadow:none; display:none;" >
                    <div class="private box" style="background:#F8F8F8;">
                        <center>
                            <div class="row no-gutters">
                                <form style="width:100%; float:right;" method="POST" action="" id="ter_form">
                                    <div style="width:100%">
                                        <ul style="list-style: '\00BB'; color:#F0AC1A; text-align:left; ">
                                            <li style="font-weight: 500; padding: 10px 0px 5px 0px; ">
                                                <i style="font-size:14px;"><b>TËRHEQJE PARASH</b> => Paratë që dëshironi t'i fusni në llogarinë tuaj në web aplikacionin tonë <b>nga llogaria juaj bankare</b></i>
                                            </li>
                                            <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                                                <i style="font-size:14px;">Shuma minimale për tërheqje është <b style="color: #CF2928; font-size:16px;">5 euro</b>, ndërsa ajo maksimale është <b style="color: #5ABC35; font-size:16px;"> 2000 euro </b> </i>
                                            </li>
                                            <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                                                <i style="font-size:14px;">Shuma duhet të jetë fikse (p.sh: <b style="color: #CF2928; font-size:16px;">5 euro, 7 euro, 10 euro, 100 euro 1000 euro... </b>) </i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group form-group1" style="width:30%;">
                                        <label> Shkruaje shumën </label>
                                        <input type="text" name="ter_shuma" id="ter_shuma" class="form-control" style="text-align:center;">
                                    </div>
                                    <div class="text-center btn_center" style="margin-bottom:20px;"><button type="submit" id="terheq_btn" name="terheq_btn" value="Vazhdo" class="btn_1 ">Vazhdo</button></div>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      function showSherbimin(){
            //nese zgjidhet terhejqe, SHOW DIV per terheqje
            var sherbimi = document.getElementById("sherbimi");
            if(sherbimi.value = "terheqje"){
                document.getElementById("terheqje_div").style.display = "block";
            }
        } 
    </script>
    <script type="text/javascript">
        var sh_terheq = false;
        document.getElementById("ter_shuma").onkeyup = function() 
		{ 
            var terheq_shuma = document.getElementById("ter_shuma");
            if(terheq_shuma.value.match(/^\d+$/))
            {
                if(terheq_shuma.value < 5 || terheq_shuma.value > 2000){
                    sh_terheq = false;
                    terheq_shuma.style.border = "2px solid red";
                }else{
                    terheq_shuma.style.border = "2px solid green";
                    sh_terheq = true; 
                }
            }else{
                terheq_shuma.style.border = "2px solid red";
                sh_terheq = false;
            }
        }

        document.querySelector("#terheq_btn").addEventListener("click", function(event) {
            if(sh_terheq == true){
                document.getElementById("ter_form").submit();
            }else{
                event.preventDefault();
                document.getElementById("ter_shuma").style.border = "2px solid red";
            }
        });
    </script>
</main>



<?php require 'footer.php'; ?>