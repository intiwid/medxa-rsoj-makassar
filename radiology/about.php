<?php

require '../koneksi/koneksi.php';

session_start();

if ($_SESSION['level'] == "radiology") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>About | Radiology</title>
    <?php include('head.php'); ?>
  </head>

  <body>

    <?php include('menu-bar.php'); ?><br>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb1 breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
      </ol>
    </nav>

    <div id="container1">
      <div id="content1">
        <div class="container-fluid">
          <div class="about-inti col-md-7">
            <h2><?= $lang['about_us'] ?></h2><br>
            <?= $lang['about_content'] ?><br>


            <p>
              <img style="width: 30px;" src="../image/whatsapp.png">&nbsp;&nbsp;<label>+62 822-2022-7912</label>&nbsp; (IT SERVICE)<br><br>
              <img style="width: 30px;" src="../image/email.png">&nbsp;&nbsp;<label>itservice@intimedika.com</label>
            </p>
          </div>
        </div>
      </div>

      <div class="footerindex">
        <div class="">
          <?php include('footer-itw.php'); ?>
        </div>
      </div>
    </div>
    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("a[href='about.php']").addClass("active-menu");
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>