<?php
require '../koneksi/koneksi.php';
include '../contract-service.php';

// if (isset($_SESSION["username"])) {
//   if ((time() - $_SESSION['last_login_timestamp']) > 3600) //  3600 = 60 menit * 60 
//   {
//     header("location:logout.php");
//   } else {
//     $_SESSION['last_login_timestamp'] = time();
//   }
// } else {
//   header('location:../index.php');
// }

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
<?php include "../bahasa.php"; ?>
<div class="mainheader">
  <div class="container-fluid">
    <div class="row">

      <div class="header">
        <div class="container-fluid">
          <div id="center2" class="logo-top">
            <img class="logo" src="../image/intiwid-logo2.png" />
            <span class="ris-head"><?= $lang['ris'] ?></span>
            <img class="logo2" src="../image/ipi2.png" />
          </div>
        </div>
      </div>

      <nav>
        <div class="nav-fostrap">
          <ul>
            <li><a href="logout.php"><img style="width: 30px;" src="../icon-menubar/new_icon/logout.png"><br class="br-menu"><?= $lang['logout'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>

            </li>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
              <!-- <i class="fa fa-bars"></i> -->
          </ul>
        </div>
        <div class="nav-bg-fostrap">
          <div class="navbar-fostrap"> <span></span> <span></span> <span></span> </div>
          <a href="" class="title-mobile"><img src="image/intiwid-logo-putih.png"></a>
        </div>
    </div>
    </nav>
    <div class='content'>
    </div>
  </div>
</div>
</div>

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