<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'function_radiographer.php';

$uid = $_GET["uid"] ?? '';
$username = $_SESSION['username'] ?? '';

if ( hapus_workload($uid, $username) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'workload.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'workload.php';
			</script>";
}

 ?>
