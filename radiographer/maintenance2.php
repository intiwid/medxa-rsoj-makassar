<?php
require 'function_radiographer.php';

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
    <title>Maintenance | Radiographer</title>
    <style>
        html,
        body,
        .background {
            margin: 0;
            width: 100%;
            height: auto;
            background: #7289DA;
            text-align: center
        }

        .title {
            font-smooth: auto;
            padding-top: 80px;
            font-family: 'Whitney', sans-serif;
            font-weight: 700;
            color: #fff;
            font-size: 30px
        }

        .background {
            background-color: #0072bd;
            background-size: 50%;
        }

        .step {
            font-smooth: auto;
            font-family: 'Whitney', sans-serif;
            font-weight: 700;
            color: #ff8b8b;
            font-size: 22px;
        }

        .link {
            text-decoration: none;
            color: #fff;
            font-family: 'Whitney', sans-serif;
            font-size: 13px;
            opacity: 0.8;
            margin-right: auto;
            margin-left: auto;
            padding: 10px 20px;
            border: 2px solid #fff;
            border-radius: 100px;
        }

        .link:hover {
            opacity: 1;
        }

        .instructions {
            font-smooth: auto;
            font-family: 'Whitney', sans-serif;
            font-weight: 650;
            color: #fff;
            font-size: 16px;
        }

        .highlight {
            background: rgba(255, 255, 255, 0.1);
            display: inline-block;
            opacity: 1;
            border-radius: 2px;
            padding: 0 5px;
            color: #fff
        }

        .highlight:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .bottom-wrapper {
            width: 100%;
            background: #2C2F33;
            text-align: center;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .wsite {
            text-decoration: none;
            color: #fff;
            font-family: 'Whitney', sans-serif;
            font-size: 18px;
            opacity: 0.5;
            transition: all 100ms ease
        }

        .bottom-wrapper:hover .wsite {
            opacity: 0.8
        }
    </style>
</head>

<body style="background-color: #0072bd;">
    <title>How to maintenance</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <div class="background">
        <div class="title">BERIKUT ADALAH TATA CARA UNTUK MAINTENANCE SERVER INTIWID RISPACS
        </div>
        <div style="height:20px"></div>
        <div class="instructions">Jadwal Maintenance :<b> <?php echo date("d M Y", strtotime($date_maintenance)); ?></div>


        <div style="height:20px"></div>
        <div class="step">Step 1</div>
        <div class="instructions">Close CMD PACS dan Close CMD MPPS<br>
            Klik kanan pada tab tanda panah dibawah -> lalu klik close all windows
        </div>
        <div style="height:15px"></div>
        <img src="../maintenance_image/close_cmd.png" width="20%" height="auto">

        <div style="height:20px"></div>
        <div class="step">Step 2</div>
        <div class="instructions">Close TOMCAT<br>
            Klik kanan pada tab tanda panah dibawah -> lalu klik close window
        </div>
        <div style="height:15px"></div>
        <img src="../maintenance_image/close_tomcat.png" width="20%" height="auto">

        <div style="height:20px"></div>
        <div class="step">Step 3</div>
        <div class="instructions">Cloase EXAMREFRESH (DI FIREFOX YANG TERBUKA)<br>
            Klik kanan pada tab tanda panah dibawah -> lalu klik close window/close all windows
        </div>
        <div style="height:15px"></div>
        <img src="../maintenance_image/close_browser.png" width="20%" height="auto">

        <div style="height:20px"></div>
        <div class="step">Step 4</div>
        <div class="instructions">Restart sercer (TUNGGU SAMPAI NYALA KEMBALI)
        </div>
        <div style="height:15px"></div>


        <div style="height:20px"></div>
        <div class="step"><span style="color: red; font-weight: bold; font-size: 25px;">*</span>NOTE : JIKA ADA TAB LAIN DILUAR CMD PACS, CMD MPPS, TOMCAT DAN EXAMREFRESH DISARANKAN UNTUK DI CLOSE</div>
        <div style="height:15px"></div>


        <div style="height:20px"></div>
        <div class="step">Step 7</div>
        <div class="instructions">Setelah server menyala, tunggu 2-3 menit sampai semua yang ada di Srtaruup sudah running
        </div>

        <div style="height:20px"></div>
        <div class="step">Step 8</div>
        <div class="instructions">Klik 2x pada firefox Exam Refresh (yang sudah disediakan di desktop). <br>
            Sistem Server telah selesai di Maintenance
        </div>
        <div style="height:15px"></div>
        <img src="../maintenance_image/open_exam.png" width="20%" height="auto">


        <div style="height:20px"></div>
        <div class="step"><span style="color: red; font-weight: bold; font-size: 25px;">*</span>NOTE : CMD PACS, CMD MPPS, TOMCAT dan EXAMREFRESH ada di desktop Server<br></div>
        <div class="instructions">
        </div>








        <div style="height:20px"></div>
        <div class="step">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $id_maintenance; ?>">
                <label for="submit">Jika Sudah Selesai, Klik Tombol Selesai</label><br>
                <button class="btn btn-danger" type="submit" name="submit" style="font-size: 15px; font-weight: bold;">SELESAI</button>
            </form>
        </div><br><br><br><br><br><br><br>
</body>

</html>