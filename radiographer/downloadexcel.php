<?php

require '../koneksi/koneksi.php';

session_start();

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>

    <head>
        <title>Download Excel | Radiographer</title>
        <?php include('head.php'); ?>
        <style>
            body {
                background-color: #1f69b7;
            }
        </style>
    </head>

    <body>
        <?php include('../sidebar-index.php'); ?>
        <div class="container-fluid" id="main">
            <div class="row">

                <div id="content1">
                    <div class="feb-button">
                        <div class="col-md-6 rata-tengah">
                            <div class="left-wrap">
                                <div class="left">
                                    <div><img src="../icon-menubar/new_icon/excel.png"></div>
                                    <div class="heading">FILE BACK UP REPORT</div>
                                    <div class="site-title">Your Report Files</div>
                                    <div class="site-slogan"><a style="color: #85cbb3; font-weight: bold;" href="index.php">INTIWID</a> Backup</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dashboard-home text-dark">
                                <div>
                                    <div id="header"></div>
                                    <div id="content1">
                                        <center>
                                            <h2 style="color: #49957b;">Download</h2>
                                        </center>
                                        <p>
                                        <table class="table-dicom table-download table-paginate" id="example" width="100%" cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Tgl. Upload</th>
                                                    <th>Nama File</th>
                                                    <th>Tipe</th>
                                                    <th>Ukuran</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            include('../koneksi/koneksi.php');
                                            include('function_radiographer.php');
                                            $sql = mysqli_query($conn, "SELECT * FROM xray_upload_excel ORDER BY id DESC");
                                            if (mysqli_num_rows($sql) > 0) {
                                                $no = 1;
                                                while ($data = mysqli_fetch_assoc($sql)) {
                                                    echo '
                                                        <tr>
                                                            <td align="center">' . $no . '</td>
                                                            <td align="center">' . $data['tanggal_upload'] . '</td>
                                                            <td><a href="' . $data['file'] . '">' . $data['nama_file'] . '</a></td>
                                                            <td align="center">' . $data['tipe_file'] . '</td>
                                                            <td align="center">' . formatBytes($data['ukuran_file']) . '</td>
                                                        </tr>
                                                        ';
                                                    $no++;
                                                }
                                            } else {
                                                echo '
                                                <tr bgcolor="#fff">
                                                    <td align="center" colspan="5" align="center">Tidak ada data!</td>
                                                </tr>
                                                ';
                                            }
                                            ?>
                                        </table>
                                        </p>
                                    </div>
                                </div>
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
                $("li[data-target='#service']").addClass("active");
                $("ul[id='service'] li[id='downloadexcel1']").addClass("active");
                $("li[data-target='#service'] a i").css('color', '#bdbdbd');
            });
        </script>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>