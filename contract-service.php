<?php
include 'koneksi/koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM xray_contract order by id DESC");
$row = $query ? mysqli_fetch_assoc($query) : null;
$contract_duedate = $row['contract_duedate'] ?? null;
$id = $row['id'] ?? null;
$no_contract = $row['no_contract'] ?? null;

$exp = -999;
if (!empty($contract_duedate)) {
    $origin = date_create(date('Y-m-d'));
    $target = date_create($contract_duedate);
    if ($target && $origin) {
        $interval = date_diff($target, $origin);
        $exp = $interval->format("%R%a");
    }
}

$exp2 = -999;
$maintenance_date = null;
if (!empty($no_contract)) {
    $query2 = mysqli_query($conn, "SELECT * FROM xray_maintenance WHERE contract_id = '$no_contract' AND status = '0' order by id ASC");
    $row2 = $query2 ? mysqli_fetch_assoc($query2) : null;
    $maintenance_date = $row2['maintenance_date'] ?? null;
    if ($maintenance_date) {
        $origin2 = date_create(date('Y-m-d'));
        $target2 = date_create($maintenance_date);
        if ($target2 && $origin2) {
            $interval2 = date_diff($target2, $origin2);
            $exp2 = $interval2->format("%R%a");
        }
    }
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
