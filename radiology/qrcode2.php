<?php
include "phpqrcode/qrlib.php";
require "../koneksi/koneksi.php";
require '../viewer-all.php';
require '../default-value.php';
require '../model/query-base-workload.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
require '../model/query-base-dokter-radiology.php';
$uid = $_GET['uid'];
$kondisi = "WHERE uid = '$uid'";
$query = mysqli_query(
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
    WHERE study.study_iuid = '$uid'"
);
$row = mysqli_fetch_assoc($query);
$dokradid = defaultValue($row['dokradid']);
$pk_dokter_radiology = defaultValue($row['pk_dokter_radiology']);
// $query = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid'";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);
// $name = $row['name'];
// $acc = $row['acc'];
// $dokradid = $row['dokradid'];
// // $query2 = "SELECT * FROM xray_dokter_ WHERE uid = '$uid'";
// // $result2 = mysqli_query($conn, $query2);
// // $row2 = mysqli_fetch_assoc($result2);
// $dokrad_name = $row['dokrad_name'];
// $dokrad_lastname = $row['dokrad_lastname'];
// $series_desc = $row['series_desc'];
// $study_datetime = $row['study_datetime'];
// $signature_datetime = $row['signature_datetime'];
// $prosedur = $row['prosedur'];
// $signature_datetime2 = date("d-M-Y H:i", strtotime($signature_datetime));
$viewer =  OHIFMOBILEFIRST . $uid . OHIFMOBILELAST;
//DATA PASIEN//
// QRcode::png("Nama Patient: $name
// ID : $acc
// Pemeriksaan : $prosedur $series_desc
// Jam Pemeriksaan : $study_datetime
// Approved By $dokrad_name $dokrad_lastname
// Approve Sign in $signature_datetime2", "phpqrcode/ttddokter/$uid.png", "L", 4, 4);
// echo "<img src='phpqrcode/ttddokter/$uid.png' />";
//DATA PASIEN//
//LINK GAMBAR//
QRcode::png("$viewer", "phpqrcode/ttddokter/$uid.png", "L", 4, 4);
// echo "<img src='phpqrcode/ttddokter/$uid.png' />";
//LINK GAMBAR//
$query2 = "UPDATE xray_dokter_radiology SET
				otp = NULL
				WHERE pk = '$pk_dokter_radiology'
				";
mysqli_query($conn, $query2);
header('refresh:1;//' . $_SERVER['SERVER_NAME'] . '/intiwid-native-base/radiology/workload.php');
