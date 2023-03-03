<?php
require 'koneksi/koneksi.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-workload-bhp.php';
require 'date-time-zone.php';

session_start();

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=DataPatient.xls");

header('Cache-Control: max-age=0');

// post dari form
$fromUpdatedTime = $_POST['from_workload'];
$fromUpdatedTime = $fromUpdatedTime != null ? date("Y-m-d H:i", strtotime($fromUpdatedTime)) : null;
$toUpdatedTime = $_POST['to_workload'];
$toUpdatedTime = $toUpdatedTime != null ? date("Y-m-d H:i", strtotime($toUpdatedTime)) : null;
$modsInStudy = implode("','", $_POST['mods_in_study']);
$modsInStudy = str_replace('\\', '\\\\', $modsInStudy);
$priorityDoctor = implode("','", $_POST['priority_doctor']);
$radiographerId = implode("','", $_POST['radiographer']);
$depId = implode("','", $_POST['dep_id']);
$dokradId = implode("','", $_POST['dokradid']);
$statusOne = implode("','", $_POST['status']);

// dokter radiologi
$dokterRadiologyAll = [];
$query_dokter_radiology = mysqli_query(
    $conn,
    "SELECT dokrad_name, dokrad_lastname FROM xray_dokter_radiology WHERE dokradid IN('$dokradId')"
);
while ($dokterRadiology = mysqli_fetch_assoc($query_dokter_radiology)) {
    $dokterRadiologyAll[] = $dokterRadiology['dokrad_name'] . ' ' . $dokterRadiology['dokrad_lastname'];
    $dokradFullName = str_replace("'", "", implode("'<br />'", $dokterRadiologyAll));
}

// radiografer
$radiographerIdArray = [];
$radiographerNameArray = [];
$query_radiographer = "SELECT radiographer_name, radiographer_id FROM xray_radiographer";
// jika radiografer dipilih all maka query semua radiographer id
if ($radiographerId == 'all') {
    $radiographer_query = mysqli_query($conn, $query_radiographer);
    while ($radiographer = mysqli_fetch_assoc($radiographer_query)) {
        $radiographerIdArray[] = $radiographer['radiographer_id'];
        $radiographerNameArray[] = $radiographer['radiographer_name'];
    }
    $radiographerId = implode("','", $radiographerIdArray);
    $radiographerName = implode("','", $radiographerNameArray);
    // else jika dipilih query masing2 radiografer
} else {
    $radiographer_query = mysqli_query($conn, $query_radiographer . " WHERE radiographer_id IN('$radiographerId')");
    while ($radiographer = mysqli_fetch_assoc($radiographer_query)) {
        $radiographerIdArray[] = $radiographer['radiographer_id'];
        $radiographerNameArray[] = $radiographer['radiographer_name'];
    }
    $radiographerId = implode("','", $radiographerIdArray);
    $radiographerName = implode("','", $radiographerNameArray);
}

// department
$depIdArray = [];
$nameDepArray = [];
$query_department = "SELECT name_dep, dep_id FROM xray_department";
// jika department dipilih all maka query semua department id
if ($depId == 'all') {
    $department_query = mysqli_query($conn, $query_department);
    while ($department = mysqli_fetch_assoc($department_query)) {
        $depIdArray[] = $department['dep_id'];
        $nameDepArray[] = $department['name_dep'];
    }
    $depId = implode("','", $depIdArray);
    $nameDep = implode("','", $nameDepArray);
    // else jika dipilih query masing2 department
} else {
    $department_query = mysqli_query($conn, $query_department . " WHERE dep_id IN('$depId')");
    while ($department = mysqli_fetch_assoc($department_query)) {
        $depIdArray[] = $department['dep_id'];
        $nameDepArray[] = $department['name_dep'];
    }
    $depId = implode("','", $depIdArray);
    $nameDep = implode("','", $nameDepArray);
}

// kondisi form
$kondisi = "study.study_datetime BETWEEN '$fromUpdatedTime' AND '$toUpdatedTime'
            AND mods_in_study IN('$modsInStudy')
            AND priority_doctor IN('$priorityDoctor')
            AND radiographer_id IN('$radiographerId')
            AND dep_id IN('$depId')
            AND dokradid IN('$dokradId')
            AND status IN('$statusOne')
            ";

