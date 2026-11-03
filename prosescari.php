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
require_once __DIR__ . '/model/query-base-dokter-radiology.php';
require_once __DIR__ . '/model/query-base-take-envelope.php';

$username = $_SESSION['username'] ?? '';
$level = $_SESSION['level'] ?? '';

// kolom untuk order by 
$columns = ['pk', 'pk', 'status', 'pat_name', 'pat_id', 'patientid', 'pat_birthdate', 'pat_sex', 'study_desc_pacsio', 'pk', 'mods_in_study', 'named', 'name_dep', 'dokrad_name', 'radiographer_name', 'study_datetime', 'approved_at', 'pk'];

$pk = '';
if ($level === 'radiology') {
  $res_dokrad = mysqli_query($conn, "SELECT pk FROM $table_dokter_radiology WHERE username = '$username'");
  $row_dokrad = $res_dokrad ? mysqli_fetch_assoc($res_dokrad) : null;
  $pk = $row_dokrad['pk'] ?? '';
}

$query_base = "SELECT 
              pat_id,
              pat_name,
              pat_sex,
              pat_birthdate,
              study_iuid,
              study_datetime,
              study_desc_pacsio,
              mods_in_study,
              study.updated_time,
              status,
              approved_at,
              pk_dokter_radiology,
              patientid AS no_foto,
              named,
              dokradid,
              dokrad_name,
              name_dep,
              radiographer_name,
              priority,
              fromorder
              FROM $table_patient
              JOIN $table_study
              ON patient.pk = study.patient_fk
              JOIN $table_workload
              ON study.study_iuid = xray_workload.uid
              LEFT JOIN $table_order
              ON xray_order.uid = xray_workload.uid";

$where = [];
if ($level === 'radiology') {
  $where[] = "xray_workload.status = 'approved'";
  $where[] = "xray_workload.pk_dokter_radiology = '$pk'";
}

if (($_POST["is_date_search"] ?? "") == "yes") {
  $from = !empty($_POST["from_study_datetime"]) ? date_create($_POST["from_study_datetime"]) : false;
  $from_study_datetime = $from ? date_format($from, "Y-m-d H:i") : date("Y-m-d 00:00");

  $to = !empty($_POST["to_study_datetime"]) ? date_create($_POST["to_study_datetime"]) : false;
  $to_study_datetime = $to ? date_format($to, "Y-m-d H:i") : date("Y-m-d 23:59");

  $where[] = 'study.study_datetime BETWEEN "' . $from_study_datetime . '" AND "' . $to_study_datetime . '"';
} else {
  $date = date('Y-m-d 23:59', strtotime("-30 days"));
  $date2 = date('Y-m-d 23:59');

  $where[] = 'study.study_datetime BETWEEN "' . $date . '" AND "' . $date2 . '"';
}

// kolom untuk mencari LIKE masing2 kolom (SEARCHING)
if (isset($_POST["search"]["value"]) && $_POST["search"]["value"] !== "") {
  $search_val = mysqli_real_escape_string($conn_pacsio, $_POST["search"]["value"]);
  $where[] = '(pat_id LIKE "%' . $search_val . '%" 
  OR patientid LIKE "%' . $search_val . '%" 
  OR pat_name LIKE "%' . $search_val . '%" 
  OR pat_birthdate LIKE "%' . $search_val . '%"
  OR pat_sex LIKE "%' . $search_val . '%"
  OR study_desc_pacsio LIKE "%' . $search_val . '%"
  OR mods_in_study LIKE "%' . $search_val . '%" 
  OR named LIKE "%' . $search_val . '%"
  OR radiographer_name LIKE "%' . $search_val . '%"
  OR study.study_datetime LIKE "%' . $search_val . '%"
  OR approved_at LIKE "%' . $search_val . '%")';
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
  $pat_name_f = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['pat_name']));
  $where[] = 'UPPER(pat_name) LIKE "%' . $pat_name_f . '%"';
}

// jika mrn diketik
if (isset($_POST['mrn']) && $_POST['mrn'] != "") {
  $mrn_f = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['mrn']));
  $where[] = 'UPPER(pat_id) LIKE "%' . $mrn_f . '%"';
}

