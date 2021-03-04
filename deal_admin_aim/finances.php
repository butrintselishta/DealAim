<?php 
    require_once "../db.php";
     if(!isset($_SESSION['logged'])){
        header("location:../index.php");
    }else if($_SESSION['user']['status'] !== ADMIN){
        header("location:index.php");
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

	$balance_dealaim = prep_stmt("SELECT * FROM bank_acc WHERE acc_full_name = ?", "DealAIM Company", "s");
	$balance_fetch = mysqli_fetch_array($balance_dealaim);
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
                    <li><a href="profile.phP">Profili im</a></li>
                    <li><a href="#">Messages</a></li>
                    <li><a href="#">Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
				<li class=""><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li ><a href="myprofile.php"><i class="lnr lnr-user"></i> <span>Profili im</span></a></li>
                <?php if($_SESSION['user']['status'] == ADMIN) { ?>
                    <li class="active"><a href="finances.php"><i class="lnr lnr-chart-bars"></i> <span>Financat</span></a></li>
                    <li><a href="users.php"><i class="lnr lnr-users"></i> <span>Përdoruesit</span></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
<!-- MAIN CONTENT -->
<div id="main-content">
    <div class="container-fluid">
		<div class="dashboard-section">
			<div class="section-heading clearfix">
				<h2 class="section-title"><i class="fa fa-pie-chart"></i> Analiza e të ardhurave </h2>
				<!-- <a href="#" class="right">View Full Analytics Reports</a> -->
			</div>
			<div class="panel-content">
				<div class="row">
					<!-- YEARLY PROFIT --->
					<div class="col-md-3 col-sm-6">
					<?php 
							$thisYear = prep_stmt("SELECT * FROM income_ratio
							WHERE YEAR(date_time) = YEAR(CURRENT_DATE)");

							$lastYear = prep_stmt("SELECT * FROM income_ratio
							WHERE YEAR(date_time) = YEAR(CURRENT_DATE - INTERVAL 1 YEAR)");

							$thisYearProfit = 0;
							$lastYearProfit = 0;
							if(mysqli_num_rows($lastYear) > 0){
								while($row = mysqli_fetch_array($lastYear)){
									$lastYearProfit = $lastYearProfit + $row['profit'];
								}
							}
							if(mysqli_num_rows($thisYear) > 0){
								while($row = mysqli_fetch_array($thisYear)){
									$thisYearProfit = $thisYearProfit + $row['profit']; 
								}
							}
							//die($lastYearProfit . " " . $thisYearProfit);
							$YearProfitPerc = 0;
							if($thisYearProfit > $lastYearProfit){
								$YearProfitPerc = ($thisYearProfit - $lastYearProfit) ;
								$YearProfitPerc = ($YearProfitPerc / $lastYearProfit) * 100;
								$YearProfitPerc = number_format($YearProfitPerc,2) . " %";
							}else if($thisYearProfit < $lastYearProfit){
								$YearProfitPerc = $thisYearProfit - $lastYearProfit;
								$profiYearProfitPerctPerc = ($YearProfitPerc / $lastYearProfit) * 100 ;
								$YearProfitPerc = number_format($YearProfitPerc,2) . " %";
							}else{
								$YearProfitPerc = 0 . " %";
							}
						?>
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart1" class="inlinesparkline"><?php echo $lastYearProfit . ",".$thisYearProfit; ?></div>
								<?php if($YearProfitPerc < 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-down text-danger'></i> $YearProfitPerc krahasuar me vitin e kaluar!</p>";
								 }elseif($YearProfitPerc > 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $YearProfitPerc krahasuar me vitin e kaluar!</p>";
								 }else{
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $YearProfitPerc krahasuar me vitin e kaluar!</p>";
								 } ?>
							</div>
							<div class="number"><span><?php echo number_format($balance_fetch['acc_balance'],2). "€"; ?></span> <span>TE ARDHURAT TOTALE</span></div>
						</div>
					</div>
					<!-- MONTHLY PROFIT --->
					<div class="col-md-3 col-sm-6">
					<?php 
						$thisMonth = prep_stmt("SELECT * FROM income_ratio
						WHERE YEAR(date_time) = YEAR(CURRENT_DATE)
						AND MONTH(date_time) = MONTH(CURRENT_DATE)");

						$lastMonth = prep_stmt("SELECT * FROM income_ratio
						WHERE YEAR(date_time) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
						AND MONTH(date_time) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)");

						$thisMonthProfit = 0;
						$lastMonthProfit = 0;
						if(mysqli_num_rows($lastMonth) > 0){
							while($row = mysqli_fetch_array($lastMonth)){
								$lastMonthProfit = $lastMonthProfit + $row['profit'];
							}
						}
						if(mysqli_num_rows($thisMonth) > 0){
							while($row = mysqli_fetch_array($thisMonth)){
								$thisMonthProfit = $thisMonthProfit + $row['profit'];
							}
						}
						//die($lastMonthProfit . " " . $thisMonthProfit);
						$profitPerc = 0;
						if($thisMonthProfit > $lastMonthProfit){
							$profitPerc = ($thisMonthProfit - $lastMonthProfit) * 100 ;
							$profitPerc = number_format($profitPerc,2) . " %";
						}else if($thisMonthProfit < $lastMonthProfit){
							$profitPerc = $thisMonthProfit - $lastMonthProfit;
							$profitPerc = ($profitPerc / $lastMonthProfit) * 100 ;
							$profitPerc = number_format($profitPerc,2) . " %";
						}else{
							$profitPerc = 0 . " %";
						}
					?>
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart2" class="inlinesparkline"><?php echo $lastMonthProfit . "," . $thisMonthProfit ?></div>
								<?php if($profitPerc < 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-down text-danger'></i> $profitPerc krahasuar me muajin e kaluar!</p>";
								 }elseif($profitPerc > 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $profitPerc krahasuar me muajin e kaluar!</p>";
								 }else{
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $profitPerc krahasuar me muajin e kaluar!</p>";
								 } ?>
							</div>
							<div class="number"><span><?php echo number_format($thisMonthProfit,2) . "€" ?></span> <span>Të ARDHURAT PËR KËTË MUAJ</span></div>
						</div>
					</div>
					<!-- WEEKLY PROFIT --->
					<div class="col-md-3 col-sm-6">
						<?php 
							$thisWeek = prep_stmt("SELECT * FROM income_ratio
							WHERE YEAR(date_time) = YEAR(CURRENT_DATE)
							AND MONTH(date_time) = MONTH(CURRENT_DATE)
							AND WEEK(date_time) = WEEK(CURRENT_DATE)");
							
							$lastWeek = prep_stmt("SELECT * FROM income_ratio
							WHERE YEAR(date_time) = YEAR(CURRENT_DATE - INTERVAL 1 WEEK)
							AND MONTH(date_time) = MONTH(CURRENT_DATE - INTERVAL 1 WEEK)
							AND WEEK(date_time) = WEEK(CURRENT_DATE - INTERVAL 1 WEEK)");

							$thisWeekProfit = 0;
							$lastWeekProfit = 0;
							if(mysqli_num_rows($lastWeek) > 0){
								while($row = mysqli_fetch_array($lastWeek)){
									$lastWeekProfit = $lastWeekProfit + $row['profit'];
								}
							}
							if(mysqli_num_rows($thisWeek) > 0){
								while($row = mysqli_fetch_array($thisWeek)){
									$thisWeekProfit = $thisWeekProfit + $row['profit'];
								}
							}

							$weekProfitPerc = 0;
							if($thisWeekProfit > $lastWeekProfit){
								$weekProfitPerc = ($thisWeekProfit - $lastWeekProfit) * 100 ;
								$weekProfitPerc = number_format($weekProfitPerc,2) . " %";
							}else if($thisWeekProfit < $lastWeekProfit){
								$weekProfitPerc = $thisWeekProfit - $lastWeekProfit;
								$weekProfitPerc = ($weekProfitPerc / $lastWeekProfit) * 100 ;
								$weekProfitPerc = number_format($weekProfitPerc,2) . " %";
							}else{
								$weekProfitPerc = 0 . " %";
							}
							
						?>
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart3" class="inlinesparkline"><?php echo $lastWeekProfit . "," . $thisWeekProfit ?></div>
								<?php if($weekProfitPerc < 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-down text-danger'></i> $weekProfitPerc krahasuar me javën e kaluar!</p>";
								 }elseif($weekProfitPerc > 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $weekProfitPerc krahasuar me javën e kaluar!</p>";
								 }else{
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $weekProfitPerc krahasuar me javën e kaluar!</p>";
								 } ?>
							</div>
							<div class="number"><span><?php echo number_format($thisWeekProfit,2) . "€" ?></span> <span>TE ARDHURAT PËR KËTË JAVË</span></div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<?php 
							$thisDay = prep_stmt("SELECT * FROM income_ratio
							WHERE YEAR(date_time) = YEAR(CURRENT_DATE)
							AND MONTH(date_time) = MONTH(CURRENT_DATE)
							AND WEEK(date_time) = WEEK(CURRENT_DATE)
                            AND DAY(date_time) = DAY(CURRENT_DATE)");
							
							$lastDay = prep_stmt("SELECT * FROM income_ratio
							WHERE YEAR(date_time) = YEAR(CURRENT_DATE - INTERVAL 1 DAY)
							AND MONTH(date_time) = MONTH(CURRENT_DATE - INTERVAL 1 DAY)
							AND WEEK(date_time) = WEEK(CURRENT_DATE - INTERVAL 1 DAY)
                            AND DAY(date_time) = DAY(CURRENT_DATE - INTERVAL 1 DAY)");

							$thisDayProfit = 0;
							$lastDayProfit = 0;
							if(mysqli_num_rows($lastDay) > 0){
								while($row = mysqli_fetch_array($lastDay)){
									$lastDayProfit = $lastDayProfit + $row['profit'];
								}
							}
							if(mysqli_num_rows($thisDay) > 0){
								while($row = mysqli_fetch_array($thisDay)){
									$thisDayProfit = $thisDayProfit + $row['profit'];
								}
							}

							$dayProfitPerc = 0;
							if($thisDayProfit > $lastDayProfit){
								$dayProfitPerc = ($thisDayProfit - $lastDayProfit) * 100 ;
								$dayProfitPerc = number_format($dayProfitPerc,2) . " %";
							}else if($thisDayProfit < $lastDayProfit){
								$dayProfitPerc = $thisDayProfit - $lastDayProfit;
								$dayProfitPerc = ($dayProfitPerc / $lastDayProfit) * 100 ;
								$dayProfitPerc = number_format($dayProfitPerc,2) . " %";
							}else{
								$dayProfitPerc = 0 . " %";
							}
							
						?>
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart4" class="inlinesparkline"><?php echo $lastDayProfit . "," . $thisDayProfit ?></div>
								<?php if($dayProfitPerc < 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-down text-danger'></i> $dayProfitPerc krahasuar me ditën e kaluar!</p>";
								 }elseif($dayProfitPerc > 0){ 
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $dayProfitPerc krahasuar me ditën e kaluar!</p>";
								 }else{
									echo "<p class='text-muted'><i class='fa fa-caret-up text-success'></i> $dayProfitPerc krahasuar me ditën e kaluar!</p>";
								 } ?>
							</div>
							<div class="number"><span><?php echo number_format($thisDayProfit,2) . "€" ?></span> <span>TE ARDHURAT PËR SOT</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<!-- TARIFF TYPE -->
					<?php
						$tariffWithdrawal = prep_stmt("SELECT * FROM income_ratio WHERE tariff_type = ?", "Tërheqje parash", "s");
						$tariffSoldProd = prep_stmt("SELECT * FROM income_ratio WHERE tariff_type = ?", "Shitje e produktit", "s");

						$withdrawal = 0; 
						$soldProd = 0;
						$withCount = 0;
						$solCount = 0;
						if(mysqli_num_rows($tariffWithdrawal)>0){
							while($row = mysqli_fetch_array($tariffWithdrawal)){
								$withCount++;
								$withdrawal = $withdrawal + $row['profit'];
							}
						}
						if(mysqli_num_rows($tariffSoldProd)>0){
							while($row = mysqli_fetch_array($tariffSoldProd)){
								$solCount++;
								$soldProd = $soldProd + $row['profit'];
							}
						}

					?>
					<div class="panel-content">
						<h2 class="heading"><i class="fa fa-square"></i> Lloji i tarifes</h2>
						<div id="demo-pie-chart" class="ct-chart"></div>
					</div>
					<!-- END TRAFFIC SOURCES -->
				</div>
				<div class="col-md-4">
					<!-- REFERRALS -->
					<div class="panel-content">
						<h2 class="heading"><i class="fa fa-square"></i> Detajet </h2>
						<ul class="list-unstyled list-referrals">
							<li>
								<p><span class="value"><?php echo $withCount; ?></span><span class="text-muted">herë </span>(nga terheqja e parave)</p>
								<div class="progress progress-xs progress-transparent custom-color-blue" style="background-color:blue;">
									<div class="progress-bar" data-transitiongoal="87"></div>
								</div>
							</li>
							<li>
								<p><span class="value"><?php echo $solCount; ?></span><span class="text-muted">herë</span> (nga produktet e shitura)</p>
								<div class="progress progress-xs progress-transparent custom-color-green" style="background-color:green;">
									<div class="progress-bar" data-transitiongoal="34"></div>
								</div>
							</li>
						</ul>
					</div>
					<!-- END REFERRALS -->
				</div>
			</div>
		</div>
		<?php 
			$sel_prof_lweek = prep_stmt("SELECT * FROM income_ratio WHERE date_time > (DATE(NOW()) - INTERVAL 7 DAY) order by date_time ASC", null, null);

			$last_week = date("d-M", strtotime("-7 days"));
			$week_days = array();
			$cnti = 0;
			for($i = 0; $i < 8; $i++){
				$week_days[] .= "'$last_week'";
				$last_week = date('d-M', strtotime("+1 day", strtotime($last_week)));
			}
			$last_7days = "";
			foreach($week_days as $day){
				$last_7days .= $day . ",";
			}
			$last_7days = rtrim($last_7days, ",");//die($last_7days);

			$db_date = array();
			if(mysqli_num_rows($sel_prof_lweek) > 0){
				while($row = mysqli_fetch_array($sel_prof_lweek)){
					$data = date("d-M", strtotime($row['date_time']));
					$db_date[] = array("data" => $data, "profit" => $row['profit']);
				}
			}
			die(var_dump($db_date));


		?>
        <div class="section-heading">
            <h1 class="page-title">Chartist</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Line Chart</h2>
                    <div id="demo-line-chart" class="ct-chart"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Bar Chart</h2>
                    <div id="demo-bar-chart" class="ct-chart"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Area Chart</h2>
                    <div id="demo-area-chart" class="ct-chart"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Multiple Chart</h2>
                    <div id="demo-multiple-chart" class="ct-chart"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Simple Pie Chart</h2>
                    <div id="demo-pie-chart" class="ct-chart"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Donut Chart</h2>
                    <div id="demo-donut-chart" class="ct-chart"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Stacked Bar Chart</h2>
                    <div id="demo-stackedbar-chart" class="ct-chart"></div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel-content">
                    <h2 class="heading margin-bottom-50"><i class="fa fa-square"></i> Horizontal Bar Chart</h2>
                    <div id="demo-horizontalbar-chart" class="ct-chart"></div>
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
<script src="assets/vendor/chartist/js/chartist.min.js"></script>
<script src="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>
<script src="assets/vendor/chartist-plugin-legend-latest/chartist-plugin-legend.js"></script>
<script src="assets/vendor/chartist-plugin-axistitle/chartist-plugin-axistitle.min.js"></script>
<script src="assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js"></script>
<script src="assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>
<script src="assets/vendor/toastr/toastr.js"></script>
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
<?php ?>
<script>
	$(function() {
		var options;

		var data = {
			labels: [<?php echo $last_7days ?>],
			series: [
				[200, 380, 350, 320, 410, 450, 570,234],
			]
		};

		// line chart
		options = {
			height: "300px",
			showPoint: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
			]
		};

		new Chartist.Line('#demo-line-chart', data, options);


		// bar chart
		options = {
			height: "300px",
			axisX: {
				showGrid: false
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
			]
		};

		new Chartist.Bar('#demo-bar-chart', data, options);


		// area chart
		options = {
			height: "270px",
			showArea: true,
			showLine: false,
			showPoint: false,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#demo-area-chart', data, options);


		// multiple chart
		var dataMultiple = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}, {
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}]
		};

		options = {
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showPoint: false,
				},
			},
			plugins: [
				Chartist.plugins.legend({
					legendNames: ['Actual', 'Projection']
				})
			]
		};

		new Chartist.Line('#demo-multiple-chart', dataMultiple, options);


		// pie chart
		var dataPie = {
			series: [<?php echo $withdrawal . "," . $soldProd ?>]
		};

		var labels = ['Tërheqje', 'Shitje'];
		var sum = function(a, b) {
			return a + b;
		};
		
		new Chartist.Pie('#demo-pie-chart', dataPie, {
			height: "270px",
			labelInterpolationFnc: function(value, idx) {
				var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
				console.log(value / dataPie.series.reduce(sum));
				return labels[idx] + ' (' + percentage + ')';
			}
		});


		// donut chart
		var dataDonut = {
			series: [20, 10, 30, 40]
		};

		new Chartist.Pie('#demo-donut-chart', dataDonut, {
			height: "270px",
			donut: true,
			donutWidth: 60,
			donutSolid: true,
			startAngle: 270,
			showLabel: true
		});


		// stacked bar chart
		var dataStackedBar = {
			labels: ['Q1', 'Q2', 'Q3', 'Q4'],
			series: [
				[800000, 1200000, 1400000, 1300000],
				[200000, 400000, 500000, 300000],
				[100000, 200000, 400000, 600000]
			]
		};

		new Chartist.Bar('#demo-stackedbar-chart', dataStackedBar, {
			height: "270px",
			stackBars: true,
			axisX: {
				showGrid: false
			},
			axisY: {
				labelInterpolationFnc: function(value) {
					return (value / 1000) + 'k';
				}
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
			]
		}).on('draw', function(data) {
			if (data.type === 'bar') {
				data.element.attr({
					style: 'stroke-width: 30px'
				});
			}
		});


		// horizontal bar chart
		var dataHorizontalBar = {
			labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
			series: [
				[5, 4, 3, 7, 5, 10, 3],
				[3, 2, 9, 5, 4, 6, 4]
			]
		};

		new Chartist.Bar('#demo-horizontalbar-chart', dataHorizontalBar, {
			height: "300px",
			seriesBarDistance: 15,
			reverseData: true,
			horizontalBars: true,
			axisY: {
				offset: 75
			}
		});

	});

	$(function() {

		var sparklineNumberChart = function() {

		var params = {
			width: '140px',
			height: '30px',
			lineWidth: '2',
			lineColor: '#20B2AA',
			fillColor: false,
			spotRadius: '2',
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			disableInteraction: false
		};

		$('#number-chart1').sparkline('html', params);
		$('#number-chart2').sparkline('html', params);
		$('#number-chart3').sparkline('html', params);
		$('#number-chart4').sparkline('html', params);
		};

		sparklineNumberChart();




		// progress bars
		$('.progress .progress-bar').progressbar({
			display_text: 'none'
		});

		// line chart
		var data = {
		labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		series: [
			[200, 380, 350, 480, 410, 450, 550],
		]
		};

		var options = {
		height: "200px",
		showPoint: true,
		showArea: true,
		axisX: {
			showGrid: false
		},
		lineSmooth: false,
		chartPadding: {
			top: 0,
			right: 0,
			bottom: 30,
			left: 30
		},
		plugins: [
			Chartist.plugins.tooltip({
				appendToBody: true
			}),
			Chartist.plugins.ctAxisTitle({
				axisX: {
					axisTitle: 'Day',
					axisClass: 'ct-axis-title',
					offset: {
						x: 0,
						y: 50
					},
					textAnchor: 'middle'
				},
				axisY: {
					axisTitle: 'Reach',
					axisClass: 'ct-axis-title',
					offset: {
						x: 0,
						y: -10
					},
				}
			})
		]
		};

		new Chartist.Line('#demo-line-chart', data, options);


		// sales performance chart
		var sparklineSalesPerformance = function() {

		var lastWeekData = [142, 164, 298, 384, 232, 269, 211];
		var currentWeekData = [352, 267, 373, 222, 533, 111, 60];

		$('#chart-sales-performance').sparkline(lastWeekData, {
			fillColor: 'rgba(90, 90, 90, 0.1)',
			lineColor: '#5A5A5A',
			width: '' + $('#chart-sales-performance').innerWidth() + '',
			height: '100px',
			lineWidth: '2',
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			chartRangeMin: 0,
			chartRangeMax: 1000
		});

		$('#chart-sales-performance').sparkline(currentWeekData, {
			composite: true,
			fillColor: 'rgba(60, 137, 218, 0.1)',
			lineColor: '#3C89DA',
			lineWidth: '2',
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			chartRangeMin: 0,
			chartRangeMax: 1000
		});
		}

		sparklineSalesPerformance();

		var sparkResize;
		$(window).on('resize', function() {
		clearTimeout(sparkResize);
		sparkResize = setTimeout(sparklineSalesPerformance, 200);
		});


		// top products
		var dataStackedBar = {
		labels: ['Q1', 'Q2', 'Q3'],
		series: [
			[800000, 1200000, 1400000],
			[200000, 400000, 500000],
			[100000, 200000, 400000]
		]
		};

		new Chartist.Bar('#chart-top-products', dataStackedBar, {
		height: "250px",
		stackBars: true,
		axisX: {
			showGrid: false
		},
		axisY: {
			labelInterpolationFnc: function(value) {
				return (value / 1000) + 'k';
			}
		},
		plugins: [
			Chartist.plugins.tooltip({
				appendToBody: true
			}),
			Chartist.plugins.legend({
				legendNames: ['Phone', 'Laptop', 'PC']
			})
		]
		}).on('draw', function(data) {
		if (data.type === 'bar') {
			data.element.attr({
				style: 'stroke-width: 30px'
			});
		}
		});
	});

	
	</script>
</body>

</html>