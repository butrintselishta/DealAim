<?php 
	require "db.php";
    if($_SESSION['logged'] == false){
        header("location:signin.php");
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
                                <form style="width:100%; float:right;" >
                                    <div class="custom-select-form" style="width:50%">
                                         <label> Zgjedhni shërbmin </label>
                                        <select class="wide add_bottom_10" name="country" id="sherbimi"  onchange="showDiv(this)" >
                                            <option value="" selected="">Zgjedhni...</option>
                                            <option value="0">Tërheqje</option>
                                            <option value="1">Depozitë</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>

                <div class="form_container" id="sherbimi_div" style="box-shadow:none; display:none;" >
                    <div class="private box" style="background:#F8F8F8;">
                        <center>
                            <div class="row no-gutters">
                                <form style="width:100%; float:right;" >
                                    <div style="width:100%">
                                        <ul style="list-style: '\00BB'; color:#F0AC1A; text-align:left; ">
                                            <li style="font-weight: 500; padding: 10px 0px 5px 0px; ">
                                                <i style="font-size:13px;"><b>TËRHEQJE PARASH</b> => Paratë që dëshironi t'i fusni në llogarinë tuaj në web aplikacionin tonë <b>nga llogaria juaj bankare</b></i>
                                            </li>
                                            <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                                                <i style="font-size:13px;">Shuma minimale për tërheqje është <b style="color: #CF2928">5 euro</b>, ndërsa ajo maksimale është <b style="color: #5ABC35"> 2000 euro </b> </i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group form-group1" style="width:30%;">
                                        <label> Shkruaje shumën </label>
                                        <input type="text" name="number" id="number" class="form-control" style="text-align:center;">
                                    </div>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function showDiv(select){
        if(select.value==1){
            document.getElementById('sherbimi_div').style.display = "block";
        } else{
            document.getElementById('sherbimi_div').style.display = "none";
        }
        } 
</script>
</main>



<?php require 'footer.php'; ?>