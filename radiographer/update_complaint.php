<?php
require 'function_radiographer.php';
session_start();
$username = $_SESSION['username'];
//ambil data di url
$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM xray_complaint WHERE id = '$id' ");
$row111 = mysqli_fetch_array($result);

$complaint_date = $row111['complaint_date'];
$complaint_time = $row111['complaint_time'];
$person_call = $row111['person_call'];
$problem = $row111['problem'];
$solve_date = $row111['solve_date'];
$solve_time = $row111['solve_time'];
$explanation = $row111['explanation'];

if (isset($_POST["submit"])) {
	if (editcomplaint($_POST) > 0) {
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_complaint.php';
</script>
";
	} else {
		echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'update_complaint.php?id=$id';
</script>";
	}
}

// function jin_date_str($date)
// {
// 	$exp = explode('-', $date);
// 	if (count($exp) == 3) {
// 		$date = $exp[2] . '/' . $exp[1] . '/' . $exp[0];
// 	}
// 	return $date;
// }
if ($_SESSION['username'] == 'rafdi') {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Update Complain</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">

				<div id="content1">
					<div class="col-12" style="padding: 0;">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item"><a href="settings.php">Settings</a></li>
								<li class="breadcrumb-item"><a href="view_complaint.php">Complain</a></li>
								<li class="breadcrumb-item active">
									Update Complain
								</li>
							</ol>
						</nav>
					</div>
					<div class="container-fluid">
						<form action="" method="post">
							<div class="about-inti back-search" style="padding: 10px;">
								<h1>Update Complain</h1>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6"><br>
											<input type="hidden" name="id" id="id" value="<?= $id; ?>"></input>
											<label><b>Complain Date</b></label>
											<?php $d = date('Y-m-d', strtotime($row111["complaint_date"])); ?>
											<input type="text" class="form-control" name="complaint_date" id="complaint_date" autocomplete="off" value="<?= $d; ?>"></input>
										</div>
										<div class="col-md-6"><br>
											<label><b>Complain Time</b></label><br>
											<input type="text" class="form-control" name="complaint_time" id="complaint_time" autocomplete="off" value="<?= $row111['complaint_time']; ?>"></input>
										</div>
									</div>
									<div>
										<br>
										<label>Person Call:</label>
										<input type="text" class="form-control" name="person_call" value="<?= $row111['person_call']; ?>">
									</div>
									<div>
										<br>
										<label>Problem:</label>
										<textarea class="form-control" name="problem" value="<?= $row111['problem']; ?>"><?= $row111["problem"]; ?></textarea>
									</div>
									<div class="row">
										<div class="col-md-6"><br>
											<label><b>Solve Date</b></label>
											<?php $d = date('Y-m-d', strtotime($row111["solve_date"])); ?>
											<input type="text" class="form-control" name="solve_date" id="solve_date" autocomplete="off" value="<?= $d; ?>"></input>
										</div>
										<div class="col-md-6"><br>
											<label><b>Solve Time</b></label><br>
											<input type="text" class="form-control" name="solve_time" id="solve_time" autocomplete="off" value="<?= $row111['solve_time']; ?>"></input>
										</div>
									</div>
									<div>
										<br>
										<label>Explanation:</label>
										<textarea class="form-control" name="explanation" value="<?= $row111['explanation']; ?>"><?= $row111["explanation"]; ?></textarea>
									</div>
								</div>
							</div>

							<br><br><br>
							<?php if ($username != "demo") { ?>
								<li>
									<button class="btn buttonsearch2 waves-effect waves-light" type="submit" name="submit">Ubah Data</button>
								</li>
							<?php } else { ?>
								<li>
									<button class="btn buttonsearch2 waves-effect waves-light" type="submit" name="submit" disabled>Ubah Data</button>
								</li><br>
							<?php } ?>
							</ul>
						</form>
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
		<script>
			$(document).ready(function() {
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='workload1']").addClass("active");
			});
		</script>

		<script>
			$(document).ready(function() {
				$(".klik-dokter").hide();
				$(".btn-info").click(function() {
					// $(".dokteravail").hide();
					$(".dokteravail").show();
					$(".klik-dokter").hide();
				});
			});
		</script>


		<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
		<script>
			$(document).ready(function() {
				$('#solve_date').datetimepicker({
					timepicker: false,
					format: 'Y-m-d'
				});
			});
			$('#solve_time').datetimepicker({
				datepicker: false,
				step: 1,
				format: 'H:i:s'
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#complaint_date').datetimepicker({
					timepicker: false,
					format: 'Y-m-d'
				});
			});
			$('#complaint_time').datetimepicker({
				datepicker: false,
				step: 1,
				format: 'H:i:s'
			});
		</script>


	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>