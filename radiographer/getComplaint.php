<?php

require '../koneksi/koneksi.php';


$query = mysqli_query($conn, "SELECT * FROM xray_complaint ORDER BY id DESC LIMIT 1000");
$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
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

    $data[] = [
        "no" => $i,
        "report" => $edit,
        "complaint" => $complaint_date2->format('d M Y') . ' ' . $complaint_time,
        "person_call" => $person_call,
        "problem" => $problem2,
        "solve" => $solve_date2->format('d M Y') . ' ' . $solve_time . ' / ' . $solve_date2_to->format('d M Y') . ' ' . $solve_time_to,
        "explanation" => $explanation2
    ];
    $i++;
}

echo json_encode($data);
