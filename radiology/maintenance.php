<?php
require '../radiographer/function_radiographer.php';

$contract_query = mysqli_query($conn, 'SELECT * FROM xray_contract ORDER BY id DESC');
$row_query = mysqli_fetch_assoc($contract_query);
$id = $row_query['id'];
$maintenance_query = mysqli_query($conn, "SELECT * FROM xray_maintenance WHERE contract_id = '$id' AND status = 0 ORDER BY id ASC");
$row_maintenance = mysqli_fetch_assoc($maintenance_query);
$id_maintenance = $row_maintenance['id'];
$date_maintenance = $row_maintenance['maintenance_date'];

if (isset($_POST["submit"])) {
    if (maintenancepost($_POST) > 0) {
        echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                       title: 'Data Berhasil Diinput',
                       text:  '',
                       icon: 'success',
                       timer: 1000,
                       showConfirmButton: true
                   });  
            },10); 
            window.setTimeout(function(){ 
             window.location.replace('index.php');
            } ,1000); 
           </script>";
    } else {
        echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                       title: 'Data Gagal Diinput',
                       text:  '',
                       icon: 'error',
                       timer: 1000,
                       showConfirmButton: true
                   });  
            },10); 
            window.setTimeout(function(){ 
             window.location.replace('maintenance.php');
            } ,1000); 
           </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <b>JADWAL MAINTENANCE : <?php echo date("d M Y", strtotime($date_maintenance)); ?></b><br>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $id_maintenance; ?>">
        <label for="submit"><b>Jika Sudah Selesai, Klik Tombol Selesai</b></label><br>
        <button type="submit" name="submit">SELESAI</button>
    </form>
</body>

</html>