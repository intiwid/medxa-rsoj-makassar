<?php

require '../koneksi/koneksi.php';

session_start();

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=DataMaintenance.xls");

header('Cache-Control: max-age=0');

$From = date_create($_POST["From"]);
$dateFrom = date_format($From, "Y-m-d");

$to = date_create($_POST["to"]);
$dateto = date_format($to, "Y-m-d");

$resultQuery = mysqli_query($conn, "SELECT * FROM xray_maintenance WHERE maintenance_date BETWEEN '$dateFrom' AND '$dateto' ORDER BY id DESC");
$num_rows = mysqli_num_rows($resultQuery);
// $row = mysqli_fetch_assoc($resultQuery);
$result = '';

$result .= 'Tanggal Maintenance ' . $_POST["From"] . ' - ' . $_POST["to"];
// ------
$i = 1;
$result .= '
    <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
              <thead class="thead1">
                <tr>
                    <th>No</th>
                    <th>No Contract</th>
                    <th>Maintenance Schedule</th>
                    <th>Status</th>
                    <th>Maintenance Date/to</th>
                </tr>
              </thead> ';
if ($num_rows > 0) {
  while ($row = mysqli_fetch_array($resultQuery)) {
    $id = $row['id'];
    $contract_id = $row['contract_id'];
    $maintenance_date = $row['maintenance_date'];
    $maintenance_date2 = new DateTime($maintenance_date);
    $status = $row['status'];
    $do_maintenance_date = $row['do_maintenance_date'];
    $do_maintenance_date2 = new DateTime($do_maintenance_date);
    if ($status == 1) {
      $status2 = "SUDAH DIKERJAKAN";
    } else {
      $status2 = "BELUM DIKERJAKAN";
    }
    // $complaint_time = $row['complaint_time'];
    // $person_call = $row['person_call'];
    // $problem = $row['problem'];
    // $solve_date = $row['solve_date'];
    // $solve_date2 = new DateTime($solve_date);
    // $solve_date_to = $row['solve_date_to'];
    // $solve_date2_to = new DateTime($solve_date_to);
    // $solve_time = $row['solve_time'];
    // $solve_time_to = $row['solve_time_to'];
    // $explanation = $row['explanation'];
    // $bday = new DateTime($birth_date);
    // $today = new DateTime(date('y-m-d'));
    // $diff = $today->diff($bday);
    if ($do_maintenance_date) {
      $result .= '
          <tr>  
            <td align="center">' . $i . '</td>
            <td align="center">' . $contract_id . '</td>
            <td align="center">' . $maintenance_date2->format('d M Y') . '</td> 
            <td align="center">' . $status2 . '</td>
            <td align="center">' . $do_maintenance_date2->format('d M Y') . '</td>
          </tr>';
      $i++;
    } else {
      $result .= '  
      <tr>  
        <td align="center">' . $i . '</td>
        <td align="center">' . $contract_id . '</td>
        <td align="center">' . $maintenance_date2->format('d M Y') . '</td> 
        <td align="center">' . $status2 . '</td>
        <td align="center"> - </td>
      </tr>';
      $i++;
    }
  }
} else {
  $result .= '
      <tr>
      <td colspan="5">No Item Found</td>
      </tr>';
}
$result .= '</table>';
echo $result;
exit;
