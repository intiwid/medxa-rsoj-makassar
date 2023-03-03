<?php
session_start();

$username = $_SESSION['username'];
// -----------------xray_exam2--------------

if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta http-equiv="refresh" content="300" />
		<title>Worklist | Radiology</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">

				<div id="content1">
					<div class="body">

						<div class="container-fluid">
							<div class="col-12" style="padding: 0;">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item active">Worklist</li>
									</ol>
								</nav>
							</div>
							<div class="table-view col-md-12 dashboard-home" style="overflow-x:auto;">

								<table class="table-dicom" id="example" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px; width: 2325px;">
									<thead class="thead1">
										<div class="input-group-sm" style="    margin-bottom: -8px;">
											<input type="text" class="form-control" style="width: 115px; float: right;" id="mrn" placeholder="search MRN">
											<input type="text" class="form-control" style="width: 115px; float: right; margin-right: 6px;" id="name" placeholder="search Name">
										</div>
										<?php include '../thead.php'; ?>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php require '../modal.php'; ?>
			</div>
		</div>

		<!-- <div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div> -->
		<?php include('script-footer.php'); ?>
		<script>
			$(document).ready(function() {
				$("li[id='worklist1']").addClass("active");
			});
		</script>
		<script>
			$(document).ready(function() {
				var table = $('#example').DataTable({
					"ajax": {
						"url": "../getAll.php",
						"dataSrc": ""
					},
					"columns": [{
							"data": "no"
						},
						{
							"data": "report"
						},
						{
							"data": "status"
						},
						{
							"data": "pat_name"
						},
						{
							"data": "mrn"
						},
						{
							"data": "no_foto"
						},
						{
							"data": "pat_birthdate"
						},
						{
							"data": "pat_sex"
						},
						{
							"data": "study_desc"
						},
						{
							"data": "series_desc"
						},
						{
							"data": "mods_in_study"
						},
						{
							"data": "named"
						},
						{
							"data": "name_dep"
						},
						{
							"data": "dokrad_name"
						},
						{
							"data": "radiographer_name"
						},
						{
							"data": "study_datetime"
						},
						{
							"data": "approve_date"
						},
						{
							"data": "spendtime"
						}
					]
				});
				$('#mrn').on('keyup', function() {
					table
						.columns(4)
						.search(this.value)
						.draw();
				});
				$('#name').on('keyup', function() {
					table
						.columns(3)
						.search(this.value)
						.draw();
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>