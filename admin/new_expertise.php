<?php
require 'function_dokter.php';
session_start();

$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM xray_expertise"));

if (isset($_POST["submit"])) {
    if (update_expertise($_POST) > 0) {
        echo "<script type='text/javascript'>
						setTimeout(function () { 
						swal({
								title: 'Berhasil Diinput!',
								text:  '',
								icon: 'success',
								timer: 1000,
								showConfirmButton: true
							});  
						},10); 
						window.setTimeout(function(){ 
						window.location.replace('view_expertise.php');
						} ,1000); 
					</script>";
    } else {
        echo "<script type='text/javascript'>
						setTimeout(function () { 
						swal({
								title: 'Gagal Diinput!',
								text:  '',
								icon: 'error',
								timer: 1000,
								showConfirmButton: true
							});  
						},10); 
						window.setTimeout(function(){ 
						window.location.replace('new_expertise.php');
						} ,1000); 
					</script>";
    };
}
if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Update Expertise dokter radiologi</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Expertise</li>
                <li style="float: right;">
                    <label>Zoom</label>
                    <a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
                    <a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
                </li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="body">
                    <h1 style="color: #ee7423">Expertise</h1>
                    <div class="container-fluid">
                        <div class="row form-dokter">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-md-5 col-md-offset-1">
                                    <input type="hidden" name="pk" value="1">
                                    <label for="dokradid"><b>- Qr Code Hasil Pasien ? </b></label><br>
                                    <label class="radio-admin">
                                        <input type="radio" <?= $row['qr_code_pasien'] == '1' ? 'checked' : ''; ?> name="qr_code_pasien" value="1"> Aktif
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-admin">
                                        <input type="radio" <?= $row['qr_code_pasien'] == '0' ? 'checked' : ''; ?> name="qr_code_pasien" value="0"> Tidak Aktif
                                        <span class="checkmark"></span>
                                    </label>
                                    <br>
                                    <!--  -->
                                    <label for="dokradid"><b>- Signature Dokter Radiologi ? </b></label><br>
                                    <label class="radio-admin">
                                        <input type="radio" <?= $row['signature_dokter_radiologi'] == 'qr_code' ? 'checked' : ''; ?> name="signature_dokter_radiologi" value="qr_code"> Qr Code
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-admin">
                                        <input type="radio" <?= $row['signature_dokter_radiologi'] == 'signature_scan' ? 'checked' : ''; ?> name="signature_dokter_radiologi" value="signature_scan"> Signature Scan
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-admin">
                                        <input type="radio" <?= $row['signature_dokter_radiologi'] == 'signature_empty' ? 'checked' : ''; ?> name="signature_dokter_radiologi" value="signature_empty"> Signature Empty
                                        <span class="checkmark"></span>
                                    </label>
                                    <button class="button1" type="submit" name="submit"><?= $lang['add_data'] ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerindex">
                <div class="">
                    <div class="footer-login col-sm-12"><br>
                        <center>
                            <p>&copy; Powered by Multimed IT Solution 2022</a>.</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php include('script-footer.php'); ?>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>