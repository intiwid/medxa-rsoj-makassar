<?php
require 'function_dokter.php';
session_start();

$data_dokter_radiology = mysqli_query(
	$conn,
	"SELECT *
	FROM xray_selected_dokter_radiology"
);
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Data Dokter Radiology</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page">Mapping Dokter Radiology</li>
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
					<h2 style="color: #EE7423; text-align: center;">Mapping Dokter Radiology</h2>
					<br>
					<div class="container-fluid">
						<div class="">
							<div class="col-md-12 table-box" style="overflow-x:auto;">
								<br><br>
								<table class="table-paginate table-dicom" border="1" cellpadding="8" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Active ? </th>
											<th>Waktu</th>
											<th><?= $lang['action'] ?></th>
										</tr>
									</thead>
									<?php $i = 1; ?>
									<?php foreach ($data_dokter_radiology as $row) : ?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $row["is_active"] == 0 ? 'Tidak Aktif' : 'Aktif'; ?></td>
											<td><?= $row["created_at"]; ?></td>
											<td>
												<a href="new_selected_dokter_radiology.php?pk=<?= $row["pk"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png"></a>
											</td>
										</tr>
										<?php $i++; ?>
									<?php endforeach; ?>
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