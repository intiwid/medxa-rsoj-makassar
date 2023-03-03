<?php
require 'function_dokter.php';
session_start();
if (isset($_POST["submit"])) {
	if (new_departement($_POST) > 0) {
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
		window.location.replace('view_department.php');
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
            window.location.replace('view_department.php');
            } ,1000); 
        </script>";
	}
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Insert Departmen</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['new_departmen'] ?></li>
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
					<h1 style="color: #ee7423"><?= $lang['add_departmen'] ?></h1>
					<div class="container">
						<div class="row form-dokter">
							<form action="" method="post" class="form_adm">
								<ul>
									<li>
										<label for="dep_id"><b>Department ID</b></label><br>
										<input type="text" id="dep_id" name="dep_id" placeholder="ID Department..." required><br>
									</li>
									<li>
										<label for="name_dep"><b><?= $lang['departmen_name'] ?></b></label><br>
										<input type="text" id="name_dep" name="name_dep" placeholder="Department.." required><br>
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