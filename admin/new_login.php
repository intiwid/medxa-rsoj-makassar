<?php
require 'function_dokter.php';

session_start();

if (isset($_POST["submit"])) {
    $username = $_POST['username'];

    $password = $_POST['password'];
    $passwordulang = $_POST['passwordulang'];
    $result = mysqli_query($conn, "SELECT * FROM xray_login WHERE username = '$username' ");
    $row = mysqli_fetch_assoc($result);
    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        echo "<script type='text/javascript'>
		setTimeout(function () { 
		swal({
				title: 'username sudah ada',
				text:  '',
				icon: 'error',
				timer: 1000,
				showConfirmButton: true
			});  
		},10);
	</script>";
    } else if ($password == $passwordulang) {
        if (new_login($_POST) > 0) {
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
             window.location.replace('new_login.php');
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
         window.location.replace('new_login.php');
        } ,1000); 
       </script>";
    }
}

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <title>Login | Radiographer</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Login</li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="body">
                    <h1 style="color: #ee7423">Add Login</h1>
                    <div class="container">
                        <div class="row">
                            <a class="ahref" href="view_login.php"><i class="fas fa-eye"></i>List Login</a>
                            <br><br>
                        </div>
                    </div>

                    <div class="container chart-box2">
                        <div class="row">

                            <div class="aetitle-box">
                                <form action="" method="post">
                                    <input type="hidden" name="id_table">
                                    <label for="username"><b>Username</b></label><br>
                                    <input class="form-control" type="text" name="username" id="username" required>
                                    <label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
                                    <label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
                                    <input class="form-control" type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required><br>
                                    <label for="level"><b>Level</b></label><br>
                                    <select name="level">
                                        <option value="refferal">Referral</option>
                                        <option value="radiographer">Radiographer</option>
                                        <option value="radiology">Radiology</option>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Superadmin</option>
                                    </select>
                                    <button class="btn-worklist" type="submit" name="submit">Save</button>
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