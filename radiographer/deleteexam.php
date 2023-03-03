<?php

require '../koneksi/koneksi.php';

$study_iuid = $_GET["study_iuid"];
$pat_name = $_GET["pat_name"];

$query = mysqli_query(
	$conn_mppsio,
	"DELETE	FROM mwl_item
	WHERE mwl_item.study_iuid = '$study_iuid'"
);

if (!$query) {
	echo "<script>
            alert('Error, status on delete restrict. harap Kontak IT');
            document.location.href= 'exam2.php';
	    </script>";
} else {
	echo "<script>
			alert('$pat_name berhasil dihapus!');
			document.location.href= 'exam2.php';
		</script>";
}

mysqli_close($conn);
