<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Home | Admin</title>
    <?php include('head.php'); ?>
    <script type="text/javascript" src="js/Chart.js"></script>
    <!-- <style type="text/css">
    body{
    font-family: roboto;
    }
    table{
    margin: 0px auto;
    }
    </style> -->
  </head>

  <body>
    <?php include('menu-bar.php'); ?><br><br><br> <br><br><br>
    <!-- ---------------------------------chart--------------------- -->


    <!-- //////content home/////////////// -->
    <?php include('../home-index.php'); ?>
    <!-- //////end content home/////////////// -->


    <!-- <div class="footerindex">
        
          <div class="footer-login"><br>
            <center><p style="margin-bottom: 0px;">&copy; Powered by Intiwid IT Solution 2022</a>.</p></center>
          </div>
  
      </div> -->





    <?php include('script-footer.php'); ?>

  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>