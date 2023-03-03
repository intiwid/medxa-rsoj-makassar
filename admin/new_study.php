<?php
require 'function_dokter.php';
session_start();

if (isset($_POST["submit"])) {
	if (new_study($_POST) > 0) {
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
		window.location.replace('view_study.php');
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
		window.location.replace('new_study.php');
		} ,1000); 
	</script>";
	}
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Input Data Harga</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['new_procedure'] ?></li>
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
					<h1 style="color: #ee7423"><?= $lang['add_procedure'] ?></h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form class="adm_new_price" action="" method="post">
								<div class="col-md-10 col-md-offset-1">
									<label for="type"><b><?= $lang['pro_type'] ?></b></label><br>
									<select id="id_modality" name="id_modality" required>
										<option>---Select Modality---</option>
										<?php
										$result = mysqli_query($conn, "SELECT * FROM xray_modalitas ORDER BY xray_type_code ASC ");
										while ($row = mysqli_fetch_assoc($result)) {  ?>
											<option value="<?= $row['id_modality']; ?>"><?= $row['xray_type_code']; ?></option>
										<?php } ?>
									</select>
									<label for="id_study"><b>ID Study</b></label><br>
									<input type="text" id="id_study" name="id_study" placeholder="Input ID Study Desc" required><br>
									<label for="study"><b>Study Desc</b></label><br>
									<input type="text" id="study" name="study" placeholder="Input Study Desc" required><br>
									<label for="harga"><b><?= $lang['price'] ?></b></label><br>
									<input type="text" id="harga" name="harga" placeholder="<?= $lang['input_price'] ?>">

									<button class="button button1" type="submit" name="submit"><?= $lang['add_data'] ?> </button>
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