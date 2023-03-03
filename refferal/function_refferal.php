<?php

require '../koneksi/koneksi.php';
//untuk menampilkan
function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function password($passwordid)
{
	global $conn;
	$username = $_SESSION['username'];
	$password = $passwordid["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query($conn, "UPDATE xray_login SET 
				password = '$password_hash'
				WHERE username = '$username'");

	mysqli_query($conn, "UPDATE xray_dokter_radiology SET 
				password = '$password_hash'
				WHERE username = '$username'");
}
