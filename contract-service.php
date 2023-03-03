<?php
include 'koneksi/koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM xray_contract order by id DESC");
$row = mysqli_fetch_assoc($query);
$contract_duedate = $row['contract_duedate'];
$id = $row['id'];
$no_contract = $row['no_contract'];

$origin = date_create(date('Y-m-d'));
$target = date_create($contract_duedate);
$interval = date_diff($target, $origin);
$exp = $interval->format("%R%a");

$query2 = mysqli_query($conn, "SELECT * FROM xray_maintenance WHERE contract_id = '$no_contract' AND status = '0' order by id ASC");
$row2 = mysqli_fetch_assoc($query2);
$maintenance_date = $row2['maintenance_date'];
if ($maintenance_date) {
    $origin2 = date_create(date('Y-m-d'));
    $target2 = date_create($maintenance_date);
    $interval2 = date_diff($target2, $origin2);
    $exp2 = $interval2->format("%R%a");
}

// storage
// jika storage data K ada tampilkan, tetapi jika tidak ada 0; (default storage server K)
$dir = 'k:';
$is_dir = is_dir($dir);
if ($is_dir == true) {
    $diskFree = disk_free_space($dir);
    $diskTotal = disk_total_space($dir);
    $diskUsed = $diskTotal - $diskFree;
} else {
    $diskFree = 0;
    $diskTotal = 0;
    $diskUsed = $diskTotal - $diskFree;
}
