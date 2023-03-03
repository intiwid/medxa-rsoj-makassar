<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-mwl-item.php';
require '../bahasa.php';

$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
    $conn_mppsio,
    "SELECT 
    $select_order,
    $select_mwl_item,
    study.study_iuid AS study_iuid_pacsio
    FROM $table_order
    LEFT JOIN $table_mwl_item
    ON xray_order.uid = mwl_item.study_iuid
    LEFT JOIN $table_study
    ON study.study_iuid = xray_order.uid
    WHERE xray_order.uid = '$uid'
    LIMIT 1"
));
$fromorder = $row['fromorder'];
?>
<style>
    .fill {
        padding: 10px;
    }
</style>

<div class="col justify-content-center text-center">
    <div class="row-12">
        <?php
        if ($fromorder == 'SIMRS' || $fromorder == 'simrs') { ?>
            <i class="fas fa-exchange-alt text-info" title="terintegrasi dengan SIMRS"></i>
        <?php } ?>
    </div>
</div>
<div class="fill">
    <div class="table-responsive-sm">
        <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
            <thead class="thead1">
                <tr>
                    <td>UID</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $row['uid']; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_name'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['name']) ?></td>
                </tr>
                <tr>
                    <td>MRN</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['mrn']); ?></td>
                </tr>
                <tr>
                    <td>No Foto</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['patientid']); ?></td>
                </tr>
                <tr>
                    <td>Accession No</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['acc']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['date_birth'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDate($row['birth_date']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['address'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['address']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['weight'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['weight']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['sex'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['sex']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['referral_physician'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['named']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['radiology_physician'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['dokrad_name']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['priority'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['priority']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_state'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['pat_state']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['modality'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['xray_type_code']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['exam_date'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['schedule_date'] . ' ' . $row['schedule_time']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['radiographer'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['radiographer_name']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['spc_needs'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['spc_needs']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['payment'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['payment']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_order'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['create_time']); ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php

mysqli_close($conn);
