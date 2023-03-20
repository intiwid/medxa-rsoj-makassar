<?php

require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-mwl-item.php';
require '../viewer-all.php';

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
    WHERE fromorder IN('SIMRS', 'RIS')
    ORDER BY xray_order.schedule_date DESC, xray_order.schedule_time DESC
    LIMIT 1000"
);

$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
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

    // menggunakan orderrefresh
    // if ($study_iuid_mppsio == null && $study_iuid_pacsio == null && $fromorder == 'TERKIRIM') {
    //     $label = "<div class='alert alert-danger' role='alert'>GAGAL DIPERIKSA</div>";
    //     $aksi = "<form id=order  name=order method=post action='exam.php'>
    //                 <input name='uid' type='hidden' id='uid' value='" . $uid . "'>
    //                 <button class ='btn-worklist' type='submit' name='button' id='button' value='RESEND'>KIRIM ULANG</button>
    //             </form>";
    // } else if ($study_iuid_mppsio == null && $study_iuid_pacsio == null && $fromorder != 'TERKIRIM') {
    //     $label = "<div class='alert alert-primary' role='alert'>BARU</div>";
    //     $aksi = "<form id=order  name=order method=post action='exam.php'>
    //                 <input name='uid' type='hidden' id='uid' value='" . $uid . "'>
    //                 <button class ='btn-worklist' type='submit' name='button' id='button' value='SEND'>KIRIM</button>
    //             </form>";
    // } else if ($study_iuid_mppsio != null && $study_iuid_pacsio == null) {
    //     $label = "<div class='alert alert-info' role='alert'>SEDANG DIPERIKSA</div>";
    //     $aksi = '&nbsp;';
    // } else if ($study_iuid_mppsio == null && $study_iuid_pacsio != null) {
    //     $label = "<div class='alert alert-success' role='alert'>SELESAI DIPERIKSA</div>";
    //     $aksi = '&nbsp;';
    // } else if ($study_iuid_mppsio != null && $study_iuid_pacsio != null) {
    //     $label = "<div class='alert alert-success' role='alert'>SELESAI DIPERIKSA</div>";
    //     $aksi = "<a style='text-decoration:none;' class='ahref-edit' href='deleteexam.php?study_iuid=$uid&pat_name=$row[name]'>
    //     <span class='btn red lighten-1 btn-intiwid1'>
    //     <i class='fas fa-trash-alt' data-toggle='tooltip' title='Delete WORKLIST'></i>
    //     </span>
    //     </a>";
    // } else {
    //     $label = "-";
    //     $aksi = "-";
    // }

    // tidak menggunakan orderrefresh
    if ($study_iuid_mppsio == null && $study_iuid_pacsio == null && $fromorder == 'SIMRS') {
        $label = "<div class='alert alert-danger' role='alert'>GAGAL DIPERIKSA</div>";
        $aksi = "<a href='http://$server_name:8000/api/create-xml/$uid' class='text-black'>
                    <span class='btn yellow lighten-1 btn-intiwid1'>
                        <i class='fas fa-share' data-toggle='tooltip' title='ReSend'></i>
                    </span>
                </a>";
    } else if ($study_iuid_mppsio == null && $study_iuid_pacsio == null && $fromorder != 'SIMRS') {
        $label = "<div class='alert alert-primary' role='alert'>BARU</div>";
        $aksi = "<a href='http://$server_name:8000/api/create-xml/$uid' class='text-white'>
                    <span class='btn blue lighten-1 btn-intiwid1'>
                        <i class='fas fa-share' data-toggle='tooltip' title='Send'></i>
                    </span>
                </a>";
    } else if ($study_iuid_mppsio != null && $study_iuid_pacsio == null) {
        $label = "<div class='alert alert-info' role='alert'>SEDANG DIPERIKSA</div>";
        $aksi = '&nbsp;';
    } else if ($study_iuid_mppsio == null && $study_iuid_pacsio != null) {
        $label = "<div class='alert alert-success' role='alert'>SELESAI DIPERIKSA</div>";
        $aksi = '&nbsp;';
    } else if ($study_iuid_mppsio != null && $study_iuid_pacsio != null) {
        $label = "<div class='alert alert-success' role='alert'>SELESAI DIPERIKSA</div>";
        $aksi = "<a style='text-decoration:none;' class='ahref-edit' href='deleteexam.php?study_iuid=$uid&pat_name=$row[name]'>
                    <span class='btn red lighten-1 btn-intiwid1'>
                        <i class='fas fa-trash-alt' data-toggle='tooltip' title='Delete Worklist'></i>
                    </span>
                </a>";
    } else {
        $label = "-";
        $aksi = "-";
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

    $data[] = [
        "no" => $i,
        "action" => $aksi . $badge,
        "mrn" => defaultValue($row['mrn']),
        "name" => $detail . '&nbsp;' . $priority_style,
        "acc" => defaultValue($row['acc']),
        "birth_date" => defaultValueDate($row['birth_date']),
        "sex" => $sex_icons,
        "xray_type_code" => defaultValue($row['xray_type_code']),
        "prosedur" => defaultValue($row['prosedur']),
        "create_time" => defaultValueDateTime($row['create_time']),
        "schedule_date" => defaultValueDateTime($row['schedule_date'] . ' ' . $row['schedule_time']),
        "label" => $label,
    ];
    $i++;
}

echo json_encode($data);

mysqli_close($conn);
