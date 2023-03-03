<?php
require 'function_dokter.php';

session_start();

if (isset($_POST["submit"])) {
    if ($_POST['passwordconfirm'] == "27102108") {
        if (new_ae($_POST) > 0) {
            echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                    title: 'Berhasil Diinput!',
                    text:  '',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: true
                });  
            },10); 
            window.setTimeout(function(){ 
            window.location.replace('view_ae.php');
            } ,1000); 
        </script>";
        } else {
            echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                    title: 'Gagal Diinput!',
                    text:  '',
                    icon: 'error',
                    timer: 1000,
                    showConfirmButton: true
                });  
            },10); 
            window.setTimeout(function(){ 
            window.location.replace('new_ae.php');
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
         window.location.replace('new_ae.php');
        } ,1000); 
       </script>";
    }
}

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <title>AE-TITLE | Radiographer</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $lang['input_aetitle'] ?></li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="body">
                    <h1 style="color: #ee7423"><?= $lang['add_aetitle'] ?></h1>
                    <div class="container">
                        <div class="row">
                            <a class="ahref" href="view_ae.php"><i class="fas fa-eye"></i><?= $lang['view_aetitle'] ?></a>
                            <br><br>
                        </div>
                    </div>

                    <div class="container chart-box2">
                        <div class="row">

                            <div class="aetitle-box">
                                <form action="" method="post">
                                    <label for="aet">AE TITLE</label>
                                    <input class="form-control" type="text" name="aet" required><br />
                                    <label for="hostname">IP/Hostname</label>
                                    <input class="form-control" type="text" name="hostname" required><br />
                                    <label for="port">PORT</label>
                                    <input class="form-control" type="text" name="port" required><br />
                                    <!-- <label for="color">COLOR</label>
                                    <input class="form-control" type="color" name="color" required><br /> -->
                                    <label for="port">Password Confirm</label>
                                    <input class="form-control" type="password" name="passwordconfirm" required><br />
                                    <input type="submit" class="btn btn-success" name="submit" value="SAVE" style="margin: 0px; font-size: 12px; font-weight: bold;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerindex">
                <div class="">
                    <div class="footer-login col-sm-12"><br>
                        <center>
                            <p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php include('script-footer.php'); ?>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>