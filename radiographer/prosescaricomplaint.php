<?php
//fetch.php
require '../koneksi/koneksi.php';

$columns = array('id', 'complaint_date', 'complaint_time', 'person_call', 'problem', 'solve_date', 'solve_date_to', 'solve_time', 'solve_time_to', 'explanation');

$query = "SELECT * FROM xray_complaint WHERE ";

if ($_POST["is_date_search"] == "yes") {
  $From = date_create($_POST["From"]);
  $dateFrom = date_format($From, "Y-m-d");

  $to = date_create($_POST["to"]);
  $dateto = date_format($to, "Y-m-d");
  $query .= 'complaint_date BETWEEN "' . $dateFrom . '" AND "' . $dateto . '" AND ';
}

if (isset($_POST["search"]["value"])) {
  $query .= '
  (id LIKE "%' . $_POST["search"]["value"] . '%"
  OR complaint_date LIKE "%' . $_POST["search"]["value"] . '%"
  OR complaint_time LIKE "%' . $_POST["search"]["value"] . '%" 
  OR person_call LIKE "%' . $_POST["search"]["value"] . '%" 
  OR problem LIKE "%' . $_POST["search"]["value"] . '%" 
  OR solve_date LIKE "%' . $_POST["search"]["value"] . '%" 
  OR solve_date_to LIKE "%' . $_POST["search"]["value"] . '%"
  OR solve_time LIKE "%' . $_POST["search"]["value"] . '%" 
  OR solve_time_to LIKE "%' . $_POST["search"]["value"] . '%"
  OR explanation LIKE "%' . $_POST["search"]["value"] . '%")
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
  $complaint_date = $row['complaint_date'];
  $complaint_date2 = new DateTime($complaint_date);
  $complaint_time = $row['complaint_time'];
  $person_call = $row['person_call'];
  $problem = $row['problem'];
  $solve_date = $row['solve_date'];
  $solve_date2 = new DateTime($solve_date);
  $solve_date_to = $row['solve_date_to'];
  $solve_date2_to = new DateTime($solve_date_to);
  $solve_time = $row['solve_time'];
  $solve_time_to = $row['solve_time_to'];
  $explanation = $row['explanation'];
  // $bday = new DateTime($birth_date);
  // $today = new DateTime(date('y-m-d'));
  // $diff = $today->diff($bday);


  $problem2 = '<a href="#" class="edit-record3 penawaran-a" data-id="' . $id . '" ><i class="fas fa-info-circle fa-lg"></i></a>';
  $explanation2 = '<a href="#" class="edit-record2 penawaran-a" data-id="' . $id . '"><i class="fas fa-info-circle fa-lg"></i></a>';
  $edit = '<a href="update_complaint.php?id=' . $id . '">EDIT</a>';


  $sub_array = array();
  $sub_array[] = $i;
  $sub_array[] = $edit;
  $sub_array[] = $complaint_date2->format('d M Y') . ' ' . $complaint_time;
  $sub_array[] = $person_call;
  $sub_array[] = $problem2;
  $sub_array[] = $solve_date2->format('d M Y') . ' ' . $solve_time . ' / ' . $solve_date2_to->format('d M Y') . ' ' . $solve_time_to;
  $sub_array[] = $explanation2;
  $i++;
  $data[] = $sub_array;
}

function get_all_data($conn)
{
  $query = "SELECT * FROM xray_complaint";
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
