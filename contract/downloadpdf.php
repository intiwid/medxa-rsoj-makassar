<?php

require '../koneksi/koneksi.php';

session_start();

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>

    <head>
        <title>About | Radiographer</title>
        <?php include('head.php'); ?>
        <!-- <link rel="stylesheet" type="text/css" href="stylesss.css"> -->
        <style type="text/css">
            .rata-tengah {
                display: flex;
                flex-wrap: wrap;
                align-content: center;
                justify-content: center;
            }

            .dashboard-home2 {
                background-color: #fff;
                border: solid 1px #ecebeb;
                padding: 5px;
                margin: 5px;
                border-radius: 10px;
            }

            .feb-button {
                background-color: #0072bd;
                width: 100%;
                height: 86vh;
                color: #fff;
                padding: 20px;
                display: flex;
                flex-wrap: wrap;
                align-content: center;
                justify-content: center;
                margin-top: -33px;
                margin-bottom: -50px;
            }

            @media only screen and (max-width: 460px) {
                .feb-button {
                    display: inline-table;
                    margin-bottom: -20px;
                }
            }

            .heading {
                font-size: 45px;
                font-weight: 1000;
                letter-spacing: .1rem;
                margin-bottom: -15px;
            }

            .site-title {
                font-size: 30px;
                color: rgb(221, 221, 221);
                margin-bottom: -7px;
            }

            .site-slogan {
                font-size: 22px;
                color: rgb(223, 223, 223);
            }

            /*---------------------------------*/
            label#largeFile:after {
                /*  position:absolute;*/
                display: inline-block;
                width: 100%;
                content: "Click here to upload";
                text-align: center;
                padding: 3px 10px 3px 10px;
                border-radius: 10px;
                border: 5px dashed #ccc;
                color: #ccc;
                font-size: 30px;
            }

            label#largeFile:hover:after {
                background: #ccc;
                color: #fff;
                cursor: pointer;
            }

            label#largeFile input#files {
                width: 0px;
                height: 0px;
            }

            #info {
                display: none;
                padding: 10px 20px;
                width: auto;
                height: auto;
                overflow: hidden;
                background: #FFFFFF;
                border-radius: 3px;
            }

            #size span,
            #type span,
            #name span {
                color: #EA4026;
            }

            /*-------------------------------------------------*/
            button:focus {
                outline: none;
            }

            .more {
                position: relative;
                top: 30px;
                left: 18%;
                -webkit-transform: translate(-50%, -50%);
                -moz-transform: translate(-50%, -50%);
                -o-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                display: inline-block;
                padding: 15px 45px;
                background: #0072bd;
                border: none;
                font: 14px;
                color: #fff;
                border-radius: 4px;
                cursor: pointer;
                -webkit-transition: .3s ease;
                -moz-transition: .3s ease;
                -o-transition: .3s ease;
                transition: .3s ease;
            }

            .more:after {
                content: '';
                display: none;
                position: absolute;
                top: 50%;
                left: 50%;
                width: 20px;
                height: 20px;
                border: solid 2px;
                border-color: #fff transparent transparent transparent;
                border-radius: 100%;
                -webkit-transition: .3s ease;
                -moz-transition: .3s ease;
                -o-transition: .3s ease;
                transition: .3s ease;
                animation: spin 1s infinite;
                transform-origin: 0 0;
            }

            .more.load {
                padding: 15px 6px;
            }

            .more.load span {
                opacity: 0;
            }

            .more.load:after {
                display: block;
            }

            @keyframes spin {
                from {
                    transform: rotate(0) translate(-50%, -50%)
                }

                to {
                    transform: rotate(360deg) translate(-50%, -50%)
                }
            }


            .dcm-note p {
                font-size: 13px;
                font-weight: bold;
            }

            /*-----------------------------------------------*/
            .dashboard-home {
                width: 80%;
                padding: 15px;
                box-shadow: 10px 12px 0px #0c6aa8;
            }

            @media only screen and (max-width: 1411px) {
                .dashboard-home {
                    width: 75%;
                }

                .more {
                    left: 10%;
                }
            }

            @media only screen and (max-width: 1411px) {
                .dashboard-home {
                    width: 100%;
                    margin-top: 20px;
                }

                .more {
                    left: 14%;
                }
            }

            @media only screen and (max-width: 1411px) {
                .more {
                    left: 24%;
                }
            }
        </style>
    </head>

    <body>
        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Your Backup</li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">


                <div class="feb-button">

                    <div class="col-md-6 rata-tengah">
                        <div class="left-wrap">
                            <div class="left">
                                <div><img src="../icon-menubar/new_icon/excel.png"></div>
                                <div class="heading">FILE BACK UP REPORT</div>
                                <div class="site-title">Your Report Files</div>
                                <div class="site-slogan"><a style="color: #e37979; font-weight: bold;" href="index.php">INTIWID</a> Backup</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-home text-dark">
                            <div>
                                <div id="header">

                                </div>



                                <div id="content1">
                                    <h2>Download</h2>
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





                <div class="footerindex">
                    <div class="">
                        <?php include('footer-itw.php'); ?>
                    </div>
                </div>
            </div>
            <?php include('script-footer.php'); ?>
            <script>
                $(document).ready(function() {
                    $("a[href='#upload']").addClass("active-menu");
                });
            </script>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>