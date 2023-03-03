<?php
require '../koneksi/koneksi.php';
session_start();
$from = date('d-m-Y 23:59', strtotime("-2 days"));
$to = date('d-m-Y 23:59', strtotime("-1 days"));
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Exam | Radiographer</title>
		<style>
			.uploadimg {
				border-radius: 5px;
				cursor: pointer;
				transition: 0.3s;
				margin: 0px 0px 5px 5px;
				width: 150px;
				font-size: 160px;
			}

			.kotakfoto {
				display: none;
				/* Hidden by default */
				position: fixed;
				/* Stay in place */
				z-index: 100;
				/* Sit on top */
				padding-top: 100px;
				/* Location of the box */
				left: 0;
				top: 0;
				width: 100%;
				/* Full width */
				height: 100%;
				/* Full height */
				overflow: auto;
				/* Enable scroll if needed */
				background-color: rgb(0, 0, 0);
				/* Fallback color */
				background-color: rgba(0, 0, 0, 0.9);
				/* Black w/ opacity */
			}

			/* Modal Content (Image) */
			.kontenfoto {
				margin: auto;
				display: block;
				width: 80%;
				max-width: 350px;
			}

			.capt {
				margin: auto;
				display: block;
				width: 100%;
				max-width: 700px;
				text-align: center;
				color: #FFF8DC;
				padding: 10px 0;
				height: 500px;
			}

			/* Add Animation - Zoom in the Modal */
			.kontenfoto,
			.capt {
				animation-name: zoom;
				animation-duration: 0.6s;
			}

			@keyframes zoom {
				from {
					transform: scale(0)
				}

				to {
					transform: scale(1)
				}
			}

			/* The Close Button */
			.close1 {
				/* margin-top: -50px; */
				color: #fff;
				font-size: 20px;
				font-weight: bold;
				transition: 0.3s;
				opacity: unset;
				float: unset;
				width: 100%;
			}

			.close1:hover,
			.close1:focus {
				color: #f2f2f2;
				text-decoration: none;
				cursor: pointer;
			}

			/* 100% Image Width on Smaller Screens */
			@media only screen and (max-width: 600px) {
				.kontenfoto {
					width: 100%;
				}
			}
		</style>
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
										<li class="breadcrumb-item active"><?= $lang['patient_being_examined'] ?></li>
									</ol>
								</nav>
							</div>
							<div class="table-view col-md-12 table-box" style="overflow-x:auto;">
								
								<h4 class="text-center"><?= $lang['patient_being_examined'] ?></h4>
								<br>
								<form class="form-inline" method="POST" action="deleteexamall.php">
									<div class="form-group">
										<label class="sr-only" for="from">Dari Tanggal</label>
										<input type="text" class="form-control input-sm form-control-sm" name="from" id="from" placeholder="dari tanggal" autocomplete="off" value="<?= $from ?>">
									</div>
									<div class="form-group">
										<label class="sr-only" for="from">Sampai Tanggal</label>
										<input type="text" class="form-control input-sm form-control-sm" name="to" id="to" placeholder="sampai tanggal" autocomplete="off" value="<?= $to ?>">
									</div>
									<button type="submit" class="btn btn-default btn-sm" style="padding: 7px;">Hapus</button>
								</form>
								<br>
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
											<th><?= $lang['exam_date'] ?></th>
											<th><?= $lang['patient_order'] ?></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal" id="myModal">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h3>QR Code</h3>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body detail-targeting targeting2 detail-targeting2">

					</div>

					<!-- Modal footer -->
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div> -->

				</div>
			</div>
		</div>

		<!-- The Modal study_iuid -->
		<div class="modal" id="modal-exam-room">
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
				$(document).on('click', '.exam-room', function(e) {
					e.preventDefault();
					$("#modal-exam-room").modal('show');
					$.post('hasil-exam-room.php', {
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
				$("ul[id='products1'] li[id='exam3']").addClass("active");
				$("li[data-target='#products1'] a i").css('color', '#bdbdbd');

			});
		</script>

		<script>
			function myFunction() {
				alert("Data belum kirim kepacs");
			}
		</script>
		<script>
			$('#from').datetimepicker({
				format: 'd-m-Y H:i',
				allowTimes: ['00:00',
					'01:00',
					'02:00',
					'03:00',
					'04:00',
					'05:00',
					'06:00',
					'07:00',
					'08:00',
					'09:00',
					'10:00',
					'11:00',
					'12:00',
					'13:00',
					'14:00',
					'15:00',
					'16:00',
					'17:00',
					'18:00',
					'19:00',
					'20:00',
					'21:00',
					'22:00',
					'23:00',
					'23:59'
				]
			});
			$('#to').datetimepicker({
				format: 'd-m-Y H:i',
				allowTimes: ['00:00',
					'01:00',
					'02:00',
					'03:00',
					'04:00',
					'05:00',
					'06:00',
					'07:00',
					'08:00',
					'09:00',
					'10:00',
					'11:00',
					'12:00',
					'13:00',
					'14:00',
					'15:00',
					'16:00',
					'17:00',
					'18:00',
					'19:00',
					'20:00',
					'21:00',
					'22:00',
					'23:00',
					'23:59'
				]
			});
		</script>
		<script>
			$('document').ready(function() {
				$('#example').dataTable({
					"ajax": {
						"url": "getExam2.php",
						"dataSrc": ""
					},
					"columns": [{
							"data": "no"
						},
						{
							"data": "action"
						},
						{
							"data": "pat_name"
						},
						{
							"data": "pat_id"
						},
						{
							"data": "accession_no"
						},
						{
							"data": "pat_birthdate"
						},
						{
							"data": "pat_sex"
						},
						{
							"data": "modality"
						},
						{
							"data": "start_datetime"
						},
						{
							"data": "created_time"
						},
						// {
						// 	"data": "qrcode"
						// },
					]
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>