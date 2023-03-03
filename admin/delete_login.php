<?php
require 'function_dokter.php';

session_start();

$id_table = $_GET["id_table"];

if (delete_login($id_table) > 0) {
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
	 window.location.replace('view_login.php');
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
	 window.location.replace('view_login.php');
	} ,1000); 
   </script>";
}
