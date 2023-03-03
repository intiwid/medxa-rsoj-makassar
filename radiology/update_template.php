<?php
require 'function_radiology.php';
session_start();

if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data template</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
								<li class="breadcrumb-item"><a href="view_template.php">Tabel template</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Data template</li>
							</ol>
						</nav>
					</div>

					<div class="container-fluid">

						<div class="about-inti table-box">
							<h1><?= $lang['create_template']; ?></h1>
							<div class="container-fluid">
								<?php include('../template-update.php') ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- <div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div> -->

		<?php include('script-footer.php'); ?>

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>