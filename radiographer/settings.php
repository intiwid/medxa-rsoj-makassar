<?php

require 'function_radiographer.php';

session_start();

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
  $password = $_POST['password'];
  $passwordulang = $_POST['passwordulang'];

  if ($password == $passwordulang) {
    password($_POST);
    echo "<script>alert('Password Changed');
document.location.href='settings.php';
</script>";
  } else {
    echo "<script>alert('password tidak sama');</script>";
  }
}

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Setting | radiographer</title>
    <?php include('head.php'); ?>
  </head>

  <body>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">
        <div class="col-12" style="padding: 0;">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">
                <?= $lang['settings'] ?>
              </li>
            </ol>
          </nav>
        </div>
        <div id="content1">

          <div class="container-fluid">
            <div class="">
              <div class="row">
                <?php if ($username != "demo") { ?>
                  <div class="col-xs-1 settingclass">
                    <a href="#" data-toggle="modal" data-target="#changePw" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/password.svg">
                        <center><?= $lang['change_pw'] ?></center>
                      </div>
                    </a>
                  </div>
                <?php } ?>
                <div class="col-xs-1 settingclass">
                  <a href="#" data-toggle="modal" data-target="#changeLanguage" style="text-decoration: none;">
                    <div class="thumbnail">
                      <img src="../icon-menubar/language.svg">
                      <center><?= $lang['change_language'] ?></center>
                    </div>
                  </a>
                </div>

                <div class="col-xs-1 settingclass">
                  <a href="dcm_send.php" style="text-decoration: none;">
                    <div class="thumbnail">
                      <img src="../icon-menubar/upload.svg">
                      <center>Upload Dicom</center>
                    </div>
                  </a>
                </div>

                <div class="col-xs-1 settingclass">
                  <a href="view_template.php" style="text-decoration: none;">
                    <div class="thumbnail">
                      <img src="../icon-menubar/template.svg">
                      <center>Template Expertise</center>
                    </div>
                  </a>
                </div>

                <!-- <div class="col-xs-1 settingclass">
                    <a href="recyclebinindex.php" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/recyclebin.svg">
                        <center>Recycle Bin</center>
                      </div>
                    </a>
                  </div> -->

                <div class="col-xs-1 settingclass">
                  <a href="about.php" style="text-decoration: none;">
                    <div class="thumbnail">
                      <img src="../icon-menubar/about.svg">
                      <center><?= $lang['about'] ?></center>
                    </div>
                  </a>
                </div>
                <?php
                //  if ($username == 'rafdi') {

                ?>
                <!-- <div class="col-xs-1 settingclass">
                    <a href="new_complaint.php" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../image/complain.png">
                        <center>Complaint</center>
                      </div>
                    </a>
                  </div> -->
                <?php
                // } 
                ?>
                <!-- <div class="col-xs-1 settingclass">
                  <a href="view_maintenance.php" style="text-decoration: none;">
                    <div class="thumbnail">
                      <img src="../image/maintenance.png">
                      <center>View Maintenance</center>
                    </div>
                  </a>
                </div> -->

                <!-- <div class="col-xs-1 settingclass">
                  <a href="http://192.168.10.144:8000" target="_blank" style="text-decoration: none;">
                    <div class="thumbnail">
                      <img src="../image/radiation.png">
                      <center>Report Dose</center>
                    </div>
                  </a>
                </div> -->
                <!-- <div class="col-xs-6 col-md-2">
                        <a href="#" class="thumbnail" data-toggle="modal" data-target="#aetitle" style="text-decoration: none;">
                          <img src="../icon-menubar/bone.png" >
                          <center>Input AE-TITLE Modality</center>
                        </a>
                      </div> -->

              </div>

              <!-- Modal -->
              <div class="modal fade" id="aetitle" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">AE-TITLE</h4>
                    </div>
                    <div class="modal-body">


                      <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                          <a style="text-decoration: none;" href="new_ae.php"><button type="button" class="btn btn-default"> Create AE-TITLE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                        </div>
                        <div class="btn-group" role="group">
                          <a style="text-decoration: none;" href="view_ae.php"><button type="button" class="btn btn-default"> View AE-TITLE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                        </div>
                      </div>





                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
              <!-- End Modal -->



              <!-- Modal -->
              <div class="modal fade" id="changeLanguage" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><?= $lang['change_language'] ?></h4>
                    </div>
                    <div class="modal-body">


                      <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                          <a style="text-decoration: none;" href="?lang=en"><button type="button" class="btn btn-default"><img style="width: 20px;" src="../image/usa.png"> English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                        </div>
                        <div class="btn-group" role="group">
                          <a style="text-decoration: none;" href="?lang=id"><button type="button" class="btn btn-default"><img style="width: 20px;" src="../image/indonesia.png"> Bahasa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                        </div>
                      </div>





                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
              <!-- End Modal -->


              <!-- Modal -->
              <div class="modal fade" id="changePw" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><?= $lang['change_pw'] ?></h4>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
                        <input class="form-control" type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
                        <label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
                        <input class="form-control" type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required><br>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-default" name="submit"><?= $lang['change_pw'] ?></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Modal -->

              <br>

            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- <div class="footerindex">
      <div class="">
        <?php include('footer-itw.php'); ?>
      </div>
    </div> -->

    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[id='settings1']").addClass("active");
        $("li[id='settings1'] a i").css('color', '#bdbdbd');
      });
    </script>

  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>