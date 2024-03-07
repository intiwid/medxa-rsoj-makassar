<?php
require 'function_dokter.php';
session_start();

$row_send_pacs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM active_notification_send_pacs"));

if (isset($_POST["submit"])) {
	if (update_notification_send_pacs_radiologist($_POST) > 0) {
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
						window.location.replace('new_notification_send_pacs_radiologist.php');
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
					<h2 style="color: #EE7423; text-align: center;">Edit Notifikasi Dokter Radiologi</h2>
					<div class="container-fluid">
						<div class="row form-dokter" style="background-color: #F8F8FF;">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-5 col-md-offset-1">
									<h4 class="text-left">Notifikasi pasien selesai diperiksa dan diterima pacs</h4>
									<label for="dokradid"><b>Active Telegram ? </b></label><br>
									<label class="radio-admin">
										<input type="radio" <?= $row_send_pacs['is_active_telegram'] == '1' ? 'checked' : ''; ?> name="is_active_telegram" value="1"> Aktif
										<span class="checkmark"></span>
									</label>
									<label class="radio-admin">
										<input type="radio" <?= $row_send_pacs['is_active_telegram'] == '0' ? 'checked' : ''; ?> name="is_active_telegram" value="0"> Tidak Aktif
										<span class="checkmark"></span>
									</label>
									<br><br>
									<label for="dokradid"><b>Active Mail ? </b></label><br>
									<label class="radio-admin">
										<input type="radio" <?= $row_send_pacs['is_active_mail'] == '1' ? 'checked' : ''; ?> name="is_active_mail" value="1"> Aktif
										<span class="checkmark"></span>
									</label>
									<label class="radio-admin">
										<input type="radio" <?= $row_send_pacs['is_active_mail'] == '0' ? 'checked' : ''; ?> name="is_active_mail" value="0"> Tidak Aktif
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
							<p>&copy; Powered by IT Solution 2022</a>.</p>
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