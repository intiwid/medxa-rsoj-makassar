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

// edit

function ubah_exam($post_exam)
{
	global $conn;
	$uid = $post_exam['uid'];
	$fill = $post_exam['fill'];

	$query = "UPDATE xray_exam SET 
				fill = '$fill'
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function bgst($post_exam_fill)
{
	global $conn;
	$uid = $post_exam_fill['uid'];
	$fill = $post_exam_fill['fill'];
	$q2 = mysqli_query($conn, 'SELECT MAX(pdf_id) as pdf from xray_testpdf');
	$row2 = mysqli_fetch_assoc($q2);
	$ai2 = $row2['pdf'] + 1;
	$query = "INSERT INTO xray_testpdf
				VALUES 
				('$ai2','$fill')
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function input_temp($post_exam_temp)
{
	global $conn;
	$title = $post_exam_temp['title'];
	$fill = $post_exam_temp['fill'];
	$username = $_SESSION['username'];
	if (empty($title)) {
		echo "<script>alert('Title belum diisi!'); </script>
         <script>
            function play(){
            var audio1 = document.getElementById('audio1');
            audio1.play();
                 }
        </script>";
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

function input_approve($get_approve)
{
	global $conn;
	$uid = $get_approve['uid'];
	$fill = $get_approve['fill'];
	$query3 = "SELECT * FROM xray_exam2 WHERE uid = '$uid'";
	$data_exam = mysqli_query($conn, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);

	$acc = $row3['acc'];
	$patientid = $row3['patientid'];
	$mrn = $row3['mrn'];
	$name = $row3['name'];
	$lastname = $row3['lastname'];
	$sex = $row3['sex'];
	$birth_date = $row3['birth_date'];
	$weight = $row3['weight'];
	$name_dep = $row3['name_dep'];
	$xray_type_code = $row3['xray_type_code'];
	$prosedur = $row3['prosedur'];
	$dokterid = $row3['dokterid'];
	$named = $row3['named'];
	$lastnamed = $row3['lastnamed'];
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
	$arrive_time = $row3['arrive_time'];
	$complete_time = $row3['complete_time'];

	$query4 = "INSERT INTO xray_workload
        VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$prosedur','$dokterid', '$named', '$lastnamed','$radiographer_id','$radiographer_name','$radiographer_lastname','$dokradid','$dokrad_name','$dokrad_lastname', '$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs', '$arrive_time','$fill','$complete_time',NOW(),NOW())";
	mysqli_query($conn, $query4);


	mysqli_query($conn, "DELETE FROM xray_exam2 WHERE uid = '$uid'");

	return mysqli_affected_rows($conn);
}



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

function ubahworkload($post_edit_workload)
{
	global $conn;
	$uid = $post_edit_workload['uid'];
	$acc = $post_edit_workload['acc'];
	$patientid = $post_edit_workload['patientid'];
	$mrn = $post_edit_workload['mrn'];
	$name = $post_edit_workload['name'];
	$name1 = str_replace('^', ' ', $name);
	$name1 = addslashes($name1);
	$lastname = $post_edit_workload['lastname'];
	$lastname = addslashes($lastname);
	$address = $post_edit_workload['address'];
	$address = addslashes($address);
	$payment = $post_edit_workload['payment'];
	$sex = $post_edit_workload['sex'];
	$birth_date = $post_edit_workload['birth_date'];
	$weight = $post_edit_workload['weight'];

	$xray_type_code = $post_edit_workload['xray_type_code'];

	$name_dep = addslashes($post_edit_workload['name_dep']);

	@$prosedur = $post_edit_workload['prosedur'];
	$namedluar = $post_edit_workload['namedluar'];
	$namedluar = addslashes($namedluar);
	$lastnamedluar = $post_edit_workload['lastnamedluar'];
	$lastnamedluar = addslashes($lastnamedluar);
	$emailluar = $post_edit_workload['emailluar'];

	$named = $post_edit_workload['named'];
	$named = addslashes($named);

	$radiographer_name = $post_edit_workload['radiographer_name'];

	$contrast = $post_edit_workload['contrast'];
	$priority = $post_edit_workload['priority'];
	$pat_state = addslashes($post_edit_workload['pat_state']);
	$contrast_allergies = $post_edit_workload['contrast_allergies'];
	$spc_needs = addslashes($post_edit_workload['spc_needs']);
	$filmsize8 = $post_edit_workload['filmsize8'];
	$filmsize10 = $post_edit_workload['filmsize10'];
	$filmreject8 = $post_edit_workload['filmreject8'];
	$filmreject10 = $post_edit_workload['filmreject10'];
	$kv = $post_edit_workload['kv'];
	$mas = $post_edit_workload['mas'];
	@$xraytype = $post_edit_workload['xraytype'];
	@$formregistration = $post_edit_workload['formregistration'];
	$rephoto = $post_edit_workload['rephoto'];


	$query = "UPDATE xray_workload SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				address = '$address',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				named = '$named',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs',
				payment = '$payment'
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	mysqli_query($conn, "UPDATE xray_workload_radiographer SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				address = '$address',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				named = '$named',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs',
				payment = '$payment',
				payment = '$payment',
				filmsize8 = '$filmsize8',
				filmsize10 = '$filmsize10',
				filmreject8 = '$filmreject8',
				filmreject10 = '$filmreject10',
				kv = '$kv',
				mas = '$mas',
				xraytype = '$xraytype',
				formregistration = '$formregistration',
				rephoto = '$rephoto'
				WHERE uid = '$uid'");

	return mysqli_affected_rows($conn);
}

function ubahworkloadbefore($post_edit_workload)
{
	global $conn;
	$uid = $post_edit_workload['uid'];
	$acc = $post_edit_workload['acc'];
	$patientid = $post_edit_workload['patientid'];
	$mrn = $post_edit_workload['mrn'];
	$name = $post_edit_workload['name'];
	$name1 = str_replace('^', ' ', $name);
	$name1 = addslashes($name1);
	$lastname = $post_edit_workload['lastname'];
	$lastname = addslashes($lastname);
	$named = $post_edit_workload['named'];
	$named = addslashes($named);
	$sex = $post_edit_workload['sex'];
	$birth_date = $post_edit_workload['birth_date'];
	$weight = $post_edit_workload['weight'];
	$address = $post_edit_workload['address'];
	$address = addslashes($address);
	$payment = $post_edit_workload['payment'];
	$xray_type_code = $post_edit_workload['xray_type_code'];
	$name_dep = addslashes($post_edit_workload['name_dep']);
	@$prosedur = $post_edit_workload['prosedur'];
	$radiographer_name = $post_edit_workload['radiographer_name'];
	$radiographer_name = addslashes($radiographer_name);

	$contrast = $post_edit_workload['contrast'];
	$priority = $post_edit_workload['priority'];
	$pat_state = addslashes($post_edit_workload['pat_state']);
	$contrast_allergies = $post_edit_workload['contrast_allergies'];
	$spc_needs = addslashes($post_edit_workload['spc_needs']);
	$filmsize8 = $post_edit_workload['filmsize8'];
	$filmsize10 = $post_edit_workload['filmsize10'];
	$filmreject8 = $post_edit_workload['filmreject8'];
	$filmreject10 = $post_edit_workload['filmreject10'];
	$kv = $post_edit_workload['kv'];
	$mas = $post_edit_workload['mas'];
	@$xraytype = $post_edit_workload['xraytype'];
	@$formregistration = $post_edit_workload['formregistration'];
	$rephoto = $post_edit_workload['rephoto'];

	$query = "UPDATE xray_exam2 SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				address = '$address',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				named = '$named',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs',
				payment = '$payment'
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	mysqli_query($conn, "UPDATE xray_workload_radiographer SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				address = '$address',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				named = '$named',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs',
				payment = '$payment',
				filmsize8 = '$filmsize8',
				filmsize10 = '$filmsize10',
				filmreject8 = '$filmreject8',
				filmreject10 = '$filmreject10',
				kv = '$kv',
				mas = '$mas',
				xraytype = '$xraytype',
				formregistration = '$formregistration',
				rephoto = '$rephoto'
				WHERE uid = '$uid'");

	return mysqli_affected_rows($conn);
}

function hapus_mwl($study_iuid)
{
	global $conn_mppsio, $conn;
	mysqli_query($conn_mppsio, "DELETE FROM mwl_item WHERE study_iuid = '$study_iuid' ");
	mysqli_query($conn, "DELETE FROM xray_exam WHERE uid = '$study_iuid' ");

	return mysqli_affected_rows($conn_mppsio);
}

function hapus_workload($uid, $username)
{
	global $conn, $conn_pacs;
	$query3 = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid'";
	$data_exam = mysqli_query($conn, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);

	$acc = $row3['acc'];
	$patientid = $row3['patientid'];
	$mrn = $row3['mrn'];
	$name = $row3['name'];
	$lastname = $row3['lastname'];
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
	$depid = $row313['depid'];
	$fill = $row3['fill'];
	$study_datetime = $row3['study_datetime'];
	$updated_time = $row3['updated_time'];
	$num_instances = $row3['num_instances'];
	$num_series = $row3['num_series'];
	$src_aet = $row3['src_aet'];
	$series_desc = $row3['series_desc'];
	$status = $row3['status'];

	mysqli_query($conn, "INSERT INTO xray_recyclebin
    	(uid, acc, patientid, mrn, name, lastname, sex, birth_date, weight, name_dep, xray_type_code, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name, radiographer_lastname,dokradid,dokrad_name,dokrad_lastname,create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time,approve_date,approve_time,fill,status,study_datetime,updated_time, num_instances, num_series, series_desc, src_aet, del) VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$prosedur','$dokterid', '$named', '$lastnamed','$email','$radiographer_id','$radiographer_name','$radiographer_lastname','$dokradid','$dokrad_name','$dokrad_lastname','$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs','$payment','$arrive_date', '$arrive_time','$complete_date','$complete_time',NOW(),NOW(),'$fill','$status','$study_datetime','$updated_time', '$num_instances', '$num_series', '$series_desc', '$src_aet', '$username') ");
	mysqli_query($conn, "DELETE FROM xray_workload WHERE uid = '$uid' ");
	mysqli_query($conn, "DELETE FROM xray_exam2 WHERE uid = '$uid' ");
	mysqli_query($conn, "DELETE FROM xray_workload_radiographer WHERE uid = '$uid' ");
	mysqli_query($conn_pacs, "UPDATE study SET del = 'DELETE' WHERE study_iuid = '$uid' ");
	return mysqli_affected_rows($conn);
}

function hapus_worklist($uid, $username)
{
	global $conn, $conn_pacs;
	$query3 = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid'";
	$data_exam = mysqli_query($conn, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);

	$acc = $row3['acc'];
	$patientid = $row3['patientid'];
	$mrn = $row3['mrn'];
	$name = $row3['name'];
	$lastname = $row3['lastname'];
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
	$depid = $row313['depid'];
	$study_datetime = $row3['study_datetime'];
	$updated_time = $row3['updated_time'];
	$num_instances = $row3['num_instances'];
	$num_series = $row3['num_series'];
	$src_aet = $row3['src_aet'];
	$series_desc = $row3['series_desc'];
	$status = $row3['status'];

	mysqli_query($conn, "INSERT INTO xray_recyclebin
    	(uid, acc, patientid, mrn, name, lastname, sex, birth_date, weight, depid, name_dep, xray_type_code, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name, radiographer_lastname,create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time, status, study_datetime, updated_time, num_instances, num_series, series_desc, src_aet, del) VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight', '$depid', '$name_dep', '$xray_type_code', '$prosedur','$dokterid', '$named', '$lastnamed','$email','$radiographer_id','$radiographer_name','$radiographer_lastname', '$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs', '$payment', '$arrive_date', '$arrive_time', '$complete_date', '$complete_time','$status', '$study_datetime', '$updated_time', '$num_instances', '$num_series', '$series_desc', '$src_aet','$username') ");
	mysqli_query($conn, "DELETE FROM xray_exam2 WHERE uid = '$uid' ");
	mysqli_query($conn, "DELETE FROM xray_workload_radiographer WHERE uid = '$uid' ");
	mysqli_query($conn_pacs, "UPDATE study SET del = 'DELETE' WHERE study_iuid = '$uid' ");
	return mysqli_affected_rows($conn);
}

function hapus_worklistpacs($study_iuid)
{
	global $conn_pacs;
	mysqli_query($conn_pacs, "UPDATE study SET del = 'DELETE' WHERE study_iuid = '$study_iuid' ");
	return mysqli_affected_rows($conn_pacs);
}

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
	$username = $value['username'];

	mysqli_query($conn, "UPDATE xray_template SET 
				title = '$title',
				fill = '$fill',
				username = '$username'
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

function inputpatient($postpasien)
{
	global $conn;
	$mrn = $postpasien['mrn'];
	$result1 = mysqli_query($conn, "SELECT * FROM xray_patient WHERE mrn = '$mrn'");
	$row1 = mysqli_fetch_array($result1);
	$patientid = $row1['patientid'];
	$name = $row1['name'];
	$lastname = $row1['lastname'];
	$sex = $row1['sex'];
	$birth_date = $row1['birth_date'];
	$weight = $row1['weight'];
	$username = $_SESSION['username'];

	$q1 = mysqli_query($conn, 'SELECT MAX(patientorderid) as user_id1 from xray_patient_order');
	$w1 = mysqli_fetch_array($q1);
	$ai1 = $w1['user_id1'] + 1;
	$query = "INSERT INTO xray_patient_order
	VALUES
	('$ai1', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight','$username')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function inputorder($postorder)
{
	global $conn;

	$username = $_SESSION['username'];

	$result = mysqli_query($conn, "SELECT * FROM xray_patient_order WHERE username = '$username' ORDER BY patientorderid DESC LIMIT 0,99");
	$row = mysqli_fetch_array($result);
	$patientid = $row['patientid'];
	$mrn = $row['mrn'];
	$name = $row['name'];
	$lastname = $row['lastname'];
	$sex = $row['sex'];
	$birth_date = $row['birth_date'];
	$weight = $row['weight'];
	$username = $row['username'];
	// -----------
	$dokterid = $postorder['dokterid'];
	@$namedluar = $postorder['namedluar'];
	$lastnamedluar = $postorder['lastnamedluar'];
	@$emailluar = $postorder['emailluar'];

	$dokter = mysqli_query($conn, "SELECT * FROM xray_dokter WHERE dokterid = '$dokterid'");
	$row_dokter = mysqli_fetch_assoc($dokter);
	$named = $row_dokter['named'];
	$lastnamed = $row_dokter['lastnamed'];
	$email = $row_dokter['email'];
	// ------------
	$dep_id = $postorder['dep_id'];
	$result2 = mysqli_query($conn, "SELECT * FROM xray_department WHERE dep_id = '$dep_id' ");
	$row2 = mysqli_fetch_array($result2);
	$dep_id = $row2['dep_id'];
	$name_dep = $row2['name_dep'];
	// ------------
	$xray_type_code = $postorder['xray_type_code'];
	$result4 = mysqli_query($conn, "SELECT * FROM xray_modalitas WHERE xray_type_code = '$xray_type_code' ");
	$row4 = mysqli_fetch_array($result4);
	$typename = $row4['typename'];
	// ------------
	// $code_xray = $postorder['code_xray'];
	// $result3 = mysqli_query($conn, "SELECT * FROM xray_price1 WHERE code_xray = '$code_xray' ");
	// $row3 = mysqli_fetch_array($result3);
	// $type = $row3['type'];
	$main_prosedur = $postorder['main_prosedur'];

	// $main_prosedur2 = implode("','", $main_prosedur);

	// $result6 = mysqli_query($conn, "SELECT * FROM xray_price1 WHERE prosedur IN('".$prosedur2."') GROUP BY prosedur");
	// while($row6 = mysqli_fetch_array($result6)){
	// $prosedur1 = $row6['prosedur'];
	// }

	foreach ($main_prosedur as $main_prosedur1) {

		$result5 = mysqli_query($conn, "SELECT * FROM xray_price WHERE main_prosedur IN('" . $main_prosedur1 . "') ");
		$row5 = mysqli_fetch_array($result5);
		$type = $row5['type'];

		$schedule_date = $postorder['schedule_date'];
		$schedule_time = $postorder['schedule_time'];
		$contrast = $postorder['contrast'];
		$priority = $postorder['priority'];
		$pat_state = $postorder['pat_state'];
		$contrast_allergies = $postorder['contrast_allergies'];
		$spc_needs = addslashes($postorder['spc_needs']);

		$length = 8;
		$acc = '';
		for ($i = 0; $i < $length; $i++) {
			$acc .= rand(1, 7);
		}

		$length1 = 9;
		$add = '';
		for ($a = 0; $a < $length1; $a++) {
			$add .= rand(1, 9);
		}

		$length2 = 1;
		$add2 = '';
		for ($r = 0; $r < $length2; $r++) {
			$add2 .= rand(1, 9);
		}

		$text = preg_replace('/[^A-Za-z0-9\  ]/', '', $schedule_date);

		$uid = '1.2.40.0.13.1.' . $acc . '.' . $add2 . '.' . $text . '.' . $add;

		if (!$dokterid) {
			$query = " INSERT INTO xray_order (uid ,acc ,patientid ,mrn ,name ,lastname ,sex ,birth_date ,weight ,name_dep ,xray_type_code ,prosedur ,dokterid ,named ,lastnamed ,email ,create_time ,schedule_date , schedule_time ,contrast ,priority ,pat_state ,contrast_allergies ,spc_needs ,payment, fromorder)
			VALUES
			('$uid' ,'$acc' ,'$patientid' ,'$mrn' ,'$name' ,'$lastname' ,'$sex' ,'$birth_date' ,'$weight' ,'$name_dep' ,'$xray_type_code' , '$main_prosedur1' ,'','$namedluar' ,'$lastnamedluar' ,'$emailluar',NOW() ,'$schedule_date' ,'$schedule_time' ,'$contrast' ,'$priority' ,'$pat_state' ,'$contrast_allergies' ,'$spc_needs' ,'', 'RIS')";
			mysqli_query($conn, $query);
		} else {
			$query = " INSERT INTO xray_order (uid ,acc ,patientid ,mrn ,name ,lastname ,sex ,birth_date ,weight ,name_dep ,xray_type_code ,prosedur ,dokterid ,named ,lastnamed ,email ,create_time ,schedule_date , schedule_time ,contrast ,priority ,pat_state ,contrast_allergies ,spc_needs ,payment, fromorder)
			VALUES
			('$uid' ,'$acc' ,'$patientid' ,'$mrn' ,'$name' ,'$lastname' ,'$sex' ,'$birth_date' ,'$weight' ,'$name_dep' ,'$xray_type_code' , '$main_prosedur1' ,'$dokterid','$named' ,'$lastnamed' ,'$email',NOW() ,'$schedule_date' ,'$schedule_time' ,'$contrast' ,'$priority' ,'$pat_state' ,'$contrast_allergies' ,'$spc_needs' ,'', 'RIS')";
			mysqli_query($conn, $query);
		}
	}
	return mysqli_affected_rows($conn);
}

function inputpopup($inputpop)
{
	global $conn;

	$q2 = mysqli_query($conn, 'SELECT MAX(dokterorderid) as user_id2 from xray_dokter_order');
	$w2 = mysqli_fetch_array($q2);
	$ai2 = $w2['user_id2'] + 1;

	$length = 5;
	$ai4 = '';
	for ($i = 0; $i < $length; $i++) {
		$ai4 .= rand(1, 9);
	}

	$named = addslashes($inputpop['named']);
	$lastnamed = addslashes($inputpop['lastnamed']);
	$email = addslashes($inputpop['email']);

	$query = "INSERT INTO xray_dokter_order
	VALUES
	('$ai2', '$ai4', '$named', '$lastnamed','$email')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function formatBytes($bytes, $precision = 2)
{
	$units = array('B', 'KB', 'MB', 'GB', 'TB');

	$bytes = max($bytes, 0);
	$pow = floor(($bytes ? log($bytes) : 0) / log(10240));
	$pow = min($pow, count($units) - 1);

	$bytes /= pow(10240, $pow);

	return round($bytes, $precision) . ' ' . $units[$pow];
}

//----------------------------------CHAT-----------------------------------------------------
function fetch_user_last_activity($username)
{
	global $conn;

	$query = "
 SELECT * FROM xray_login 
 WHERE username = '$username' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		return $row['last_activity'];
	}
}


//---------------------------------------------------------------------------------------
function fetch_user_chat_history($from_username, $to_username)
{
	global $conn;
	$query = "
 SELECT * FROM xray_chat_message 
 WHERE (from_username = '" . $from_username . "' 
 AND to_username = '" . $to_username . "') 
 OR (from_username = '" . $to_username . "' 
 AND to_username = '" . $from_username . "') 
 ORDER BY timestamp ASC
 ";
	$result = mysqli_query($conn, $query);
	$output = '<ul class="list-unstyled">';
	while ($row = mysqli_fetch_assoc($result)) {
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if ($row["from_username"] == $from_username) {
			if ($row["status"] == '2') {
				$chat_message = '<em>Pesan ini telah dihapus</em>';
				$user_name = '<b class="text-success" style="float: right;">Kamu</b>';
			} else {
				$chat_message = $row['chat_message'];
				$user_name = '<button type="button" class="remove_chat dot" title="Hapus chat" id="' . $row['chat_message_id'] . '"><i class="fas fa-minus-circle"></i></button>&nbsp;<b class="text-success" style="float: right;">Kamu</b>';
			}


			$dynamic_background = 'background-color:#edfaf0; text-align: right;';
		} else {
			if ($row["status"] == '2') {
				$chat_message = '<em>Pesan ini telah dihapus</em>';
			} else {
				$chat_message = $row["chat_message"];
			}
			$user_name = '<b class="text-danger">' . get_user_name($row['from_username']) . '</b>';
			$dynamic_background = 'background-color:#fffff2;';
		}
		$output .= '
  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
   <p>' . $user_name . ' <br> ' . $chat_message . '
    <div align="right">
     - <small><em>' . $row['timestamp'] . '</em></small>
    </div>
   </p>
  </li>
  ';
	}
	$output .= '</ul>';
	$query = "
 UPDATE xray_chat_message 
 SET status = '0' 
 WHERE from_username = '" . $to_username . "' 
 AND to_username = '" . $from_username . "' 
 AND status = '1'
 ";
	mysqli_query($conn, $query);
	// return mysqli_affected_rows($conn);
	return $output;
}


//---------------------------------------------------------------------------------------
function fetch_group_chat_history()
{
	global $conn;
	$query = "
 SELECT * FROM chat_message 
 WHERE to_user_id = '0'  
 ORDER BY timestamp DESC
 ";
	$result = mysqli_query($conn, $query);
	$output = '<ul class="list-unstyled">';
	while ($row = mysqli_fetch_assoc($result)) {
		$user_name = '';
		$chat_message = '';
		$dynamic_background = '';

		if ($row['from_user_id'] == $_SESSION['user_id']) {
			if ($row["status"] == '2') {
				$chat_message = '<em>Pesan ini telah dihapus</em>';
				$user_name = '<b class="text-success">Kamu</b>';
			} else {
				$chat_message = $row['chat_message'];
				$user_name = '<b class="text-success">Kamu</b>&nbsp;<button type="button" class="btn btn-danger btn-sm remove_chat" id="' . $row['chat_message_id'] . '">x</button>';
			}
			$dynamic_background = 'background-color:#edfaf0; text-align: right;';
		} else {
			if ($row["status"] == '2') {
				$chat_message = '<em>Pesan ini telah dihapus</em>';
			} else {
				$chat_message = $row['chat_message'];
			}
			$user_name = '<b class="text-danger">' . get_user_name($row['from_user_id']) . '</b>';
			$dynamic_background = 'background-color:#fffff2;';
		}
		$output .= '
  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
   <p>' . $user_name . ' <br> ' . $chat_message . ' 
    <div align="right">
     <small><em>' . $row['timestamp'] . '</em></small>
    </div>
   </p>
   
  </li>
  ';
	}
	$output .= '</ul>';
	return $output;
}


//---------------------------------------------------------------------------------------
function get_user_name($user_id)
{
	global $conn;
	$query = "SELECT username FROM xray_login WHERE username = '$user_id'";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		return $row['username'];
	}
}


//---------------------------------------------------------------------------------------
function count_unseen_message($from_username, $to_username)
{
	global $conn;
	$query = "
 SELECT * FROM xray_chat_message 
 WHERE from_username = '$from_username' 
 AND to_username = '$to_username' 
 AND status = '1'
 ";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);
	$output = '';
	if ($count > 0) {
		$output = '<span class="badge badge-success">' . $count . '</span>';
	}
	return $output;
}

//---------------------------------------------------------------------------------------
function fetch_is_type_status($username)
{
	global $conn;
	$query = "
 SELECT * FROM xray_login_details 
 WHERE username = '" . $username . "'
 AND type_to = '" . $_SESSION['username'] . "' 
 ORDER BY login_details_id DESC 
 LIMIT 1
 ";
	$result = mysqli_query($conn, $query);
	$output = '';
	while ($row = mysqli_fetch_assoc($result)) {
		if ($row["is_type"] == 'yes') {
			$output = ' - <small><em><span class="text-muted">mengetik...</span></em></small>';
		}
	}
	return $output;
}
//---------------------------------------END CHAT---------------------------------------------

//MAINTENANCE
function maintenancepost($maintenancepost2)
{
	global $conn;
	$id = $maintenancepost2['id'];

	$query = "UPDATE xray_maintenance SET 
				status = 1,
				do_maintenance_date = now()
				WHERE id = '$id'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//COMPLAINT
function new_complaint($new_complaint2)
{
	global $conn;
	$complaint_date = $new_complaint2['complaint_date'];
	$complaint_time = $new_complaint2['complaint_time'];
	$person_call = $new_complaint2['person_call'];
	$problem = $new_complaint2['problem'];
	$solve_date = $new_complaint2['solve_date'];
	$solve_time = $new_complaint2['solve_time'];
	$explanation = $new_complaint2['explanation'];
	$solve_date_to = $new_complaint2['solve_date_to'];
	$solve_time_to = $new_complaint2['solve_time_to'];

	$query = "INSERT INTO xray_complaint (complaint_date, complaint_time, person_call, problem, solve_date, solve_time, explanation, solve_date_to, solve_time_to) VALUES ('$complaint_date', '$complaint_time', '$person_call', '$problem', '$solve_date', '$solve_time', '$explanation', '$solve_date_to', '$solve_time_to')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


//UPDATE COMPLAINT
function editcomplaint($editcomplaint2)
{
	global $conn;
	$id = $editcomplaint2['id'];
	$complaint_date = $editcomplaint2['complaint_date'];
	$complaint_time = $editcomplaint2['complaint_time'];
	$person_call = $editcomplaint2['person_call'];
	$problem = $editcomplaint2['problem'];
	$solve_date = $editcomplaint2['solve_date'];
	$solve_time = $editcomplaint2['solve_time'];
	$explanation = $editcomplaint2['explanation'];

	$query = "UPDATE xray_complaint SET 
				complaint_date = '$complaint_date',
				complaint_time = '$complaint_time',
				person_call = '$person_call',
				problem = '$problem',
				solve_date = '$solve_date',
				solve_time = '$solve_time',
				explanation = '$explanation'
				WHERE id = '$id'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
