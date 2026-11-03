<?php
// Store the file name into variable
require 'function_radiology.php';
$contract_query = mysqli_query($conn, 'SELECT * FROM xray_contract ORDER BY id DESC');
$row_query = $contract_query ? mysqli_fetch_assoc($contract_query) : null;
$id = $row_query['id'] ?? '';
$pdf_query = !empty($id) ? mysqli_query($conn, "SELECT * FROM xray_upload_pdf WHERE contract_id = '$id'") : false;
$row_pdf = $pdf_query ? mysqli_fetch_assoc($pdf_query) : null;
$nama_pdf = $row_pdf['nama_file'] ?? '';
if ($nama_pdf) {
    $file = $nama_pdf . '.pdf';
    $host = $_SERVER['SERVER_NAME'];
    $filepath = "http://$host/intiwid/contract/pdf/" . $file;
    // Header content type
    header("Content-type: application/pdf");
    header("Location: $filepath");
  exit();
    // Send the file to the browser.
    readfile($filepath);
} else {
    $host = $_SERVER['SERVER_NAME'];
    header("Location: http://$host/intiwid/radiology/index.php");
  exit();
}
