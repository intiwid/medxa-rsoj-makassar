<?php

require '../koneksi/koneksi.php';

$from_raw = $_POST["from"] ?? $_GET["from"] ?? date("d-m-Y 00:00");
$from = date('Y-m-d H:i', strtotime($from_raw));
$to_raw = $_POST["to"] ?? $_GET["to"] ?? date("d-m-Y 23:59");
$to = date('Y-m-d H:i', strtotime($to_raw));

$query = mysqli_query(
	$conn_mppsio,
	"DELETE FROM mwl_item
	WHERE mwl_item.created_time BETWEEN '$from' AND '$to'"
);

if (!$query) {
	echo "<script>
            alert('Error, status on delete restrict. harap Kontak IT');
            document.location.href= 'exam2.php';
	    </script>";
} else {
	echo "<script>
    		alert('dari {$from_raw} sampai {$to_raw} berhasil dihapus');
    		document.location.href= 'exam2.php';
    	</script>";
}

// // mysqli_close($conn);
