<?php

require '../koneksi/koneksi.php';
include '../contract-service.php';

session_start();

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Storage | Radiographer</title>
        <?php include('head.php'); ?>
        <style>
            body {
                background-color: #1f69b7;
            }
        </style>

    </head>

    <body>
        <?php include('../sidebar-index.php'); ?>
        <div class="container" id="main">
            <div class="row">


                <div id="content1">

                    <div class="feb-button">
                        <div class="container-fluid">
                            <div class="">

                                <?php
                                function ConvertBytes($number)
                                {
                                    $len = strlen($number);
                                    if ($len < 4) {
                                        return sprintf("%d b", $number);
                                    }
                                    if (
                                        $len >= 4 && $len <= 6
                                    ) {
                                        return sprintf("%0.2f KB", $number / 1024);
                                    }
                                    if (
                                        $len >= 7 && $len <= 9
                                    ) {
                                        return sprintf("%0.2f MB", $number / 1024 / 1024);
                                    }

                                    return sprintf("%0.2f GB", $number / 1024 / 1024 / 1024);
                                }
                                ?>
                                <div>
                                    <img style="width: 180px;" src="../image/warehouse.svg">
                                </div>
                                <div class="free_disk">Disk Free : <?= ConvertBytes($diskFree) ?></div><br>
                                <div class="total_disk">Disk Total : <?= ConvertBytes($diskTotal) ?></div><br>
                                <div class="used_disk">Disk Used : <?= ConvertBytes($diskUsed) ?></div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="footerindex">
            <div class="">
                <?php include('footer-itw.php'); ?>
            </div>
        </div>

        <?php include('script-footer.php'); ?>
        <script>
            $(document).ready(function() {
                $("li[id='storage1']").addClass("active");
                $("li[id='storage1'] a i").css('color', '#bdbdbd');
            });
        </script>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>