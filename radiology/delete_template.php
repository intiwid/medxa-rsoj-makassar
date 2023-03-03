<script type="text/javascript" src="../js/sweetalert.min.js" />
</script>
<?php
require 'function_radiology.php';

session_start();

$template_id = $_GET["template_id"];

if (delete_template($template_id) > 0) {
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
	window.location.replace('view_template.php');
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
	window.location.replace('view_template.php');
	} ,1000); 
</script>";
}
