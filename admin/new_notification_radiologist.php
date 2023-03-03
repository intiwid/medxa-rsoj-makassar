<?php
require 'function_dokter.php';
session_start();

$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM active_notification_unread"));

if (isset($_POST["submit"])) {
	if (update_notification_radiologist($_POST) > 0) {
		echo "<script type='text/javascript'>
						setTimeout(function () { 
						swal({
								title: 'Berhasil Diinput!',
								text:  '',
								icon: 'success',
								timer: 1000,
								showConfirmButton: true
							});  
						},10); 
						window.setTimeout(function(){ 
						window.location.replace('view_notification_radiologist.php');
						} ,1000); 
					</script>";
	} else {
		echo "<script type='text/javascript'>
						setTimeout(function () { 
						swal({
								title: 'Gagal Diinput!',
								text:  '',
								icon: 'error',
								timer: 1000,
								showConfirmButton: true
							});  
						},10); 
						window.setTimeout(function(){ 
						window.location.replace('new_notification_radiologist.php');
						} ,1000); 
					</script>";
	};
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Update Notifikasi dokter radiologi</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page">Notification Untuk Dokter Radiologi</li>
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
					<h1 style="color: #ee7423">Notification Untuk Dokter Radiologi</h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-5 col-md-offset-1">
									<label for="dokradid"><b>Active ? </b></label><br>
									<label class="radio-admin">
										<input type="radio" <?= $row['is_active'] == '1' ? 'checked' : ''; ?> name="is_active" value="1"> Aktif
										<span class="checkmark"></span>
									</label>
									<label class="radio-admin">
										<input type="radio" <?= $row['is_active'] == '0' ? 'checked' : ''; ?> name="is_active" value="0"> Tidak Aktif
										<span class="checkmark"></span>
									</label>
									<button class="button1" type="submit" name="submit"><?= $lang['add_data'] ?></button>
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