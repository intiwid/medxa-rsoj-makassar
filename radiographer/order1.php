<?php 
require '../koneksi/koneksi.php';
session_start();
$schedule_date = $_POST['schedule_date'];
$schedule_time = $_POST['schedule_time'];
$contrast = $_POST['contrast'];
$priority = $_POST['priority'];
$pat_state = $_POST['pat_state'];
$contrast_allergies = $_POST['contrast_allergies'];
$spc_needs = $_POST['spc_needs'];

$payment = $_POST['payment'];
$other_payment = $_POST['other_payment'];
if ($other_payment) {
      $payment = $_POST['other_payment'];
    }

$result7 = mysqli_query($conn, "SELECT * FROM xray_dokrad_order ORDER BY dokradid_order DESC LIMIT 0,99");
($row7 = mysqli_fetch_array($result7));
$result6 = mysqli_query($conn, "SELECT * FROM xray_radiographer_order ORDER BY radiographer_idorder DESC LIMIT 0,99");
($row6 = mysqli_fetch_array($result6));
$result5 = mysqli_query($conn, "SELECT * FROM xray_price_order order by priceorderid DESC LIMIT 0,99");
($row5 = mysqli_fetch_array($result5));
$result4 = mysqli_query($conn, "SELECT * FROM xray_modalitas_order ORDER BY typeorderid DESC LIMIT 0,99");
($row4 = mysqli_fetch_array($result4));
$result3 = mysqli_query($conn, "SELECT * FROM xray_department_order ORDER BY deporderid DESC LIMIT 0,99");
($row3 = mysqli_fetch_array($result3));
$result2 = mysqli_query($conn, "SELECT * FROM xray_dokter_order ORDER BY dokterorderid DESC LIMIT 0,99");
($row2 = mysqli_fetch_array($result2));
$result = mysqli_query($conn, "SELECT * FROM xray_patient_order ORDER BY patientorderid DESC LIMIT 0,99");
($row = mysqli_fetch_array($result));
$patientid = $row['patientid'];
$mrn = $row['mrn'];
$name = $row['name'];
$lastname = $row['lastname'];
$sex = $row['sex'];
$birth_date = $row['birth_date'];
$weight = $row['weight'];
$dokterid = $row2['dokterid'];
$named = $row2['named'];
$lastnamed = $row2['lastnamed'];
$email = $row2['email'];
$name_dep = $row3['name_dep'];
$type_dep = $row3['type_dep'];
$depid = $row3['depid'];
$typemod = $row4['typemod'];
$xray_type_code = $row4['xray_type_code'];
$code_xray = $row5['code_xray'];
$prosedur = $row5['prosedur'];
$price = $row5['price'];
$radiographer_id = $row6['radiographer_id'];
$radiographer_name = $row6['radiographer_name'];
$radiographer_lastname = $row6['radiographer_lastname'];
$radiographer_sex = $row6['radiographer_sex'];
$radiographer_tlp = $row6['radiographer_tlp'];
$radiographer_email = $row6['radiographer_email'];
$dokradid = $row7['dokradid'];
$dokrad_name = $row7['dokrad_name'];
$dokrad_lastname = $row7['dokrad_lastname'];
$dokrad_sex = $row7['dokrad_sex'];
$dokrad_tlp = $row7['dokrad_tlp'];
$dokrad_email = $row7['dokrad_email'];

$length = 10;
  $acc = '';
  for ($i=0;$i<$length;$i++){
  $acc .= rand (1, 9);}

$length1 = 17;
  $add = '';
  for ($a=0;$a<$length1;$a++){
  $add .= rand (1, 9);}

$text = preg_replace('/[^A-Za-z0-9\  ]/', '', $schedule_date);

$uid = '1.2.40.0.13.1.'.$acc.'.'.$patientid.'.'.$text.'.'.$add;

$query = "INSERT INTO xray_order
        (uid,acc,patientid,mrn,name,lastname,sex,birth_date,weight,name_dep,xray_type_code,prosedur,dokterid,named,lastnamed,email,create_time,schedule_date,schedule_time,contrast,priority,pat_state,contrast_allergies,spc_needs,payment)
        VALUES
        ('$uid','$acc', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$prosedur','$dokterid', '$named', '$lastnamed','$email', NOW(), '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs', '$payment')";

        mysqli_query($conn, $query);
  
        header("location:order2.php");
