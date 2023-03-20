<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Report Excel</title>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<?php require '../report-index.php'; ?>
		</div>
		<!-- <div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div> -->
		<?php include('script-footer.php'); ?>
		<script src="../js/proses/report-excel.js?v=<?= $random; ?>"></script>
		<script>
			$(document).ready(function() {
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='report1']").addClass("active");

				$(".select2").select2();

				$('.check-genders').click(function() {
					$('.check-gender').prop('checked', this.checked);
				});

				$('.check-modalities').click(function() {
					$('.check-modality').prop('checked', this.checked);
				});

				$('.check-priorities').click(function() {
					$('.check-priority').prop('checked', this.checked);
				});

				$('.check-radiologists').click(function() {
					$('.check-radiologist').prop('checked', this.checked);
				});

				$('.check-statuses').click(function() {
					$('.check-status').prop('checked', this.checked);
				});

				// --------------------
				$('#from_workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
				$('#to_workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>