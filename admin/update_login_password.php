<?php
require 'function_dokter.php';
session_start();

$id_table = $_GET["id_table"];
$row =  mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM xray_login WHERE id_table = '$id_table' "
));

if (isset($_POST["submit"])) {
    if ($_POST['passwordulang'] == $_POST['password']) {
        if (update_login_password($_POST) > 0) {
            echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                       title: 'Berhasil Diubah!',
                       text:  '',
                       icon: 'success',
                       timer: 1000,
                       showConfirmButton: true
                   });  
            },10); 
            window.setTimeout(function(){ 
             window.location.replace('view_login.php');
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
             window.location.replace('update_login_password.php?id_table=" . $id_table . "');
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
         window.location.replace('update_login_password.php?id_table=" . $id_table . "');
        } ,1000); 
       </script>";
    }
}

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Ubah Data template</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item"><a href="view_template.php">Tabel template</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data template</li>
                <li style="float: right;">
                    <label>Zoom</label>
                    <a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
                    <a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
                </li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="body">
                    <div class="container-fluid">
                        <div class="form-template col-md-8 col-md-offset-2">
                            <h1>EDIT PASSWORD LOGIN</h1>
                            <form action="" method="post">
                                <input type="hidden" name="id_table" value="<?= $row['id_table']; ?>">
                                <label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
                                <input class="form-control" type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
                                <label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
                                <input class="form-control" type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required><br>
                                <button class="btn-worklist" type="submit" name="submit">Save</button>
                            </form>
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