<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Registration | Radiographer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<div class="body">

						<div class="container-fluid cont-regist" style="margin-bottom: 50px;">
							<form method="post" id="registration">
								<div>
									<h4><?= $lang['regist_new_patient'] ?></h4>
								</div>
								<div class="row">
									<div class="col-half">
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="mrn" id="mrn" placeholder="<?= $lang['input_mrn'] ?>" required />
											<div class="input-icon"><i class="fas fa-notes-medical"></i></div>
										</div>
									</div>
									<div class="col-half">
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="name" id="name" placeholder="<?= $lang['name'] ?>" required />
											<div class="input-icon"><i class="fa fa-user"></i></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-half">
										<h4><?= $lang['birth_date'] ?></h4>
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="birth_date" id="birth_date" placeholder="<?= $lang['input_birth_date'] ?>" autocomplete="off" required />
											<div class="input-icon"><i class="far fa-calendar-plus"></i></div>
										</div>
									</div>
									<div class="col-half">
										<h4>Gender</h4>
										<div class="input-group input-group-regist input-regist input-regist-gender">
											<input id="sex" class="gender-male" type="radio" name="gender-male" value="M" required />
											<label for="gender-male"><?= $lang['male'] ?></label>
											<input id="sex" class="gender-female" type="radio" name="gender-female" value="F" required />
											<label for="gender-female"><?= $lang['female'] ?></label>
											<input id="sex" class="gender-other" type="radio" name="gender-other" value="O" required />
											<label for="gender-other"><?= $lang['other'] ?></label>
										</div>
									</div>
								</div>
								<hr>

								<h4>Information Details</h4>
								<div class="row">
									<div class="col-half">
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="weight" id="weight" placeholder="<?= $lang['input_weight'] ?>" />
											<div class="input-icon"><i class="fas fa-weight"></i></div>
										</div>
									</div>
									<div class="col-half">
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="address" id="address" placeholder="<?= $lang['input_address'] ?>" />
											<div class="input-icon"><i class="fas fa-address-card"></i></div>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-half">
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="note" id="note" placeholder="<?= $lang['input_note'] ?>" />
											<div class="input-icon"><i class="fas fa-sticky-note"></i></div>
										</div>
									</div>
									<div class="col-half">
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="email" id="email" placeholder="<?= $lang['input_email'] ?>" />
											<div class="input-icon"><i class="fas fa-at"></i></div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-half">
										<div class="input-group input-group-regist input-regist input-group-icon"><input type="text" name="phone" id="phone" placeholder="<?= $lang['input_telp'] ?>" /></div>
									</div>
									<div style="width: 100%;">
										<button class="btn btn-pink-ms btn-expertise waves-effect waves-light" type="submit" name="submit" style="float: right; color:#fff;">
											<span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
											<p class="loading" style="display:inline;">Loading...</p>
											<p class="ubah" style="display:inline;"><b><?= $lang['add_data'] ?></b></p>
										</button>
									</div>
								</div>
							</form>
						</div>

						<div class="container-fluid cont-regist" style="margin-bottom: 100px;">
							<div class=" ">
								<h3 class="textsearchnewpasien2">List Patient</h3>
								<div class="table-view col-md-12 table-box" style="overflow-x: scroll;">
									<table class="table-dicom table-paginate" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
										<thead>
											<tr>
												<th>
													<center>No</center>
												</th>
												<th>
													<center>MRN</center>
												</th>
												<th>
													<center><?= $lang['name'] ?></center>
												</th>
												<th>
													<center>Gender</center>
												</th>
												<th>
													<center>Birth Date</center>
												</th>
												<th>
													<center>Weight</center>
												</th>
												<th>
													<center>Address</center>
												</th>
												<th>
													<center>Phone</center>
												</th>
												<th>
													<center>Email</center>
												</th>
												<th>
													<center>Note</center>
												</th>
												<th>
													<center><?= $lang['create_date'] ?></center>
												</th>
												<th>
													<center>ACTION</center>
												</th>
											</tr>
										</thead>
										<?php
										$i = 1;
										$patient = mysqli_query(
											$conn,
											"SELECT * FROM xray_patient ORDER BY created_at DESC"
										);
										while ($row = mysqli_fetch_array($patient)) { ?>
											<tr>
												<td> <?= $i; ?> </td>
												<td> <?= defaultValue($row['mrn']) ?> </td>
												<td><?= defaultValue($row['name']) . " " . $row['lastname']  ?></td>
												<td><?= defaultValue($row['sex']) ?></td>
												<td><?= defaultValueDate($row['birth_date']) ?></td>
												<td><?= defaultValueNumber($row['weight']) ?></td>
												<td><?= defaultValue($row['address']) ?></td>
												<td><?= defaultValue($row['phone']) ?></td>
												<td><?= defaultValue($row['email']) ?></td>
												<td><?= defaultValue($row['note']) ?></td>
												<td><?= defaultValueDateTime($row['created_at']) ?></td>
												<td width="150">
													<a href="registration-live.php?pk=<?= $row['pk']; ?>" class="btn btn-sm btn-pink-ms" value="Create Order" style="color: #ececec;"><?= $lang['create_order'] ?>
												</td>
											</tr>
											<?php $i++; ?>
										<?php } ?>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<?php include('script-footer.php'); ?>
		<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
		<script src="../js/proses/registration.js?v=<?= $random; ?>"></script>
		<script>
			$(document).ready(function() {
				$("li[data-target='#products1']").addClass("active");
				$("ul[id='products1'] li[id='regist1']").addClass("active");
				$("li[data-target='#products1'] a i").css('color', '#bdbdbd');
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#birth_date').datetimepicker({
					timepicker: false,
					format: 'Y-m-d',
					startDate: '2000-01-02'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>