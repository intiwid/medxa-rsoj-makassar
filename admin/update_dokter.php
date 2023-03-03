<?php
require 'function_dokter.php';
session_start();

$id = $_GET["id"];
$dokter = mysqli_fetch_assoc(mysqli_query(
	$conn,
	"SELECT * FROM xray_dokter WHERE id = '$id'"
));

if (isset($_POST["submit"])) {
	if (update_dokter($_POST) > 0) {
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
		window.location.replace('view_dokter.php');
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
            window.location.replace('update_dokter.php?id=$id');
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
				<li class="breadcrumb-item"><a href="view_dokter.php">Tabel Dokter</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Dokter</li>
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
							<form action="" method="post">
								<div class="col-md-5 col-md-offset-1">
									<input type="hidden" name="id" value="<?= $dokter['id']; ?>" id="id" placeholder="Input Dokter ID" required>
									<label for="dokterid"><b>Dokter ID</label>
									<br>
									<input type="text" name="dokterid" value="<?= $dokter['dokterid']; ?>" id="dokterid" placeholder="Input Dokter ID" required>
									<label for="named"><b><?= $lang['f_name'] ?> </b></label>
									<br>
									<input type="text" name="named" value="<?= $dokter['named']; ?>" id="named" placeholder="<?= $lang['input_f_name'] ?>" required>
									<label for="lastnamed"><b><?= $lang['l_name'] ?></b></label>
									<br>
									<input type="text" name="lastnamed" value="<?= $dokter['lastnamed']; ?>" id="lastnamed" placeholder="<?= $lang['input_l_name'] ?>" required>
									<label for="telp"><b>Phone Number</label>
									<br>
									<input type="text" name="telp" value="<?= $dokter['telp']; ?>" id="telp" placeholder="Input Phone Number" required>
									<label for="email"><b>Email</label>
									<br>
									<input type="text" name="email" value="<?= $dokter['email']; ?>" id="email" placeholder="Input Email" required>
									<!-- <label for="username"><b>Username</b></label>
									<br>
									<input type="text" name="username" id="username" placeholder="input username..." required> -->
									<!-- <label for="password"><b>Password</b></label>
									<br>
									<input type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>" required> -->
									<br>
									<br>
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