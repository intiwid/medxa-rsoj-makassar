<?php

require 'koneksi/koneksi.php';

session_start();

?>

<?php include "bahasa.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <link rel="stylesheet" href="css/bootstrap.css">
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

  <!-- <marquee class="marquee1"><?= $lang['welcome_intiwid'] ?> V.1.12</marquee> -->

  <div class="sdsd container">
    <div class="row">
      <div class="readbox">
        <a href="index.php" style="width: 100px;" class="positive ui button"><i class="fas fa-arrow-left"></i> Back to login</a>


        <h3 class="ui horizontal divider header">
          <i class="fas fa-tags"></i>&nbsp;
          Description
        </h3>
        <!-- <p><b>Panduan Penggunaan Intiwid RisPacs.</b></p>
        <p>Download Panduan lengkap <a href="read-more/manual-book.docx">Di sini</a></p> -->
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
              <td>Web Browser</td>
            </tr>

          </tbody>
        </table>

        <h4>Untuk membuka viewer dicom (icon mata merah) wajib instal java versi 8, download <a href="read-more/jdk-8u161-windows-i586.exe">disini</a>.</h4>

        <h4>Cara Instal Java :</h4>
        <div class="ui list">
          <div class="item">
            <div class="content">
              <div class="header"><i class="fas fa-caret-right"></i> Instal Java (Next sampai selesai)</div>
              <div class="ui medium images">
                <img class="medium ui image" src="read-more/img/1.jpg">
                <img class="medium ui image" src="read-more/img/2.jpg">
                <img class="medium ui image" src="read-more/img/3.jpg">
              </div><br>
            </div>
            <hr>
            <div class="content">
              <div class="header"><i class="fas fa-caret-right"></i> Configure Java </div> <br>
              <div class="description">
                Gambar (kiri) : Search "Configure Java" pada windows <br>
                Gambar (tengah) : Pilih Tab Update lalu unchecklist Check For Update Automaticaly <br>
                Gambar (kanan) : Pilih Do Not Check
                </b> :
                <div class="ui medium images">
                  <img class="medium ui image" src="read-more/img/5.PNG">
                  <img class="medium ui image" src="read-more/img/6.PNG">
                  <img class="medium ui image" src="read-more/img/7.PNG">
                </div><br>

                Gambar (kiri) : Pilih tab Security lalu pilih edit site list <br>
                Gambar (tengah) : Tambahkan IP Server Pacs dan port 19898 contoh : http://192.168.4.17:19898 lalu pilih add <br>
                Gambar (kanan) : Pilih ok untuk menyelesaikan
                </b> :
                <div class="ui medium images">
                  <img class="medium ui image" src="read-more/img/8.PNG">
                  <img class="medium ui image" src="read-more/img/11.PNG">
                  <img class="medium ui image" src="read-more/img/10.PNG">
                </div><br>
              </div>
            </div>
            <div class="content">
              <div class="header"><i class="fas fa-caret-right"></i> Buka Viewer di RISPACS (hanya setting diawal) </div>
              <div class="description">
                Checklist I Accept the risk <br>
                Checklist Do not show this again for apps <br>
                Lanjut pilih run
                <div class="ui medium images">
                  <img class="medium ui image" src="read-more/img/4.jpg">
                </div><br>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div><br><br><br><br>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/semantic.min.js"></script>
  <script src="js/bootstrap.js"></script>

</body>

</html>