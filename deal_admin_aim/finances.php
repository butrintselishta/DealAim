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
				<a href="#" class="right">View Full Analytics Reports</a>
			</div>
			<div class="panel-content">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart1" class="inlinesparkline">123,65,89,32,67,38,63,12,34,22</div>
								<p class="text-muted"><i class="fa fa-caret-up text-success"></i> 19% compared to last week</p>
							</div>
							<div class="number"><span>$22,500</span> <span>Të ARDHURAT TOTALE</span></div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart2" class="inlinesparkline">77,44,10,80,88,87,19,59,83,88</div>
								<p class="text-muted"><i class="fa fa-caret-up text-success"></i> 24% compared to last week</p>
							</div>
							<div class="number"><span>245</span> <span>TE ARDHURAT PER MUAJIN E FUNDIT</span></div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart3" class="inlinesparkline">99,86,31,72,62,94,50,18,74,18</div>
								<p class="text-muted"><i class="fa fa-caret-up text-success"></i> 44% compared to last week</p>
							</div>
							<div class="number"><span>561,724</span> <span>TE ARDHURAT PER JAVEN E FUNDIT</span></div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="number-chart">
							<div class="mini-stat">
								<div id="number-chart4" class="inlinesparkline">28,44,70,21,86,54,90,25,83,42</div>
								<p class="text-muted"><i class="fa fa-caret-down text-danger"></i> 6% compared to last week</p>
							</div>
							<div class="number"><span>372,500</span> <span>TE ARDHURAT PER DITEN E FUNDIT</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<!-- TRAFFIC SOURCES -->
					<div class="panel-content">
						<h2 class="heading"><i class="fa fa-square"></i> Traffic Sources</h2>
						<div id="demo-pie-chart" class="ct-chart"></div>
					</div>
					<!-- END TRAFFIC SOURCES -->
				</div>
				<div class="col-md-4">
					<!-- REFERRALS -->
					<div class="panel-content">
						<h2 class="heading"><i class="fa fa-square"></i> Referrals</h2>
						<ul class="list-unstyled list-referrals">
							<li>
								<p><span class="value">3,454</span><span class="text-muted">visits from Facebook</span></p>
								<div class="progress progress-xs progress-transparent custom-color-blue">
									<div class="progress-bar" data-transitiongoal="87"></div>
								</div>
							</li>
							<li>
								<p><span class="value">2,102</span><span class="text-muted">visits from Twitter</span></p>
								<div class="progress progress-xs progress-transparent custom-color-purple">
									<div class="progress-bar" data-transitiongoal="34"></div>
								</div>
							</li>
							<li>
								<p><span class="value">2,874</span><span class="text-muted">visits from Affiliates</span></p>
								<div class="progress progress-xs progress-transparent custom-color-green">
									<div class="progress-bar" data-transitiongoal="67"></div>
								</div>
							</li>
							<li>
								<p><span class="value">2,623</span><span class="text-muted">visits from Search</span></p>
								<div class="progress progress-xs progress-transparent custom-color-yellow">
									<div class="progress-bar" data-transitiongoal="54"></div>
								</div>
							</li>
						</ul>
					</div>
					<!-- END REFERRALS -->
				</div>
			</div>
		</div>
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
<script>
	$(function() {
		var options;

		var data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [
				[200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
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
			series: [5, 3]
		};

		var labels = ['Tërheqje parash', 'Shitje'];
		var sum = function(a, b) {
			return a + b;
		};

		new Chartist.Pie('#demo-pie-chart', dataPie, {
			height: "270px",
			labelInterpolationFnc: function(value, idx) {
				var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
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


		// traffic sources
		var dataPie = {
		series: [45, 25, 30]
		};

		var labels = ['Direct', 'Organic', 'Referral'];
		var sum = function(a, b) {
		return a + b;
		};

		new Chartist.Pie('#demo-pie-chart', dataPie, {
		height: "270px",
		labelInterpolationFnc: function(value, idx) {
			var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
			return labels[idx] + ' (' + percentage + ')';
		}
		});


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