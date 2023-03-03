<?php
require 'function_dokter.php';
session_start();
//ambil data di url
$dokradid = $_GET["dokradid"];
$query = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid'");
$dktr1 = mysqli_fetch_assoc($query);
if (isset($_POST["submit"])) {
	if (ubah_radtemp($_POST) > 0) {
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_dokter_radiology.php';
</script>
";
	} else {
		echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'updatetemplate_dokter_radiology.php';
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
								<input type="hidden" name="dokradid" value="<?= $dktr1["dokradid"]; ?>">
								<ul>
									<li><br>
										<label for="dokrad_img"><b>Masukan Gambar Template</b></label><br>
										<img style="width: 200px;" src="../image/<?= $dktr1['imgtemp']; ?>">
										<input type="file" name="filetemp">
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