<?php

require '../koneksi/koneksi.php';

session_start();
$username = $_SESSION['username'];
$level = $_SESSION['level'];

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Administrator | Admin</title>
		<?php include('head.php'); ?>
		<style>
			.social-links {
				transition: 0.2s ease-in-out;
				position: relative;
				list-style: none;
				display: flex;
				height: 100px;
				width: 500px;
			}

			.social-links:hover>li {
				transform: scale(0.95);
				/* filter: blur(2px); */
			}

			.social-links li {
				transition: 0.2s ease-in-out;
				border-radius: 10px;
				place-items: center;
				cursor: pointer;
				display: grid;
				margin: 35px;
				height: 60px;
				width: 60px;
			}

			.social-links li:hover {
				filter: blur(0px);
				transform: scale(1);
			}

			.social-links svg {
				transition: 0.2s ease-in-out;
				pointer-events: none;
				height: 40px;
				width: 40px;
			}

			.li-admin h5 {
				text-align: center;
				font-weight: bold;
				color: #fff;
			}

			.tab-pane h4 {
				color: #1a61ac;
			}

			.nav-tabs li a {
				font-weight: bold;
				font-size: 18px;
				padding: 7px 10px 10px 10px;
				color: #1a61ac;
			}

			.nav-tabs>li.active>a,
			.nav-tabs>li.active>a:hover,
			.nav-tabs>li.active>a:focus {
				color: #FFF;
				cursor: default;
				background-color: #1f69b7;
				border: none;
				border-bottom-color: rgb(221, 221, 221);
				border-bottom-color: transparent;
				padding: 7px 10px 15px 10px;
				font-size: 18px;
			}

			.nav>li>a:hover,
			.nav>li>a:focus {
				text-decoration: none;
				background-color: #1f69b7;
				border: none;
				color: #fff;
			}

			.tab-content {
				background-color: #1f69b7;
				width: 100%;
				height: 200px;
				margin: -10px 0;
				padding: 10px;
				border-radius: 5px;
			}
		</style>

	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['administrator'] ?></li>
			</ol>
		</nav>

		<div id="container1">
			<div id="content1">

				<div class="container-fluid adm">
					<div class="content-adm" style="padding: 0;">

						<div>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#home">Ref. Physician</a></li>
								<li><a data-toggle="tab" href="#menu1">Radiology Physician</a></li>
								<li><a data-toggle="tab" href="#menu2">Radiographer</a></li>
								<li><a data-toggle="tab" href="#menu3">Department</a></li>
								<li><a data-toggle="tab" href="#menu4">Modality</a></li>
								<li><a data-toggle="tab" href="#menu5">Procedure</a></li>
								<li><a data-toggle="tab" href="#menu6">AET</a></li>
								<?php
								if ($level == 'superadmin') { ?>
									<li><a data-toggle="tab" href="#menu7">Login</a></li>
									<li><a data-toggle="tab" href="#menu8">Template</a></li>
									<li><a data-toggle="tab" href="#menu9">Worklist</a></li>
									<li><a data-toggle="tab" href="#menu10">IP Publik</a></li>
									<li><a data-toggle="tab" href="#menu11">Notification Radiologist</a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div id="home" class="tab-pane fade in active">
									<div>
										<ul class="social-links">
											<li class="li-admin">
												<a href="new_dokter.php">
													<img style="width: 100%;" src="../image/plus.png">
													<h5><?= $lang['add'] ?></h5>
												</a>
											</li>
											<li class="li-admin">
												<a href="view_dokter.php">
													<img style="width: 100%;" src="../image/view.png">
													<h5><?= $lang['view'] ?></h5>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div id="menu1" class="tab-pane fade">
									<div id="home" class="tab-pane fade in active">
										<div>
											<ul class="social-links">
												<li class="li-admin">
													<a href="new_dokter_radiology.php">
														<img style="width: 100%;" src="../image/plus.png">
														<h5><?= $lang['add'] ?></h5>
													</a>
												</li>
												<li class="li-admin">
													<a href="view_dokter_radiology.php">
														<img style="width: 100%;" src="../image/view.png">
														<h5><?= $lang['view'] ?></h5>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="menu2" class="tab-pane fade">

									<div id="home" class="tab-pane fade in active">
										<div>
											<ul class="social-links">
												<li class="li-admin">
													<a href="new_radiographer.php">
														<img style="width: 100%;" src="../image/plus.png">
														<h5><?= $lang['add'] ?></h5>
													</a>
												</li>
												<li class="li-admin">
													<a href="view_radiographer.php">
														<img style="width: 100%;" src="../image/view.png">
														<h5><?= $lang['view'] ?></h5>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="menu3" class="tab-pane fade">
									<div id="home" class="tab-pane fade in active">
										<div>
											<ul class="social-links">
												<li class="li-admin">
													<a href="new_department.php">
														<img style="width: 100%;" src="../image/plus.png">
														<h5><?= $lang['add'] ?></h5>
													</a>
												</li>
												<li class="li-admin">
													<a href="view_department.php">
														<img style="width: 100%;" src="../image/view.png">
														<h5><?= $lang['view'] ?></h5>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="menu4" class="tab-pane fade">
									<div id="home" class="tab-pane fade in active">
										<div>
											<ul class="social-links">
												<li class="li-admin">
													<a href="new_modalitas.php">
														<img style="width: 100%;" src="../image/plus.png">
														<h5><?= $lang['add'] ?></h5>
													</a>
												</li>
												<li class="li-admin">
													<a href="view_modalitas.php">
														<img style="width: 100%;" src="../image/view.png">
														<h5><?= $lang['view'] ?></h5>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="menu5" class="tab-pane fade">
									<div id="home" class="tab-pane fade in active">
										<div>
											<ul class="social-links">
												<li class="li-admin">
													<a href="new_study.php">
														<img style="width: 100%;" src="../image/plus.png">
														<h5><?= $lang['add'] ?></h5>
													</a>
												</li>
												<li class="li-admin">
													<a href="view_study.php">
														<img style="width: 100%;" src="../image/view.png">
														<h5><?= $lang['view'] ?></h5>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="menu6" class="tab-pane fade">
									<div id="home" class="tab-pane fade in active">
										<div>
											<ul class="social-links">
												<li class="li-admin">
													<a href="new_ae.php">
														<img style="width: 100%;" src="../image/plus.png">
														<h5><?= $lang['add'] ?></h5>
													</a>
												</li>
												<li class="li-admin">
													<a href="view_ae.php">
														<img style="width: 100%;" src="../image/view.png">
														<h5><?= $lang['view'] ?></h5>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<!-- jika superadmin -->
								<?php
								if ($level == 'superadmin') { ?>
									<div id="menu7" class="tab-pane fade">
										<div id="home" class="tab-pane fade in active">
											<div>
												<ul class="social-links">
													<li class="li-admin">
														<a href="new_login.php">
															<img style="width: 100%;" src="../image/plus.png">
															<h5><?= $lang['add'] ?></h5>
														</a>
													</li>
													<li class="li-admin">
														<a href="view_login.php">
															<img style="width: 100%;" src="../image/view.png">
															<h5><?= $lang['view'] ?></h5>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div id="menu8" class="tab-pane fade">
										<div id="home" class="tab-pane fade in active">
											<div>
												<ul class="social-links">
													<li class="li-admin">
														<a href="new_template.php">
															<img style="width: 100%;" src="../image/plus.png">
															<h5><?= $lang['add'] ?></h5>
														</a>
													</li>
													<li class="li-admin">
														<a href="view_template.php">
															<img style="width: 100%;" src="../image/view.png">
															<h5><?= $lang['view'] ?></h5>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div id="menu9" class="tab-pane fade">
										<div id="home" class="tab-pane fade in active">
											<div>
												<ul class="social-links">
													<li class="li-admin">
														<a href="new_selected_dokter_radiology.php">
															<img style="width: 100%;" src="../image/plus.png">
															<h5><?= $lang['add'] ?> or Update</h5>
														</a>
													</li>
													<li class="li-admin">
														<a href="view_selected_dokter_radiology.php">
															<img style="width: 100%;" src="../image/view.png">
															<h5><?= $lang['view'] ?></h5>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div id="menu10" class="tab-pane fade">
										<div id="home" class="tab-pane fade in active">
											<div>
												<ul class="social-links">
													<li class="li-admin">
														<a href="new_hostname_publik.php">
															<img style="width: 100%;" src="../image/plus.png">
															<h5><?= $lang['add'] ?> or Update</h5>
														</a>
													</li>
													<li class="li-admin">
														<a href="view_hostname_publik.php">
															<img style="width: 100%;" src="../image/view.png">
															<h5><?= $lang['view'] ?></h5>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div id="menu11" class="tab-pane fade">
										<div id="home" class="tab-pane fade in active">
											<div>
												<ul class="social-links">
													<li class="li-admin">
														<a href="new_notification_radiologist.php">
															<img style="width: 100%;" src="../image/plus.png">
															<h5><?= $lang['add'] ?> or Update</h5>
														</a>
													</li>
													<li class="li-admin">
														<a href="view_notification_radiologist.php">
															<img style="width: 100%;" src="../image/view.png">
															<h5><?= $lang['view'] ?></h5>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footerindex">
				<div class="footer-login col-sm-12"><br>
					<center>
						<p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
					</center>
				</div>
			</div>
		</div>
		</div>
		<?php include('script-footer.php'); ?>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>