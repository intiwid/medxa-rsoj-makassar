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

			.btn{
				box-shadow: none;
			}
			.btn:hover{
				box-shadow: none;
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
					
					

					<div class="row">
						
						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Ref. Physician</h3>
									<hr style="margin-top: 5px;">
									<a href="new_dokter.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_dokter.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Radiology Physician</h3>
									<hr style="margin-top: 5px;">
									<a href="new_dokter_radiology.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_dokter_radiology.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Radiographer</h3>
									<hr style="margin-top: 5px;">
									<a href="new_radiographer.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_radiographer.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Departmen</h3>
									<hr style="margin-top: 5px;">
									<a href="new_department.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_department.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Modality</h3>
									<hr style="margin-top: 5px;">
									<a href="new_modalitas.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_modalitas.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Procedure</h3>
									<hr style="margin-top: 5px;">
									<a href="new_study.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_study.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>AET Worklist</h3>
									<hr style="margin-top: 5px;">
									<a href="new_ae_worklist.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_ae_worklist.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>AET Send</h3>
									<hr style="margin-top: 5px;">
									<a href="new_ae_send.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_ae_send.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>


						<?php if ($level == 'superadmin') { ?>
						<!-- ===================superadmin==================	 -->
						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Login</h3>
									<hr style="margin-top: 5px;">
									<a href="new_login.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_login.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Template</h3>
									<hr style="margin-top: 5px;">
									<a href="new_template.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_template.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Worklist</h3>
									<hr style="margin-top: 5px;">
									<a href="new_selected_dokter_radiology.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_selected_dokter_radiology.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>IP Public</h3>
									<hr style="margin-top: 5px;">
									<a href="new_hostname_publik.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_hostname_publik.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Notification Radiologist</h3>
									<hr style="margin-top: 5px;">
									<a href="new_notification_radiologist.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_notification_radiologist.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>
						<!-- ===================superadmin==================	 -->
						<?php } ?>



						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Payment</h3>
									<hr style="margin-top: 5px;">
									<a href="new_payment.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_payment.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Kop Surat</h3>
									<hr style="margin-top: 5px;">
									<a href="new_kop_surat.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="http://<?= $_SERVER['SERVER_NAME']; ?>:8000/kop-surat" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="box-admin1">
								<div class="box-title-admin">
									<h3>Expertise</h3>
									<hr style="margin-top: 5px;">
									<a href="new_expertise.php" class="btn-add-admin"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add</a>
									<a href="view_expertise.php" class="btn-view-admin"><i class="fas fa-table"></i>&nbsp;&nbsp; View</a>
								</div>
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