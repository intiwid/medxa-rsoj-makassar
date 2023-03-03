<?php

require '../js/proses/function.php';
require '../default-value.php';
require '../model/query-base-take-envelope.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
session_start();
$uid = $_GET['uid'];

$row_take_envelope = mysqli_fetch_assoc(mysqli_query(
	$conn,
	"SELECT $select_take_envelope,
	pat_name,
	study_desc,
	mods_in_study
	FROM $table_take_envelope 
	RIGHT JOIN $table_study
	ON study.study_iuid = xray_take_envelope.uid
	JOIN $table_patient
	ON patient.pk = study.patient_fk
	WHERE study_iuid = '$uid'
	"
));
$is_taken = $row_take_envelope['is_taken'];

if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ambil Amplop Expertise</title>
		<script type="text/javascript" src="../js/sweetalert.min.js" />
		</script>
		<?php include('head.php'); ?>
	</head>

	<body style="background-color: #1f69b7;">
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">

					<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
						<div class="col-md-6 box-change-dokter table-box">
							<form method="post" id="take-envelope">
								<div class="radiobtn1">
									<div class='alert alert-info' role='alert'>Hasil Expertise Pasien <?= defaultValue($row_take_envelope['pat_name']); ?>, modalitas <?= defaultValue($row_take_envelope['mods_in_study']); ?>, Pemeriksaan <?= defaultValue($row_take_envelope['study_desc']); ?></div>
									<input type="hidden" id="study_iuid" name="study_iuid" value="<?= $uid; ?>">
									<label for="name">Nama</label><br>
									<input type="text" class="form-control" name="name" id="name" value="<?= $row_take_envelope['name'] ?? '' ?>">
									<br>
									<br>
									<label for="created_at">Waktu Ambil</label><br>
									<input type="text" class="form-control" name="created_at" id="created_at" value="<?= $row_take_envelope['created_at'] ? defaultValueDateTime($row_take_envelope['created_at']) : date('d-m-Y H:i'); ?>">
									<br>
									<br>
									<?php
									if (strtoupper($is_taken) == 1 || strtoupper($is_taken) == null) {
										$checked = 'checked';
									} else {
										$checked = '';
									}
									?>
									<div style="background-color: white; padding: 12px; border-radius: 4px; border: 1px solid #ced4da;">
										<label class="radio-admin">
											<input type="radio" <?= $checked; ?> name="is_taken" id="is_taken" value="1"> Sudah Diambil
											<span class="checkmark"></span>
										</label>
										<label class="radio-admin">
											<input type="radio" <?= strtoupper($is_taken) == '0' ? 'checked' : ''; ?> name="is_taken" id="is_taken" value="0"> Belum Diambil
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<button class="btn-worklist3 btn-lg" type="submit" id="submit" name="submit" style="margin: 10px 0; float:right;">
									<span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
									<p class="loading" style="display:inline;">Loading...</p>
									<i class="fas fa-envelope"></i>
									<p class="ubah" style="display:inline;">Save</p>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div> -->
		<?php include('script-footer.php'); ?>
	</body>
	<script src="../js/proses/take-envelope.js?v=1"></script>
	<script>
		$('#created_at').datetimepicker({
			format: 'd-m-Y H:i',
			step: 1
		});
	</script>

	</html>
<?php } else {
	header("location:../index.php");
} ?>