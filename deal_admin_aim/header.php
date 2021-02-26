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
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/metisMenu/metisMenu.css">
	<link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/vendor/parsleyjs/css/parsley.css">
    <link rel="stylesheet" href="assets/vendor/summernote/summernote.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-markdown/bootstrap-markdown.min.css">
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
					<a href="index.html"><img src="../img/logo/logo_dealaim_black.png"  class="img-responsive"></a>
				</div>
				<!-- end logo -->
				<div class="navbar-right">
					<!-- search form -->
					<form id="navbar-search" class="navbar-form search-form">
						<input value="" class="form-control" placeholder="Search here..." type="text">
						<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
					</form>
					<!-- end search form -->
					<!-- navbar menu -->
					<div id="navbar-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
									<i class="lnr lnr-alarm"></i>
									<span class="notification-dot"></span>
								</a>
								<ul class="dropdown-menu notifications">
									<li class="header"><strong>You have 7 new notifications</strong></li>
									<li>
										<a href="#">
											<div class="media">
												<div class="media-left">
													<i class="fa fa-fw fa-flag-checkered text-muted"></i>
												</div>
												<div class="media-body">
													<p class="text">Your campaign <strong>Holiday Sale</strong> is starting to engage potential customers.</p>
													<span class="timestamp">24 minutes ago</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="media">
												<div class="media-left">
													<i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
												</div>
												<div class="media-body">
													<p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
													<span class="timestamp">2 hours ago</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="media">
												<div class="media-left">
													<i class="fa fa-fw fa-bar-chart text-muted"></i>
												</div>
												<div class="media-body">
													<p class="text">Website visits from Facebook is 27% higher than last week.</p>
													<span class="timestamp">Yesterday</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="media">
												<div class="media-left">
													<i class="fa fa-fw fa-check-circle text-success"></i>
												</div>
												<div class="media-body">
													<p class="text">Your campaign <strong>Holiday Sale</strong> is approved.</p>
													<span class="timestamp">2 days ago</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="media">
												<div class="media-left">
													<i class="fa fa-fw fa-exclamation-circle text-danger"></i>
												</div>
												<div class="media-body">
													<p class="text">Error on website analytics configurations</p>
													<span class="timestamp">3 days ago</span>
												</div>
											</div>
										</a>
									</li>
									<li class="footer"><a href="#" class="more">See all notifications</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
									<i class="lnr lnr-cog"></i>
								</a>
								<ul class="dropdown-menu user-menu menu-icon">
									<li class="menu-heading">ACCOUNT SETTINGS</li>
									<li><a href="#"><i class="fa fa-fw fa-edit"></i> <span>Basic</span></a></li>
									<li><a href="#"><i class="fa fa-fw fa-bell"></i> <span>Notifications</span></a></li>
									<li><a href="#"><i class="fa fa-fw fa-sliders"></i> <span>Preferences</span></a></li>
									<li><a href="#"><i class="fa fa-fw fa-lock"></i> <span>Privacy</span></a></li>
									<li class="menu-heading">BILLING</li>
									<li><a href="#"><i class="fa fa-fw fa-file-text-o"></i> <span>Invoices</span></a></li>
									<li><a href="#"><i class="fa fa-fw fa-credit-card"></i> <span>Payments</span></a></li>
									<li><a href="#"><i class="fa fa-fw fa-refresh"></i> <span>Renewals</span></a></li>
									<li class="menu-button">
										<a href="#" class="btn btn-primary"><i class="fa fa-rocket"></i> UPGRADE PLAN</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
									<i class="lnr lnr-question-circle"></i>
								</a>
								<ul class="dropdown-menu user-menu">
									<li>
										<form class="search-form help-search-form">
											<input value="" class="form-control" placeholder="How can we help?" type="text">
											<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
										</form>
									</li>
									<li class="menu-heading">HOW-TO</li>
									<li><a href="#">Setting up Campaign</a></li>
									<li><a href="#">Understanding Website Analytics</a></li>
									<li><a href="#">Boost Your Sales</a></li>
									<li><a href="#">Knowing Your Audience</a></li>
									<li class="menu-heading">ACCOUNT</li>
									<li><a href="#">Change Password</a></li>
									<li><a href="#">Privacy &amp; Security</a></li>
									<li><a href="#">Membership</a></li>
									<li class="menu-heading">BILLING</li>
									<li><a href="#">Setup Payment</a></li>
									<li><a href="#">Auto-Renewal Program</a></li>
									<li><a href="#">Cancellation</a></li>
									<li class="menu-button">
										<a href="#" class="btn btn-primary"><i class="fa fa-question-circle"></i> HELP CENTER</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- end navbar menu -->
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->