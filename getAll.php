<?php

require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-dokter-radiology.php';
require 'model/query-base-selected-dokter-radiology.php';
session_start();

$username = $_SESSION['username'];

// kondisi jika mapping dokter diaktifkan
$selected_dokter_radiology = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_selected_dokter_radiology 
    FROM $table_selected_dokter_radiology"
));

// kondisi jika ada di dicom.php
$row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_dokter_radiology 
    FROM $table_dokter_radiology 
    WHERE username = '$username'"
));
$dokradid = $row_dokrad['dokradid'];
$dokrad_fullname = $row_dokrad['dokrad_fullname'];
$http_referer = $_SERVER['HTTP_REFERER'] ?? '';
$explode = explode('/radiology', $http_referer);
$dicom = $explode[1] ?? '';
if ($dicom == '/dicom.php') {
    // (dicom.php) berdasarkan priority CITO, updated_time DESC.
    // kondisi ketika bridging simrs status waiting dan dokradid simrs (xray_order).
    // OR kondisi ketika bridging simrs dokter radiologi is null atau pasien manual (tidak integrasi simrs). 
    $kondisi = "WHERE (xray_workload.status = 'waiting' AND xray_order.dokradid = '$dokradid')
                OR (xray_workload.status = 'waiting' AND xray_order.dokradid IS NULL)
                ORDER BY xray_order.priority IS NULL, xray_order.priority ASC, study.study_datetime DESC 
                LIMIT 3000";
} else {
    // (getAll.php) kondisi
    $kondisi = 'ORDER BY study.study_datetime DESC LIMIT 1000';
}

$query = mysqli_query(
    $conn_pacsio,
    "SELECT 
    pat_id,
    pat_name,
    pat_sex,
    pat_birthdate,
    study_iuid,
    study_datetime,
    study_desc_pacsio,
    mods_in_study,
    study.updated_time,
    status,
    fill,
    approved_at,
    pk_dokter_radiology,
    patientid AS no_foto,
    named,
    dokradid,
    dokrad_name,
    name_dep,
    radiographer_name,
    priority,
    fromorder
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    LEFT JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    $kondisi"
);

