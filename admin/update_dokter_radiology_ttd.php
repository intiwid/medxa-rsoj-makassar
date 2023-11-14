<?php
require 'function_dokter.php';
session_start();

$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kop_surat"));

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Update ttd dokter radiologi</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page">ttd dokter radiologi</li>
				<li style="float: right;">
					<label>Zoom</label>
					<a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
					<a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
				</li>
			</ol>
		</nav>

		<div id="container1">
			<div id="content1">
				<div class="body">
					<h1 style="color: #ee7423">ttd dokter radiologi</h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form id="kop-surat" method="post" enctype="multipart/form-data">
								<div class="col-md-5 col-md-offset-1">
									<iframe src="http://<?= $_SERVER['SERVER_NAME']; ?>:8000/dokter-radiology/edit/<?= $_GET['pk'] ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" scrolling="auto"></iframe>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="footerindex">
				<div class="">
					<div class="footer-login col-sm-12"><br>
						<center>
							<p>&copy; Powered by Medxa IT Solution 2022</a>.</p>
						</center>
					</div>
				</div>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
		<script src="../js/proses/new_kop_surat.js?v=<?= $random; ?>"></script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>