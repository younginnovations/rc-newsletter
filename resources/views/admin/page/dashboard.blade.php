<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">

	<title>Dashboard</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!--external css-->
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
	<link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">

	<script src="assets/js/chart-master/Chart.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

<section id="container" >
	<!-- **********************************************************************************************************************************************************
	TOP BAR CONTENT & NOTIFICATIONS
	*********************************************************************************************************************************************************** -->
	<!--header start-->
	<header class="header black-bg">
		<div class="sidebar-toggle-box">
			<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
		</div>
		<!--logo end-->
		<div class="nav notify-row" id="top_menu">
			<!--  notification start -->
			<ul class="nav top-menu">
				<!-- settings start -->
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
						<i class="fa fa-tasks"></i>
						<span class="badge bg-theme">4</span>
					</a>
					<ul class="dropdown-menu extended tasks-bar">
						<div class="notify-arrow notify-arrow-green"></div>
						<li>
							<p class="green">You have 4 pending tasks</p>
						</li>
						<li>
							<a href="#">
								<div class="task-info">
									<div class="desc">DashGum Admin Panel</div>
									<div class="percent">40%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
										<span class="sr-only">40% Complete (success)</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<div class="task-info">
									<div class="desc">Database Update</div>
									<div class="percent">60%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
										<span class="sr-only">60% Complete (warning)</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<div class="task-info">
									<div class="desc">Product Development</div>
									<div class="percent">80%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
										<span class="sr-only">80% Complete</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<div class="task-info">
									<div class="desc">Payments Sent</div>
									<div class="percent">70%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
										<span class="sr-only">70% Complete (Important)</span>
									</div>
								</div>
							</a>
						</li>
						<li class="external">
							<a href="#">See All Tasks</a>
						</li>
					</ul>
				</li>
				<!-- settings end -->
				<!-- inbox dropdown start-->
				<li id="header_inbox_bar" class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
						<i class="fa fa-envelope-o"></i>
						<span class="badge bg-theme">5</span>
					</a>
					<ul class="dropdown-menu extended inbox">
						<div class="notify-arrow notify-arrow-green"></div>
						<li>
							<p class="green">You have 5 new messages</p>
						</li>
						<li>
							<a href="#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
								<span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
								<span class="message">
                                        Hi mate, how is everything?
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-divya.jpg"></span>
								<span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
								<span class="message">
                                     Hi, I need your help with this.
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
								<span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
								<span class="message">
                                        Love your new Dashboard.
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-sherman.jpg"></span>
								<span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
								<span class="message">
                                        Please, answer asap.
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">See all messages</a>
						</li>
					</ul>
				</li>
				<!-- inbox dropdown end -->
			</ul>
			<!--  notification end -->
		</div>
		<div class="top-menu">
			<ul class="nav pull-right top-menu">
				<li><a class="logout" href="{{route('logout')}}">Logout</a></li>
			</ul>
		</div>
	</header>
	<!--header end-->

	<!-- **********************************************************************************************************************************************************
	MAIN SIDEBAR MENU
	*********************************************************************************************************************************************************** -->
	<!--sidebar start-->
	<aside>
		<div id="sidebar"  class="nav-collapse ">
			<!-- sidebar menu start-->
			<ul class="sidebar-menu" id="nav-accordion">

				<li class="mt">
					<a class="active" href="index.html">
						<i class="fa fa-dashboard"></i>
						<span>Dashboard</span>
					</a>
				</li>
			</ul>
			<!-- sidebar menu end-->
		</div>
	</aside>
	<!--sidebar end-->

	<!-- **********************************************************************************************************************************************************
	MAIN CONTENT
	*********************************************************************************************************************************************************** -->
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">

			<div class="row">
				<div class="col-lg-9 main-chart">
					<section class="wrapper">
						<h3><i class="fa fa-angle-right"></i> Subscribed Users</h3>
						<div class="row mt">
							<div class="col-lg-12">
								<div class="content-panel">
									<h4><i class="fa fa-angle-right"></i> Table</h4>
									<section id="unseen">
										<table class="table table-bordered table-striped table-condensed">
											<thead>
											<tr>
												<th>Id</th>
												<th>Email</th>
												<th>Country</th>
												<th>Corporate Group</th>
												<th>Source</th>
												<th>Status</th>
												<th>Created Time</th>
												<th>Updated Time</th>
											</tr>
											</thead>
											<tbody>
											@foreach($subscribers as $subscriber)
												<tr>
													<td>{{$subscriber->id}}</td>
													<td>{{$subscriber->email}}</td>
													<td>{{join(',', $subscriber->group->country)}}</td>
													<td>{{join(',', $subscriber->group->corporate_group)}}</td>
													<td>{{$subscriber->source}}</td>
													<td>{{$subscriber->status}}</td>
													<td>{{$subscriber->created_at->format('Y-m-d')}}</td>
													<td>{{$subscriber->updated_at->format('Y-m-d')}}</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</section>
								</div><!-- /content-panel -->
							</div><!-- /col-lg-4 -->
						</div><!-- /row -->

					</section>
				</div>
			</div><! --/row -->
		</section>
	</section>

	<!--main content end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/js/jquery.sparkline.js"></script>


<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="assets/js/gritter-conf.js"></script>


</body>
</html>
