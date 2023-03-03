<?php
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-patient.php';
require 'model/query-base-study.php';
require 'model/query-base-series.php';
require 'bahasa.php';

$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT $select_patient,
	$select_study
	FROM $table_patient
	JOIN $table_study
	ON patient.pk = study.patient_fk 
	WHERE study_iuid = '$uid'"
));
?>
<style>
	.fill {
		padding: 50px;
	}
</style>
<div class="fill">
	<div class="table-responsive-sm">
		<h5 class="text-center font-weight-bold"><?= $lang['study'] ?> Detail</h5>
		<br>
		<table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
			<thead class="thead1">
				<tr>
					<td><?= $lang['patient_name'] ?></td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= removeCharacter($row['pat_name']); ?></td>
				</tr>
				<tr>
					<td>MRN</td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= defaultValue($row['pat_id']); ?></td>
				</tr>
				<tr>
					<td><?= $lang['sex'] ?></td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= defaultValue($row['pat_sex']); ?></td>
				</tr>
				<tr>
					<td><?= $lang['study'] ?></td>
					<td>&nbsp;: </td>
					<td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row['study_desc']); ?></td>
				</tr>
			</thead>
		</table>
	</div>
	<br>
	<h4>
		<strong>
			<table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
				<thead class="thead1">
					<tr>
						<th>Body Part</th>
						<th>Series</th>
						<th>Laterality</th>
						<th>Src Aet</th>
						<th><?= $lang['modality'] ?></th>
						<th>#i</th>
						<th>Department</th>
						<th>Created Date</th>
						<th>Updated Date</th>
					</tr>
					<?php
					$pk_study = $row['pk_study'];
					$query = mysqli_query(
						$conn_pacsio,
						"SELECT
						$select_series 
						FROM $table_series
						WHERE study_fk = '$pk_study'"
					);
					while ($row1 = mysqli_fetch_assoc($query)) { ?>
						<tr>
							<td align="left"><?= defaultValue($row1['body_part']); ?></td>
							<td align="left"><?= defaultValue($row1['series_desc']) ?></td>
							<td align="left"><?= defaultValue($row1['laterality']) ?></td>
							<td align="left"><?= defaultValue($row1['src_aet']); ?></td>
							<td align="left"><?= defaultValue($row1['modality']); ?></td>
							<td align="left"><?= defaultValue($row1['num_instances']); ?></td>
							<td align="left"><?= defaultValue($row1['department']) ?></td>
							<td align="left"><?= defaultValueDateTime($row1['created_time']); ?></td>
							<td align="left"><?= defaultValueDateTime($row1['updated_time']); ?></td>
						</tr>
					<?php
					}
					?>
				</thead>
			</table>
		</strong>
	</h4>
	<br>
	<p>
</div>

<?php

mysqli_close($conn);
