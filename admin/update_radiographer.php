<?php
require 'function_dokter.php';
session_start();

$pk = $_GET["pk"];
$radiographer = mysqli_fetch_assoc(mysqli_query(
	$conn,
	"SELECT * FROM xray_radiographer WHERE pk = '$pk'"
));

if (isset($_POST["submit"])) {
	if (update_radiographer($_POST) > 0) {
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
		window.location.replace('view_radiographer.php');
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
            window.location.replace('update_radiographer.php?pk=$pk');
            } ,1000); 
        </script>";
	}
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data Radiographer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_radiographer.php">Tabel Radiographer</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Radiographer</li>
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
					<h1>Ubah Data Radiographer</h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post">
								<input type="hidden" name="pk" value="<?= $radiographer["pk"]; ?>">
								<ul>
									<li>
										<label for="radiographer_id"><b>Radiographer ID</b></label><br>
										<input type="text" name="radiographer_id" id="radiographer_id" required value="<?= $radiographer["radiographer_id"]; ?>">
									</li>
									<li>
										<label for="radiographer_name"><b>Nama Depan</b></label><br>
										<input type="text" name="radiographer_name" id="radiographer_name" required value="<?= $radiographer["radiographer_name"]; ?>">
									</li>
									<li>
										<label for="radiographer_lastname"><b>Nama Belakang</b></label><br>
										<input type="text" name="radiographer_lastname" id="radiographer_lastname" value="<?= $radiographer["radiographer_lastname"]; ?>">
									</li>
									<label for="radiographer_sex"><b>Jenis Kelamin</b></label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" <?php if ($radiographer["radiographer_sex"] == 'Laki-Laki') {
																						echo 'checked';
																					} ?> value="Laki-Laki" required> Laki - laki
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" <?php if ($radiographer["radiographer_sex"] == 'Perempuan') {
																						echo 'checked';
																					} ?> value="Perempuan" required> Perempuan
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" <?php if ($radiographer["radiographer_sex"] == 'Other') {
																						echo 'checked';
																					} ?> value="Other" required> Other
										<span class="checkmark"></span>
									</label>
									<li><br>
										<label for="radiographer_tlp"><b>Masukan telepon</b></label><br>
										<input type="text" name="radiographer_tlp" id="radiographer_tlp" required value="<?= $radiographer["radiographer_tlp"]; ?>">
									</li>
									<li><br>
										<label for="radiographer_email"><b>Masukan email</b></label><br>
										<input type="text" name="radiographer_email" id="radiographer_email" required value="<?= $radiographer["radiographer_email"]; ?>">
									</li>
									<li>
										<button class="button1" type="submit" name="submit">Ubah Data</button>
									</li>
								</ul>

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