<?php
require '../koneksi/koneksi.php';
require '../viewer-all.php';
require '../default-value.php';
require '../model/query-base-workload.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
require '../model/query-base-dokter-radiology.php';
require '../model/query-base-dokter-refferal.php';

session_start();
$username = $_SESSION['username'];
$uid = $_GET['uid'];

$query_base = "SELECT 
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
            ";
$kondisi = "WHERE study.study_iuid = '$uid'";
$result = mysqli_query($conn_pacsio, $query_base . $kondisi);
$row = mysqli_fetch_array($result);
$dokterid = $row['dokterid'];
if ($dokterid) {
    $query_refferal = "SELECT $select_dokter_refferal FROM $table_dokter_refferal WHERE dokterid = '$dokterid'";
    $result3 = mysqli_query($conn, $query_refferal);
    $row3 = mysqli_fetch_assoc($result3);
    $dokter_fullname = $row3['dokter_fullname'];
    if ($row3['idtele']) {
        $token = "5414794545:AAGl8kEfUPyF-32OG3niUvWpRcJ5SSyrZ8c"; // token bot
        $pat_name = defaultValue($row['pat_name']);
        $pat_name = removeCharacter($pat_name);
        $pat_id = defaultValue($row['pat_id']);
        $study_desc = defaultValue($row['study_desc']);
        $ip = $_SERVER['SERVER_NAME'];
        $data = [
            'text' => "Halo " . $dokter_fullname . ", Pasien Anda :
Nama                       : $pat_name
MRN                         : $pat_id
Jenis Pemeriksaan : $study_desc
            Sudah Selesai, berikut hasil pemeriksaannya:
1. Link Expertise : http://$ip:8089/intiwid2022/radiology/pdf/expertise.php?uid=" . $uid . "
2. Link Foto : http://$ip:91/viewer/" . $uid,
            'chat_id' => $row3['idtele']  //contoh bot, group id -442697126
        ];
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
        echo "<script>
        alert('Notification Delivered');
        window.close();
        </script>";
    } else {
        echo "<script>
        alert('ID Telegram Dokter Pengirim Belum di daftarkan / Dokter Pengirim Belum Terdaftar');
        window.close();
        </script>";
    }
} else {
    echo "
    <script>
  alert('Dokter Pengirim Kosong / Belum di isi');
  window.close();
  </script>";
}
