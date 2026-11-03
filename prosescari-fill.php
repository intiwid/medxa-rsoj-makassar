<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/koneksi/koneksi.php';
require_once __DIR__ . '/viewer-all.php';
require_once __DIR__ . '/default-value.php';
require_once __DIR__ . '/model/query-base-workload.php';
require_once __DIR__ . '/model/query-base-order.php';
require_once __DIR__ . '/model/query-base-study.php';
require_once __DIR__ . '/model/query-base-patient.php';
require_once __DIR__ . '/model/query-base-workload-fill.php';

$username = $_SESSION['username'] ?? '';
$level = $_SESSION['level'] ?? '';

// kolom untuk order by 
$columns = ['pk', 'pk', 'pat_name', 'pat_id', 'study_desc_pacsio', 'study_datetime'];

$query_base = "SELECT 
              pat_id,
              pat_name,
              study_iuid,
              study_datetime,
              study_desc_pacsio,
              mods_in_study,
              status,
              fromorder,
              priority,
              study.updated_time
              FROM $table_patient
              JOIN $table_study
              ON patient.pk = study.patient_fk
              JOIN $table_workload
              ON study.study_iuid = xray_workload.uid
              JOIN $table_workload_fill
              ON xray_workload.uid = xray_workload_fill.uid
              LEFT JOIN $table_order
              ON xray_order.uid = xray_workload.uid";

$where = [];

if (($_POST["is_date_search"] ?? "") == "yes") {
    $from = !empty($_POST["from_study_datetime"]) ? date_create($_POST["from_study_datetime"]) : false;
    $from_study_datetime = $from ? date_format($from, "Y-m-d H:i") : date("Y-m-d 00:00");

    $to = !empty($_POST["to_study_datetime"]) ? date_create($_POST["to_study_datetime"]) : false;
    $to_study_datetime = $to ? date_format($to, "Y-m-d H:i") : date("Y-m-d 23:59");

    $where[] = 'study.study_datetime BETWEEN "' . $from_study_datetime . '" AND "' . $to_study_datetime . '"';
}

// kolom untuk mencari LIKE masing2 kolom (SEARCHING)
if (isset($_POST["search"]["value"]) && $_POST["search"]["value"] !== "") {
    $s = mysqli_real_escape_string($conn_pacsio, $_POST["search"]["value"]);
    $where[] = '(pat_id LIKE "%' . $s . '%" 
  OR pat_name LIKE "%' . $s . '%"
  OR study_desc_pacsio LIKE "%' . $s . '%"
  OR study.study_datetime LIKE "%' . $s . '%")';
}

// jika modality disearch
if (isset($_POST['mods_in_study']) && is_array($_POST['mods_in_study']) && !empty($_POST['mods_in_study'])) {
    $escaped_mods = array_map(function($m) use ($conn_pacsio) {
        return mysqli_real_escape_string($conn_pacsio, strtoupper(str_replace('\\', '\\\\', $m)));
    }, $_POST['mods_in_study']);
    $mods_in_study = implode("','", $escaped_mods);
    $where[] = "UPPER(mods_in_study) IN('" . $mods_in_study . "')";
}

// jika keyword nama diketik
if (isset($_POST['pat_name']) && $_POST['pat_name'] != "") {
    $pat_name = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['pat_name']));
    $where[] = 'UPPER(pat_name) LIKE "%' . $pat_name . '%"';
}

// jika mrn diketik
if (isset($_POST['mrn']) && $_POST['mrn'] != "") {
    $mrn = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['mrn']));
    $where[] = 'UPPER(pat_id) LIKE "%' . $mrn . '%"';
}

// jika login radiology mencari berdasarkan fill, else mencari berdasarkan no foto
if ($level == 'radiology') {
    if (isset($_POST['fill']) && $_POST['fill'] != "") {
        $fill = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['fill']));
        $where[] = 'UPPER(xray_workload_fill.fill) LIKE "%' . $fill . '%"';
    }
} else {
    if (isset($_POST['patientid']) && $_POST['patientid'] != "") {
        $patientid = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['patientid']));
        $where[] = 'UPPER(patientid) LIKE "%' . $patientid . '%"';
    }
}

$query = $query_base;
if (!empty($where)) {
    $query .= ' WHERE ' . implode(' AND ', $where) . ' ';
}

// order by
if (isset($_POST["order"][0]["column"]) && isset($columns[$_POST['order'][0]['column']])) {
    $col_index = $_POST['order'][0]['column'];
    $col_dir = (isset($_POST['order'][0]['dir']) && strtolower($_POST['order'][0]['dir']) === 'asc') ? 'ASC' : 'DESC';
    $query .= 'GROUP BY xray_workload_fill.uid ORDER BY ' . $columns[$col_index] . ' ' . $col_dir . ' ';
} else {
    $query .= 'GROUP BY xray_workload_fill.uid ORDER BY study.study_datetime DESC ';
}

$query1 = '';
if (isset($_POST["length"]) && $_POST["length"] != -1) {
    $start = intval($_POST['start'] ?? 0);
    $length = intval($_POST['length']);
    $query1 = 'LIMIT ' . $start . ', ' . $length;
}

$filter_res = mysqli_query($conn_pacsio, $query);
$number_filter_row = $filter_res ? mysqli_num_rows($filter_res) : 0;

$result = mysqli_query($conn_pacsio, $query . $query1);

$data = [];
$i = 1;
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $pat_name = defaultValue($row['pat_name'] ?? '');
        $study_iuid = defaultValue($row['study_iuid'] ?? '');
        $mods_in_study = defaultValue($row['mods_in_study'] ?? '');
        $study_datetime = defaultValueDateTime($row['study_datetime'] ?? '');
        $study_desc_pacsio = defaultValue($row['study_desc_pacsio'] ?? '');
        $pat_id = defaultValue($row['pat_id'] ?? '');
        $status = styleStatus('approved', $study_iuid);
        $priority = defaultValue($row['priority'] ?? '');
        $fromorder = $row['fromorder'] ?? '';

        // kondisi ketika data dari simrs
        if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
            $badge = SIMRS;
        } else {
            $badge = '';
        }

        // kondisi ketika detail nama lihat detail query (radiographer, referral)
        $detail = '<a href="#" class="hasil-all penawaran-a" data-id="' . $study_iuid . '">' . removeCharacter($pat_name) . '</a>';

        // kondisi jika prioriry normal dan CITO
        if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
            $priority_style = PRIORITYNORMAL;
        } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
            $priority_style = PRIORITYCITO;
        } else {
            $priority_style = '';
        }

        $sub_array = [];
        $sub_array[] = $i;
        $sub_array[] = $status . '&nbsp;' . $badge;
        $sub_array[] = $detail . '&nbsp;' . $priority_style;
        $sub_array[] = $pat_id;
        $sub_array[] = $study_desc_pacsio;
        $sub_array[] = $mods_in_study;
        $sub_array[] = $study_datetime;
        $sub_array[]  = $i++;
        $data[] = $sub_array;
    }
}

if (!function_exists('get_all_data_fill')) {
    function get_all_data_fill($val_con, $val_query)
    {
        $result = mysqli_query($val_con, $val_query);
        return $result ? mysqli_num_rows($result) : 0;
    }
}

$output = [
    "draw"    => intval($_POST["draw"] ?? 0),
    "recordsTotal"  =>  get_all_data_fill($conn_pacsio, $query_base),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
];

echo json_encode($output);

// // mysqli_close($conn);