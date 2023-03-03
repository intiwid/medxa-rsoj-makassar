<?php
session_start();
//fetch.php
require '../koneksi/koneksi.php';

require '../viewer-all.php';


$username = $_SESSION['username'];

// $dokter = "SELECT * FROM xray_radiographer WHERE username = '$username'";

// $data_dicom = mysqli_query($conn, $dokter);
// $row_dok = mysqli_fetch_assoc($data_dicom);
// $radiographer_id = $row_dok['radiographer_id'];

$columns = array('id', 'contract_id', 'maintenance_date', 'status', 'do_maintenance_date');

$query = "SELECT * FROM xray_maintenance WHERE ";

if ($_POST["is_date_search"] == "yes") {
    $From = date_create($_POST["From"]);
    $dateFrom = date_format($From, "Y-m-d");

    $to = date_create($_POST["to"]);
    $dateto = date_format($to, "Y-m-d");
    $dateto2 = $date = date('Y-m-d', strtotime("+1 day", strtotime($dateto)));
    $query .= 'maintenance_date BETWEEN "' . $dateFrom . '" AND "' . $dateto2 . '" AND ';
}

if (isset($_POST["search"]["value"])) {
    $query .= '
  (maintenance_date LIKE "%' . $_POST["search"]["value"] . '%")
 ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
 ';
} else {
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);


$data = array();
$i = 1;
while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $contract_id = $row['contract_id'];
    $contract_id2 = '<a href="view_pdf_contractmaint.php?contract_id=' . $contract_id . '" target="_blank">' . $contract_id . '</a>';
    $maintenance_date = $row['maintenance_date'];
    $maintenance_date = date("d M Y", strtotime($maintenance_date));
    $status = $row['status'];
    if ($status == 1) {
        $status1 = '<i style="color: #329ECF" class="fas fa-check-square"> SUDAH DIKERJAKAN</i>';
    } else {
        $status1 = '<i style="color: #3DA83D;" class="fas fa-sync"> BELUM DIKERJAKAN</i>';
    }
    $do_maintenance_date = $row['do_maintenance_date'];
    if ($do_maintenance_date == NULL) {
        $do_maintenance_date = '-';
        // $do_maintenance_date = date("d M Y H:i:s", strtotime($do_maintenance_date));
    } else {
        $do_maintenance_date = date("d M Y H:i:s", strtotime($do_maintenance_date));
    }
    // 
    $edit = '<a href="update_complaint.php?id=' . $id . '">EDIT</a>';

    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = $contract_id2;
    $sub_array[] = $maintenance_date;
    $sub_array[] = $status1;
    $sub_array[] = $do_maintenance_date;
    $sub_array[]  = $i++;
    $data[] = $sub_array;
}

function get_all_data($conn)
{
    $query = "SELECT * FROM xray_maintenance";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($conn),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);
