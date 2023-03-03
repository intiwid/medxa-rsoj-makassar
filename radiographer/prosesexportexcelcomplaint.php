<?php

require '../koneksi/koneksi.php';

session_start();

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=DataComplaint.xls");

header('Cache-Control: max-age=0');

$From = date_create($_POST["From"]);
$dateFrom = date_format($From, "Y-m-d");

$to = date_create($_POST["to"]);
$dateto = date_format($to, "Y-m-d");

$resultQuery = mysqli_query($conn, "SELECT * FROM xray_complaint WHERE complaint_date BETWEEN '$dateFrom' AND '$dateto' ORDER BY id DESC");
$num_rows = mysqli_num_rows($resultQuery);
// $row = mysqli_fetch_assoc($resultQuery);
$result = '';

$result .= 'Tanggal komplain ' . $_POST["From"] . ' - ' . $_POST["to"];
// ------
$i = 1;
$result .= '
    <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
              <thead class="thead1">
                <tr>
                    <th>No</th>
                    <th>Complaint Date & Time</th>
                    <th>Person Call</th>
                    <th>Problem</th>
                    <th>Solve Date & Time from/to</th>
                    <th>Explanation</th>
                </tr>
              </thead> ';
if ($num_rows > 0) {
  while ($row = mysqli_fetch_array($resultQuery)) {
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
    $result .= '
          <tr>  
            <td align="center">' . $i . ' - ' . $num_rows . '</td>
            <td align="center">' . $complaint_date2->format('d M Y') . ' ' . $complaint_time . '</td> 
            <td align="center">' . $person_call . '</td>  
            <td align="center">' . $problem . '</td>
            <td width="300" align="center">' . $solve_date2->format('d M Y') . ' ' . $solve_time . ' / ' . $solve_date2_to->format('d M Y') . ' ' . $solve_time_to . '</td>
            <td align="center">' . $explanation . '</td>
          </tr>';
    $i++;
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
