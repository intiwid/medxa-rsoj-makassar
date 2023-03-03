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

function update_draft($value)
{
	global $conn;
	$uid = $value['uid'];
	$fill = addslashes($value['fill']);

	mysqli_query(
		$conn,
		"UPDATE xray_workload SET 
		fill = '$fill'
		WHERE uid = '$uid'"
	);

	return mysqli_affected_rows($conn);
}

function insert_template_workload($value)
{
	global $conn;
	$title = $value['title'];
	$fill = $value['fill'];
	$username = $_SESSION['username'];
	if (empty($title)) {
		echo "<script>alert('Title belum diisi!');</script>";
	} else {
		mysqli_query(
			$conn,
			"INSERT INTO xray_template (title, fill, username) 
			VALUES ('$title','$fill','$username')"
		);

		return mysqli_insert_id($conn);
	}
}

function insert_workload($value)
{
	global $conn;
	$uid = $value['uid'];
	$fill = addslashes($value['fill']);
	$username = $value['username'];
	$priority_doctor = $value['priority_doctor'];

	$dokter_radiologi = mysqli_fetch_assoc(mysqli_query(
		$conn,
		"SELECT * FROM xray_dokter_radiology WHERE username = '$username'"
	));
	$pk = $dokter_radiologi['pk'];
	$dokradid = $dokter_radiologi['dokradid'];
	$dokrad_name = $dokter_radiologi['dokrad_name'];

	mysqli_query(
		$conn,
		"INSERT INTO xray_order (uid, dokradid, dokrad_name) VALUES ('$uid', '$dokradid', '$dokrad_name')
		ON DUPLICATE KEY UPDATE dokradid = '$dokradid', dokrad_name = '$dokrad_name'"
	);

	mysqli_query(
		$conn,
		"UPDATE xray_workload 
		SET pk_dokter_radiology = '$pk',
		xray_workload.status = 'approved', 
		fill = '$fill',
		approved_at = NOW(),
		priority_doctor = '$priority_doctor'
		WHERE uid = '$uid'
		"
	);

	return mysqli_affected_rows($conn);
}

function ubahdokter($uid)
{
	global $conn;

	$query = "UPDATE xray_workload_radiographer SET 
				dokradid = NULL,
				dokrad_name = NULL,
				dokrad_lastname = NULL,
				approve_date = NULL,
				approve_time = NULL,
				status = 'ready to approve',
				fill = NULL
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	$query1 = "DELETE FROM xray_workload WHERE uid = '$uid'";
	mysqli_query($conn, $query1);

	$query3 = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid'";
	$data_exam = mysqli_query($conn, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);

	$acc = $row3['acc'];
	$patientid = $row3['patientid'];
	$mrn = $row3['mrn'];
	$name = $row3['name'];
	$lastname = $row3['lastname'];
	$address = $row3['address'];
	$sex = $row3['sex'];
	$birth_date = $row3['birth_date'];
	$weight = $row3['weight'];
	$name_dep = $row3['name_dep'];
	$xray_type_code = $row3['xray_type_code'];
	$prosedur = $row3['prosedur'];
	$dokterid = $row3['dokterid'];
	$named = $row3['named'];
	$lastnamed = $row3['lastnamed'];
	$email = $row3['email'];
	$radiographer_id = $row3['radiographer_id'];
	$radiographer_name = $row3['radiographer_name'];
	$radiographer_lastname = $row3['radiographer_lastname'];
	$dokradid = $row3['dokradid'];
	$dokrad_name = $row3['dokrad_name'];
	$dokrad_lastname = $row3['dokrad_lastname'];
	$create_time = $row3['create_time'];
	$schedule_date = $row3['schedule_date'];
	$schedule_time = $row3['schedule_time'];
	$contrast = $row3['contrast'];
	$priority = $row3['priority'];
	$pat_state = $row3['pat_state'];
	$contrast_allergies = $row3['contrast_allergies'];
	$spc_needs = $row3['spc_needs'];
	$payment = $row3['payment'];
	$arrive_date = $row3['arrive_date'];
	$arrive_time = $row3['arrive_time'];
	$complete_date = $row3['complete_date'];
	$complete_time = $row3['complete_time'];
	////SELECT DEPID////
	$query313 = "SELECT * FROM xray_department WHERE name_dep = '$name_dep'";
	$data_exam313 = mysqli_query($conn, $query313);
	$row313 = mysqli_fetch_assoc($data_exam313);
	$dep_id = $row313['dep_id'];
	$fill = $row3['fill'];
	$study_datetime = $row3['study_datetime'];
	$updated_time = $row3['updated_time'];
	$num_instances = $row3['num_instances'];
	$num_series = $row3['num_series'];
	$src_aet = $row3['src_aet'];
	$series_desc = $row3['series_desc'];
	$status = $row3['status'];

	mysqli_query($conn, "INSERT INTO xray_exam2
    	(uid, acc, patientid, mrn, name, lastname, address, sex, birth_date, weight, name_dep, xray_type_code, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name, radiographer_lastname,dokradid,dokrad_name,dokrad_lastname,create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time,fill,study_datetime,updated_time, num_instances, num_series, series_desc, src_aet) VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$address', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$prosedur','$dokterid', '$named', '$lastnamed','$email','$radiographer_id','$radiographer_name','$radiographer_lastname','$dokradid','$dokrad_name','$dokrad_lastname','$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs','$payment','$arrive_date', '$arrive_time','$complete_date','$complete_time','$fill','$study_datetime','$updated_time', '$num_instances', '$num_series', '$series_desc', '$src_aet') ");

	return mysqli_affected_rows($conn);
}



