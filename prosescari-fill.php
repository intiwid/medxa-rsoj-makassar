
<?php
session_start();
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-workload-fill.php';

$username = $_SESSION['username'];
$level = $_SESSION['level'];

// kolom untuk order by 
$columns = array('pk', 'pk', 'pat_name', 'pat_id', 'study_desc_pacsio', 'study_datetime');

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

$query = $query_base . ' WHERE ';

if ($_POST["is_date_search"] == "yes") {
    $from = date_create($_POST["from_study_datetime"]);
    $from_study_datetime = date_format($from, "Y-m-d H:i");

    $to = date_create($_POST["to_study_datetime"]);
    $to_study_datetime = date_format($to, "Y-m-d H:i");

    $query .= 'study.study_datetime BETWEEN "' . $from_study_datetime . '" AND "' . $to_study_datetime . '" AND ';
}

// kolom untuk mencari LIKE masing2 kolom (SEARCHING)
if (isset($_POST["search"]["value"])) {
    $query .= '
  (pat_id LIKE "%' . $_POST["search"]["value"] . '%" 
  OR pat_name LIKE "%' . $_POST["search"]["value"] . '%"
  OR study_desc_pacsio LIKE "%' . $_POST["search"]["value"] . '%"
  OR study.study_datetime LIKE "%' . $_POST["search"]["value"] . '%"
  )';
}

// jika modality disearch
if (isset($_POST['mods_in_study']) && $_POST['mods_in_study'] != "") {
    $mods_in_study = implode("','", $_POST['mods_in_study']);
    $mods_in_study = str_replace('\\', '\\\\', strtoupper($mods_in_study));
    $query .= "AND UPPER(mods_in_study) IN('" . $mods_in_study . "')
 ";
}

// jika keyword nama diketik
if (isset($_POST['pat_name']) && $_POST['pat_name'] != "") {
    $pat_name = strtoupper($_POST['pat_name']);
    $query .= 'AND UPPER(pat_name) LIKE "%' . $pat_name . '%"
 ';
}

// jika mrn diketik
if (isset($_POST['mrn']) && $_POST['mrn'] != "") {
    $mrn = strtoupper($_POST['mrn']);
    $query .= 'AND UPPER(pat_id) LIKE "%' . $mrn . '%"
 ';
}

// jika login radiology mencari berdasarkan fill, else mencari berdasarkan no foto
if ($level == 'radiology') {
    // jika fill
    if (isset($_POST['fill']) && $_POST['fill'] != "") {
        $fill = strtoupper($_POST['fill']);
        $query .= 'AND UPPER(xray_workload_fill.fill) LIKE "%' . $fill . '%"
  ';
    }
} else {
    // jika patientid / nofoto diketik
    if (isset($_POST['patientid']) && $_POST['patientid'] != "") {
        $patientid = strtoupper($_POST['patientid']);
        $query .= 'AND UPPER(patientid) LIKE "%' . $patientid . '%"
  ';
    }
}

// order by
if (isset($_POST["order"])) {
    $query .= 'GROUP BY xray_workload_fill.uid ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
 ';
} else {
    $query .= 'GROUP BY xray_workload_fill.uid ORDER BY study.study_datetime DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

// echo $query . $query1;

$number_filter_row = mysqli_num_rows(mysqli_query($conn_pacsio, $query));

$result = mysqli_query($conn_pacsio, $query . $query1);


$data = array();
$i = 1;
while ($row = mysqli_fetch_array($result)) {
    $pat_name = defaultValue($row['pat_name']);

    $study_iuid = defaultValue($row['study_iuid']);
    $mods_in_study = defaultValue($row['mods_in_study']);
    $study_datetime = defaultValueDateTime($row['study_datetime']);
    $study_desc_pacsio = defaultValue($row['study_desc_pacsio']);
    $pat_id = defaultValue($row['pat_id']);
    $status = styleStatus('approved', $study_iuid);
    $priority = defaultValue($row['priority']);
    $fromorder = $row['fromorder'];

    // kondisi ketika data dari simrs
    if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
        $badge = SIMRS;
    } else {
        $badge = '';
    }

    // kondisi ketika detail nama lihat detail query (radiographer, referral)
    $detail = '<a href="#" class="hasil-all penawaran-a" data-id="' . $row['study_iuid'] . '">' . removeCharacter($pat_name) . '</a>';

    // kondisi jika prioriry normal dan CITO
    if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
        $priority_style = PRIORITYNORMAL;
    } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
        $priority_style = PRIORITYCITO;
    } else {
        $priority_style = '';
    }

    $level =
        INOBITECFIRST . $study_iuid . INOBITECLAST;

    $sub_array = array();
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

function get_all_data($val_con, $val_query)
{
    $result = mysqli_query($val_con, $val_query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($conn_pacsio, $query_base),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);

mysqli_close($conn);
