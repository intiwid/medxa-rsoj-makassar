<?php
require 'function_radiographer.php';

$contract_query = mysqli_query($conn, 'SELECT * FROM xray_contract ORDER BY id DESC');
$row_query = mysqli_fetch_assoc($contract_query);
$id = $row_query['id'];
$no_contract = $row_query['no_contract'];
$maintenance_query = mysqli_query($conn, "SELECT * FROM xray_maintenance WHERE contract_id = '$no_contract' AND status = 0 ORDER BY id ASC");
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
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Maintenance | Radiographer</title>
        <?php include('head.php'); ?>
    </head>

    <body style="background-color: #0072bd;">
        <div class="container">
            <div class="main-tenance">
                JADWAL MAINTENANCE :<b> <?php echo date("d M Y", strtotime($date_maintenance)); ?></b>
                <p><br>
                    BERIKUT ADALAH TATA CARA UNTUK MAINTENANCE SERVER INTIWID RISPACS <br>
                    1. CLOSE CMD PACS<br>
                    2. CLOSE CMD MPPS<br>
                    3. CLOSE TOMCAT<br>
                    4. CLOSE EXAMREFRESH (DI FIREFOX YANG TERBUKA)<br>
                    5. RESTART SERVER (TUNGGU SAMPAI NYALA KEMBALI)<br>
                </p>
                <p>
                    <span style="color: red; font-weight: bold; font-size: 25px;">*</span>NOTE : JIKA ADA TAB LAIN DILUAR CMD PACS, CMD MPPS, TOMCAT DAN EXAMREFRESH DISARANKAN UNTUK DI CLOSE<br><br>
                    SETELAH SERVER MENYALA, TUNGGU 2-3 MENIT SAMPAI SEMUA YANG ADA DI STARTUP SUDAH RUNNING, LALU<br>
                </p>
                <p>
                    <br>
                    6. KLIK 2x PADA FIREFOX EXAMREFRESH (yang sudah disediakan di desktop)<br>
                    SISTEM SERVER TELAH SELESAI DI MAINTENANCE<br>
                </p>
                <p>
                    <span style="color: red; font-weight: bold; font-size: 25px;">*</span>NOTE : CMD PACS, CMD MPPS, TOMCAT DAN EXAMREFRESH ADA DI DESKTOP<br>
                </p>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id_maintenance; ?>">
                    <label for="submit">Jika Sudah Selesai, Klik Tombol Selesai</label><br>
                    <button class="btn btn-danger" type="submit" name="submit" style="font-size: 15px; font-weight: bold;">SELESAI</button>
                </form>
            </div>
        </div>
    </body>

    </html>
    <?php } else {
    header("location:../index.php");
} ?>`