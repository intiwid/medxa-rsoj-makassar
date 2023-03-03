<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Home | Radiographer</title>
        <?php include('head.php'); ?>

    </head>

    <body>
        <?php include('sidebarnew.php'); ?>
        <section class="home-section">
            <div class="container-fluid" id="main">
                <div class="row">
                    <div class="col-12" style="padding: 0;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="margin-bottom: 0; padding-top:0;">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">
                                    <?= $lang['ris'] ?>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <!-- //////content home/////////////// -->
                    <?php include('../home-index.php'); ?>
                    <!-- //////end content home/////////////// -->

                </div>
            </div>
        </section>


        <?php include('script-footer.php'); ?>
        <script>
            $(document).ready(function() {
                $("li[data-target='#home1']").addClass("active");
            });
        </script>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>