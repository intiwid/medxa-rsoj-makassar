<?php
require '../koneksi/koneksi.php';
include '../contract-service.php';

if (isset($_SESSION["username"])) {
  if ((time() - $_SESSION['last_login_timestamp']) > 3600) // 3600 = 60 * 60
  {
    header("location:logout.php");
  } else {
    $_SESSION['last_login_timestamp'] = time();
  }
} else {
  header('location:../index.php');
}

$username = $_SESSION['username'];
$result10 = mysqli_query($conn, "SELECT * FROM xray_dokter WHERE username = '$username'");
$row10 = mysqli_fetch_assoc($result10);
$name = $row10['named'] . ' ' . $row10['lastnamed'];
?>
<?php include "../bahasa.php"; ?>
<link rel="stylesheet" href="fontawesome/css/all.css">
<!-- ------loader------ -->
<div class="disokin">
  <div class="spinner">
    <span class="ball-1"></span>
    <span class="ball-2"></span>
    <span class="ball-3"></span>
    <span class="ball-4"></span>
    <span class="ball-5"></span>
    <span class="ball-6"></span>
    <span class="ball-7"></span>
    <span class="ball-8"></span>
  </div>
</div>
<!-- ------loader------ -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<div class="mainheader">
  <div class="container-fluid">
    <div class="row">
      <?php if ($exp >= -30) {
      ?>
        <div class="p-3 mb-2 blinking-bg text-dark">
          <div class="header">
            <div class="container-fluid">
              <div id="center2" class="logo-top">
                <img class="logo" src="../image/intiwid-logo2.png" />
                <span class="ris-head"><?= $lang['ris'] ?></span>
                <img class="logo2" src="../image/ipi2.png" />
              </div>
            </div>
          </div>
        </div>
      <?php } else {
      ?>
        <div class="header">
          <div class="container-fluid">
            <div id="center2" class="logo-top">
              <img class="logo" src="../image/intiwid-logo2.png" />
              <span class="ris-head"><?= $lang['ris'] ?></span>
              <img class="logo2" src="../image/ipi2.png" />
            </div>
          </div>
        </div>
      <?php } ?>

      <nav>
        <div class="container-fluid">
          <div class="row">
            <div class="nav-fostrap">
              <ul>
                <li>
                  <center><a href="index.php"><img style="width: 30px;" src="../icon-menubar/new_icon/home.png"><br><?= $lang['home'] ?></a></center>
                </li>
                <li>
                  <center class="center-menu"><a href="workload.php"><img style="width: 30px;" src="../icon-menubar/new_icon/query.png"><br class="br-menu">Query</a></center>
                </li>
                <li>
                  <center><a href="about.php"><img style="width: 30px;" src="../icon-menubar/new_icon/about.png"><br><?= $lang['about'] ?></a></center>
                </li>
                <!-- <li><center><a href="recyclebinindex.php"><img style="width: 30px;" src="../icon-menubar/recycle-bin.png"><br>Recycle Bin</a></center></li> -->

                <li>
                  <center><a href="logout.php"><img style="width: 30px;" src="../icon-menubar/new_icon/logout.png"><br><?= $lang['logout'] ?></a></center>
                </li>

                <?php if ($exp >= -30) {
                ?>
                  <li class="blinking-bg">
                    <span class="center-menu"><a href="#"><img style="width: 30px;" src="../icon-menubar/new_icon/warningcontract.png"></i><br class="br-menu">CONTRACT</a></span>
                  </li>
                <?php } ?>


                <li style="float: right; color: #fff">
                  <center><strong><br>Hai <i class="far fa-smile"></i>, <?php echo $name; ?></strong></center>
                </li>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
              </ul>
            </div>
            <div class="nav-bg-fostrap">
              <div class="navbar-fostrap"> <span></span> <span></span> <span></span> </div>
              <a href="" class="title-mobile"><img src="image/intiwid-logo-putih.png" style="width: 115px; margin-top: -5px;"></a>
            </div>
          </div>
        </div>
      </nav>
      <div class='content'>
      </div>
    </div>
  </div>
</div>