// menampilkan detail pasien
$patient = mysqli_query($conn_pacsio, "SELECT 
            pat_name,
            pat_birthdate,
            pat_sex,
            pat_id,
            patientid AS no_foto,
            dokrad_name,
            radiographer_name,
            name_dep,
            payment,
            create_time,
            mods_in_study,
            study_desc_pacsio,
            contrast,
            contrast_allergies,
            study.updated_time,
            study.study_datetime,
            study_datetime,
            examed_at,
            film_small,
            film_medium,
            film_large,
            film_reject_small,
            film_reject_medium,
            film_reject_large,
            harga_prosedur,
            kv,
            mas,
            priority,
            priority_doctor,
            status,
            approved_at
            FROM $table_patient
            JOIN $table_study
            ON patient.pk = study.patient_fk
            JOIN $table_workload
            ON study.study_iuid = xray_workload.uid
            JOIN $table_order
            ON xray_order.uid = xray_workload.uid
            JOIN $table_workload_bhp
            ON xray_workload.uid = xray_workload_bhp.uid
            WHERE $kondisi
            ORDER BY study.study_datetime DESC");

// menampilkan jumlah film dan tarif pemeriksaan
$sum = mysqli_fetch_array(mysqli_query(
    $conn_pacsio,
    "SELECT 
    SUM(contrast_allergies) AS contrast_allergies,
    SUM(contrast) AS contrast,
    SUM(harga_prosedur) AS harga_prosedur,
    SUM(film_reject_small) AS film_reject_small, 
    SUM(film_reject_medium) AS film_reject_medium, 
    SUM(film_reject_large) AS film_reject_large,
    SUM(film_small) AS film_small,
    SUM(film_medium) AS film_medium, 
    SUM(film_large) AS film_large
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    JOIN $table_workload_bhp
    ON xray_workload.uid = xray_workload_bhp.uid
    WHERE $kondisi"
));

// menampilkan pemeriksaan
$studies = mysqli_query(
    $conn_pacsio,
    "SELECT 
    UPPER(study_desc_pacsio) AS study_desc_pacsio,
    COUNT(*) AS jumlah
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    JOIN $table_workload_bhp
    ON xray_workload.uid = xray_workload_bhp.uid
    WHERE $kondisi
    GROUP BY UPPER(study_desc_pacsio)
    ORDER BY study_desc_pacsio ASC"
);

// menampilkan total pemeriksaan
$countStudies = mysqli_fetch_array(mysqli_query(
    $conn_pacsio,
    "SELECT 
    COUNT(study_desc_pacsio) AS count_studies
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    JOIN $table_workload_bhp
    ON xray_workload.uid = xray_workload_bhp.uid
    WHERE $kondisi"
));

// menampilkan statistik bacaan dokter
$totalApproved = mysqli_fetch_array(mysqli_query(
    $conn_pacsio,
    "SELECT 
    COUNT(approved_at) AS count_approved_at
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    JOIN $table_workload_bhp
    ON xray_workload.uid = xray_workload_bhp.uid
    WHERE $kondisi
    AND status = 'approved'"
));

$totalStatus = mysqli_fetch_array(mysqli_query(
    $conn_pacsio,
    "SELECT 
    COUNT(status) AS count_status
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    JOIN $table_workload_bhp
    ON xray_workload.uid = xray_workload_bhp.uid
    WHERE $kondisi"
));

$approved = mysqli_fetch_array(mysqli_query(
    $conn_pacsio,
    "SELECT 
    SUM((SELECT TIMESTAMPDIFF(MINUTE, study.study_datetime, CONCAT(approved_at)) <= 180)) AS less_than_three_hour,
    SUM((SELECT TIMESTAMPDIFF(MINUTE, study.study_datetime, CONCAT(approved_at)) > 180)) AS greater_than_three_hour,
    (SUM((SELECT TIMESTAMPDIFF(MINUTE, study.study_datetime, CONCAT(approved_at)) <= 180)) /
        ($totalApproved[count_approved_at])
    ) * 100 AS persentase_less_than_three_hour,
    (SUM((SELECT TIMESTAMPDIFF(MINUTE, study.study_datetime, CONCAT(approved_at)) > 180)) /
        ($totalApproved[count_approved_at])
    ) * 100 AS persentase_greater_than_three_hour
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    JOIN $table_workload_bhp
    ON xray_workload.uid = xray_workload_bhp.uid
    WHERE $kondisi
    AND status = 'approved'"
));

$statuses = mysqli_query(
    $conn_pacsio,
    "SELECT 
    status, 
    COUNT(status) AS jumlah,
    COUNT(status) /
    ($totalStatus[count_status]) * 100 AS persentase
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    JOIN $table_workload_bhp
    ON xray_workload.uid = xray_workload_bhp.uid
    WHERE $kondisi
    GROUP BY status"
);

$sum_waiting = 0;
$sum_approved = 0;
$persentase_waiting = 0;
$persentase_approved = 0;
while ($status = mysqli_fetch_array($statuses)) {
    if ($status[0] == 'approved') {
        $sum_approved = $status['jumlah'];
        $persentase_approved = $status['persentase'];
    } else if ($status[0] == 'waiting') {
        $sum_waiting = $status['jumlah'];
        $persentase_waiting = $status['persentase'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel</title>
</head>

<body>
    <!-- detail penarikan -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead border="1" cellpadding="8" cellspacing="0">
            <tr>
                <td align="center">Tgl Periode: </td>
                <td align="center"><?= date('d-m-Y H:i', strtotime($fromUpdatedTime)); ?> - <?= date('d-m-Y H:i', strtotime($toUpdatedTime)); ?></td>
            </tr>
            <tr>
                <td align="center">Modality : </td>
                <td align="center"><?= str_replace("'", "", $modsInStudy); ?></td>
            </tr>
            <tr>
                <td align="center">Prioritas Pasien : </td>
                <td align="center"><?= str_replace("'", "", $priorityDoctor); ?></td>
            </tr>
            <!-- <tr>
                <td align="center">Radiografer : </td>
                <td align="center"><?= str_replace("'", "", $radiographerName); ?></td>
            </tr> -->
            <!-- <tr>
                <td align="center">Departemen : </td>
                <td align="center"><?= str_replace("'", "", $nameDep); ?></td>
            </tr> -->
            <tr>
                <td align="center">Dokter Radiologi : </td>
                <td align="center"><?= str_replace("'", "", $dokradFullName); ?></td>
            </tr>
            <tr>
                <td align="center">Status : </td>
                <td align="center"><?= str_replace("'", "", $statusOne); ?></td>
            </tr>
            <tr>
                <td align="center">Tgl Penarikan : </td>
                <td align="center"><?= date('d-m-Y H:i'); ?></td>
            </tr>
        </thead>
    </table>
    <br>
    <!-- menampilkan statistik bacaan dokter -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th colspan="6">Waktu Tunggu</th>
            </tr>
            <tr>
                <th colspan="3">Approved</th>
                <th colspan="3">Waiting</th>
            </tr>
            <tr>
                <th>Status</th>
                <th>Study</th>
                <th>Persentase</th>
                <th colspan="3">Study</th>
            </tr>
            <tr>
                <td align="center">Kurang 3 Jam</td>
                <td align="center"><?= $approved['less_than_three_hour'] ?? 0; ?></td>
                <td align="center"><?= round($approved['persentase_less_than_three_hour'], 2); ?>%</td>
                <td align="center" colspan="3" rowspan="2"><?= $sum_waiting ?></td>
            </tr>
            <tr>
                <td align="center">Lebih 3 Jam</td>
                <td align="center"><?= $approved['greater_than_three_hour'] ?? 0; ?></td>
                <td align="center"><?= round($approved['persentase_greater_than_three_hour'], 2); ?>%</td>
            </tr>
            <tr>
                <td align="center">Total Study</td>
                <td align="center" colspan="1"><?= $sum_approved ?></td>
                <td align="center" rowspan="2"></td>
                <td align="center" colspan="3"><?= $sum_waiting ?></td>
            </tr>
            <tr>
                <td align="center">Total Persentase</td>
                <td align="center" colspan="1"><?= round($persentase_approved, 2) ?>%</td>
                <td align="center" colspan="3"><?= round($persentase_waiting, 2) ?>%</td>
            </tr>
        </thead>
    </table>
    <br>
    <!-- menampilkan pemeriksaan -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemeriksaan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($study = mysqli_fetch_array($studies)) { ?>
                <tr>
                    <td align="center"><?= $no ?></td>
                    <td align="center"><?= $study['study_desc_pacsio']; ?></td>
                    <td align="center"><?= $study['jumlah']; ?></td>
                </tr>
            <?php
                $no++;
            } ?>
            <tr>
                <td align="center"></td>
                <td align="center">Total Pemeriksaan</td>
                <td align="center"><?= $countStudies['count_studies'] ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <!-- menampilkan detail pasien -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Nama Pasien</th>
                <th rowspan="3">Jenis <br /> Kelamin</th>
                <th rowspan="3">No Foto</th>
                <th rowspan="3">No Rekam <br /> Medis</th>
                <th rowspan="3">Nama <br /> Radiografer</th>
                <th rowspan="3">Tanggal <br /> Lahir</th>
                <th rowspan="3">Umur</th>
                <th rowspan="3">Ruangan</th>
                <th rowspan="3">Dokter Radiologi</th>
                <th rowspan="3">Modality</th>
                <th rowspan="3">Pemeriksaan</th>
                <th rowspan="3">Tarif <br /> Pemeriksaan</th>
                <th colspan="6">Film</th>
                <th colspan="4" rowspan="2">Exposed</th>
                <th rowspan="3">Prioritas <br /> (SIMRS)</th>
                <th rowspan="3">Prioritas <br /> (Dokter)</th>
                <th rowspan="3">Kontras</th>
                <th rowspan="3">Alergi Kontras</th>
                <th rowspan="3">Pembayaran</th>
                <th rowspan="3">Waktu Pendaftaran <br /> Pasien</th>
                <th rowspan="3">Waktu Mulai <br /> Pemeriksaan</th>
                <th rowspan="3">Waktu Selesai <br /> Pemeriksaan</th>
                <th rowspan="3">Waktu Baca <br /> Pasien</th>
                <th rowspan="3">Menghabiskan <br /> Waktu</th>
                <th rowspan="3">Status Baca</th>
            </tr>
            <tr>
                <th colspan="3">Digunakan</th>
                <th colspan="3">Gagal</th>
            </tr>
            <tr>
                <th>Small</th>
                <th>Medium</th>
                <th>Large</th>
                <th>Small</th>
                <th>Medium</th>
                <th>Large</th>
                <th colspan="2">KV</th>
                <th colspan="2">MAS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($patient)) {
                $pat_name = strtoupper(defaultValue($row['pat_name']));
                $pat_sex = strtoupper(defaultValue($row['pat_sex']));
                $pat_birthdate = defaultValueDate($row['pat_birthdate']);
                $age = strtoupper(diffDate($row['pat_birthdate']));
                $examed_at = strtoupper(defaultValueDateTime($row['examed_at']));
                $study_datetime = strtoupper(defaultValueDateTime($row['study_datetime']));
                $study_desc_pacsio = strtoupper(defaultValue($row['study_desc_pacsio']));
                $harga_prosedur = strtoupper(defaultValue($row['harga_prosedur']));
                $mods_in_study = strtoupper(defaultValue($row['mods_in_study']));
                $updated_time = strtoupper(defaultValueDateTime($row['updated_time']));
                $pat_id = strtoupper(defaultValue($row['pat_id']));
                $no_foto = strtoupper(defaultValue($row['no_foto']));
                $name_dep = strtoupper(defaultValue($row['name_dep']));
                $dokrad_name = strtoupper(defaultValue($row['dokrad_name']));
                $radiographer_name = strtoupper(defaultValue($row['radiographer_name']));
                $create_time = defaultValueDateTime($row['create_time']);
                $priority_doctor = strtoupper(defaultValue($row['priority_doctor']));
                $priority = strtoupper(defaultValue($row['priority']));
                $payment = strtoupper(defaultValue($row['payment']));
                $contrast = strtoupper(defaultValue($row['contrast']));
                $contrast_allergies = strtoupper(defaultValue($row['contrast_allergies']));
                $status = strtoupper(defaultValue($row['status']));
                $film_small = strtoupper(defaultValue($row['film_small']));
                $film_medium = strtoupper(defaultValue($row['film_medium']));
                $film_large = strtoupper(defaultValue($row['film_large']));
                $film_reject_small = strtoupper(defaultValue($row['film_reject_small']));
                $film_reject_medium = strtoupper(defaultValue($row['film_reject_medium']));
                $film_reject_large = strtoupper(defaultValue($row['film_reject_large']));
                $kv = strtoupper(defaultValue($row['kv']));
                $mas = strtoupper(defaultValue($row['mas']));
                $approved_at = defaultValueDateTime($row['approved_at']);
                $spendtime = spendTime($study_datetime, $approved_at, $row['status']);
            ?>
                <tr>
                    <td align="center"><?= $no; ?></td>
                    <td align="center"><?= removeCharacter($pat_name); ?></td>
                    <td align="center"><?= $pat_sex; ?></td>
                    <td align="center"><?= $no_foto; ?></td>
                    <td align="center"><?= $pat_id; ?></td>
                    <td align="center"><?= $radiographer_name; ?></td>
                    <td align="center"><?= $pat_birthdate; ?></td>
                    <td align="center"><?= $age; ?></td>
                    <td align="center"><?= $name_dep; ?></td>
                    <td align="center"><?= $dokrad_name; ?></td>
                    <td align="center"><?= $mods_in_study; ?></td>
                    <td align="center"><?= $study_desc_pacsio; ?></td>
                    <td align="center"><?= $harga_prosedur; ?></td>
                    <td align="center"><?= $film_small; ?></td>
                    <td align="center"> <?= $film_medium; ?> </td>
                    <td align="center"><?= $film_large; ?></td>
                    <td align="center"><?= $film_reject_small; ?></td>
                    <td align="center"> <?= $film_reject_medium; ?> </td>
                    <td align="center"><?= $film_reject_large; ?></td>
                    <td align="center" colspan="2"><?= $kv; ?></td>
                    <td align="center" colspan="2"><?= $mas; ?></td>
                    <td align="center"><?= $priority; ?></td>
                    <td align="center"><?= $priority_doctor; ?></td>
                    <td align="center"><?= $contrast; ?></td>
                    <td align="center"><?= $contrast_allergies; ?></td>
                    <td align="center"><?= $payment; ?></td>
                    <td align="center"><?= $create_time; ?></td>
                    <td align="center"><?= $examed_at; ?></td>
                    <td align="center"><?= $study_datetime; ?></td>
                    <td align="center"><?= $approved_at; ?></td>
                    <td align="center"><?= $spendtime; ?></td>
                    <td align="center"><?= $status; ?></td>
                </tr>
            <?php
                $no++;
            } ?>
            <tr>
                <td align="center" colspan="12">Jumlah</td>
                <td align="center"><?= $sum['harga_prosedur']; ?></td>
                <td align="center"><?= $sum['film_small']; ?></td>
                <td align="center"><?= $sum['film_medium']; ?></td>
                <td align="center"><?= $sum['film_large']; ?></td>
                <td align="center"><?= $sum['film_reject_small']; ?></td>
                <td align="center"><?= $sum['film_reject_medium']; ?></td>
                <td align="center"><?= $sum['film_reject_large']; ?></td>
                <td align="center" colspan="6"></td>
                <td align="center"><?= $sum['contrast']; ?></td>
                <td align="center"><?= $sum['contrast_allergies']; ?></td>
            </tr>
        </tbody>
    </table>

</body>

</html>

<?php

mysqli_close($conn);
