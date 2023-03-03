<?php
require 'function_dokter.php';
session_start();

if (isset($_POST["submit"])) {
	$radiographer_email = $_POST['radiographer_email'];
	$result = mysqli_query(
		$conn,
		"SELECT * FROM xray_radiographer"
	);
	$row = mysqli_fetch_assoc($result);
	$cek = mysqli_num_rows($result);
	if (!filter_var($radiographer_email, FILTER_VALIDATE_EMAIL)) {
		echo "<script type='text/javascript'>
        setTimeout(function () { 
        swal({
                   title: 'Format Email Salah',
                   text:  '',
                   icon: 'error',
                   timer: 1000,
                   showConfirmButton: true
               });  
        },10); 
       </script>";
	} else {
		if (new_radiographer($_POST) > 0) {
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
            window.location.replace('view_radiographer.php');
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
		<title>Tambah Data Radiographer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['new_radiographer'] ?></li>
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
					<h1 style="color: #ee7423"><?= $lang['add_radiographer'] ?></h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post">
								<div class="col-md-5 col-md-offset-1">
									<label for="radiographer_id"><b>Radiographer ID </b></label><br>
									<input type="text" name="radiographer_id" id="radiographer_id" placeholder="Input Radiographer ID" required>
									<label for="radiographer_name"><b><?= $lang['f_name'] ?> </b></label><br>
									<input type="text" name="radiographer_name" id="radiographer_name" placeholder="<?= $lang['input_f_name'] ?>" required>
									<label for="radiographer_lastname"><b><?= $lang['l_name'] ?></b></label><br>
									<input type="text" name="radiographer_lastname" id="radiographer_lastname" placeholder="<?= $lang['input_l_name'] ?>">
									<br>
									<label for="radiographer_sex"><b><?= $lang['sex'] ?></b></label><br>
									<label class="radio-admin">
										<input type="radio" checked="checked" name="radiographer_sex" value="Laki-Laki" required> <?= $lang['male'] ?>
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" value="Perempuan" required> <?= $lang['female'] ?>
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" value="Other" required> <?= $lang['other'] ?>
										<span class="checkmark"></span>
									</label>
									<br>
									<label for="radiographer_tlp"><b><?= $lang['no_telp'] ?></b></label><br>
									<input type="text" name="radiographer_tlp" id="radiographer_tlp" placeholder="<?= $lang['input_telp'] ?>" required>
									<label for="radiographer_email"><b>Email</b></label><br>
									<input type="text" name="radiographer_email" id="radiographer_email" placeholder="<?= $lang['input_email'] ?>" required>
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