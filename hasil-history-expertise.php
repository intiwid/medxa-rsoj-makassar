<?php
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-patient.php';
require 'model/query-base-study.php';
require 'model/query-base-series.php';
require 'model/query-base-workload.php';
require 'bahasa.php';

$study_iuid = $_POST['study_iuid'];
$row = mysqli_fetch_assoc(mysqli_query(
    $conn_pacsio,
    "SELECT $select_patient,
	$select_study,
    $select_workload
	FROM $table_patient
	JOIN $table_study
	ON patient.pk = study.patient_fk 
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
	WHERE study_iuid = '$study_iuid'"
));
$approved_at = defaultValueDateTime($row['approved_at']);
?>
<div class="fill-history_expertise" style="margin: 20px;">
    <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
        <thead class="thead1">
            <tr>
                <td><?= $lang['patient_name'] ?></td>
                <td>&nbsp;: </td>
                <td align="left">&nbsp; <?= removeCharacter($row['pat_name']) . ' ' . styleStatus($row['status'], $study_iuid); ?></td>
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
                <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row['study_desc_pacsio']); ?></td>
            </tr>
            <tr>
                <td>Approve Date</td>
                <td>&nbsp;: </td>
                <td align="left" class="font-weight-bold">&nbsp; <?= $approved_at; ?></td>
            </tr>
        </thead>
    </table>
    <hr>
    <!-- <button onclick="selectText('divid')">Select</button> -->
    <div id="divid">
        <?= $row['fill']; ?>
    </div>


</div>