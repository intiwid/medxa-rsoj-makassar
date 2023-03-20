<?php
require '../koneksi/koneksi.php';
require '../chart-hex-rgba.php';
session_start();

if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Chart</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<?php require '../chart-index.php'; ?>
		</div>
		<div class="footerindex">
			<div>
				<?php include('footer-itw.php'); ?>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
		<script src="../js/proses/result-chart.js?v=<?= $random; ?>"></script>
		<script>
			$(document).ready(function() {
				// class sidebar aktif
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='chart2']").addClass("active");
				$("li[data-target='#service'] a i").css('color', '#bdbdbd');

				// tanggal
				$('#from').datetimepicker({
					timepicker: false,
					format: 'd-m-Y'
				});
				$('#to').datetimepicker({
					timepicker: false,
					format: 'd-m-Y'
				});
			});

			// jika checkbox diklik
			$(document).on('click', '.cboxtombol', function() {
				$('.cbox').prop('checked', this.checked);
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>