<?php

require '../koneksi/koneksi.php';

$from = date('Y-m-d H:i', strtotime($_POST["from"]));
$to = date('Y-m-d H:i', strtotime($_POST["to"]));

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
    		alert('dari $_POST[from] sampai $_POST[to] berhasil dihapus');
    		document.location.href= 'exam2.php';
    	</script>";
}

mysqli_close($conn);
