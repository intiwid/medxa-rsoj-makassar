<?php

require '../koneksi/koneksi.php';

session_start();


if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Patient Finished Order | Radiographer</title>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">


				<div id="content1"><br>
					<div class="body">
						<div class="container-fluid">
							<div class="col-12" style="padding: 0;">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item active"><?= $lang['patient_finished_order'] ?></li>
									</ol>
								</nav>
							</div>
							<div class="table-view col-md-12 back-search" id="content1" style="overflow-x:auto;">
								<center>
									<h3 class="textsearchnewpasien2">Order</h3>
									<hr>
									<h6><?= $lang['patient_finished_order'] ?></h6>
								</center>
								<table class="table-dicom" id="example" border="1" cellpadding="8" cellspacing="0">
									<thead>
										<tr bgcolor=#CCCCCC>
											<th>No</th>
											<th>Action</th>
											<th><?= $lang['patient_name'] ?></th>
											<th>MRN</th>
											<th>Accession No</th>
											<th><?= $lang['date_birth'] ?></th>
											<th><?= $lang['sex'] ?></th>
											<th><?= $lang['modality'] ?></th>
											<th><?= $lang['study'] ?></th>
											<th><?= $lang['patient_order'] ?></th>
											<th><?= $lang['exam_date'] ?></th>
											<th>Label</th>
										</tr>
									</thead>

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- The Modal study_iuid -->
		<div class="modal" id="modal-order2">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<!-- <h1 class="modal-title">Modal Heading</h1> -->
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<!-- <h3>Specification</h3> -->
					</div>
					<!-- Modal footer -->
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div> -->
				</div>
			</div>
		</div>
		<!-- End The Modal -->
		<!-- <div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div> -->
		<?php include('script-footer.php'); ?>
		<script>
			// untuk menampilkan data popup
			$(function() {
				$(document).on('click', '.order2', function(e) {
					e.preventDefault();
					$("#modal-order2").modal('show');
					$.post('hasil-order2.php', {
							uid: $(this).attr('data-id')
						},
						function(html) {
							$(".modal-body").html(html);
						}
					);
				});
			});
			// end untuk menampilkan data popup
		</script>
		<script>
			$(document).ready(function() {
				$("li[data-target='#products1']").addClass("active");
				$("ul[id='products1'] li[id='order3']").addClass("active");
				$("li[data-target='#products1'] a i").css('color', '#bdbdbd');
			});
		</script>
		<script>
			$('document').ready(function() {
				$('#example').dataTable({
					"ajax": {
						"url": "getOrder2.php",
						"dataSrc": ""
					},
					"columns": [{
							"data": "no"
						},
						{
							"data": "action"
						},
						{
							"data": "name"
						},
						{
							"data": "mrn"
						},
						{
							"data": "acc"
						},
						{
							"data": "birth_date"
						},
						{
							"data": "sex"
						},
						{
							"data": "xray_type_code"
						},
						{
							"data": "prosedur"
						},
						{
							"data": "create_time"
						},
						{
							"data": "schedule_date"
						},
						{
							"data": "label"
						}
					]
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>