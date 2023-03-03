<?php
require 'function_dokter.php';

session_start();

$id = $_GET["id"];

if (delete_dokter($id) > 0) {
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
	window.location.replace('view_dokter.php');
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
	window.location.replace('view_dokter.php');
	} ,1000); 
	</script>";
}
