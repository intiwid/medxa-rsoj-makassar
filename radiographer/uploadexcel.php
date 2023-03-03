<?php

require '../koneksi/koneksi.php';

session_start();

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Backup Excel | Radiographer</title>
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
                                    <div class="heading">UPLOAD FILE REPORT</div>
                                    <div class="site-title">Back Up Your Report Files</div>
                                    <div class="site-slogan">With <a style="color: #85cbb3; font-weight: bold;" href="index.php">INTIWID</a> Backup</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class=" text-dark">
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
                                            @$file_ext        = strtolower(end(explode('.', $file_name)));
                                            $file_size        = $_FILES['file']['size'];
                                            $file_tmp        = $_FILES['file']['tmp_name'];
                                            $nama            = $_POST['nama'];
                                            $tgl            = date("Y-m-d");

                                            if (in_array($file_ext, $allowed_ext) === true) {
                                                if ($file_size < 10440700) {
                                                    $lokasi = 'files/' . $nama . '.' . $file_ext;
                                                    move_uploaded_file($file_tmp, $lokasi);
                                                    $q2 = mysqli_query($conn, 'SELECT MAX(id) as upload from xray_upload_excel');
                                                    $row2 = mysqli_fetch_assoc($q2);
                                                    $ai2 = $row2['upload'] + 1;
                                                    $in = mysqli_query($conn, "INSERT INTO xray_upload_excel VALUES('$ai2', '$tgl', '$nama', '$file_ext', '$file_size', '$lokasi')");
                                                    if ($in) {
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
                                            <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td><b>Nama File</b></td>
                                                    <td><b>:</b></td>
                                                    <td><input type="text" name="nama" size="40" required class="form-control" style="width: 215px; margin: 3px 0px;"></td>
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
                $("ul[id='service'] li[id='uploadexcel1']").addClass("active");
                $("li[data-target='#service'] a i").css('color', '#bdbdbd');
            });
        </script>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>