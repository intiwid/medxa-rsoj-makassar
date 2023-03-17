<?php

require 'koneksi/koneksi.php';

session_start();

echo "<script>
            function play(){
            var audio = document.getElementById('audio');
            audio.play();
                 }
      </script>";

if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  if (empty($username)) {
    echo "<script>alert('Username belum diisi!'); </script>
         <script>
            function play(){
            var audio1 = document.getElementById('audio1');
            audio1.play();
                 }
        </script>";
  } elseif (empty($password)) {
    echo "<script>alert('Password belum diisi!'); </script>
          <script>
            function play(){
            var audio1 = document.getElementById('audio1');
            audio1.play();
                 }
        </script>";
  } else {
    //---------------------------- query untuk mendapatkan username --------------------------------

    $query = "SELECT * FROM xray_login WHERE username = '$username' ";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);

    //---------------------------- cek kesesuaian password -------------------------------
    if (password_verify($password, $data['password'])) {
      $_SESSION['last_login_timestamp'] = time();

      echo "<script>document.location.href='menu.php';</script>
          <script>
            function play(){
            var audio = document.getElementById('audio');
            audio.play();
                 }
          </script>";

      //----------------------------- menyimpan username dan level ke dalam session ----------------------------------------
      $_SESSION['level'] = $data['level'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['fill'] = $data_temp['fill'];
    }
    echo "<script>alert('username atau password salah silahkan ulangi kembali'); </script>
        <script>
            function play(){
            var audio1 = document.getElementById('audio1');
            audio1.play();
                 }
        </script>";
  }
}

?>

<?php
@$username = $_SESSION['username'];
$query = "SELECT * FROM xray_login WHERE username = '$username' ";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);

if (!($_SESSION['username'] = $data['username'])) {
?>
  <?php include "bahasa.php"; ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- ketika pencet tombol back akan kembali kehalaman awal -->
    <script language="javascript" type="text/javascript">
      window.history.forward();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="styleindex.css" />
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="icon" href="image/ipi-icon3.png" type="image/png">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
    <style>
            .label5 {
                color: #d5d5d5;
            }

            .input5 {
                border-bottom: 2px solid #d5d5d5;
                background: #2e8db5;
                color: #fff;
            }

            .input5:focus~.label5,
            .input5:valid~.label5 {
                color: #d5d5d5;
            }
        </style>
  </head>

  <body>
    <div class="container-fluid">
    <div class="row">

<div class="main-login" style="">
    <div class="">

        <div class="form_login">

            <form class="login" method="post" action="" style="width: 375px;">
                <div class="img-login">
                    <img src="image/multimed_2_logo.png" alt="">
                </div><br>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?= $lang['input_uname'] ?>" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="<?= $lang['input_pw'] ?>" required>
                </div>
                <button href="readmore.php" type="submit" name="login" class="buttonsearch" style="width: 100%;">Login</button>

                <div class="dropdown" style=" position: absolute; width: 79%; bottom: 39px;">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" style="padding: 6px; border: none; border-radius: 3px;background: #eaeaea; color: #9f015d; font-weight: bold; font-size: 12px;"><?= $lang['language'] ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="?lang=en"><img style="width: 20px;" src="image/usa.png"> English</a></li>
                        <li><a href="?lang=id"><img style="width: 20px;" src="image/indonesia.png"> Bahasa</a></li>
                    </ul>
                    <!-- <a class="float-right" style="padding: 6px; border: none; border-radius: 3px;background: #eaeaea; color: #9f015d; font-weight: bold; font-size: 12px;" href="readmore.php"><?= $lang['read_more'] ?>?</a> -->
                </div>


                <div class="form1">
                    <!-- <div class="group5">
                        <input name="username" class="input5" type="text" required>
                        <span class="highlight5"></span>
                        <span class="bar5"></span>
                        <label class="label5"><?= $lang['input_uname'] ?></label>
                    </div>
                    <div class="group5">
                        <input name="password" class="input5" type="password" required>
                        <span class="highlight5"></span>
                        <span class="bar5"></span>
                        <label class="label5"><?= $lang['input_pw'] ?></label>
                    </div>

                    <button class="buttonsearch" type="submit" name="login" onclick="play()"><?= $lang['login'] ?></button> -->
                </div><br>



            </form>

        </div>



    </div>
</div>
</div>
    </div>



    </div>
    <!-- <div class="footerindex">

      <center><b>Developed by Multimed Medical System</b></center>

    </div> -->


    <!-- <div class="content">
  


</div> -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>

  </html>
<?php } else {
  if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
    header("location:admin/administrator.php");
  } else if ($_SESSION['level'] == "superadmin") {
    header("location:admin/administrator.php");
  } else if ($_SESSION['level'] == "radiology") {
    header("location:radiology/dicom.php");
  } else if ($_SESSION['level'] == "radiographer") {
    header("location:radiographer/workload.php");
  }
} ?>