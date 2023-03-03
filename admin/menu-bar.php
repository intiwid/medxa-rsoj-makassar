<?php
require '../koneksi/koneksi.php';

if (isset($_SESSION["username"])) {
  if ((time() - $_SESSION['last_login_timestamp']) > 600) // 600 = 10 * 60
  {
    header("location:logout.php");
  } else {
    $_SESSION['last_login_timestamp'] = time();
  }
} else {
  header('location:../index.php');
}

$username = $_SESSION['username'];
$result10 = mysqli_query($conn, "SELECT * FROM xray_admin WHERE username = '$username'");
$row10 = mysqli_fetch_assoc($result10);
$name = $row10['ad_name'] . ' ' . $row10['ad_lastname'];
?>
<?php include "../bahasa.php"; ?>
<div class="mainheader">
  <div class="container-fluid">
    <div class="row">
      <div class="header">

        <div class="container-fluid">
          <!-- <div id="center" class="col-md-2">
            <img class="logo1" src="image/logo-rispacs1.png" />
          </div> -->
          <div id="center2" class="col-md-2">
            <img class="logo" src="../image/intiwid-logo-new-putih-2.png" />
          </div>
        </div>

      </div>

      <nav>
        <div class="container-fluid">
          <div class="row">
            <div class="nav-fostrap">
              <ul>
                <!-- <li><center><a href="index.php"><img style="width: 30px;" src="../icon-menubar/home.png"><br><i class="fas fa-home-alt"></i><?= $lang['home'] ?></a></center></li> -->
                <li>
                  <center><a href="administrator.php"><img style="width: 30px;" src="../icon-menubar/new_icon/registration.png"><br><?= $lang['administrator'] ?></a></center>
                </li>
                <!-- <li><center><a href="report.php"><img style="width: 30px;" src="../icon-menubar/report.png"><br><?= $lang['report'] ?></a></center></li> -->
                <!--  <li><center><a href="report-news.php"><img style="width: 30px;" src="../icon-menubar/news.png"><br><?= $lang['report_news'] ?></a></center></li> -->
                <li>
                  <center><a href="about.php"><img style="width: 30px;" src="../icon-menubar/new_icon/about.png"><br><?= $lang['about'] ?></a></center>
                </li>

                <!--  <li><center><a href="#" data-toggle="modal" data-target="#myModalMenu"><img data-toggle="tooltip" title="For Enterprise" style="width: 30px;" src="../icon-menubar/folder.png"><br>Management CS</a></center></li>
          <li><center><a href="#" data-toggle="modal" data-target="#myModalMenu"><img data-toggle="tooltip" title="For Enterprise" style="width: 30px;" src="../icon-menubar/bhp.png"><br>BHP</a></center></li>
          <li><center><a href="#" data-toggle="modal" data-target="#myModalMenu"><img data-toggle="tooltip" title="For Enterprise" style="width: 30px;" src="../icon-menubar/dose.png"><br>Dose Monitoring</a></center></li> -->




                <li class="dropdown" id="drpdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <center><img style="width: 30px;" src="../icon-menubar/language.png"><br><?= $lang['language'] ?><span class="caret"></span></center>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="?lang=en"><img style="width: 20px;" src="../image/usa.png"> English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                    <li><a href="?lang=id"><img style="width: 20px;" src="../image/indonesia.png"> Bahasa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                  </ul>
                </li>
                <li>
                  <center><a href="logout.php"><img style="width: 30px;" src="../icon-menubar/new_icon/logout.png"><br><?= $lang['logout'] ?></a></center>
                </li>
                <li style="float: right; color: #fff">
                  <center><bold><br>Administrator</bold></center>
                </li>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                  <!-- <i class="fa fa-bars"></i> -->
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


<!-- Modal -->
<div class="modal fade" id="myModalMenu" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">This Fiture for Enterprise</h4>
      </div>
      <div class="modal-body">
        <label>Contact us for Enterprise</label><br>
        <p><img style="width: 30px;" src="../image/whatsapp.png">&nbsp;&nbsp;<label>+62 822-2022-7912</label><br><br>
          <img style="width: 30px;" src="../image/email.png">&nbsp;&nbsp;<label>itservice@intimedika.com</label>/<label>Email: sales@intimedika.co</label>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>