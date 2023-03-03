<?php

session_start();

if ($_SESSION['level'] == "superadmin") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>New Template</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php include('head.php'); ?>
  </head>

  <body>
    <?php include('menu-bar.php'); ?><br><br><br><br><br><br><br>
    <div class="container-fluid" id="main">
      <?php include('../template-create.php'); ?>
    </div>
    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[data-target='#template']").addClass("active");
        $("ul[id='template'] li[id='newt1']").addClass("active");
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>