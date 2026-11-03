<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../koneksi/koneksi.php';
require_once __DIR__ . '/../viewer-all.php';

$columns = ['id', 'contract_id', 'maintenance_date', 'status', 'do_maintenance_date'];

$where = [];

if (($_POST["is_date_search"] ?? "") == "yes") {
    $From = !empty($_POST["From"]) ? date_create($_POST["From"]) : false;
    $dateFrom = $From ? date_format($From, "Y-m-d") : date("Y-m-d");

    $to = !empty($_POST["to"]) ? date_create($_POST["to"]) : false;
    $dateto = $to ? date_format($to, "Y-m-d") : date("Y-m-d");
    $dateto2 = date('Y-m-d', strtotime("+1 day", strtotime($dateto)));
    $where[] = 'maintenance_date BETWEEN "' . $dateFrom . '" AND "' . $dateto2 . '"';
}

if (isset($_POST["search"]["value"]) && $_POST["search"]["value"] !== "") {
    $s = mysqli_real_escape_string($conn, $_POST["search"]["value"]);
    $where[] = '(maintenance_date LIKE "%' . $s . '%")';
}

$query = "SELECT * FROM xray_maintenance";
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
        $contract_id = $row['contract_id'] ?? '';
        $contract_id2 = '<a href="view_pdf_contractmaint.php?contract_id=' . $contract_id . '" target="_blank">' . $contract_id . '</a>';
        $maintenance_date = !empty($row['maintenance_date']) ? date("d M Y", strtotime($row['maintenance_date'])) : '-';
        $status = $row['status'] ?? 0;
        if ($status == 1) {
            $status1 = '<i style="color: #329ECF" class="fas fa-check-square"> SUDAH DIKERJAKAN</i>';
        } else {
            $status1 = '<i style="color: #3DA83D;" class="fas fa-sync"> BELUM DIKERJAKAN</i>';
        }
        $do_maint = $row['do_maintenance_date'] ?? null;
        if ($do_maint === null || $do_maint === '') {
            $do_maintenance_date = '-';
        } else {
            $do_maintenance_date = date("d M Y H:i:s", strtotime($do_maint));
        }

        $sub_array = [];
        $sub_array[] = $i;
        $sub_array[] = $contract_id2;
        $sub_array[] = $maintenance_date;
        $sub_array[] = $status1;
        $sub_array[] = $do_maintenance_date;
        $sub_array[]  = $i++;
        $data[] = $sub_array;
    }
}

if (!function_exists('get_all_data_maintenance')) {
    function get_all_data_maintenance($conn)
    {
        $query = "SELECT * FROM xray_maintenance";
        $result = mysqli_query($conn, $query);
        return $result ? mysqli_num_rows($result) : 0;
    }
}

$output = [
    "draw"    => intval($_POST["draw"] ?? 0),
    "recordsTotal"  =>  get_all_data_maintenance($conn),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
];

echo json_encode($output);