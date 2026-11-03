<?php
require 'koneksi/koneksi.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-dokter-radiology.php';
include "bahasa.php";

$uid = $_POST['uid'] ?? $_GET['uid'] ?? '';
$res = !empty($uid) ? mysqli_query($conn_pacsio, "SELECT $select_patient, $select_study, $select_order, $select_workload FROM $table_patient JOIN $table_study ON patient.pk = study.patient_fk LEFT JOIN $table_order ON xray_order.uid = study.study_iuid LEFT JOIN $table_workload ON study.study_iuid = xray_workload.uid WHERE study.study_iuid = '$uid' ORDER BY study.study_datetime DESC") : false;
$row = $res ? (mysqli_fetch_assoc($res) ?: []) : [];
$pat_name = defaultValue($row['pat_name'] ?? null);
$pat_sex = styleSex($row['pat_sex'] ?? null);
$pat_birthdate = defaultValueDate($row['pat_birthdate'] ?? null);
$age = diffDate($row['pat_birthdate'] ?? null);
$study_iuid = defaultValue($row['study_iuid'] ?? null);
$study_datetime = defaultValueDateTime($row['study_datetime'] ?? null);
$accession_no = defaultValue($row['accession_no'] ?? null);
$ref_physician = defaultValue($row['ref_physician'] ?? null);
$study_desc_pacsio = defaultValue($row['study_desc_pacsio'] ?? null);
$mods_in_study = defaultValue($row['mods_in_study'] ?? null);
$num_series = defaultValue($row['num_series'] ?? null);
$num_instances = defaultValue($row['num_instances'] ?? null);
$created_time = defaultValueDateTime($row['created_time'] ?? null);
$updated_time = defaultValueDateTime($row['updated_time'] ?? null);
$pat_id = defaultValue($row['pat_id'] ?? null);
$weight = defaultValue($row['weight'] ?? null);
$no_foto = defaultValue($row['no_foto'] ?? null);
$address = defaultValue($row['address'] ?? null);
$name_dep = defaultValue($row['name_dep'] ?? null);
$named = defaultValue($row['named'] ?? null);
$contrast = defaultValue($row['contrast'] ?? null);
$priority = defaultValue($row['priority'] ?? null);
$priority_doctor = defaultValue($row['priority_doctor'] ?? null);
$radiographer_name = defaultValue($row['radiographer_name'] ?? null);
$create_time = defaultValueDateTime($row['create_time'] ?? null);
$examed_at = defaultValueDateTime($row['examed_at'] ?? null);
$pat_state = defaultValue($row['pat_state'] ?? null);
$spc_needs = defaultValue($row['spc_needs'] ?? null);
$payment = defaultValue($row['payment'] ?? null);
$status = styleStatus($row['status'] ?? null, $study_iuid);
$approved_at = defaultValueDateTime($row['approved_at'] ?? null);
$spendtime = spendTime($study_datetime, $approved_at, $row['status'] ?? null);
$fromorder = $row['fromorder'] ?? null;
$pk_dokter_radiology = $row['pk_dokter_radiology'] ?? null;

// kondisi mencari ditabel dokter radiology
$row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_dokter_radiology 
    FROM $table_dokter_radiology 
    WHERE pk = '$pk_dokter_radiology'"
));

$status_val = $row['status'] ?? '';
if ($status_val == 'waiting' || $status_val == '') {
    // jika status waiting kalo ada dokradid di xray_order tampilkan di xray_order
    $dokrad_name = defaultValue($row['dokrad_name'] ?? null);
} else if ($status_val == 'approved') {
    // jika status approved ambil data dari pk_dokter_radiology tabel xray_dokter_radiology
    $dokrad_name = defaultValue($row_dokrad['dokrad_fullname']);
}

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
                    <td><?= $lang['study'] ?> Iuid</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $study_iuid; ?></td>
                </tr>
                <tr>
                    <td>Accession No</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $accession_no; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $status; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_name'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= removeCharacter($pat_name); ?></td>
                </tr>
                <tr>
                    <td>MRN</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_id; ?></td>
                </tr>
                <tr>
                    <td>No Foto</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $no_foto; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['date_birth'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_birthdate; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['age'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $age; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['sex'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_sex; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['weight'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $weight; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['address'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $address; ?></td>
                </tr>
                <tr>
                    <td>Contrast</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $contrast; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['priority'] ?>(SIMRS)</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= strtoupper($priority); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['priority'] ?> (Hasil)</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= strtoupper($priority_doctor); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['study'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $study_desc_pacsio; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['series_image'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $num_series . ' / ' . $num_instances; ?></td>
                </tr>
                <tr>
                    <td>Modality</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $mods_in_study; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['referral_physician'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $named; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['departmen'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $name_dep; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_state'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_state; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['radiology_physician'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $dokrad_name; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['radiographer'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $radiographer_name; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['spc_needs'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $spc_needs; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['payment'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $payment; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_order'] ?> Date</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $create_time; ?></td>
                </tr>
                <tr>
                    <td>Send Modality Date</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $examed_at; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['study_date'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $study_datetime; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['approve_date'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $approved_at; ?></td>
                </tr>
                <tr>
                    <td><?= $lang['spend_time'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $spendtime; ?></td>
                </tr>
                <tr>
                    <td>Created Date Send Pacs</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $created_time; ?></td>
                </tr>
                <tr>
                    <td>Updated Date Send Pacs</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $updated_time; ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php
// // mysqli_close($conn);
