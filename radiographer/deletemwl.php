<?php 
require 'function_radiographer.php';

session_start();

$study_iuid = $_GET["study_iuid"];

if ( hapus_mwl($study_iuid) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'modality-worklist.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'modality-worklist.php';
			</script>";
}

 ?>
