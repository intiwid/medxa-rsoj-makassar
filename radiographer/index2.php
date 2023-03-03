<?php

require '../koneksi/koneksi.php';

session_start();

if ($_SESSION['level'] == "radiographer") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('head.php'); ?>
<title>Home | Radiographer</title>

</head>

<body>

<?php include('menu-bar.php'); ?><br><br><br> <br><br><br>  
    <!-- ---------------------------------chart--------------------- -->
    

    <!-- //////content home/////////////// -->
  <?php include('../home-index2.php'); ?>
    <!-- //////end content home/////////////// -->
        <?php include('script-footer.php'); ?>
        <script>
    $(document).ready(function(){
      $(".dataTables_filter").hide();
      });
</script>

       
  </body>
  </html>
   
   <?php } else {header("location:../index.php");} ?>