// ---------------------------------------------------------

function ashiap($post_fill)
{
	global $conn;
	$uid = $post_fill['uid'];
	$title = $post_fill['title'];
	$q3 = mysqli_query($conn, 'SELECT * FROM xray_template WHERE title = "$title"');
	$row3 = mysqli_fetch_assoc($q3);
	$fill = $row3['fill'];

	return mysqli_affected_rows($conn);
}

// =================================Workload Edit================================

function update_workload($value)
{
	global $conn;

	$uid = $value['uid'];
	$fill = addslashes($value['fill']);
	$priority_doctor = $value['priority_doctor'];

	mysqli_query(
		$conn,
		"UPDATE xray_workload SET 
		fill = '$fill',
		approve_updated_at = NOW(),
		priority_doctor = '$priority_doctor'
		WHERE uid = '$uid'"
	);

	return mysqli_affected_rows($conn);
}

function savetempworkload($post_exam_temp)
{
	global $conn;
	$title = $post_exam_temp['title'];
	$fill = $post_exam_temp['fill'];
	$username = $_SESSION['username'];
	if (empty($title)) {
		echo "<script>alert('Title belum diisi!');</script>";
	} else {
		$q2 = mysqli_query($conn, 'SELECT MAX(template_id) as pdf from xray_template');
		$row2 = mysqli_fetch_assoc($q2);
		$ai2 = $row2['pdf'] + 1;
		$query = "INSERT INTO xray_template
				VALUES 
				('$ai2','$title','$fill','$username')
				";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

// =================================Hapus Template================================

function delete_template($template_id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_template WHERE template_id = '$template_id' ");
	return mysqli_affected_rows($conn);
}


function hapus_temp_new($template_id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_template WHERE template_id = '$template_id' ");
	return mysqli_affected_rows($conn);
}

function update_template($value)
{
	global $conn;
	$template_id = $value['template_id'];
	$title = $value['title'];
	$fill = $value['fill'];

	mysqli_query($conn, "UPDATE xray_template SET 
				title = '$title',
				fill = '$fill'
				WHERE template_id = '$template_id'
	");
	return mysqli_affected_rows($conn);
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

function approvesignworkload($approvesign)
{
	global $conn;
	// $approvedsign = $approvesign['approvedsign'];
	$uid = $approvesign['uid'];
	$uid2 = $uid . '.png';

	$query2 = "UPDATE xray_workload SET
				signature = '$uid2',
				signature_datetime = NOW()
				WHERE uid = '$uid'
				";
	mysqli_query($conn, $query2);

	return mysqli_affected_rows($conn);
}
