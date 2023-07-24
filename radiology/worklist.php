<?php
require 'function_radiology.php';
require '../viewer-all.php';
require '../default-value.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
require '../model/query-base-order.php';
require '../model/query-base-workload.php';
require '../model/query-base-template.php';

session_start();

$uid = $_GET['uid'];
$username = $_SESSION['username'];
$row = mysqli_fetch_assoc(mysqli_query(
	$conn,
	"SELECT $select_patient,
	$select_study,
    $select_order,
    $select_workload
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    LEFT JOIN $table_order
    ON xray_order.uid = study.study_iuid
    LEFT JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
	WHERE study_iuid = '$uid'"
));
$pat_name = defaultValue($row['pat_name']);
$pat_sex = styleSex($row['pat_sex']);
$pat_birthdate = diffDate($row['pat_birthdate']);
$study_iuid = defaultValue($row['study_iuid']);
$study_datetime = defaultValueDateTime($row['study_datetime']);
$accession_no = defaultValue($row['accession_no']);
$ref_physician = defaultValue($row['ref_physician']);
$study_desc = defaultValue($row['study_desc']);
$mods_in_study = defaultValue($row['mods_in_study']);
$num_series = defaultValue($row['num_series']);
$num_instances = defaultValue($row['num_instances']);
$updated_time = defaultValueDateTime($row['updated_time']);
$pat_id = defaultValue($row['pat_id']);
$no_foto = defaultValue($row['no_foto']);
$address = defaultValue($row['address']);
$name_dep = defaultValue($row['name_dep']);
$named = defaultValue($row['named']);
$radiographer_name = defaultValue($row['radiographer_name']);
$dokrad_name = defaultValue($row['dokrad_name']);
$create_time = defaultValueDateTime($row['create_time']);
$pat_state = defaultValue($row['pat_state']);
$priority = defaultValue($row['priority']);
$spc_needs = defaultValue($row['spc_needs']);
$payment = defaultValue($row['payment']);
$fromorder = $row['fromorder'];
$status = styleStatus($row['status'], $study_iuid);
$fill = $row['fill'];
$approved_at = defaultValueDateTime($row['approved_at']);
$spendtime = spendTime($study_datetime, $approved_at, $row['status']);
$pk_study = $row['pk_study'];
$detail_uid = '<a href="#" class="hasil-all penawaran-a" data-id="' . $uid . '">' . removeCharacter($pat_name) . '</a>';

// query mencari berdasarkan pat_id (mrn)
$query_mrn = mysqli_query(
	$conn,
	"SELECT $select_patient,
	$select_study,
	$select_workload
	FROM $table_patient
	JOIN $table_study
	ON patient.pk = study.patient_fk 
	JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
	WHERE pat_id = '$row[pat_id]'
	AND study.study_iuid != '$uid'
	ORDER BY study.study_datetime DESC"
);


// untuk tombol save template
if (isset($_POST["save_template"])) {
	$insert = insert_template_workload($_POST);
	if ($insert) {
		echo "
			<script>
				alert('Report Telah Di Simpan ke template');
				document.location.href= 'worklist.php?uid=$uid&template_id=$insert';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Report Gagal Di Simpan ke template');
				history.back();
			</script>";
	}
}

