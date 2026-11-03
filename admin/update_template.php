<?php
if (session_status() === PHP_SESSION_NONE) {
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
}
require 'function_dokter.php';

if (($_SESSION['level'] ?? '') == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data template</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br><br><br><br><br><br><br>
		<div class="container-fluid" id="main">
			<div class="row">
				<div class="col-12" style="padding: 0;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
							<li class="breadcrumb-item"><a href="view_template.php">Tabel template</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Data template</li>
						</ol>
					</nav>
				</div>
				<div class="container-fluid">
					<?php include('../template-update.php') ?>
				</div>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
  exit();
} ?>