<?php
require 'function_dokter.php';
session_start();

$pk = $_GET["pk"];
$ae = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT * FROM ae WHERE pk = '$pk'"
));

if (isset($_POST["submit"])) {
	if ($_POST['passwordconfirm'] == "27102108") {
		if (update_ae($_POST) > 0) {
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
		window.location.replace('view_ae.php');
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
            window.location.replace('update_ae.php?pk=$pk');
            } ,1000); 
        </script>";
		}
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
         window.location.replace('update_ae.php?pk=$pk');
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
									<input class="form-control" type="hidden" value="<?= $ae['pk']; ?>" name="pk" required>
									<label for="aet">AE TITLE</label>
									<input class="form-control" type="text" value="<?= $ae['aet']; ?>" name="aet" required><br />
									<label for="hostname">IP/HostName</label>
									<input class="form-control" type="text" value="<?= $ae['hostname']; ?>" name="hostname" required><br />
									<label for="port">PORT</label>
									<input class="form-control" type="text" value="<?= $ae['port']; ?>" name="port" required><br />
									<!-- <label for="color">COLOR</label>
                                    <input class="form-control" type="color" name="color" required><br /> -->
									<label for="port">Password Confirm</label>
									<input class="form-control" type="password" name="passwordconfirm" required><br />
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