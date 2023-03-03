<?php
require '../koneksi/koneksi.php';

session_start();
$username = $_SESSION['username'];
$otpp = mt_rand(100000, 999999);

$query = "UPDATE xray_dokter_radiology SET 
otp = '$otpp'
WHERE username = '$username'
";

$result = mysqli_query($conn, $query);

// -------------------------------xray_workload-----------------------------------


$query3 = "SELECT * FROM xray_dokter_radiology WHERE username = '$username' ";

$result3 = mysqli_query($conn, $query3);

$row3 = mysqli_fetch_assoc($result3);

$nama = $row3['dokrad_name'] . ' ' . $row3['dokrad_lastname'];

$idtele = $row3['idtele'];

// $otp = $row3['email'];

// $link = "http://intimedik.com:8089/intimedika/portal/portal-sales?p=penawaran&act=index";
$token = "5414794545:AAGl8kEfUPyF-32OG3niUvWpRcJ5SSyrZ8c"; // token bot

$data = [
    'text' => "Halo " . $nama . ", Kode OTP ini bersifat rahasia, jangan diberikan kepada siapapun, Kode OTP Anda adalah " . $otpp,
    'chat_id' => $idtele  //contoh bot, group id -442697126
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));

echo "<script>window.close('OTP SUDAH TERKIRIM');</script>";
