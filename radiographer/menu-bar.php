<?php
require '../koneksi/koneksi.php';
include '../contract-service';

if (isset($_SESSION["username"])) {
  if ((time() - $_SESSION['last_login_timestamp']) > 3600) //  3600 = 60 menit * 60 
  {
    header("location:logout");
  } else {
    $_SESSION['last_login_timestamp'] = time();
  }
} else {
  header('location:../index');
}

$username = $_SESSION['username'];
$result10 = mysqli_query($conn, "SELECT * FROM xray_radiographer WHERE username = '$username'");
$row10 = mysqli_fetch_assoc($result10);
$radiographer_name = $row10['radiographer_name'] . ' ' . $row10['radiographer_lastname'];
?>

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
<?php include "../bahasa"; ?>
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
        <div class="nav-fostrap">
          <ul>
            <li><span class="center-menu"><a href="index.php"><img style="width: 30px;" src="../icon-menubar/new_icon/home.png"><br class="br-menu"><?= $lang['home'] ?></a></span>
            </li>

            <li><span class="center-menu"><a href="registration.php"><img style="width: 30px;" src="../icon-menubar/new_icon/registration.png"><br class="br-menu"><?= $lang['registration'] ?></a></span>
            </li>
            <li><span class="center-menu"><a href="order2.php"><img style="width: 30px;" src="../icon-menubar/new_icon/order.png"><br class="br-menu"><?= $lang['all_order'] ?></a></span>
            </li>
            <li><span class="center-menu"><a href="exam2.php"><img style="width: 30px;" src="../icon-menubar/new_icon/exam-room.png"><br class="br-menu"><?= $lang['examroom'] ?></a></span>
            </li>

            <li><span class="center-menu"><a href="workload.php"><img style="width: 30px;" src="../icon-menubar/new_icon/workload.png"><br class="br-menu">Workload</a></span></li>




            <li class="dropdown" id="drpdown"><a class="center-menu dropdown-toggle" data-toggle="dropdown" href="#template"><img style="width: 30px;" src="../icon-menubar/new_icon/template.png"><br class="br-menu">Template <span class="caret"></span></a>
              <ul class="dropdown-menu drpdwn-menu">
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="new_template.php"><?= $lang['new_template'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="view_template.php"><?= $lang['view_template'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
              </ul>
            </li>

            <li><span class="center-menu"><a href="chart.php"><img style="width: 30px;" src="../icon-menubar/new_icon/chart.png"><br class="br-menu"><?= $lang['chart'] ?></a></span></li>
            <li><span class="center-menu"><a href="report.php"><img style="width: 30px;" src="../icon-menubar/new_icon/report.png"><br class="br-menu"></i>Report</a></span>
            </li>

            <li class="dropdown" id="drpdown"><a class="center-menu dropdown-toggle" data-toggle="dropdown" href="#upload"><img style="width: 30px;" src="../icon-menubar/new_icon/excel.png"><br class="br-menu">Excel <span class="caret"></span></a>
              <ul class="dropdown-menu drpdwn-menu">
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="uploadexcel.php"><?= $lang['upload_excel'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a style="width: 160px; margin-left: 0px; border-radius:0%;" href="downloadexcel.php"><?= $lang['download_excel'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
              </ul>
            </li>

            <li><span class="center-menu"><a href="dcm_send.php"><img style="width: 30px;" src="../icon-menubar/new_icon/send.png"><br class="br-menu">DCM Send</a></span></li>


            <!-- <li><span class="center-menu"><a href="about.php"><img style="width: 30px;" src="../icon-menubar/new_icon/about.png"><br class="br-menu"><?= $lang['about'] ?></a></span></li> -->
            <li><span class="center-menu"><a href="settings.php"><img style="width: 30px;" src="../icon-menubar/new_icon/settings.png"><br class="br-menu"><?= $lang['settings'] ?></a></span></li>


            <?php
            // Storage
            if (@$diskFree <= 10000000000) { ?>
              <li>
                <div class="blinking-bg"><span class="center-menu"><a href="storage.php"><img style="width: 30px;" src="../icon-menubar/new_icon/storage.png"></i><br class="br-menu">Storage Full</a></span></div>
              </li>
            <?php } else { ?>
              <li>
                <div><span class="center-menu"><a href="storage.php"><img style="width: 30px;" src="../icon-menubar/new_icon/storage.png"></i><br class="br-menu">Storage Full</a></span></div>
              </li>
            <?php } ?>
            <!-- End Storage -->




            <?php if (@$exp >= -30) {
            ?>
              <li>
                <div class="blinking-bg"><span class="center-menu"><a href="view_pdf_contract.php" target="_blank"><img style="width: 30px;" src="../icon-menubar/new_icon/warningcontract.png"></i><br class="br-menu">CONTRACT</a></span></div>
              </li>
            <?php } ?>

            <?php if (@$exp2 >= -1) { ?>
              <li>
                <div class="blinking-bg"><span class="center-menu"><a href="maintenance2.php"><img style="width: 30px;" src="../icon-menubar/new_icon/maintenance.png"></i><br class="br-menu">Maintenance </a></span></div>
              </li>
            <?php } ?>










            <li style="float: right; color: #fff" class="dropdown" id="drpdown">
              <a class="dropdown-name dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%; text-align: center;">
                <span class="center-menu"><strong><img style="width: 30px;" src="../icon-menubar/new_icon/user.png"><br class="br-menu"><?php echo $radiographer_name; ?></strong> <span class="caret"></span></span>
              </a>
              <ul class="dropdown-menu drpdwn-menu dropdown-lgout">
                <li><a href="logout.php"><img style="width: 30px;" src="../icon-menubar/new_icon/logout.png"><br class="br-menu"><?= $lang['logout'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
              </ul>
            </li>









            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
              <!-- <i class="fa fa-bars"></i> -->
          </ul>
        </div>



        <?php if ($exp >= -30) {
        ?>
          <div class="nav-bg-fostrap blinking-bg-resp">
            <div class="navbar-fostrap"> <span></span> <span></span> <span></span> </div>
            <a href="" class="title-mobile"><img src="image/intiwid-logo-putih.png"></a>
          </div>
        <?php } else {
        ?>
          <div class="nav-bg-fostrap">
            <div class="navbar-fostrap"> <span></span> <span></span> <span></span> </div>
            <a href="" class="title-mobile"><img src="image/intiwid-logo-putih.png"></a>
          </div>
        <?php } ?>

    </div>
    </nav>
    <div class='content'>
    </div>
  </div>
</div>
</div>




<?php include('../chat_index'); ?>





<!-- Modal -->
<div class="modal fade" id="modal-expertise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Full License</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>Contact us at (Office) +62-21-4532648</h2>
        <img style="width: 30px;" src="../image/whatsapp.png">&nbsp;&nbsp;<label>+62 822-2022-7912</label>&nbsp; (IT SERVICE)<br><br>
        <img style="width: 30px;" src="../image/email.png">&nbsp;&nbsp;<label>itservice@intimedika.com</label>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ----------- -->