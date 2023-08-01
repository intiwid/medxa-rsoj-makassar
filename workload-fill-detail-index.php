<?php
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-dokter-radiology.php';
require 'model/query-base-workload-fill.php';
require 'js/proses/function.php';
include "bahasa.php";

$uid = $_GET['study_iuid'];
$username = $_SESSION['username'];

$row = mysqli_fetch_assoc(mysqli_query(
    $conn_pacsio,
    "SELECT 
    $select_patient,
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
    WHERE study.study_iuid = '$uid'
    ORDER BY study.study_datetime DESC"
));
$pat_name = defaultValue($row['pat_name']);
$pat_sex = styleSex($row['pat_sex']);
$pat_birthdate = defaultValueDate($row['pat_birthdate']);
$age = diffDate($row['pat_birthdate']);
$study_iuid = defaultValue($row['study_iuid']);
$study_datetime = defaultValueDateTime($row['study_datetime']);
$accession_no = defaultValue($row['accession_no']);
$ref_physician = defaultValue($row['ref_physician']);
$study_desc_pacsio = defaultValue($row['study_desc_pacsio']);
$mods_in_study = defaultValue($row['mods_in_study']);
$num_series = defaultValue($row['num_series']);
$num_instances = defaultValue($row['num_instances']);
$created_time = defaultValueDateTime($row['created_time']);
$updated_time = defaultValueDateTime($row['updated_time']);
$pat_id = defaultValue($row['pat_id']);
$weight = defaultValue($row['weight']);
$no_foto = defaultValue($row['no_foto']);
$address = defaultValue($row['address']);
$name_dep = defaultValue($row['name_dep']);
$named = defaultValue($row['named']);
$contrast = defaultValue($row['contrast']);
$priority = defaultValue($row['priority']);
$priority_doctor = defaultValue($row['priority_doctor']);
$radiographer_name = defaultValue($row['radiographer_name']);
$create_time = defaultValueDateTime($row['create_time']);
$examed_at = defaultValueDateTime($row['examed_at']);
$pat_state = defaultValue($row['pat_state']);
$spc_needs = defaultValue($row['spc_needs']);
$payment = defaultValue($row['payment']);
$status = styleStatus($row['status'], $study_iuid);
$approved_at = defaultValueDateTime($row['approved_at']);
$spendtime = spendTime($study_datetime, $approved_at, $row['status']);
$fromorder = $row['fromorder'];
$pk_dokter_radiology = $row['pk_dokter_radiology'];

// kondisi mencari ditabel dokter radiology berdasarkan pk dokter radiology
$row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_dokter_radiology 
    FROM $table_dokter_radiology 
    WHERE pk = '$pk_dokter_radiology'"
));
if ($row['status'] == 'waiting' || $row['status'] == '') {
    // jika status waiting kalo ada dokradid di xray_order tampilkan di xray_order
    $dokrad_name = defaultValue($row['dokrad_name']);
} else if ($row['status'] == 'approved') {
    // jika status approved ambil data dari pk_dokter_radiology tabel xray_dokter_radiology
    $dokrad_name = defaultValue($row_dokrad['dokrad_fullname']);
}
?>
<style>
    .icon-fill:hover {
        background-color: deepskyblue;
    }
</style>
<div class="col-12" style="padding: 0;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="workload.php">Workload</a></li>
            <li class="breadcrumb-item active">Workload Expertise</li>
        </ol>
    </nav>
</div>
<div class="container">
    <h3 class="text-center">Expertise Detail</h3>
    <hr>
    <div class="row">
        <div class="col-lg-6">
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
                        <td align="left">&nbsp; <?= $priority; ?></td>
                    </tr>
                    <tr>
                        <td><?= $lang['priority'] ?> (Hasil)</td>
                        <td>&nbsp;: </td>
                        <td align="left">&nbsp; <?= $priority_doctor; ?></td>
                    </tr>
                    <tr>
                        <td><?= $lang['study'] ?></td>
                        <td>&nbsp;: </td>
                        <td align="left">&nbsp; <?= $study_desc_pacsio; ?></td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-lg-6">
            <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
                <thead class="thead1">
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
</div>
<div class="container-fluid">
    <table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
        <thead class="thead1">
            <tr>
                <th>No</th>
                <th>Action</th>
                <th>Dokter Radiologi</th>
                <th>Expertise</th>
                <th>Default</th>
                <th>Ubah Dokter</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            <?php
            $i = 1;
            $query = mysqli_query(
                $conn,
                "SELECT 
                        $select_workload_fill
                        FROM $table_workload_fill
                        WHERE uid = '$uid'
                        ORDER BY created_at DESC"
            );
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $pk = defaultValue($row['pk']);
                    $dokrad_name = defaultValue($row['dokrad_name']);
                    $fill = defaultValue($row['fill']);
                    $is_default = defaultValue($row['is_default']);
                    $change_doctor_approved = defaultValue($row['change_doctor_approved']);
                    $created_at = defaultValueDateTime($row['created_at']);
                    $updated_at = defaultValueDateTime($row['updated_at']);
                    $pk_dokter_radiology_fill = $row['pk_dokter_radiology'];

                    // kondisi mencari ditabel dokter radiology berdasarkan username / login
                    $row_dokrad_username = mysqli_fetch_assoc(mysqli_query(
                        $conn,
                        "SELECT $select_dokter_radiology 
                        FROM $table_dokter_radiology 
                        WHERE username = '$username'"
                    ));
                    $pk_dokter_radiology_username = $row_dokrad_username['pk'];
            ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <?php
                            // ketika pk dokter radiologi di xray_workload_fill sama dengan pk dokter radiologi berdasarkan login && pk dokter radiologi xray_workload_fill tidak kosong
                            if (($pk_dokter_radiology == $pk_dokter_radiology_fill) && ($pk_dokter_radiology_fill == $pk_dokter_radiology_username) && $pk_dokter_radiology_fill != null) { ?>
                                <a href="#" class="icon-fill" onclick="isDefault(event, '<?= $uid; ?>', '<?= $pk; ?>')" id="workload-fill">
                                    <i class="fas fa-edit text-info" aria-hidden="true"></i>
                                    <span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                                    <p class="loading" style="display:inline;">Loading...</p>
                                </a>
                            <?php } else { ?>
                                <!-- <a href="#">
                                    <i class="fas fa-edit text-warning" aria-hidden="true"></i>
                                </a> -->
                            <?php } ?>
                            <?php if ($is_default == 1) {
                                echo PDFFIRST . $study_iuid . PDFLAST;
                            } ?>
                        </td>
                        <td><?= $dokrad_name; ?></td>
                        <td style="text-align:left;" width="530"><?= $fill ?>
                            <hr>
                        </td>
                        <td><?= $is_default == 1 ? '<i class="fa fa-check text-success" title="Expertise Selected" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" title="Expertise Not Selected" aria-hidden="true"></i>'; ?></td>
                        <td><?= $change_doctor_approved == 1 ? '<img src="../image/new/user-doctor-no.svg" data-toggle="tooltip" title="Change Physician" style="width: 3%;">' : '-'; ?></td>
                        <td><?= $created_at; ?></td>
                        <td><?= $updated_at; ?></td>
                    </tr>
                <?php $i++;
                }
            } else {
                ?>
                <tr>
                    <td colspan="10">Data Tidak Ada</td>
                </tr>
            <?php } ?>
        </thead>
    </table>
</div>
<script src="js/3.1.1/jquery.min.js"></script>
<script src="../js/proses/workload-fill-detail.js?v=<?= $random; ?>"></script>