// jika login radiology mencari berdasarkan fill, else mencari berdasarkan no foto
if ($level == 'radiology') {
  if (isset($_POST['fill']) && $_POST['fill'] != "") {
    $fill_f = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['fill']));
    $where[] = 'UPPER(fill) LIKE "%' . $fill_f . '%"';
  }
} else {
  if (isset($_POST['patientid']) && $_POST['patientid'] != "") {
    $patientid_f = mysqli_real_escape_string($conn_pacsio, strtoupper($_POST['patientid']));
    $where[] = 'UPPER(patientid) LIKE "%' . $patientid_f . '%"';
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
  $query .= 'ORDER BY ' . $columns[$col_index] . ' ' . $col_dir . ' ';
} else {
  $query .= 'ORDER BY study.study_datetime DESC ';
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
    $pat_sex = styleSex($row['pat_sex'] ?? '');
    $pat_birthdate = diffDate($row['pat_birthdate'] ?? '');
    $study_iuid = defaultValue($row['study_iuid'] ?? '');
    $study_datetime = defaultValueDateTime($row['study_datetime'] ?? '');
    $study_desc_pacsio = defaultValue($row['study_desc_pacsio'] ?? '');
    $mods_in_study = defaultValue($row['mods_in_study'] ?? '');
    $updated_time = defaultValueDateTime($row['updated_time'] ?? '');
    $pat_id = defaultValue($row['pat_id'] ?? '');
    $no_foto = defaultValue($row['no_foto'] ?? '');
    $name_dep = defaultValue($row['name_dep'] ?? '');
    $named = defaultValue($row['named'] ?? '');
    $radiographer_name = defaultValue($row['radiographer_name'] ?? '');
    $dokrad_name = defaultValue($row['dokrad_name'] ?? '');
    $dokradid = $row['dokradid'] ?? '';
    $priority = defaultValue($row['priority'] ?? '');
    $row_status = $row['status'] ?? '';
    $status = styleStatus($row_status, $study_iuid);
    $fromorder = $row['fromorder'] ?? '';
    $approved_at = defaultValueDateTime($row['approved_at'] ?? '');
    $spendtime = spendTime($study_datetime, $approved_at, $row_status);
    $pk_dokter_radiology = $row['pk_dokter_radiology'] ?? '';

    //kondisi status change doctor
    if ($row_status == 'approved') {
      $workload_status = 'approved';
    } else {
      $workload_status = 'waiting';
    }

    // kondisi ketika dokter belum ada menggunakan icon berbeda
    if (empty($pk_dokter_radiology) && empty($dokradid)) {
      $icon_change_doctor = CHANGEDOCTORICONNO;
    } else {
      $icon_change_doctor = CHANGEDOCTORICONYES;
    }

    $res_envelope = mysqli_query(
      $conn,
      "SELECT is_taken, name, created_at FROM $table_take_envelope WHERE uid = '$study_iuid'"
    );
    $row_envelope = $res_envelope ? mysqli_fetch_assoc($res_envelope) : null;
    $is_taken = $row_envelope['is_taken'] ?? null;
    $name_envelope = $row_envelope['name'] ?? '';
    $created_at_envelope = $row_envelope['created_at'] ?? '';

    // kondisi ketika hasil expertise belum diambil menggunakan icon berbeda
    if ($row_status == 'waiting') {
      $icon_get_expertise = GETEXPERTISEICONWAITING;
      $href_get_expertise = GETEXPERTISEHREFNO;
    } else if (($is_taken === null || $is_taken == 0) && $row_status == 'approved') {
      $icon_get_expertise = GETEXPERTISEICONNO;
      $href_get_expertise = GETEXPERTISEHREFYES . $study_iuid;
    } else {
      $icon_get_expertise = GETEXPERTISEICONYES;
      $href_get_expertise = GETEXPERTISEHREFYES . $study_iuid;
    }

    // kondisi ketika detail nama lihat detail query (radiographer, referral)
    $detail = '<a href="#" class="hasil-all penawaran-a" data-id="' . $study_iuid . '">' . mb_convert_encoding(removeCharacter($pat_name), 'UTF-8', 'ISO-8859-1') . '</a>';

    // kondisi session level ketika login
    $level_session = $_SESSION['level'] ?? '';
    // ketika login radiology
    if ($level_session == 'radiology') {
      $detail = '<a href="workload-edit.php?uid=' . $study_iuid . '" class="penawaran-a">' . mb_convert_encoding(removeCharacter($pat_name), 'UTF-8', 'ISO-8859-1') . '</a>';
      $level_action =
        RADIANTFIRST . $study_iuid . RADIANTLAST .
        DICOMFIRST . $study_iuid . DICOMLAST .
        OHIFNEWFIRST . $study_iuid . OHIFNEWLAST .
        CHANGEDOCTORFIRST . "'$study_iuid', '$dokradid', '$workload_status'" . CHANGEDOCTORLAST . $icon_change_doctor . CHANGEDOCTORVERYLAST .
        EDITWORKLOADFIRST . $study_iuid . EDITWORKLOADLAST;
    } else if ($level_session == 'radiographer') {
      // kondisi ketika xray_workload masuk dari trigger
      if ($status != '-') {
        // ketika modality MRI 
        if ($mods_in_study == 'MR' || $mods_in_study == 'PR\\MR' || $mods_in_study == 'SC\\PR\\MR') {
          $viewer = DICOMFIRST . $study_iuid . DICOMLAST . OHIFNEWFIRST . $study_iuid . OHIFNEWLAST;
        } else {
          $viewer = DICOMFIRST . $study_iuid . DICOMLAST . OHIFNEWFIRST . $study_iuid . OHIFNEWLAST . HTMLFIRST . $study_iuid . HTMLLAST;
        }
        $level_action = $viewer . RADIANTFIRST . $study_iuid . RADIANTLAST . EDITPASIENFIRST . $study_iuid . EDITPASIENLAST .
          CHANGEDOCTORFIRST . "'$study_iuid', '$dokradid', '$workload_status'" . CHANGEDOCTORLAST . $icon_change_doctor . CHANGEDOCTORVERYLAST .
          SENDDICOMFIRST . $study_iuid . SENDDICOMLAST;
      } else {
        // kondisi ketika xray_workload tidak masuk dari trigger
        $level_action = OHIFOLDFIRST . $study_iuid . OHIFOLDLAST;
      }
    } else if ($level_session == 'refferal') {
      // ketika modality MRI
      if ($mods_in_study == 'MR' || $mods_in_study == 'PR\\MR' || $mods_in_study == 'SC\\PR\\MR') {
        $level_action = DICOMFIRST . $study_iuid . DICOMLAST;
      } else {
        $level_action = OHIFNEWFIRST . $study_iuid . OHIFNEWLAST . HTMLFIRST . $study_iuid . HTMLLAST;
      }
    } else {
      $level_action = '-';
    }

    // kondisi ketika data dari simrs
    if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
      $badge = SIMRS;
    } else {
      $badge = '';
    }

    // kondisi jika prioriry normal dan CITO
    if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
      $priority_style = PRIORITYNORMAL;
    } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
      $priority_style = PRIORITYCITO;
    } else {
      $priority_style = '';
    }

    // kondisi mencari ditabel dokter radiology
    $res_dokrad_loop = !empty($pk_dokter_radiology) ? mysqli_query(
      $conn,
      "SELECT CONCAT(xray_dokter_radiology.dokrad_name,' ',xray_dokter_radiology.dokrad_lastname) AS dokrad_fullname
        FROM $table_dokter_radiology 
        WHERE pk = '$pk_dokter_radiology'"
    ) : false;
    $row_dokrad = $res_dokrad_loop ? mysqli_fetch_assoc($res_dokrad_loop) : null;

    if ($row_status == 'waiting' || $row_status == '') {
      // jika status waiting kalo ada dokradid di xray_order tampilkan di xray_order
      $dokrad_name = defaultValue($row['dokrad_name'] ?? '');
    } else if ($row_status == 'approved') {
      // jika status approved ambil data dari pk_dokter_radiology tabel xray_dokter_radiology
      $dokrad_name = defaultValue($row_dokrad['dokrad_fullname'] ?? '');
    }

    $sub_array = [];
    $sub_array[] = $i;
    $sub_array[] = $detail . '&nbsp;' . $priority_style;
    $sub_array[] = $pat_id;
    $sub_array[] = $status . '&nbsp;' . $badge;
    $sub_array[] =
      PDFFIRST . $study_iuid . PDFLAST .
      $level_action;
    $sub_array[] = $no_foto;
    $sub_array[] = $pat_birthdate;
    $sub_array[] = $pat_sex;
    $sub_array[] = mb_convert_encoding($study_desc_pacsio, 'UTF-8', 'ISO-8859-1');
    $sub_array[] = READMORESERIESFIRST . $study_iuid . READMORESERIESLAST;
    $sub_array[] = $mods_in_study;
    $sub_array[] = $named;
    $sub_array[] = $name_dep;
    $sub_array[] = $dokrad_name;
    $sub_array[] = $radiographer_name;
    $sub_array[] = $study_datetime;
    $sub_array[] = $approved_at;
    $sub_array[] = $spendtime;
    $sub_array[]  = $i++;
    $data[] = $sub_array;
  }
}

if (!function_exists('get_all_data')) {
  function get_all_data($val_con, $val_query)
  {
    $res = mysqli_query($val_con, $val_query);
    $row = $res ? mysqli_fetch_assoc($res) : null;
    return $row['total_row'] ?? 0;
  }
}

$output = [
  "draw"    => intval($_POST["draw"] ?? 0),
  "recordsTotal"  =>  get_all_data($conn_pacsio, "SELECT count(*) AS total_row FROM $table_patient JOIN $table_study ON patient.pk = study.patient_fk"),
  "recordsFiltered" => $number_filter_row,
  "data"    => $data
];

echo json_encode($output);

// // mysqli_close($conn);