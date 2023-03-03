<?php
require 'function_dokter.php';
session_start();

$data_dokter = mysqli_query($conn, "SELECT * FROM xray_dokter
									");
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Data Dokter</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['table_doc'] ?></li>
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
					<h2 style="color: #EE7423; text-align: center;"><?= $lang['list_doc'] ?></h2>
					<br>
					<div class="container-fluid">
						<div class="">

							<div class="container-fluid">
								<div class="">
									<div style="padding: 0px;" class="col-md-6">
										<br>
										<a class="ahref" href="new_dokter.php"><i class="fas fa-plus"></i> <?= $lang['add_data_doc'] ?></a>
									</div>
									<!-- <div style="padding: 0px;" class="col-md-3 col-md-offset-3">
				<input class="form-control" id="myInput" type="text" placeholder="Search..">
				</div> -->
								</div>

							</div>
							<br>


							<div class="col-md-12 table-box" style="overflow-x:auto;">
								<table class=" table-dicom table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th><?= $lang['id_doc'] ?></th>
											<th><?= $lang['doc_name'] ?></th>
											<th>Telp</th>
											<th>Email</th>
											<th><?= $lang['action'] ?></th>
										</tr>
									</thead>
									<?php $i = 1; ?>
									<?php foreach ($data_dokter as $row) : ?>

										<tr class="myTable">
											<td><?= $i; ?></td>
											<td><?= $row["dokterid"]; ?></td>
											<td><?= $row["named"] . " " . $row["lastnamed"]; ?></td>
											<td><?= $row["telp"]; ?></td>
											<td><?= $row["email"]; ?></td>
											<td>
												<a href="update_dokter.php?id=<?= $row["id"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png"></a>
												<a href="delete_dokter.php?id=<?= $row["id"]; ?>" class="tombol-hapus"><img data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>
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