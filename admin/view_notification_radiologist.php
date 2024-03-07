<?php
require 'function_dokter.php';
session_start();

$active_notification_unread = mysqli_query(
	$conn,
	"SELECT *
	FROM active_notification_unread"
);

$active_notification_send_pacs = mysqli_query(
	$conn,
	"SELECT *
	FROM active_notification_send_pacs"
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
				<li class="breadcrumb-item active" aria-current="page">Notifikasi Dokter Radiologi</li>
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
					<h2 style="color: #EE7423; text-align: center;">Notifikasi Dokter Radiologi</h2>
					<br>
					<div class="container-fluid">
						<div class="">
							<div class="col-md-12 table-box" style="overflow-x:auto;">
								<br><br>
								<h4 class="text-center">Notifikasi pasien selesai diperiksa dan diterima pacs</h4>
								<table class="table-paginate table-dicom" border="1" cellpadding="8" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Active Telegram ? </th>
											<th>Active Mail ? </th>
											<th>Waktu</th>
											<th><?= $lang['action'] ?></th>
										</tr>
									</thead>
									<?php $i = 1; ?>
									<?php foreach ($active_notification_send_pacs as $row) : ?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $row["is_active_telegram"] == 0 ? 'Tidak Aktif' : 'Aktif'; ?></td>
											<td><?= $row["is_active_mail"] == 0 ? 'Tidak Aktif' : 'Aktif'; ?></td>
											<td><?= $row["created_at"]; ?></td>
											<td>
												<a href="new_notification_send_pacs_radiologist.php?pk=<?= $row["pk"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png"></a>
											</td>
										</tr>
										<?php $i++; ?>
									<?php endforeach; ?>
								</table>
								<h4 class="text-center">Notifikasi pasien belum dilakukan expertise kurang dari 3 jam</h4>
								<table class="table-paginate table-dicom" border="1" cellpadding="8" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Active Telegram ? </th>
											<th>Active Mail ? </th>
											<th>Waktu</th>
											<th><?= $lang['action'] ?></th>
										</tr>
									</thead>
									<?php $i = 1; ?>
									<?php foreach ($active_notification_unread as $row) : ?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $row["is_active_telegram"] == 0 ? 'Tidak Aktif' : 'Aktif'; ?></td>
											<td><?= $row["is_active_mail"] == 0 ? 'Tidak Aktif' : 'Aktif'; ?></td>
											<td><?= $row["created_at"]; ?></td>
											<td>
												<a href="new_notification_unread_radiologist.php?pk=<?= $row["pk"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png"></a>
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
							<p>&copy; Powered by IT Solution 2022</a>.</p>
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