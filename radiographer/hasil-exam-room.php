<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-mwl-item.php';
require '../bahasa.php';

$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
    $conn_mppsio,
    "SELECT pat_name, 
    pat_sex, 
    pat_id,
    pat_birthdate, 
    accession_no, 
    modality, 
    start_datetime, 
    $select_mwl_item
    FROM $table_mwl_item
    JOIN patient
    ON mwl_item.patient_fk = patient.pk
    WHERE mwl_item.study_iuid = '$uid'
    ORDER BY patient.created_time DESC"
));
?>
<style>
    .fill {
        padding: 10px;
    }
</style>

<div class="fill">

    <div class="table-responsive-sm">
        <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
            <thead class="thead1">
                <tr>
                    <td>Study Iuid</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['study_iuid_mppsio']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_name'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= str_replace('^^^^', '', defaultValue($row['pat_name'])); ?></td>
                </tr>
                <tr>
                    <td>MRN</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['pat_id']); ?></td>
                </tr>
                <tr>
                    <td>Accession No</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['accession_no']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['date_birth'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDate($row['pat_birthdate']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['sex'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['pat_sex']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['modality'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['modality']); ?></td>
                </tr>
                <tr>
                    <td>Sps Id</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['sps_id']); ?></td>
                </tr>
                <tr>
                    <td>Req Proc Id</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['req_proc_id']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['exam_date'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['start_datetime']); ?></td>
                </tr>
                <tr>
                    <td>Station Aet</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['station_aet']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['radiographer'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $row['perf_physician'] == '^^^^' ? '-' : str_replace('^^^^', '', $row['perf_physician']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_order'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['created_time']); ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php

mysqli_close($conn);
