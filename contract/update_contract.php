<?php
require 'function_dokter.php';

session_start();
$contract_query = mysqli_query($conn, 'SELECT * FROM xray_contract ORDER BY id DESC');
$row_query = mysqli_fetch_assoc($contract_query);

$username = $_SESSION['username'];
$username_query = mysqli_query($conn, "SELECT * FROM xray_login WHERE username = '$username'");
$row_usernamequery = mysqli_fetch_assoc($username_query);
$contract_pass = $row_usernamequery['password_contract'];
if (isset($_POST["submit"])) {
    if (password_verify($_POST['password'], $contract_pass)) {
        if (contractpost($_POST) > 0) {
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
             window.location.replace('update_contract.php');
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
             window.location.replace('update_contract.php');
            } ,1000); 
           </script>";
        }
    } else {
        echo "<script type='text/javascript'>
        setTimeout(function () { 
        swal({
                   title: 'Password Konfirmasi Salah',
                   text:  '',
                   icon: 'error',
                   timer: 1000,
                   showConfirmButton: true
               });  
        },10); 
        window.setTimeout(function(){ 
         window.location.replace('update_contract.php');
        } ,1000); 
       </script>";
    }
}
if ($_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>CONTRACT SERVICE</title>
        <?php include('head.php'); ?>
        <style type="text/css">
            .sizepon {
                font-size: 30px;
            }

            .sizepon2 {
                font-size: 20px;
            }

            .tengah {
                align-self: center;
            }

            .sizehead {
                font-size: 40px;
                font-weight: bold;
            }

            #box2 {
                width: 1000px;
                height: 400px;
                background-color: blanchedalmond;
            }

            #box1 {
                width: 1000px;
                height: 400px;
                background-color: violet;
            }

            .center {
                margin: auto;
                width: 99%;
                border: 3px solid #87CEFA;
                padding: 10px;
            }

            .button {
                background-color: #1e92c1;
                /* Green */
                border: none;
                color: white;
                padding: 16px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
            }

            .buttonrpl {
                background-color: white;
                color: black;
                border: 2px solid #1e92c1;
            }

            .buttonrpl:hover {
                background-color: #1e92c1;
                color: white;
            }
        </style>
    </head>

    <body>
        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contract Service</li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="container-fluid">

                    <h2 class="sizehead">Info Contract Service</h2><br>
                    <table>
                        <tr>
                            <td class="sizepon"> No Contract</td>
                            <td class="sizepon"> : </td>
                            <td class="sizepon"><?php
                                                if ($row_query['no_contract']) {
                                                    echo $row_query['no_contract'];
                                                } else {
                                                    echo '-';
                                                } ?></td>
                        </tr>
                        <tr>
                            <td class="sizepon"> Tanggal Mulai Kontrak</td>
                            <td class="sizepon"> : </td>
                            <td class="sizepon"><?php
                                                if ($row_query['contract_date']) {
                                                    echo date("d M Y", strtotime($row_query['contract_date']));
                                                } else {
                                                    echo '-';
                                                } ?></td>
                        </tr>
                        <tr>
                            <td class="sizepon">Tanggal Habis Kontrak</td>
                            <td class="sizepon">:</td>
                            <td class="sizepon"><?php
                                                if ($row_query['contract_duedate']) {
                                                    echo date("d M Y", strtotime($row_query['contract_duedate']));
                                                } else {
                                                    echo '-';
                                                } ?></td>
                        </tr>
                        <tr>
                            <td class="sizepon">Tanggal Input Kontrak Terbaru</td>
                            <td class="sizepon">:</td>
                            <td class="sizepon"><?php
                                                if ($row_query['contract_update']) {
                                                    echo date("d M Y", strtotime($row_query['contract_update']));
                                                } else {
                                                    echo '-';
                                                } ?></td>
                        </tr>
                        <tr>
                            <td class="sizepon">Diinput Oleh</td>
                            <td class="sizepon">:</td>
                            <td class="sizepon"><?php
                                                if ($row_query['contract_sign_by']) {
                                                    echo $row_query['contract_sign_by'];
                                                } else {
                                                    echo '-';
                                                }
                                                ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="center">
                <div class="container-fluid">
                    <div class="row form-dokter">
                        <form action="" method="post">
                            <input type="hidden" name="username" value="<?= $_SESSION['username']; ?>">
                            <input type="hidden" name="contract_pass" value="<?= $row_usernamequery['contract_pass']; ?>">
                            <ul>
                                <li>
                                    <label for="no_contract" class="sizepon2"><b>Input No Contract</b></label><br>
                                    <input type="text" name="no_contract" id="no_contract" class="form-control input-lg" placeholder="Nomer Contract" /><br>
                                </li>
                                <li>
                                    <label for="contract_date" class="sizepon2"><b>Input Tanggal Kontrak Baru</b></label><br>
                                    <input type="text" name="contract_date" id="contract_date" class="form-control input-lg" placeholder="Contract Date" autocomplete="off" /><br>
                                </li>
                                <li>
                                    <label for="contract" class="sizepon2"><b>Lama Kontrak</b></label>
                                    <div class="select">
                                        <select id="standard-select" class="form-control input-lg" name="contract">
                                            <option value="1">1 Tahun</option>
                                            <option value="2">2 Tahun</option>
                                            <option value="3">3 Tahun</option>
                                            <option value="4">4 Tahun</option>
                                            <option value="5">5 Tahun</option>
                                        </select>
                                        <span class="focus"></span>
                                    </div>
                                </li>
                                <li>
                                    <label for="password" class="sizepon2"><b>Input Password</b></label><br>
                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" autocomplete="off" required /><br>
                                </li>
                                <button class="button buttonrpl" type="submit" name="submit">Ubah Data</button>&nbsp;&nbsp;
                                <?php
                                $id = $row_query['no_contract'];
                                $select_pdf = mysqli_query($conn, "SELECT * FROM xray_upload_pdf WHERE contract_id = '$id'");
                                $row_pdf = mysqli_fetch_assoc($select_pdf);
                                $idpdf = $row_pdf['id'];
                                if (!$idpdf) { ?>
                                    <a href="uploadpdf.php?id=<?= $row_query['no_contract']; ?>"><i class="fas fa-upload fa-3x"></i></a>
                                <?php } else { ?>
                                    <a href="view_pdf.php"><i class="fas fa-upload fa-3x"></i></a>
                                <?php } ?>
                                </li>
                            </ul>

                        </form>
                    </div>
                </div>
            </div>


            <div class="footerindex">
                <div class="">
                    <?php include('footer-itw.php'); ?>
                </div>
            </div>
        </div>
        <?php include('script-footer.php'); ?>
        <script>
            $('#contract_date').datetimepicker({
                format: 'd-m-Y H:i',
                allowTimes: ['00:00',
                    '01:00',
                    '02:00',
                    '03:00',
                    '04:00',
                    '05:00',
                    '06:00',
                    '07:00',
                    '08:00',
                    '09:00',
                    '10:00',
                    '11:00',
                    '12:00',
                    '13:00',
                    '14:00',
                    '15:00',
                    '16:00',
                    '17:00',
                    '18:00',
                    '19:00',
                    '20:00',
                    '21:00',
                    '22:00',
                    '23:00',
                    '23:59'
                ]
            });
        </script>
        <script>
            $(document).ready(function() {
                $("a[href='about.php']").addClass("active-menu");
            });
        </script>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>