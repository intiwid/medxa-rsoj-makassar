<?php

require '../koneksi/koneksi.php';

session_start();
$no_contract = $_GET['id'];
echo $no_contract;
$select_pdf = mysqli_query($conn, "SELECT * FROM xray_upload_pdf WHERE contract_id = '$no_contract'");
$row_pdf = mysqli_fetch_assoc($select_pdf);
$idpdf = $row_pdf['id'];

if (!$idpdf && $_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>About | Radiographer</title>
        <?php include('head.php'); ?>
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
                <li class="breadcrumb-item active" aria-current="page">Backup Excel</li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">


                <div class="feb-button">

                    <div class="col-md-6 rata-tengah">
                        <div class="left-wrap">
                            <div class="left">
                                <div><img src="../icon-menubar/new_icon/excel.png"></div>
                                <div class="heading">UPLOAD FILE REPORT</div>
                                <div class="site-title">Back Up Your Report Files</div>
                                <div class="site-slogan">With <a style="color: #e37979; font-weight: bold;" href="index.php">INTIWID</a> Backup</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-home text-dark">

                            <div class="table-box">
                                <!-- <div id="menu">
                                        <a href="uploadexcel.php" class="active">Upload</a>
                                        <a href="downloadexcel.php">Download</a>
                                    </div> -->

                                <div id="content1" style="font-size: 14px;">
                                    <p>Files can be uploaded with this extension <b> .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .rar, .zip </b> maximum upload files 10MB.</p><br>
                                    <p style="color: red;"><b>Rename your format excel file before upload with .XLSX</b></p>

                                    <?php

                                    if (@$_POST['upload']) {
                                        $allowed_ext    = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip');
                                        $file_name        = $_FILES['file']['name'];
                                        $file_ext        = strtolower(end(explode('.', $file_name)));
                                        $file_size        = $_FILES['file']['size'];
                                        $file_tmp        = $_FILES['file']['tmp_name'];
                                        $nama            = $_POST['nama'];
                                        $tgl            = date("Y-m-d");

                                        if (in_array($file_ext, $allowed_ext) === true) {
                                            if ($file_size < 10440700) {
                                                $lokasi = 'pdf/' . $nama . '.' . $file_ext;
                                                move_uploaded_file($file_tmp, $lokasi);
                                                $q2 = mysqli_query($conn, 'SELECT MAX(id) as upload from xray_upload_pdf');
                                                $row2 = mysqli_fetch_assoc($q2);
                                                $ai2 = $row2['upload'] + 1;
                                                $in = mysqli_query($conn, "INSERT INTO xray_upload_pdf VALUES('$ai2', '$no_contract', '$tgl', '$nama', '$file_ext', '$file_size', '$lokasi')");
                                                if ($in) {
                                                    echo '<meta http-equiv="refresh" content="1" />';
                                                    echo '<div class="ok">SUCCESS: File berhasil di Upload!</div>';
                                                } else {
                                                    echo '<div class="error">ERROR: Gagal upload file!</div>';
                                                }
                                            } else {
                                                echo '<div class="error">ERROR: Besar ukuran file (file size) maksimal 1 Mb!</div>';
                                            }
                                        } else {
                                            echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
                                        }
                                    }
                                    ?>

                                    <p>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <table width="100%" align="center" border="0" bgcolor="#eee" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td><b>Nama File</b></td>
                                                <td><b>:</b></td>
                                                <td><input type="text" name="nama" size="40" required class="form-control mb-4" style="width: 50%;"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Pilih File</b></td>
                                                <td><b>:</b></td>
                                                <td>
                                                    <!-- <input type="file" name="file" required /> -->

                                                    <label class="file1" title="">
                                                        <input type="file" name="file" required onchange="this.parentNode.setAttribute('title', this.value.replace(/^.*[\\/]/, ''))" />
                                                    </label>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><input type="submit" class="btn-worklist" name="upload" value="UPLOAD" style="font-weight:bold; margin: 10px 0px; font-size: 15px;"></td>
                                            </tr>
                                        </table>
                                    </form>
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
    header("location:update_contract.php");
} ?>