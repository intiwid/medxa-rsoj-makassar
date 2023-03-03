<?php

require '../koneksi/koneksi.php';

session_start();

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>About | Radiographer</title>
    <?php include('head.php'); ?>
  </head>

  <body>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">

        <div id="content1">
          <div class="col-12" style="padding: 0;">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">
                  <?= $lang['about'] ?>
                </li>
              </ol>
            </nav>
          </div>
          <div class="container-fluid">
            <div class="about-inti">
              <h2><?= $lang['about_us'] ?></h2><br>
              <?= $lang['about_content'] ?>
              <img style="width: 30px;" src="../image/whatsapp.svg">&nbsp;&nbsp;<label>+62 822-2022-7912</label>&nbsp; (IT SERVICE)<br><br>
              <img style="width: 30px;" src="../image/gmail.svg">&nbsp;&nbsp;<label>itservice@intimedika.com</label>
              </p>
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
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>