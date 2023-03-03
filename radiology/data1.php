<?php 

require '../koneksi/koneksi.php';

session_start();

// Tambahkan table
  
  //query menampilkan data
    $date = date('Y-m-d');

    $username = $_SESSION['username'];

  $data_dicom = mysqli_query($conn,"SELECT * 
                        FROM xray_dokter_radiology 
                      WHERE username = '$username'");
  $row = mysqli_fetch_assoc($data_dicom);
  $username3 = $row['dokradid'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $sql = mysqli_query($conn, "SELECT * 
                  FROM xray_workload 
                  WHERE dokradid = '$username3' 
                  AND approve_date BETWEEN '$start_date' AND '$end_date' 
                  ORDER BY approve_time DESC");
    $no = 1;
    echo "Query Date From '$start_date' To '$end_date' Run Report Date : $date";
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>NO.</th>
          <th>UID</th>
          <th>ACC NUMBER</th>
          <th>MRN</th>
          <th>PATIENT NAME</th>
          <th>SEX</th>
          <th>DEPARTMENT NAME</th>
          <th>MODALITY</th>
          <th>PROCEDUR</th>
          <th>REFERRAL PHYSICIAN</th>
          <th>RADIOLOGY PHYSICIAN</th>
          <th>FILL</th>
          <th>COMPLETE TIME</th>
          <th>APPROVE TIME</th>
          ';
    echo  '</tr>';
      while($data = mysqli_fetch_assoc($sql)){
        echo '<tr>';
        echo '<td>'.$no.'</td>
            <td  style="width:285px;">'.$data['uid'].'</td>
              <td>'.$data['acc'].'</td>
              <td>'.$data['mrn'].'</td>
              <td>'.$data['name'].' '.$data['lastname'].' </td>
              <td>'.$data['sex'].'</td>
              <td>'.$data['name_dep'].'</td>
              <td>'.$data['xray_type_code'].'</td>
              <td>'.$data['prosedur'].'</td>
              <td>'.$data['named'].' '.$data['lastnamed'].'</td>
              <td>'.$data['dokrad_name'].' '.$data['dokrad_lastname'].'</td>
              <td>'.$data['fill'].'</td>
              <td>'.$data['complete_time'].'</td>
              <td>'.$data['approve_time'].'</td>
              ';
        echo '</tr>';
        $no++;
      }
      echo '</table>';

?>