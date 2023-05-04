<?php
require 'function_dokter.php';
session_start();
if (isset($_POST["submit"])) {
	if (new_payment($_POST) > 0) {
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
		window.location.replace('view_payment.php');
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
            window.location.replace('view_payment.php');
            } ,1000); 
        </script>";
	}
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Insert Payment</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Payment</li>
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
					<h1 style="color: #ee7423">Add Payment</h1>
					<div class="container">
						<div class="row form-dokter">
							<form action="" method="post" class="form_adm">
								<ul>
									<li>
										<label for="id_payment"><b>Payment ID</b></label><br>
										<input type="text" id="id_payment" name="id_payment" placeholder="ID Payment..." required><br>
									</li>
									<li>
										<label for="payment"><b>Payment Name</b></label><br>
										<input type="text" id="payment" name="payment" placeholder="Payment.." required><br>
									</li>
									<li>
										<button class="button1" type="submit" name="submit"><?= $lang['add_data'] ?></button>
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
							<p>&copy; Powered by Multimed IT Solution 2022</a>.</p>
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