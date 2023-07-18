<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "refferal") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <?php include('head.php'); ?>
    <title>Home | radiology</title>

  </head>

  <body>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">

        <!-- //////content home/////////////// -->
        <?php include('../workload-index.php'); ?>
        <!-- //////end content home/////////////// -->

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
        $("li[id='query1']").addClass("active");
        $("li[data-target='#query1']").addClass("active");
        $("ul[id='query1'] li[id='workload1']").addClass("active");
        $("li[data-target='#query1'] a i").css('color', '#bdbdbd');
      });
    </script>


  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>