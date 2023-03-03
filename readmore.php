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
    <!-- <link rel="icon" href="image/favicon.png" type="image/png"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styleindex.css" />
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/ionicons.min.css">



    <!-- <link rel="stylesheet" type="text/css" href="css/styles.css" /> -->
    <link rel="icon" href="image/ipi-icon3.png" type="image/png">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <link rel="stylesheet" href="../fontawesome/css/all.css"> -->
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    <title>Read More</title>
    <!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script> -->
  </head>

  <body>

    <marquee class="marquee1"><?= $lang['welcome_intiwid'] ?> V.1.12</marquee>

    <div class="sdsd container">
      <div class="row">
        <div class="readbox">
          <a href="index.php" style="width: 100px;" class="positive ui button"><i class="fas fa-arrow-left"></i> Back to login</a>


          <h3 class="ui horizontal divider header">
            <i class="fas fa-tags"></i>&nbsp;
            Description
          </h3>
          <p><b>Panduan Penggunaan Intiwid RisPacs.</b></p>
          <p>Download Panduan lengkap <a href="read-more/manual-book.docx">Di sini</a></p>
          <h3 class="ui horizontal divider header">
            <i class="fas fa-chart-bar"></i>&nbsp;
            Requirements
          </h3>

          <table class="ui definition table">
            <tbody>
              <tr>
                <td class="two wide column">Viewer Dicom</td>
                <td>Java</td>
              </tr>
              <tr>
                <td>Web Viewer</td>
                <td>Web Browser (Recommended Mozilla Firefox)</td>
              </tr>

            </tbody>
          </table>

          <h4>Untuk membuka viewer dicom wajib instal java versi 7, download <a href="read-more/jdk-7u55.exe">disini</a>.</h4>

          <h4>Cara Instal Java :</h4>
          <div class="ui list">
            <div class="item">
              <div class="content">
                <div class="header"><i class="fas fa-caret-right"></i> Instal Java</div>
                <div class="description">Instal seperti biasa.</div>
              </div>
              <hr>
              <div class="content">
                <div class="header"><i class="fas fa-caret-right"></i> Setting Environtment</div>
                <div class="description">Setting system environment variables di komputer anda. Search <b>edit the system environment variables</b>
                  Lalu pilih <b>environment variables</b> :
                  <div class="ui medium images">
                    <img class="medium ui image" src="read-more/img/rm-1.png">
                    <img class="medium ui image" src="read-more/img/rm-2.png">
                  </div><br>

                  Lalu pada tab <b>system variables</b> pilih <b>New</b>, Masukkan <b> Variable Name : JAVA_HOME</b> dan <b>Variable Value : C:\Program Files (x86)\Java\jdk1.7.0_55</b>
                  <div class="ui medium images">
                    <img class="medium ui image" src="read-more/img/rm-3.png">
                    <img class="medium ui image" src="read-more/img/rm-4.png">
                  </div><br>

                  Lalu pada tab <b>Use variables for server pacs</b> pilih <b>path</b> lalu <b>Edit</b>, pilih <b>new</b> dan isi data: <b>C:\Program Files (x86)\Java\jdk1.7.0_55\bin</b> lalu pilih <b>OK</b>
                  <div class="ui medium images">
                    <img class="medium ui image" src="read-more/img/rm-3.png">
                    <img class="medium ui image" src="read-more/img/rm-5.png">
                  </div><br>
                </div>
              </div>
              <hr>

              <div class="content">
                <div class="header"><i class="fas fa-caret-right"></i> Configure Java</div>
                <div class="description">Search dengan keyword <b>configure java</b>, Pilih <b>tab update</b>, klik <b>check for update automatically</b>, pilih <b>Do not check</b>
                  <div class="ui medium images">
                    <img class="medium ui image" src="read-more/img/rm-6.png">
                    <img class="medium ui image" src="read-more/img/rm-7.png">
                    <img class="medium ui image" src="read-more/img/rm-8.png">
                  </div><br>

                  Lalu pilih <b>tab Security </b> dan <b>setting medium</b> dan pilih <b>OK</b>
                  <div class="ui medium images">
                    <img class="medium ui image" src="read-more/img/rm-9.png">
                  </div><br>
                </div>
              </div>


            </div>
          </div>


        </div>
      </div>
    </div><br><br><br><br>



    </div>
    <div class="footerindex">

      <center>PT. Intimedika Puspa Indah / Email: itservice@intimedika.co</center>

    </div>


    <!-- <div class="content">
  


</div> -->
    <script src="js/jquery.min.js"></script>
    <script src="js/semantic.min.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>

  </html>
<?php } else {
  if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
    header("location:admin/administrator.php");
  } else if ($_SESSION['level'] == "superadmin") {
    header("location:superadmin/index.php");
  } else if ($_SESSION['level'] == "radiology") {
    header("location:radiology/dicom.php");
  } else if ($_SESSION['level'] == "radiographer") {
    header("location:radiographer/index.php");
  }
} ?>