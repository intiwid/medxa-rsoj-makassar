<?php
require 'function_dokter.php';
session_start();

//ambil data di url
$pk = $_GET["pk"];
$dokter_radiology = mysqli_fetch_assoc(mysqli_query(
	$conn,
	"SELECT * FROM xray_dokter_radiology 
	WHERE pk = '$pk'"
));
if (isset($_POST["submit"])) {
	if (update_dokter_radiology($_POST) > 0) {
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
            window.location.replace('update_dokter_radiology.php?pk=$pk');
            } ,1000); 
        </script>";
	}
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data Dokter</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_dokter_radiology.php">Tabel Dokter Radiology</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Dokter Radiology</li>
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
					<h1>Ubah Data Dokter</h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post" enctype="multipart/form-data">
								<input type="hidden" name="pk" value="<?= $dokter_radiology["pk"]; ?>">
								<ul>
									<li>
										<label for="dokradid"><b>Kode Dokter Radiology</b></label><br>
										<input type="text" name="dokradid" id="dokradid" required value="<?= $dokter_radiology["dokradid"]; ?>">
									</li>
									<li>
										<label for="dokrad_name"><b>Nama Depan</b></label><br>
										<input type="text" name="dokrad_name" id="dokrad_name" required value="<?= $dokter_radiology["dokrad_name"]; ?>">
									</li>
									<li>
										<label for="dokrad_lastname"><b>Nama Belakang</b></label><br>
										<input type="text" name="dokrad_lastname" id="dokrad_lastname" value="<?= $dokter_radiology["dokrad_lastname"]; ?>">
									</li>
									<label for="dokrad_sex"><b>Jenis Kelamin</b></label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" <?php if ($dokter_radiology["dokrad_sex"] == 'Laki-Laki') {
																					echo 'checked';
																				} ?> value="Laki-Laki" required> Laki - laki
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" <?php if ($dokter_radiology["dokrad_sex"] == 'Perempuan') {
																					echo 'checked';
																				} ?> value="Perempuan" required> Perempuan
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" <?php if ($dokter_radiology["dokrad_sex"] == 'Other') {
																					echo 'checked';
																				} ?> value="Other" required> Other
										<span class="checkmark"></span>
									</label>
									<li><br>
										<label for="dokrad_tlp"><b>Masukan tlp</b></label><br>
										<input type="text" name="dokrad_tlp" id="dokrad_tlp" required value="<?= $dokter_radiology["dokrad_tlp"]; ?>">
									</li>
									<li><br>
										<label for="nip"><b>Masukan NIP</b></label><br>
										<input type="text" name="nip" id="nip" required value="<?= $dokter_radiology["nip"]; ?>">
									</li>
									<li><br>
										<label for="idtele"><b>Masukan ID Telegram</b></label><br>
										<input type="text" name="idtele" id="idtele" required value="<?= $dokter_radiology["idtele"]; ?>">
									</li>
									<li><br>
										<label for="dokrad_email"><b>Masukan email</b></label><br>
										<input type="text" name="dokrad_email" id="dokrad_email" required value="<?= $dokter_radiology["dokrad_email"]; ?>">
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