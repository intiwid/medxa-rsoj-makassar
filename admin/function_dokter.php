<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

function view_login($value)
{
	global $conn;
	$id_table = $_SESSION['id_table'];
	$password = $value["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query($conn, "UPDATE xray_login SET 
				password = '$password_hash'
				WHERE id_table = '$id_table'");
}

function new_login($value)
{
	global $conn;
	$username = $value["username"];
	$password = $value["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
	$level = $value["level"];

	mysqli_query(
		$conn,
		"INSERT INTO xray_login (username, password, level, date) 
		VALUES ('$username','$password_hash', '$level', NOW())"
	);

	return mysqli_affected_rows($conn);
}

function update_login($value)
{
	global $conn;

	$id_table = $value["id_table"];
	$username = $value["username"];
	$level = $value["level"];

	mysqli_query(
		$conn,
		"UPDATE xray_login SET 
		username = '$username',
		level = '$level'
		WHERE id_table = '$id_table'"
	);

	return mysqli_affected_rows($conn);
}

function update_login_password($value)
{
	global $conn;

	$id_table = $value["id_table"];
	$password = $value["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query(
		$conn,
		"UPDATE xray_login SET 
		password = '$password_hash'
		WHERE id_table = '$id_table'"
	);

	return mysqli_affected_rows($conn);
}

function delete_login($id_table)
{
	global $conn;

	mysqli_query(
		$conn,
		"DELETE FROM xray_login 
		WHERE id_table = '$id_table'"
	);

	return mysqli_affected_rows($conn);
}
///////DOKTER PENGIRIM///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function new_dokter($value)
{
	global $conn;
	$dokterid = $value["dokterid"];
	$named = $value["named"];
	$lastnamed = $value["lastnamed"];
	$telp = $value["telp"];
	$email = $value["email"];
	// $username = $value["username"];
	// $password = $value["password"];
	// $password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query(
		$conn,
		"INSERT INTO xray_dokter (dokterid, named, lastnamed, telp, email) 
		VALUES ('$dokterid','$named', '$lastnamed', '$telp', '$email')"
	);

	// mysqli_query(
	// 	$conn,
	// 	"INSERT INTO xray_login (username, password, level, date) 
	// 	VALUES ('$username', '$password_hash','refferal', NOW())"
	// );

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function delete_dokter($id)
{
	global $conn;

	mysqli_query(
		$conn,
		"DELETE FROM xray_dokter 
		WHERE id = '$id'"
	);

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function update_dokter($value)
{
	global $conn;

	$id = $value["id"];
	$dokterid = $value["dokterid"];
	$named = $value["named"];
	$lastnamed = $value["lastnamed"];
	$telp = $value["telp"];
	$email = $value["email"];

	mysqli_query(
		$conn,
		"UPDATE xray_dokter SET 
		dokterid = '$dokterid',
		named = '$named',
		lastnamed ='$lastnamed',
		telp ='$telp',
		email ='$email'
		WHERE id = '$id'"
	);

	return mysqli_affected_rows($conn);
}

///////DOKTER RADIOLOGY///////////////////////////////////////////////////////////////

function new_dokter_radiology($value)
{
	global $conn;
	$dokrad_name = $value["dokrad_name"];
	$dokrad_lastname = $value["dokrad_lastname"];
	@$dokrad_fullname = $dokrad_name . ' ' . $dokrad_lastname;
	$dokradid = $value["dokradid"];
	$dokrad_sex = $value["dokrad_sex"];
	$dokrad_tlp = $value["dokrad_tlp"];
	$nip = $value["nip"];
	$idtele = $value["idtele"];
	$dokrad_email = $value["dokrad_email"];
	$username = $value["username"];
	$password = $value["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query(
		$conn,
		"INSERT INTO xray_dokter_radiology (dokradid, dokrad_name, dokrad_lastname, dokrad_sex, dokrad_tlp, dokrad_email, idtele, nip, username, password)
		VALUES 
		('$dokradid', '$dokrad_name', '$dokrad_lastname', '$dokrad_sex', '$dokrad_tlp', '$dokrad_email', '$idtele', '$nip', '$username', '$password_hash')"
	);
	mysqli_query(
		$conn,
		"INSERT INTO xray_login (username, password, level, date)
		VALUES ('$username', '$password_hash', 'radiology', NOW())"
	);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function delete_dokter_radiology($pk, $id_table)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_dokter_radiology WHERE pk = '$pk'");
	mysqli_query($conn, "DELETE FROM xray_login WHERE id_table = '$id_table'");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function update_dokter_radiology($value)
{
	global $conn;

	$pk = $value["pk"];
	$dokradid = $value["dokradid"];
	$dokrad_name = $value["dokrad_name"];
	$dokrad_lastname = $value["dokrad_lastname"];
	@$dokrad_fullname = $dokrad_name . ' ' . $dokrad_lastname;
	$dokrad_sex = $value["dokrad_sex"];
	$dokrad_tlp = $value["dokrad_tlp"];
	$dokrad_email = $value["dokrad_email"];
	$nip = $value["nip"];
	$idtele = $value["idtele"];

	mysqli_query(
		$conn,
		"UPDATE xray_dokter_radiology SET 
		dokradid = '$dokradid',
		dokrad_name = '$dokrad_name',
		dokrad_lastname = '$dokrad_lastname',
		dokrad_sex = '$dokrad_sex',
		dokrad_tlp = '$dokrad_tlp',
		dokrad_email = '$dokrad_email',
		nip = '$nip',
		idtele = '$idtele'
		WHERE pk = '$pk'"
	);

	return mysqli_affected_rows($conn);
}

function ubah_radtemp($ubah_temp)
{
	global $conn;
	$dokradid = $ubah_temp["dokradid"];
	$nametemp = $_FILES["filetemp"]["name"];
	$file_tmp = $_FILES["filetemp"]["tmp_name"];
	move_uploaded_file($file_tmp, '../image/' . $nametemp);

	$query = "UPDATE xray_dokter_radiology SET 
				imgtemp = '$nametemp'
				WHERE dokradid = '$dokradid'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah_radprofile($ubah_img)
{
	global $conn;
	$dokradid = $ubah_img["dokradid"];
	$nametemp = $_FILES["filetemp"]["name"];
	$file_tmp = $_FILES["filetemp"]["tmp_name"];
	move_uploaded_file($file_tmp, '../image/' . $nametemp);

	$query = "UPDATE xray_dokter_radiology SET 
				dokrad_img = '$nametemp'
				WHERE dokradid = '$dokradid'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
/////end of DOKTER RADIOLOGY///////////////////////////////////////////////////////////////

///////DOKTER RADIOGRAPHER///////////////////////////////////////////////////////////////

function new_radiographer($value)
{
	global $conn;

	$radiographer_id = $value["radiographer_id"];
	$radiographer_name = $value["radiographer_name"];
	$radiographer_lastname = $value["radiographer_lastname"];
	$radiographer_sex = $value["radiographer_sex"];
	$radiographer_tlp = $value["radiographer_tlp"];
	$radiographer_email = $value["radiographer_email"];

	mysqli_query(
		$conn,
		"INSERT INTO xray_radiographer (radiographer_id, radiographer_name, radiographer_lastname, radiographer_sex, radiographer_tlp, radiographer_email)
		VALUES ('$radiographer_id', '$radiographer_name', '$radiographer_lastname', '$radiographer_sex', '$radiographer_tlp', '$radiographer_email')
	"
	);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function delete_radiographer($pk)
{
	global $conn;
	mysqli_query(
		$conn,
		"DELETE FROM xray_radiographer 
		WHERE pk = '$pk'"
	);

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function update_radiographer($value)
{
	global $conn;
	$pk = $value["pk"];
	$radiographer_id = $value["radiographer_id"];
	$radiographer_name = $value["radiographer_name"];
	$radiographer_lastname = $value["radiographer_lastname"];
	$radiographer_sex = $value["radiographer_sex"];
	$radiographer_tlp = $value["radiographer_tlp"];
	$radiographer_email = $value["radiographer_email"];

	mysqli_query($conn, "UPDATE xray_radiographer SET 
	radiographer_id = '$radiographer_id',
	radiographer_name = '$radiographer_name',
	radiographer_lastname ='$radiographer_lastname',
	radiographer_sex = '$radiographer_sex',
	radiographer_tlp = '$radiographer_tlp',
	radiographer_email = '$radiographer_email'
	WHERE pk = '$pk'");

	return mysqli_affected_rows($conn);
}
/////end of DOKTER RADIOGRAPHER///////////////////////////////////////////////////////////////

///////////////////////////DEPARTMEN/////////////////////////////////

//untuk insert atau menambahkan
function new_departement($value)
{
	global $conn;

	$depid = $value['dep_id'];
	$name_dep = $value['name_dep'];

	mysqli_query(
		$conn,
		"INSERT INTO xray_department (dep_id, name_dep)
		VALUES('$depid', '$name_dep')"
	);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function delete_department($pk)
{
	global $conn;

	mysqli_query(
		$conn,
		"DELETE FROM xray_department 
		WHERE pk = '$pk'"
	);

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function update_department($value)
{
	global $conn;
	$pk = $value['pk'];
	$dep_id = $value['dep_id'];
	$name_dep = $value['name_dep'];

	mysqli_query(
		$conn,
		"UPDATE xray_department SET
		dep_id = '$dep_id',
		name_dep = '$name_dep'
		WHERE pk = '$pk'"
	);

	return mysqli_affected_rows($conn);
}

///////////////end of DEPARTMEN////////////////////////


////////////////Modalitas////////////////////////

//untuk insert atau menambahkan
function new_modalitas($value)
{
	global $conn;

	$id_modality = $value['id_modality'];
	$xray_type_code = $value['xray_type_code'];

	mysqli_query(
		$conn,
		"INSERT INTO xray_modalitas (id_modality, xray_type_code) 
		VALUES('$id_modality', '$xray_type_code')"
	);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function delete_modalitas($pk)
{
	global $conn;

	mysqli_query(
		$conn,
		"DELETE FROM xray_modalitas 
		WHERE pk = '$pk'"
	);

	return mysqli_affected_rows($conn);
}

function update_modalitas($value)
{
	global $conn;
	$pk = $value['pk'];
	$id_modality = $value['id_modality'];
	$xray_type_code = $value['xray_type_code'];

	mysqli_query(
		$conn,
		"UPDATE xray_modalitas SET
		xray_type_code = '$xray_type_code',
		id_modality = '$id_modality'
		WHERE pk = '$pk'"
	);

	return mysqli_affected_rows($conn);
}

/////////END OF MODALITAS/////////////////////////////

function new_study($value)
{
	global $conn;
	$id_modality = $value['id_modality'];
	$id_study = $value['id_study'];
	$study = $value['study'];
	$harga = $value['harga'];

	mysqli_query(
		$conn,
		"INSERT INTO xray_study (id_modality, id_study, study, harga)
		VALUES ('$id_modality', '$id_study', '$study', '$harga')"
	);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function delete_study($pk)
{
	global $conn;
	mysqli_query(
		$conn,
		"DELETE FROM xray_study
		WHERE pk = '$pk'"
	);
	return mysqli_affected_rows($conn);
}

function update_study($value)
{
	global $conn;
	$pk = $value['pk'];
	$id_modality = $value['id_modality'];
	$id_study = $value['id_study'];
	$study = $value['study'];
	$harga = $value['harga'];

	mysqli_query(
		$conn,
		"UPDATE xray_study SET
		id_modality = '$id_modality',
		id_study = '$id_study',
		study = '$study',
		harga = '$harga'
		WHERE pk = '$pk'"
	);

	return mysqli_affected_rows($conn);
}

///////ADMIN///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function admin_tambah($post_admin)
{
	global $conn;
	$ad_name = $post_admin["ad_name"];
	$ad_lastname = $post_admin["ad_lastname"];
	$username = $post_admin["username"];
	$password = $post_admin["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$q = mysqli_query($conn, 'SELECT MAX(admin_id) as user_id from xray_admin');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$q4 = mysqli_query($conn, 'SELECT MAX(id_table) as user_id4 from xray_login');
	$row4 = mysqli_fetch_assoc($q4);
	$ai4 = $row4['user_id4'] + 1;


	//query insert data
	$query = "INSERT INTO xray_admin
				VALUES 
				('$ai','$ad_name', '$ad_lastname', '$username', '$password_hash')
				";
	$query_login = "INSERT INTO xray_login
				VALUES 
				('$ai4', '$username', '$password_hash','admin', NOW(), '')
				";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query_login);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_admin($admin_id, $id_table)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_admin WHERE admin_id = $admin_id");
	mysqli_query($conn, "DELETE FROM xray_login WHERE id_table = $id_table");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function ubah_admin($ubah_admin)
{
	global $conn;
	$admin_id = $ubah_admin["admin_id"];
	$ad_name = $ubah_admin["ad_name"];
	$ad_lastname = $ubah_admin["ad_lastname"];


	//query insert data
	$query = "UPDATE xray_admin SET 
				ad_name = '$ad_name',
				ad_lastname ='$ad_lastname'
				WHERE admin_id = '$admin_id'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
/////end of ADMIN///////////////////////////////////////////////////////////////

///////superadmin///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function superadmin_tambah($post_superadmin)
{
	global $conn;
	$sa_name = $post_superadmin["sa_name"];
	$sa_lastname = $post_superadmin["sa_lastname"];
	$username = $post_superadmin["username"];
	$contract_password = $post_superadmin["contract_password"];
	$password_hash_contract = password_hash($contract_password, PASSWORD_BCRYPT, array('cost' => 12));
	$password = $post_superadmin["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$q = mysqli_query($conn, 'SELECT MAX(said) as user_id from xray_superadmin');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$q4 = mysqli_query($conn, 'SELECT MAX(id_table) as user_id4 from xray_login');
	$row4 = mysqli_fetch_assoc($q4);
	$ai4 = $row4['user_id4'] + 1;


	//query insert data
	$query = "INSERT INTO xray_superadmin
				VALUES 
				('$ai','$sa_name', '$sa_lastname', '$username', '$password_hash')
				";
	$query_login = "INSERT INTO xray_login
				VALUES 
				('$ai4', '$username', '$password_hash','superadmin', NOW(), '$password_hash_contract')
				";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query_login);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_superadmin($said, $id_table)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_superadmin WHERE said = $said");
	mysqli_query($conn, "DELETE FROM xray_login WHERE id_table = $id_table");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function ubah_superadmin($ubah_superadmin)
{
	global $conn;
	$said = $ubah_superadmin["said"];
	$sa_name = $ubah_superadmin["sa_name"];
	$sa_lastname = $ubah_superadmin["sa_lastname"];


	//query insert data
	$query = "UPDATE xray_superadmin SET 
				sa_name = '$sa_name',
				sa_lastname ='$sa_lastname'
				WHERE said = '$said'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
/////end of superadmin///////////////////////////////////////////////////////////////

/////////////////////////// berita ////////////////////////////////////////////////

function berita($post_berita)
{
	global $conn;
	$berita = $post_berita['berita'];

	$q5 = mysqli_query($conn, 'SELECT MAX(id) as user_id5 from xray_berita');
	$row5 = mysqli_fetch_assoc($q5);
	$ai5 = $row5['user_id5'] + 1;

	mysqli_query($conn, "INSERT INTO xray_berita (id,berita,tanggal) VALUES ('$ai5','$berita',NOW())");

	return mysqli_affected_rows($conn);
}

//////////////////////// end of berita //////////////////////////////////////////////////////////////////////

function new_ae($value)
{
	global $conn_pacsio;
	$aet = $value['aet'];
	$hostname = $value['hostname'];
	$port = $value['port'];
	// $color = $value['color'];

	mysqli_query(
		$conn_pacsio,
		"INSERT INTO ae (aet, hostname, port, installed) 
		VALUES ('$aet', '$hostname', '$port', 1)"
	);

	return mysqli_affected_rows($conn_pacsio);
}

function update_ae($value)
{
	global $conn_pacsio;
	$pk = $value['pk'];
	$aet = $value['aet'];
	$hostname = $value['hostname'];
	$port = $value['port'];

	mysqli_query(
		$conn_pacsio,
		"UPDATE ae SET 
		aet = '$aet',
		hostname = '$hostname',
		port = '$port'
		WHERE pk = '$pk'
	"
	);
	return mysqli_affected_rows($conn_pacsio);
}

function delete_ae($pk)
{
	global $conn_pacsio;
	mysqli_query(
		$conn_pacsio,
		"DELETE FROM ae WHERE pk = '$pk'"
	);
	return mysqli_affected_rows($conn_pacsio);
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

function delete_template($template_id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_template WHERE template_id = '$template_id' ");
	return mysqli_affected_rows($conn);
}

function update_selected_dokter_radiology($value)
{
	global $conn;
	$is_active = $value['is_active'];

	mysqli_query(
		$conn,
		"INSERT INTO xray_selected_dokter_radiology (pk, is_active, created_at, updated_at) VALUES(1, '$is_active', NOW(), NOW())
		ON DUPLICATE KEY UPDATE is_active = '$is_active', created_at = NOW(), updated_at = NOW()"
	);

	return mysqli_affected_rows($conn);
}

function update_hostname_publik($value)
{
	global $conn;
	$ip_publik = $value['ip_publik'];

	mysqli_query(
		$conn,
		"INSERT INTO xray_hostname_publik (pk, ip_publik, created_at) VALUES(1, '$ip_publik', NOW())
		ON DUPLICATE KEY UPDATE ip_publik = '$ip_publik', created_at = NOW()"
	);

	return mysqli_affected_rows($conn);
}

function update_notification_radiologist($value)
{
	global $conn;
	$is_active = $value['is_active'];

	mysqli_query(
		$conn,
		"INSERT INTO active_notification_unread (pk, is_active, created_at, updated_at) VALUES(1, '$is_active', NOW(), NOW())
		ON DUPLICATE KEY UPDATE is_active = '$is_active', created_at = NOW(), updated_at = NOW()"
	);

	return mysqli_affected_rows($conn);
}
