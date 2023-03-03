<?php
$uid = $_GET['uid'];
require '../koneksi/koneksi.php';
session_start();
$username = $_SESSION['username'];

if (isset($_POST["login"])) {

    $otp = $_POST["otp"];

    if (empty($otp)) {
        echo "<script>alert('Otp belum diisi!'); </script>
         ";
    } else {
        //---------------------------- query untuk mendapatkan username --------------------------------

        $query = "SELECT * FROM xray_dokter_radiology WHERE username = '$username' ";
        $hasil = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($hasil);

        //---------------------------- cek kesesuaian password -------------------------------
        if ($otp == $data['otp']) {
            echo "
            <script>
                alert('Your OTP is Correct');
                document.location.href= 'qrcode.php?uid=$uid&verify=verified';
            </script>
            ";
        }
        echo "<script>alert('OTP salah silahkan ulangi kembali'); </script>";
    }
}

?>

<?php include "../bahasa.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- ketika pencet tombol back akan kembali kehalaman awal -->
    <script language="javascript" type="text/javascript">
        window.history.forward();
    </script>
    <!-- <link rel="icon" href="image/favicon.png" type="image/png"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/css-navbar.css" />
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/ionicons.min.css">

    <!-- <link rel="stylesheet" type="text/css" href="css/styles.css" /> -->
    <link rel="icon" href="image/ipi-icon3.png" type="image/png">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <link rel="stylesheet" href="../fontawesome/css/all.css"> -->
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    <title>Login</title>
    <!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script> -->
</head>

<body>
    <div class="sdsd container-fluid">
        <div class="row">
            <!-- <div style="padding-left: 65px; margin-top: 100px;" class="col-md-5 col-md-offset-1">
                <div id="header">
                    <div class="logo">
                        <img class="img-responsive" src="image/intiwid-logo.png">
                    </div>
                    <hr class="hrindex">

                    <div class="logo2">
                        <img class="img-responsive" src="image/logo-rispacs1.png">
                    </div>
                </div>
            </div> -->

            <!--  <script>
            function play(){
            var audio = document.getElementById('audio');
            audio.play();
                 }
        </script> -->
            <div class="col-md-offset-4 col-md-4" style="margin-top: 100px;">
                <!--   <form class="login" method="post" action="">
                        <input type="text" name="otp" class="login-input" placeholder="Insert OTP.." autofocus>
                        <input type="hidden" name="verify" value="verified">
                        <button class="buttonsearch" type="submit" name="login" onclick="play()"><span>Confirm</span></button>
                        <a style="text-decoration:none; float: right;" href="phpmailer/examples/gmailotp.php" target="_blank">
                            <span class="btn btn-intiwid1">Get OTP</span>
                        </a>
                    </form> -->

                <!-- Default form login -->
                <form class="login border" method="post" action="" style="padding: 20px; font-size: 15px; background-color: #fff; border-color: #c1c8ce !important;">

                    <center>
                        <h2 class="mb-4">OTP Code</h2>
                    </center>

                    <!-- Email -->
                    <input type="text" name="otp" placeholder="Insert OTP.." class="form-control mb-4" style="padding: 15px;" autofocus>


                    <!-- Sign in button -->
                    <button class="btn btn-success btn-block my-4" type="submit" name="login" style="font-size: 15px;">Confirm</button>
                    <!-- get otp gmail -->
                    <!-- <a style="text-decoration:none;" href="phpmailer/examples/gmailotp.php" target="_blank">
                        <span class="btn btn-info btn-block my-4" type="submit" style="font-size: 15px;">Get OTP</span></a> -->
                    <!-- end get otp gmail -->
                    <!-- get otp telegram -->
                    <a style="text-decoration:none;" href="teleotp.php" target="_blank">
                        <span class="btn btn-info btn-block my-4" type="submit" style="font-size: 15px;">Get OTP</span></a>
                    <!-- get otp telegram -->

                    <hr>

                    <p>Back to
                        <a href="<?= "http://" . $_SERVER['SERVER_NAME']; ?>/intiwid-native-base/radiology/workload.php">Expertise</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- <div class="content">
</div> -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
?>