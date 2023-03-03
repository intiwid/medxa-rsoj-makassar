<?php

require '../koneksi/koneksi.php';

session_start();

if ($_SESSION['level'] == "radiology") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('head.php'); ?>
<title>Home | Radiographer</title>

</head>

<body>

<?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
        <div class="row">
    

    <!-- //////content home/////////////// -->
          <?php include('../recyclebin.php'); ?>
    <!-- //////end content home/////////////// -->
    </div>       
    </div>

    <div class="footerindex">
        <div class="">
          <?php include('footer-itw.php'); ?>
        </div>
    </div>
        <?php include('script-footer.php'); ?>

       
  </body>
  </html>
   
   <?php } else {header("location:../index.php");} ?>