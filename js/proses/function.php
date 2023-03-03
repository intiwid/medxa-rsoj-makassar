<?php
require '../koneksi/koneksi.php';

function ubahdokterworklist($post)
{
    global $conn;

    $uid = $post['uid'];
    $dokradid = $post['dokradid'];
    // $status = $post['status'];

    $query4 = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid'";
    $data_exam1 = mysqli_query($conn, $query4);
    $row4 = mysqli_fetch_assoc($data_exam1);

    $pk = $row4['pk'];
    $dokradid1 = $row4['dokradid'];
    $dokradname1 = $row4['dokrad_name'] . ' ' . $row4['dokrad_lastname'];
    // echo $pk . ' ' . $dokradid1 . ' ' . $dokradname1 . ' ' . $dokradlastname1;
    // die();

    $queryinsert = " INSERT INTO xray_order (uid, dokradid, dokrad_name) VALUES ('$uid','$dokradid1','$dokradname1')
	ON DUPLICATE KEY UPDATE dokradid = '$dokradid1', dokrad_name = '$dokradname1'";
    mysqli_query($conn, $queryinsert);

    $query1 = "UPDATE xray_workload SET 
	pk_dokter_radiology = '$pk'
	WHERE uid = '$uid'
	";
    mysqli_query($conn, $query1);

    return mysqli_affected_rows($conn);
}

function ubahdokterworkload($post)
{
    global $conn;

    $uid = $post['uid'];
    $dokradid = $post['dokradid'];


    $query4 = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid'";
    $data_exam1 = mysqli_query($conn, $query4);
    $row4 = mysqli_fetch_assoc($data_exam1);

    $pk = $row4['pk'];
    $dokradid1 = $row4['dokradid'];
    $dokradname1 = $row4['dokrad_name'] . ' ' . $row4['dokrad_lastname'];

    $query = "UPDATE xray_order SET 
	dokradid = '$dokradid1',
	dokrad_name = '$dokradname1'
	WHERE uid = '$uid'
";
    mysqli_query($conn, $query);

    $query1 = "UPDATE xray_workload SET 
	pk_dokter_radiology = '$pk',
	status = 'waiting',
	fill = NULL,
	approved_at = NULL,
	approve_updated_at = NULL,
	signature = NULL,
	signature_datetime = NULL,
    priority_doctor = 'normal' 
	WHERE uid = '$uid'
	";
    mysqli_query($conn, $query1);

    return mysqli_affected_rows($conn);
}


function new_template($new_template)
{
    global $conn;
    $title = $new_template['title'];
    $fill = $new_template['fill'];
    $username = $new_template['username'];

    mysqli_query(
        $conn,
        "INSERT INTO xray_template (title, fill, username) 
		VALUES ('$title','$fill','$username')"
    );

    return mysqli_affected_rows($conn);
}
