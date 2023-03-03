<?php 

require '../koneksi/koneksi.php';
if (isset($_POST['button'])) {

	mysqli_query($conn, "DELETE FROM xray_exam WHERE acc = '$acc' ");

	header("location:worklist.php");
}

?>