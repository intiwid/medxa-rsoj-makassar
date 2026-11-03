<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../koneksi/koneksi.php';

$columns = ['id', 'complaint_date', 'complaint_time', 'person_call', 'problem', 'solve_date', 'solve_date_to', 'solve_time', 'solve_time_to', 'explanation'];

$where = [];

if (($_POST["is_date_search"] ?? "") == "yes") {
  $From = !empty($_POST["From"]) ? date_create($_POST["From"]) : false;
  $dateFrom = $From ? date_format($From, "Y-m-d") : date("Y-m-d");

  $to = !empty($_POST["to"]) ? date_create($_POST["to"]) : false;
  $dateto = $to ? date_format($to, "Y-m-d") : date("Y-m-d");
  $where[] = 'complaint_date BETWEEN "' . $dateFrom . '" AND "' . $dateto . '"';
}

if (isset($_POST["search"]["value"]) && $_POST["search"]["value"] !== "") {
  $s = mysqli_real_escape_string($conn, $_POST["search"]["value"]);
  $where[] = '(id LIKE "%' . $s . '%"
  OR complaint_date LIKE "%' . $s . '%"
  OR complaint_time LIKE "%' . $s . '%" 
  OR person_call LIKE "%' . $s . '%" 
  OR problem LIKE "%' . $s . '%" 
  OR solve_date LIKE "%' . $s . '%" 
  OR solve_date_to LIKE "%' . $s . '%"
  OR solve_time LIKE "%' . $s . '%" 
  OR solve_time_to LIKE "%' . $s . '%"
  OR explanation LIKE "%' . $s . '%")';
}

$query = "SELECT * FROM xray_complaint";
if (!empty($where)) {
  $query .= " WHERE " . implode(" AND ", $where);
}

if (isset($_POST["order"][0]["column"]) && isset($columns[$_POST['order'][0]['column']])) {
  $col_index = $_POST['order'][0]['column'];
  $col_dir = (isset($_POST['order'][0]['dir']) && strtolower($_POST['order'][0]['dir']) === 'asc') ? 'ASC' : 'DESC';
  $query .= ' ORDER BY ' . $columns[$col_index] . ' ' . $col_dir . ' ';
} else {
  $query .= ' ORDER BY id DESC ';
}

$query1 = '';
if (isset($_POST["length"]) && $_POST["length"] != -1) {
  $start = intval($_POST['start'] ?? 0);
  $length = intval($_POST['length']);
  $query1 = 'LIMIT ' . $start . ', ' . $length;
}

$filter_res = mysqli_query($conn, $query);
$number_filter_row = $filter_res ? mysqli_num_rows($filter_res) : 0;

$result = mysqli_query($conn, $query . $query1);

$data = [];
$i = 1;
if ($result) {
  while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'] ?? '';
    $complaint_date = !empty($row['complaint_date']) ? date("d M Y", strtotime($row['complaint_date'])) : '-';
    $complaint_time = $row['complaint_time'] ?? '';
    $person_call = $row['person_call'] ?? '';
    $solve_date_val = !empty($row['solve_date']) ? date("d M Y", strtotime($row['solve_date'])) : '-';
    $solve_date_to_val = !empty($row['solve_date_to']) ? date("d M Y", strtotime($row['solve_date_to'])) : '-';
    $solve_time = $row['solve_time'] ?? '';
    $solve_time_to = $row['solve_time_to'] ?? '';

    $problem2 = '<a href="#" class="edit-record3 penawaran-a" data-id="' . $id . '" ><i class="fas fa-info-circle fa-lg"></i></a>';
    $explanation2 = '<a href="#" class="edit-record2 penawaran-a" data-id="' . $id . '"><i class="fas fa-info-circle fa-lg"></i></a>';
    $edit = '<a href="update_complaint.php?id=' . $id . '">EDIT</a>';

    $sub_array = [];
    $sub_array[] = $i;
    $sub_array[] = $edit;
    $sub_array[] = $complaint_date . ' ' . $complaint_time;
    $sub_array[] = $person_call;
    $sub_array[] = $problem2;
    $sub_array[] = $solve_date_val . ' ' . $solve_time . ' / ' . $solve_date_to_val . ' ' . $solve_time_to;
    $sub_array[] = $explanation2;
    $i++;
    $data[] = $sub_array;
  }
}

if (!function_exists('get_all_data_complaint')) {
  function get_all_data_complaint($conn)
  {
    $query = "SELECT * FROM xray_complaint";
    $result = mysqli_query($conn, $query);
    return $result ? mysqli_num_rows($result) : 0;
  }
}

$output = [
  "draw"    => intval($_POST["draw"] ?? 0),
  "recordsTotal"  =>  get_all_data_complaint($conn),
  "recordsFiltered" => $number_filter_row,
  "data"    => $data
];

echo json_encode($output);