<?php
require 'function_dokter.php';
session_start();

if (isset($_POST["submit"])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordulang = $_POST['passwordulang'];
	$dokrad_email = $_POST['dokrad_email'];
	$result = mysqli_query($conn, "SELECT * FROM xray_login WHERE username = '$username' ");
	$row = mysqli_fetch_assoc($result);
	$cek = mysqli_num_rows($result);
	if ($cek > 0) {
		echo "<script type='text/javascript'>
		setTimeout(function () { 
		swal({
				title: 'username sudah ada',
				text:  '',
				icon: 'error',
				timer: 1000,
				showConfirmButton: true
			});  
		},10);
	</script>";
	} elseif (!filter_var($dokrad_email, FILTER_VALIDATE_EMAIL)) {
		echo "<script type='text/javascript'>
		setTimeout(function () { 
		swal({
				title: 'Format Email salah',
				text:  '',
				icon: 'error',
				timer: 1000,
				showConfirmButton: true
			});  
		},10);
	</script>";
	} else {
		if ($password == $passwordulang) {
			if (new_dokter_radiology($_POST) > 0) {
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
						window.location.replace('view_dokter_radiology.php');
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
						window.location.replace('new_dokter_radiology.php');
						} ,1000); 
					</script>";
			};
		} else {
			echo "<script type='text/javascript'>
						setTimeout(function () { 
						swal({
								title: 'Password Konfirmasi Salah',
								text:  '',
								icon: 'error',
								timer: 1000,
								showConfirmButton: true
							});  
						},10); 
						window.setTimeout(function(){ 
						} ,1000); 
					</script>";
		}
	}
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Tambah Data Dokter Radiology</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['add_doc_rad'] ?></li>
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
					<h1 style="color: #ee7423"><?= $lang['add_doc_rad'] ?></h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-5 col-md-offset-1">
									<label for="dokradid"><b>Kode dokter radiology</b></label><br>
									<input type="text" name="dokradid" id="dokradid" placeholder="Kode dokter radiology" required>
									<label for="dokrad_name"><b><?= $lang['f_name'] ?> </b></label><br>
									<input type="text" name="dokrad_name" id="dokrad_name" placeholder="<?= $lang['input_f_name'] ?>" required>
									<label for="dokrad_lastname"><b><?= $lang['l_name'] ?></b></label><br>
									<input type="text" name="dokrad_lastname" id="dokrad_lastname" placeholder="<?= $lang['input_l_name'] ?>">
									<br>
									<br>
									<label for="dokrad_sex"><b><?= $lang['sex'] ?></b></label><br>
									<label class="radio-admin">
										<input type="radio" checked="checked" name="dokrad_sex" value="Laki-Laki" required> <?= $lang['male'] ?>
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" value="Perempuan" required> <?= $lang['female'] ?>
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" value="Other" required> <?= $lang['other'] ?>
										<span class="checkmark"></span>
									</label>
									<br>
									<label for="dokrad_tlp"><b><?= $lang['no_telp'] ?></b></label><br>
									<input type="text" name="dokrad_tlp" id="dokrad_tlp" placeholder="<?= $lang['input_telp'] ?>" required>
								</div>
								<div class="col-md-5">
									<label for="nip"><b>NIP</b></label><br>
									<input type="text" name="nip" id="nip" placeholder="Input NIP"><br>
									<label for="idtele"><b>ID Telegram</b></label><br>
									<input type="text" name="idtele" id="idtele" placeholder="Input ID Telegram"><br>
									<label for="dokrad_email"><b>Email</b></label><br>
									<input type="text" name="dokrad_email" id="dokrad_email" placeholder="<?= $lang['input_email'] ?>" required><br>
									<!-- <label for="dokrad_img"><b><?= $lang['input_photo'] ?></b></label><br>
									<input type="file" name="file"><br>
									<label for="dokrad_tempimg"><b><?= $lang['input_template'] ?></b></label><br>
									<input type="file" name="filetemp"><br> -->
									<label for="username"><b>Username</b></label><br>
									<input type="text" name="username" id="username" placeholder="Masukan username.." required>
									<label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
									<input type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
									<label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
									<input type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required>
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