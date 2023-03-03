<?php
require 'function_dokter.php';

session_start();

$pk = $_GET["pk"];
$id_table = $_GET["id_table"];

if (delete_dokter_radiology($pk, $id_table) > 0) {
	echo "<script type='text/javascript'>
	setTimeout(function () { 
	swal({
			title: 'Berhasil Dihapus!',
			text:  '',
			icon: 'success',
			timer: 1000,
			showConfirmButton: true
		});  
	},10); 
	window.setTimeout(function(){ 
	window.location.replace('view_dokter_radiology.php');
	} ,1000); 
</script>";
} else {
	echo "<script type='text/javascript'>
	setTimeout(function () { 
	swal({
			title: 'Gagal Dihapus!',
			text:  '',
			icon: 'error',
			timer: 1000,
			showConfirmButton: true
		});  
	},10); 
	window.setTimeout(function(){ 
	window.location.replace('view_dokter_radiology.php');
	} ,1000); 
</script>";
}
