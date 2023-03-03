<?php
require 'function_dokter.php';
session_start();

$data_dokter = mysqli_query(
	$conn,
	"SELECT *
	FROM xray_radiographer
	"
);
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Data Radiographer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page">List Radiographer</li>
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
					<h2 style="color: #EE7423; text-align: center;"><?= $lang['table_radiographer'] ?></h2>
					<br>
					<div class="container-fluid">
						<div class="">

							<div class="col-md-12 table-box" style="overflow-x:auto;">
								<a class="ahref" href="new_radiographer.php"><i class="fas fa-plus"></i> <?= $lang['new_radiographer'] ?></a>
								<br><br>
								<table class="table-paginate table-dicom" border="1" cellpadding="8" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Radiographer ID</th>
											<th><?= $lang['name_radiographer'] ?></th>
											<th><?= $lang['sex'] ?></th>
											<th><?= $lang['no_telp'] ?></th>
											<th>Email</th>
											<!-- <th>Username</th> -->
											<th><?= $lang['action'] ?></th>
										</tr>
									</thead>
									<?php $i = 1; ?>
									<?php foreach ($data_dokter as $row) { ?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $row["radiographer_id"]; ?></td>
											<td><?= $row["radiographer_name"] . " " . $row["radiographer_lastname"]; ?></td>
											<td><?= $row["radiographer_sex"]; ?></td>
											<td><?= $row["radiographer_tlp"]; ?></td>
											<td><?= $row["radiographer_email"]; ?></td>
											<!-- <td><?= $row["username"]; ?></td> -->
											<td>
												<a href="update_radiographer.php?pk=<?= $row["pk"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png"></a>
												<a href="delete_radiographer.php?pk=<?= $row["pk"]; ?>" class="tombol-hapus"><img data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>
											</td>
										</tr>
										<?php $i++; ?>
									<?php }; ?>
								</table>
							</div>
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
		<script>
			$(document).ready(function() {
				$('.tombol-hapus').on('click', function(e) {
					e.preventDefault();
					const href = $(this).attr('href');
					swal({
							title: "Hapus",
							text: "Yakin ingin menghapus?",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((result) => {
							if (result) {
								document.location.href = href;
							}
						})
				});
			});
		</script>
		<script>
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>