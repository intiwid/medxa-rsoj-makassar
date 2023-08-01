<?php

require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-mwl-item.php';

$query = mysqli_query(
    $conn_mppsio,
    "SELECT pat_name, 
    pat_sex, 
    pat_id,
    pat_id_issuer,
    pat_birthdate, 
    accession_no, 
    modality, 
    start_datetime, 
    $select_mwl_item
    FROM $table_mwl_item
    JOIN patient
    ON mwl_item.patient_fk = patient.pk
    ORDER BY mwl_item.created_time DESC"
);
$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
    $pat_name = str_replace('^^^^', '', defaultValue($row['pat_name']));

    $sex = defaultValue($row['pat_sex']);
    if ($sex == 'M') {
        $pat_sex = '<i style="color: blue;" class="fas fa-mars"> M</i>';
    } else if ($sex == 'L') {
        $pat_sex = '<i style="color: blue;" class="fas fa-mars"> L</i>';
    } else if ($sex == 'P') {
        $pat_sex = '<i style="color: #ff637e;" class="fas fa-venus"> P</i>';
    } else if ($sex == 'F') {
        $pat_sex = '<i style="color: #ff637e;" class="fas fa-venus"> F</i>';
    } else if ($sex == 'O') {
        $pat_sex = '<i class="fas fa-genderless"> O</i>';
    } else {
        $pat_sex = '-';
    }

    $detail = '<a href="#" class="exam-room penawaran-a" data-id="' . $row['study_iuid_mppsio'] . '">' . $pat_name . '</a>';

    $delete = '<a style="text-decoration:none;" 
                    class="ahref-edit" href="deleteexam.php?study_iuid=' . $row['study_iuid_mppsio'] . '&pat_name=' . $pat_name . '" 
                    onclick=\'return confirm("Delete data?");\'>
                    <span class="btn red lighten-1 btn-intiwid1">
                        <i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i>
                    </span>
                </a>';

    $data[] = [
        "no" => $i,
        "action" => $delete,
        "pat_name" => $detail,
        "pat_id" => defaultValue($row['pat_id']),
        "pat_id_issuer" => defaultValue($row['pat_id_issuer']),
        "accession_no" => defaultValue($row['accession_no']),
        "pat_birthdate" => defaultValueDate($row['pat_birthdate']),
        "pat_sex" => $pat_sex,
        "modality" => defaultValue($row['modality']),
        "created_time" => defaultValueDateTime($row['created_time']),
        "start_datetime" => defaultValueDateTime($row['start_datetime'])
    ];
    $i++;
}

echo json_encode($data);

mysqli_close($conn);
