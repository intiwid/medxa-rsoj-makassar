<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/radiology/function_radiology.php';

$uid = $_GET["uid"] ?? '';

if (!empty($uid) && ubahdokter($uid) > 0) {
	echo "<script type='text/javascript'>
				setTimeout(function () { 
				swal({
						title: 'Berhasil diubah, silahkan ke physician worklist',
						text:  '',
						icon: 'success',
						timer: 1000,
						showConfirmButton: true
					});  
				},10); 
				window.setTimeout(function(){ 
				window.location.replace('workload.php');
				} ,1000); 
			</script>";
} else {
	echo "<script type='text/javascript'>
			setTimeout(function () { 
			swal({
					title: 'Gagal Diubah!',
					text:  '',
					icon: 'error',
					timer: 1000,
					showConfirmButton: true
				});  
			},10); 
			window.setTimeout(function(){ 
			window.location.replace('workload.php');
			} ,1000); 
		</script>";
}
