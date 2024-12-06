<?php
session_start();
require 'koneksi/koneksi.php';
require 'model/query-base-workload.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'default-value.php';

$uid = $_GET['uid'];

$stmt = mysqli_prepare($conn, "SELECT 
                                    pat_name,
                                    pat_birthdate,
                                    study_desc,
                                    study_iuid,
                                    fill
                                    FROM $table_patient
                                    JOIN $table_study
                                    ON patient.pk = study.patient_fk
                                    JOIN $table_workload
                                    ON study.study_iuid = xray_workload.uid
                                    WHERE study_iuid = ?
                                    AND approved_at > DATE_SUB(NOW(), INTERVAL 92 DAY)");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$study_count = mysqli_num_rows($result);
$study = mysqli_fetch_assoc($result);
$hostname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM xray_hostname_publik"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil untuk pasien</title>
</head>

<body>
    <div class="container">
        <?php if ($study_count > 0) { ?>
            <table class="table">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= removeCharacter(defaultValue($study['pat_name'])); ?></td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td>:</td>
                    <td><?= defaultValueDate($study['pat_birthdate']); ?></td>
                </tr>
                <tr>
                    <td>Pemeriksaan</td>
                    <td>:</td>
                    <td><?= defaultValue($study['study_desc']); ?></td>
                </tr>
                <tr>
                    <td>Hasil</td>
                    <td>:</td>
                    <td><?= defaultValue($study['fill']); ?></td>
                </tr>
            </table>
            <hr>
            <iframe src="http://<?= $_SERVER['SERVER_NAME'] . ':' ?><?= $_SERVER['SERVER_NAME'] == $hostname['ip_publik'] ? '92' : '91'; ?>/viewer/<?= $study['study_iuid']; ?>" width="100%" height="700px" frameborder="0"></iframe>
            <!-- <iframe src="http://202.150.157.78:92/viewer/1.2.40.0.13.1.286424.20230127.09161597301" width="100%" height="700px" frameborder="0"></iframe> -->
        <?php } else { ?>
            <p class="text-center">Pasien Tidak Ditemukan</p>
        <?php } ?>
    </div>
</body>

</html>