// untuk tombol save draft
if (isset($_POST["save_draft"])) {
	if (update_draft($_POST)) {
		echo "
			<script>
				alert('Report Telah Di Simpan ke Draft');
				document.location.href= 'dicom.php';
			</script>";
	} else {
		echo "
			<script>
				alert('Report Gagal Di Simpan ke Draft');
				history.back();
			</script>";
	}
}
// untuk tombol approved
if (isset($_POST["save_approve"])) {
	if ($_POST['fill'] == null) {
		echo "<script type='text/javascript'>
					alert('expertise wajib diisi');
				</script>";
	} else {
		if (insert_workload($_POST)) {
			echo "<script type='text/javascript'>
					setTimeout(function () { 
					swal({
							title: 'Berhasil expertise!',
							text:  '',
							icon: 'success',
							timer: 1000,
							showConfirmButton: true
						});  
					},10); 
					window.setTimeout(function(){ 
					document.location.href= 'dicom.php';
					} ,1000); 
					win = window.open('pdf/expertise.php?uid=$uid', '_blank');
					win.focus();
					win.print();
				</script>";
		} else {
			echo "<script type='text/javascript'>
					setTimeout(function () { 
					swal({
							title: 'Gagal Expertise!',
							text:  '',
							icon: 'error',
							timer: 1000,
							showConfirmButton: true
						});  
					},10); 
					window.setTimeout(function(){ 
					history.back();
					} ,1000); 
				</script>";
		}
	}
}
if ($_SESSION['level'] == "radiology") { ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<script type="text/javascript" src="../js/sweetalert.min.js" />
		</script>
		<?php include('head.php'); ?>
		<title>Expertise | Radiology Physician</title>
		<script type="text/javascript" src="js/jquery1.10.2.js"></script>
	</head>
	<style>
		.fill {
			padding: 50px;
		}
	</style>

	<body>
		<?php include('../sidebar-index.php');
		require '../modal.php'; ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12" style="padding: 0;">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item"><a href="dicom.php">Worklist</a></li>
										<li class="breadcrumb-item active">Expertise</li>
									</ol>
								</nav>
							</div>


							<div class="col-lg-9">
								<div class="row div-left">
									<div class="col-lg-4" style="padding-top: 11px;">
										<div class="div-left">
											<div class="info-patient">
												<div class="info-patient2">
													<div class="row justify-content-center">
														<div class="info-left col-sm-12">
															<table class="infopatientworklist table-left">
																<tr>
																	<td><span class="table-left">Name</span></td>
																</tr>
																<tr>
																	<td><?= $detail_uid; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">MRN</span></td>
																</tr>
																<tr>
																	<td><?= $pat_id; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">Sex</span></td>
																</tr>
																<tr>
																	<td><?= $pat_sex; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">Age</span></td>
																</tr>
																<tr>
																	<td><?= $pat_birthdate; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">Special Needs</span></td>
																</tr>
																<tr>
																	<td><?= $spc_needs; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">Procedure</span></td>
																</tr>
																<tr>
																	<td><?= $study_desc; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">Study Date</span></td>
																</tr>
																<tr>
																	<td><?= $study_datetime; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">Department</span></td>
																</tr>
																<tr>
																	<td><?= $name_dep; ?></td>
																</tr>
																<tr>
																	<td><span class="table-left">Refferal Physician</span></td>
																</tr>
																<tr>
																	<td><?= $named; ?></td>
																</tr>
															</table>
														</div>
													</div>
												</div>
											</div>
											<!-- <div class="left-top">
												<div style="width: 50%; padding: 3px;">
													<div class="work-order">
														<ul>
															<a class="button-work-order" href="#!">
																<li class="li-work patient-work">History</li>
															</a>
														</ul>
													</div>
												</div>
												<div style="width: 50%; padding: 3px;">
													<div class="work-patient">
														<ul>
															<a class="button-work-patient" href="#!">
																<li class="li-work patient-work">viewer</li>
															</a>
														</ul>
													</div>
												</div>
											</div> -->
											<!-- history pasien berdasarkan mrn pat_iid-->
											<div class="data-order">
												<h4 style="margin: 0px;">History</h4>
												<hr style="margin: 10px 0px;">
												<?php
												$i = 1;
												while ($mrn = mysqli_fetch_assoc($query_mrn)) {
													$study_iuid = $mrn['study_iuid'];
													$detail_mrn = '<a href="#" class="hasil-all penawaran-a" data-id="' . $study_iuid . '">' . removeCharacter($pat_name) . '</a>';
												?>
													<table>
														<tbody>
															<p class="text-center"><?= $i; ?></p>
															<tr>
																<td><span class="table-left">Name</span></td>
															</tr>
															<tr>
																<td><?= $detail_mrn . ' ' . styleStatus($mrn['status'], $study_iuid); ?></td>
															</tr>
															<tr>
																<td><span class="table-left">MRN</span></td>
															</tr>
															<tr>
																<td><?= $pat_id; ?></td>
															</tr>
															<tr>
																<td><span class="table-left">Pemeriksaan</span></td>
															</tr>
															<tr>
																<td><?= defaultValue($mrn['study_desc']); ?></td>
															</tr>
															<tr>
																<td><span class="table-left">Waktu Pemeriksaan</span></td>
															</tr>
															<tr>
																<td><strong class="text-dark text-center"><?= defaultValueDateTime($mrn['study_datetime']); ?></strong></td>
															</tr>
															<tr>
																<td>
																	<?= PDFFIRST . $study_iuid . PDFLAST .
																		HOROSFIRST . $study_iuid . HOROSLAST .
																		OHIFOLDFIRST . $study_iuid . OHIFOLDLAST;
																	?>
																	<a href="#" class="view-history-expertise" data-id="<?= $study_iuid;  ?>">
																		<i data-toggle="tooltip" title="View History Expertise" class="fa fa-file-archive-o fa-lg"></i>
																	</a>
																</td>
															</tr>
														</tbody>
													</table>
													<hr>
												<?php $i++;
												} ?>
											</div>
											<!-- Multimed viewer -->
											<!-- <div class="data-patient">
												<div class="content2-adm li-adm">
													<h4 style="margin: 0px;">Viewer</h4>
													<hr style="margin: 10px 0px;">
													<div class="buttons1">
														<?= HOROSWORKLISTFIRST . $uid . HOROSWORKLISTLAST .
															RADIANTWORKLISTFIRST . $uid . RADIANTWORKLISTLAST .
															HTMLWORKLISTFIRST . $uid . HTMLWORKLISTLAST .
															OHIFOLDWORKLISTFIRST . $uid . OHIFOLDWORKLISTLAST;
														?>
													</div>
												</div>
											</div> -->
											<form action="" method="post">
												<div class="tambahan1">
													<label for="priority_doctor">
														<h5 style="margin-top: 0px; margin-bottom:-6px; font-weight:bold;"><?= $lang['information'] ?></h5>
													</label><br>
													<label class="radio-admin">
														<input type="radio" checked name="priority_doctor" value="normal" required> Normal
														<span class="checkmark"></span>
													</label><br>
													<label class="radio-admin">
														<input type="radio" name="priority_doctor" value="cito" required> Cito
														<span class="checkmark"></span>
													</label>
												</div>
										</div>
									</div>

									<div class="col-lg-8">
										<div class="div-mid">
											<div class="work-patient6">
												<!-- Multimed viewer -->
												<div class="data-patient">
													<div class="content2-adm li-adm">
														<!-- <h4 style="margin: 0px;">Viewer</h4>
														<hr style="margin: 10px 0px;"> -->
														<div class="container-fluid">
															<div class="row">
																<?= RADIANTWORKLISTFIRST . $uid . RADIANTWORKLISTLAST .
																	INOBITECWORKLISTFIRST . "'$uid'" . INOBITECWORKLISTLAST .
																	HTMLWORKLISTFIRST . $uid . HTMLWORKLISTLAST .
																	OHIFOLDWORKLISTFIRST . $uid . OHIFOLDWORKLISTLAST;
																?>

															</div>
														</div>

													</div>
												</div>

												<input type="hidden" name="uid" value="<?= $uid; ?>">
												<input type="hidden" name="username" value="<?= $username; ?>">
												<?php
												@$template_id = $_GET['template_id'];
												$template = mysqli_fetch_assoc(mysqli_query(
													$conn,
													"SELECT $select_template 
													FROM $table_template
													WHERE template_id = '$template_id'"
												));
												if ($template_id == "") {
													$fill = $row['fill'];
												} else {
													$fill = $template['fill'];
												}
												?>
												<br>

												<div class="textarea-ckeditor">
													<textarea class="ckeditor" name="fill" id="ckeditor">
													<?= $fill; ?>
													</textarea>
												</div>
												<button class="btn btn-worklist btn-expertise button-popup-approve" id="save_edit" name="save_approve"><i class="fas fa-check-square"></i> Approve</button>
												<div class="kotak">
													<!---POP UP -->
													<div class="container">
														<!-- Button to Open the Modal -->
														<button class="btn btn-worklist3 btn-expertise button-popup" type="button" data-toggle="modal" data-target="#modal-insert-template"><i class="fas fa-file-export"></i> Save Template
														</button>
														<!-- Modal -->
														<div class="modal fade" id="modal-insert-template" role="dialog">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Insert Title</h4><br />
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																	</div>
																	<div class="modal-body-template" style="padding: 10px;">
																		<input class="form-control" type="text" name="title" value="" placeholder="Insert Tittle">
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
																		<button style="border-radius: 5px; font-weight: bold; margin-bottom:4px;" class=" btn btn-success" id="save_template" name="save_template">Save</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!-- END OF POP UP -->
													<div class="btn-bar-1">
														<button class="btn btn-worklist3 btn-expertise" id="save_draft" name="save_draft" onclick="return confirm('Are you sure save draft?');"><i class="fas fa-save"></i> Save Draft</button>
													</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br><br>



							<div class="col-lg-3">
								<div class="div-right">
									<div class="">
										<input type="text" class="form-control" placeholder="search by tittle.. " id="myInput" style="margin: 9px 0px; width: 100%;">
									</div>
									<div class="template-save1">
										Template Name
									</div>
									<div class="template-save" id="container-template">
										<!-- <div id="content"></div> -->
										<table border="1" id="mytemplate" class="type-choice mytemplate" style="width: 100%;">
											<?php
											$query_template = mysqli_query(
												$conn,
												"SELECT $select_template 
												FROM $table_template 
												WHERE username = '$username'"
											);
											while ($template = mysqli_fetch_assoc($query_template)) { ?>
												<thead class="myTable">
													<td class="td1">
														<a href="worklist.php?uid=<?= $uid; ?>&template_id=<?= $template['template_id']; ?>"><?= $template['title']; ?></a>
													</td>
													<td style="text-align: center;">
														<a href="#" class="view-template" data-id="<?= $template['template_id'];  ?>">
															<i data-toggle="tooltip" title="View Template" class="fas fa-eye fa-lg"></i>
														</a>
													</td>
													<td style="text-align: center;">
														<a href="hapustemplate.php?uid=<?= $uid; ?>&template_id=<?= $template['template_id']; ?>&halaman=worklist" data-id="<?= $template['template_id'];  ?>" onclick="return confirm('Teruskan Menghapus Data?');">
															<i data-toggle="tooltip" title="Delete Template" class="fas fa-trash fa-lg"></i>
														</a>
													</td>
												<?php } ?>
												</thead>
										</table>
									</div>
								</div>
							</div>

							<div class="col-lg-12" style="overflow-x: auto;"><br><br>
								<div style="margin-left: -14px; min-width: 697px;">
									<!-- menampilkan OHIF 1 halaman -->
									<div class="collapse div-left" id="ohif">
										<iframe src="<?= "$url$uid" ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="600px"></iframe>
									</div>
								</div>
							</div>


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
		<!-- SCRIPT -->
		<?php include('script-footer.php'); ?>
		<script>
			$(document).ready(function() {
				$("li[id='worklist1']").addClass("active");
			});
		</script>
		<script>
			CKEDITOR.replace('ckeditor', {
				enterMode: CKEDITOR.ENTER_BR
			});
		</script>
		<script>
			var save = false;
			$('#save_edit').click(function() {
				save = true;
			});

			$('#save_template').click(function() {
				save = true;
			});

			$('#save_draft').click(function() {
				save = true;
			});

			// ketika dokter input 1 kata, dan close browser atau pindah halaman akan muncul pop up.
			$(document).ready(function() {
				CKEDITOR.instances['ckeditor'].on('change', function(e) {
					var fill = CKEDITOR.instances['ckeditor'].getData();

					window.addEventListener('beforeunload', function(e) {
						if (fill !== '' && save !== true) {
							e.preventDefault();
							e.returnValue = '';
						}
					});
				});
			});
		</script>
		<!-- -------------------javascript select template-------------- -->
		<script>
			$(document).ready(function() {
				$(".type-choice").show();
			});
			$(function() {
				$('#selector1').change(function() {
					$('.type-choice').hide();
					$('#' + $(this).val()).show();
				});
			});
		</script>
		<!-- -------------------javascript select temlate-------------- -->
		<script>
			// $(document).ready(function() {
			// 	$(".data-order").hide();
			// 	$(".work-patient").css("background", "#68b399");
			// 	$(".work-order").css("background", "#f1f1f1");
			// 	$(".work-patient a").css("color", "#fff");
			// 	$(".work-order a").css("color", "#68b399");
			// 	$(".button-work-order").click(function() {
			// 		$(".work-order").css("background", "#68b399");
			// 		$(".work-patient").css("background", "#f1f1f1");
			// 		$(".work-order a").css("color", "#fff");
			// 		$(".work-patient a").css("color", "#68b399");
			// 		$(".data-order").show();
			// 		$(".data-patient").hide();
			// 	});
			// });
			// $(document).ready(function() {
			// 	$(".button-work-patient").click(function() {
			// 		$(".work-patient").css("background", "#68b399");
			// 		$(".work-order").css("background", "#f1f1f1");
			// 		$(".work-patient a").css("color", "#fff");
			// 		$(".work-order a").css("color", "#68b399");
			// 		$(".data-patient").show();
			// 		$(".data-order").hide();
			// 	});
			// });
		</script>
		<script>
			$(document).ready(function() {
				$(".dokteravail").toggle();
				$(".btn-info").click(function() {
					$(".dokteravail").hide();
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
	mysqli_close($conn);
} ?>