$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
    $pat_name = defaultValue($row['pat_name']);
    $pat_sex = styleSex($row['pat_sex']);
    $pat_birthdate = diffDate($row['pat_birthdate']);
    $study_iuid = defaultValue($row['study_iuid']);
    $study_datetime = defaultValueDateTime($row['study_datetime']);
    $study_desc_pacsio = defaultValue($row['study_desc_pacsio']);
    $mods_in_study = defaultValue($row['mods_in_study']);
    $updated_time = defaultValueDateTime($row['updated_time']);
    $pat_id = defaultValue($row['pat_id']);
    $no_foto = defaultValue($row['no_foto']);
    $name_dep = defaultValue($row['name_dep']);
    $named = defaultValue($row['named']);
    $radiographer_name = defaultValue($row['radiographer_name']);
    $dokrad_name = defaultValue($row['dokrad_name']);
    $dokradid = $row['dokradid'];
    $priority = defaultValue($row['priority']);
    $fromorder = $row['fromorder'];
    $status = styleStatus($row['status'], $study_iuid);
    $fill = $row['fill'];
    $approved_at = defaultValueDateTime($row['approved_at']);
    $spendtime = spendTime($study_datetime, $approved_at, $row['status']);
    $pk_dokter_radiology = $row['pk_dokter_radiology'];
    //kondisi status change doctor
    if ($row['status'] == 'approved') {
        $workload_status = 'approved';
    } else {
        $workload_status = 'waiting';
    }

    // kondisi ketika detail nama lihat detail HOME (radiographer, radiology, referral)
    $detail = '<a href="#" class="hasil-all penawaran-a" data-id="' . $row['study_iuid'] . '">' . removeCharacter($pat_name) . '</a>';

    if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
        $badge = SIMRS;
    } else {
        $badge = '';
    }

    // kondisi ketika dokter belum ada menggunakan icon berbeda
    if ($pk_dokter_radiology == null && $dokradid == null) {
        $icon_change_doctor = CHANGEDOCTORICONNO;
    } else {
        $icon_change_doctor = CHANGEDOCTORICONYES;
    }

    // kondisi aksi jika ada dihalaman dicom.php
    if ($dicom == '/dicom.php') {
        // kondisi ketika xray_workload masuk dari trigger
        if ($status != '-') {
            // kondisi pk_dokter_radiologi null dan dokradid null dan ketika aktif bernilai 1 mapping dokter
            if ($pk_dokter_radiology == null && $dokradid == null && $selected_dokter_radiology['is_active'] == 1) {
                $aksi = '?';
                $detail = '<a href="dicom.php" onclick="validationDokter(event,' . "'$dokrad_fullname'" . ')" class="penawaran-a">' . removeCharacter($pat_name) . '</a>';
            } else {
                // kondisi ketika pasien manual tetapi pk_dokter_radiologi sudah ada 
                if (!$fill || $fill == null) {
                    // ketika fill kosong muncul worklist
                    $worklist = WORKLISTFIRST . $study_iuid . WORKLISTLAST;
                } else {
                    // ketika worklist sudah dibaca muncul draft
                    $worklist = DRAFTFIRST . $study_iuid . DRAFTLAST;
                }

                // kondisi ketika sudah dipilih dokternya 
                $detail = '<a href="worklist.php?uid=' . $study_iuid . '" class="penawaran-a">' . removeCharacter($pat_name) . '</a>';

                $aksi = $worklist .
                    CHANGEDOCTORFIRST . "'$study_iuid', '$dokradid', '$workload_status'" . CHANGEDOCTORLAST . $icon_change_doctor . CHANGEDOCTORVERYLAST;
            }
        } else {
            // kondisi ketika xray_workload TIDAK masuk dari trigger
            $aksi = '!TRIGGER!';
            $detail = '<a href="dicom.php" class="penawaran-a">' . removeCharacter($pat_name) . '</a>';
        }
    } else {
        $pdf = PDFFIRST . $study_iuid . PDFLAST;
        // ketika modality MRI
        if ($mods_in_study == 'MR' || $mods_in_study == 'PR\\MR' || $mods_in_study == 'SC\\PR\\MR') {
            $aksi = $pdf /*. RENDERFIRST . $study_iuid . RENDERLAST*/ . DICOMFIRST . $study_iuid . DICOMLAST;
        } else {
            $aksi = $pdf .
                #RENDERFIRST . $study_iuid . RENDERLAST .
                OHIFOLDFIRST . $study_iuid . OHIFOLDLAST .
                HTMLFIRST . $study_iuid . HTMLLAST;
        }
    }

    // kondisi jika prioriry normal dan CITO
    if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
        $priority_style = PRIORITYNORMAL;
    } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
        $priority_style = PRIORITYCITO;
    } else {
        $priority_style = '';
    }

    // kondisi mencari ditabel dokter radiology
    $row_dokrad = mysqli_fetch_assoc(mysqli_query(
        $conn,
        "SELECT CONCAT(xray_dokter_radiology.dokrad_name,' ',xray_dokter_radiology.dokrad_lastname) AS dokrad_fullname
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

    $data[] = [
        "no" => $i,
        "pat_name" => $detail . '&nbsp;' . $priority_style,
        "status" => $status . '&nbsp;' . $badge,
        "report" => $aksi,
        "mrn" => $pat_id,
        "no_foto" => $no_foto,
        "pat_birthdate" => $pat_birthdate,
        "pat_sex" => $pat_sex,
        "study_desc" => $study_desc_pacsio,
        "series_desc" => READMORESERIESFIRST . $study_iuid . READMORESERIESLAST,
        "mods_in_study" => $mods_in_study,
        "named" => $named,
        "name_dep" => $name_dep,
        "dokrad_name" => $dokrad_name,
        "radiographer_name" => $radiographer_name,
        "study_datetime" => $study_datetime,
        "approve_date" => $approved_at,
        "spendtime" => $spendtime
    ];
    $i++;
}

echo json_encode($data);

mysqli_close($conn);
