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
$result10 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username'");
$row10 = mysqli_fetch_assoc($result10);
$name = $row10['dokrad_name'] . ' ' . $row10['dokrad_lastname'];
?>
<?php include "../bahasa.php"; ?>



<!-- ------loader------ -->
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
<!-- ------loader------ -->
<div class="mainheader">
  <div class="container-fluid">
    <div class="row">

      <?php // if ($exp >= -30) {
      ?>
      <!-- <div class="p-3 mb-2 blinking-bg text-dark">
          <div class="header">
            <div class="container-fluid">
              <div id="center2" class="logo-top">
                <img class="logo" src="../image/intiwid-logo2.png" />
                <span class="ris-head"><?= $lang['ris'] ?></span>
                <img class="logo2" src="../image/ipi2.png" />
              </div>
            </div>
          </div>
        </div> -->
      <?php // } else {
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
      <?php // } 
      ?>

      <nav>

        <div class="nav-fostrap">
          <ul>

            <li><span class="center-menu"><a href="index.php"><img style="width: 30px;" src="../icon-menubar/new_icon/home.png"><br class="br-menu"><?= $lang['home'] ?></a></span>
            </li>

            <li><span class="center-menu"><a href="dicom.php"><img style="width: 30px;" src="../icon-menubar/new_icon/worklist.png"><br class="br-menu">Worklist</a></span></li>
            <!-- <li><center class="center-menu"><a href="modality-worklist.php"><img style="width: 30px;" src="../icon-menubar/worklist-mod.png"><br class="br-menu"><?= $lang['modality_worklist'] ?></a></center></li> -->

            <li class="dropdown" id="drpdown"><a class="center-menu dropdown-toggle" data-toggle="dropdown" href="#report"><img style="width: 30px;" src="../icon-menubar/new_icon/workload.png"><br class="br-menu">Report <span class="caret"></span></a>
              <ul class="dropdown-menu drpdwn-menu">
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="report.php">Report Excel&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="workload.php"><?= $lang['expertise'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="workload.php">Query&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
              </ul>
            </li>

            <!-- <li>
              <center class="center-menu"><a href="workload.php"><img style="width: 30px;" src="../icon-menubar/new_icon/workload.png"><br class="br-menu"><?= $lang['expertise'] ?></a></center>
            </li>
            <li><span class="center-menu"><a href="report.php"><img style="width: 30px;" src="../icon-menubar/new_icon/report.png"><br class="br-menu"></i>report</a></span>
            </li> -->
            <!-- 
            <li class="dropdown" id="drpdown"><a class="center-menu dropdown-toggle" data-toggle="dropdown" href="#template"><img style="width: 30px;" src="../icon-menubar/new_icon/template.png"><br class="br-menu">Template <span class="caret"></span></a>
              <ul class="dropdown-menu drpdwn-menu">
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="new_template.php"><?= $lang['new_template'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="view_template.php"><?= $lang['view_template'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
              </ul>
            </li> -->

            <!-- <li>
              <center class="center-menu"><a href="workload.php"><img style="width: 30px;" src="../icon-menubar/new_icon/query.png"><br class="br-menu">Query</a></center>
            </li> -->
            <!-- <li><span class="center-menu"><a href="about.php"><img style="width: 30px;" src="../icon-menubar/new_icon/about.png"><br class="br-menu"><?= $lang['about'] ?></a></span></li> -->



            <li><span class="center-menu"><a href="settings.php"><img style="width: 30px;" src="../icon-menubar/new_icon/settings.png"><br class="br-menu"><?= $lang['settings'] ?></a></span></li>

            <?php if ($exp >= -30) {
            ?>
              <li>
                <div class="blinking-bg"><span class="center-menu"><a href="view_pdf_contract.php"><img style="width: 30px;" src="../icon-menubar/new_icon/warningcontract.png"></i><br class="br-menu">CONTRACT</a></span></div>
              </li>
            <?php } ?>
            <?php if (@$exp2 >= -1) { ?>
              <li>
                <div class="blinking-bg"><span class="center-menu"><a href="maintenance.php"><img style="width: 30px;" src="../icon-menubar/new_icon/maintenance.png"></i><br class="br-menu">Maintenance </a></span></div>
              </li>
            <?php  } ?>
            <!-- <li><center class="center-menu"><a href="logout.php"><img style="width: 30px;" src="../icon-menubar/logout.png"><br class="br-menu"><?= $lang['logout'] ?></a></center></li> -->


            <li style="float: right; color: #fff" class="dropdown" id="drpdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%; text-align: center; padding-bottom: 18px;">
                <center class="center-menu"><strong><br> <i class="fas fa-user"></i> <?php echo $name; ?></strong> <span class="caret"></span></center>
              </a>
              <ul class="dropdown-menu drpdwn-menu">
                <li><a href="logout.php"><img style="width: 30px;" src="../icon-menubar/new_icon/logout.png"><br class="br-menu"><?= $lang['logout'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
              </ul>
            </li>

            <!-- <li style="float: right; color: #fff"><center><strong><br>Hai <i class="far fa-smile"></i>, <?php echo $name; ?></strong></center></li> -->

            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          </ul>
        </div>
        <div class="nav-bg-fostrap">
          <div class="navbar-fostrap"> <span></span> <span></span> <span></span> </div>
          <a href="" class="title-mobile"><img src="image/intiwid-logo-putih.png" style="width: 115px; margin-top: -5px;"></a>
        </div>

      </nav>
      <div class='content'>
      </div>
    </div>
  </div>
</div>