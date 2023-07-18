<?php
require '../koneksi/koneksi.php';
session_start();

// --------------------------------

if ($_SESSION['level'] == "refferal") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>

    <head>
        <title>Workload | Radiographer</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('../sidebar-index.php'); ?>
        <div class="container-fluid" id="main">
            <div class="row">
                <?php include('../workload-fill-detail-index.php'); ?>
            </div>
        </div>
        <br><br>
        <div class="footerindex">
            <div class="">
                <?php include('footer-itw.php'); ?>
            </div>
        </div>
        <?php include('script-footer.php'); ?>
    </body>

    </html>
    <script>
        $(document).ready(function() {
            $("li[data-target='#expertise-history']").addClass("active");
            $("li[id='expertise-history']").addClass("active");
            $("li[data-target='#expertise-history'] a i").css('color', '#bdbdbd');
        });
    </script>
<?php } else {
    header("location:../index.php");
} ?>