<?php
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-patient.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-mwl-item.php';
require 'bahasa.php';

$uid = $_POST['uid'];
$pat_id = $_POST['pat_id'];

$row_study = mysqli_fetch_assoc(mysqli_query(
    $conn_pacsio,
    "SELECT 
    $select_patient,
    $select_study,
    $select_order
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    LEFT JOIN $table_order
    ON xray_order.uid = study.study_iuid
    WHERE study.study_iuid = '$uid'"
));
?>
<style>
    .fill {
        padding: 50px;
    }
</style>
<div class="fill">
    <h5 class="text-center font-weight-bold">Bridging Simrs</h5>
    <p>Catatan : <br> - Pastikan modality dan pemeriksaan sesuai - klik kolom acc <br> - Menampilkan pasien berdasarkan norekam medis selama exam date 7 hari periode <?= date('d-m-Y', strtotime('-7 day')) ?> - <?= date('d-m-Y') ?> <br> - Tidak tampil data pasien ? silahkan edit norekam medis (MRN) pada form</p>
    <div class="table-responsive-sm">
        <h6 class="font-weight-bold">Pasien Modality</h6>
        <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
            <thead class="thead1">
                <tr>
                    <td><?= $lang['patient_name'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= removeCharacter($row_study['pat_name']); ?></td>
                </tr>
                <tr>
                    <td>MRN</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row_study['pat_id']); ?></td>
                </tr>
                <tr>
                    <td>Acc</td>
                    <td>&nbsp;: </td>
                    <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row_study['acc']); ?></td>
                </tr>
                <tr>
                    <td>Modality</td>
                    <td>&nbsp;: </td>
                    <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row_study['mods_in_study']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['study'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row_study['study_desc']); ?></td>
                </tr>
            </thead>
        </table>
    </div>
    <br>
    <h4>
        <h6 class="font-weight-bold">Pasien SIMRS</h6>
        <strong>

            <table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
                <thead class="thead1">
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th><?= $lang['patient_name'] ?></th>
                        <th>MRN</th>
                        <th>Acc</th>
                        <th><?= $lang['modality'] ?></th>
                        <th><?= $lang['study'] ?></th>
                        <th><?= $lang['patient_order'] ?></th>
                        <th><?= $lang['exam_date'] ?></th>
                        <th>Label</th>
                    </tr>
                    <?php
                    $i = 1;
                    $query = mysqli_query(
                        $conn,
                        "SELECT 
                        $select_order,
                        $select_mwl_item,
                        study.study_iuid AS study_iuid_pacsio
                        FROM $table_order
                        LEFT JOIN $table_mwl_item
                        ON xray_order.uid = mwl_item.study_iuid
                        LEFT JOIN $table_study
                        ON study.study_iuid = xray_order.uid
                        WHERE fromorder IN('SIMRS')
                        AND mrn = '$pat_id'
                        AND schedule_date > DATE_SUB(NOW(), INTERVAL 8 DAY)
                        ORDER BY xray_order.schedule_date DESC, xray_order.schedule_time DESC"
                    );
                    while ($row = mysqli_fetch_assoc($query)) {
                        $server_name = $_SERVER['SERVER_NAME'];
                        $study_iuid_mppsio = $row['study_iuid_mppsio'];
                        $study_iuid_pacsio = $row['study_iuid_pacsio'];
                        $uid = $row['uid'];
                        $priority = defaultValue($row['priority']);
                        $fromorder = strtoupper($row['fromorder']);
                        $deleted_at = $row['deleted_at'];

                        $sex = defaultValue($row['sex']);
                        if ($sex == 'M') {
                            $sex_icons = '<i style="color: blue;" class="fas fa-mars"> M</i>';
                        } else if ($sex == 'L') {
                            $sex_icons = '<i style="color: blue;" class="fas fa-mars"> L</i>';
                        } else if ($sex == 'P') {
                            $sex_icons = '<i style="color: #ff637e;" class="fas fa-venus"> P</i>';
                        } else if ($sex == 'F') {
                            $sex_icons = '<i style="color: #ff637e;" class="fas fa-venus"> F</i>';
                        } else if ($sex == 'O') {
                            $sex_icons = '<i class="fas fa-genderless"> O</i>';
                        } else {
                            $sex_icons = '-';
                        }

                        // tidak menggunakan orderrefresh
                        if ($study_iuid_mppsio == null && $study_iuid_pacsio == null && $fromorder == 'SIMRS') {
                            $label = "<div class='alert alert-danger' role='alert'>GAGAL DIPERIKSA</div>";
                        } else if ($study_iuid_mppsio == null && $study_iuid_pacsio == null && $fromorder != 'SIMRS') {
                            $label = "<div class='alert alert-primary' role='alert'>BARU</div>";
                        } else if ($study_iuid_mppsio != null && $study_iuid_pacsio == null) {
                            $label = "<div class='alert alert-info' role='alert'>SEDANG DIPERIKSA</div>";
                        } else if ($study_iuid_mppsio == null && $study_iuid_pacsio != null) {
                            $label = "<div class='alert alert-success' role='alert'>SELESAI DIPERIKSA</div>";
                        } else if ($study_iuid_mppsio != null && $study_iuid_pacsio != null) {
                            $label = "<div class='alert alert-success' role='alert'>SELESAI DIPERIKSA</div>";
                        } else {
                            $label = "-";
                        }

                        $detail = '<a href="#" class="order2 penawaran-a" data-id="' . $uid . '">' . defaultValue($row['name']) . '</a>';

                        // kondisi ketika data dari simrs
                        if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
                            $badge = SIMRS;
                        } else {
                            $badge = '';
                        }

                        // kondisi jika prioriry normal dan CITO
                        if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
                            $priority_style = PRIORITYNORMAL;
                        } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
                            $priority_style = PRIORITYCITO;
                        } else {
                            $priority_style = '';
                        }
                    ?>
                        <tr>
                            <td align=" left"><?= $i; ?></td>
                            <td align="left"><?= $badge ?></td>
                            <td align="left"><?= $detail . '&nbsp;' . $priority_style ?></td>
                            <td align="left"><?= defaultValue($row['mrn']) ?></td>
                            <td align="left"><a href="#" onclick="copyPaste(event, '<?= $row['acc']; ?>', '<?= $row['xray_type_code']; ?>')"><?= defaultValue($row['acc']); ?> <i class="fas fa-copy" title="copy paste"></i></a></td>
                            <td align="left"><?= defaultValue($row['xray_type_code']) ?></td>
                            <td align="left"><?= defaultValue($row['prosedur']); ?></td>
                            <td align="left"><?= defaultValueDateTime($row['create_time']); ?></td>
                            <td align="left"><?= defaultValueDateTime($row['schedule_date'] . ' ' . $row['schedule_time']); ?></td>
                            <td align="left"><?= $label; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </thead>
            </table>
        </strong>
    </h4>
    <br>
    <p>
</div>


<script>
    function copyPaste(e, pat_id, xray_type_code) {
        e.preventDefault();
        if (xray_type_code != $('#mods_in_study').val()) {
            swal({
                title: "Perbedaan Modality",
                text: `Yakin Ingin Update ?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    swal({
                        title: 'Berhasil disalin',
                        timer: 1000,
                    });
                    setTimeout(function() {
                        $('#modal-acc').modal('hide')
                    }, 1000);
                    $('#accession_no').val(pat_id);
                }
            });
        } else {
            swal({
                title: 'Berhasil disalin',
                timer: 1000,
            });
            setTimeout(function() {
                $('#modal-acc').modal('hide')
            }, 1000);
            $('#accession_no').val(pat_id);
        }
    }
</script>

<?php

mysqli_close($conn);
