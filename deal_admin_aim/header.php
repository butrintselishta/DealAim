<?php 
    require_once "../db.php";
?>
<!doctype html>
<html lang="en">

<head>
	<title>DealAIM</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	
	<!-- JQUERY CONFIRM -->
	<link rel="stylesheet" id="bs-stylesheet" href="assets/confirm/bs3.css">
    <link rel="stylesheet" href="assets/confirm/bundled.css">
    <!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
    <link rel="stylesheet" href="assets/confirm/demo.css">
    <script>
        var version = '3.3.4';
    </script>
    <link rel="stylesheet" type="text/css" href="assets/confirm/jquery-confirm.css"/>

	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/metisMenu/metisMenu.css">
	<link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/vendor/parsleyjs/css/parsley.css">
    <link rel="stylesheet" href="assets/vendor/summernote/summernote.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-markdown/bootstrap-markdown.min.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist.min.css">
	<link rel="stylesheet" href="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/datepicker.css" type="text/css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../img/logo/logo_circle.ico">
	

    <style>
	.table-wrapper-scroll-y {
	max-height: 50rem;
	overflow: auto;
	display:block;
	}
	.table-striped {
		background: #F3F5F6;
	}
    .img-res{
        padding: 0 3px;
    }
    @media only screen and (max-width: 768px){
        .img-res{
            width:100% !important;
            padding-bottom: 3px;
        }
		
		.fieldS{
			margin:auto;
			width:100%;
		}
		.label_field{
			float:left;
		}
		.input_field{
			width:100%;
		}
    } 
	@media screen and (max-width: 992px) {
        .fieldS{
			margin:auto;
			width:100%;
		}
		.label_field{
			float:right;
		}
		.input_field{
			width:100%;
		}
    }
	@media screen and (min-width: 992px) {
        .fieldS{
			margin:auto;
			width:75%;
		}
		.label_field{
			float:right;
		}
		.input_field{
			width:100%;
		}
    }
    .sukses {
        width:100%;
        padding: 10px 10px 1px 10px;
        background-color:#D4EDDA;
        text-align:center;
        margin-bottom:6px;
    }
    .gabim {
        width:100%;
        padding: 10px 10px 1px 10px;
        background-color:#EFB3AB;
        text-align:center;
        margin-bottom:6px;
    }       
	#navbar-search1 {
		margin-left: 20px;
   		margin-right: 20px;
	}
	.btn_det{
		background-color: #5A5A5A;
		color: #fff;
	}
	.btn_det:hover{
		background-color: #cecece;
		color: #5A5A5A;
	}
    </style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu"></i></button>
				</div>
				<!-- logo -->
				<div class="navbar-brand" style="padding:8px 15px; max-width:15%;">
					<a href="index.html"><img src="../img/logo/mobile-logo.png"  class="img-responsive"></a>
				</div>
				<!-- end logo -->
				<div class="navbar-right">
					<!-- search form -->
					<form id="navbar-search1" class="navbar-form search-form">
						<input value="" class="form-control" placeholder=" here..." type="text">
						<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->