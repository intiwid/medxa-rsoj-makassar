<?php
require "phpqrcode/qrlib.php";
require 'function_radiology.php';
session_start();
$username = $_SESSION['username'];
@$uid = $_GET['uid'];
// $query1 = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid' ";

// $result1 = mysqli_query($conn, $query1);

// $row1 = mysqli_fetch_assoc($result1);
// $signature = $row1['signature'];
if (isset($_POST["approvesign"])) {
    if (approvesignworkload($_POST)) {
        echo "
<script>
	alert('Sign QRCode Anda Telah Dibuat Oleh System');
	document.location.href= 'qrcode2.php?uid=$uid';
</script>
";
    } else {
        echo "
<script>
	alert('Sign QRCode Anda Gagal!');
	document.location.href= 'qrcode.php?uid=$uid&verify=verified';
</script>";
    }
}

if ($_SESSION['level'] == "radiology") {
    if ($_GET['verify'] == "verified") {

?>
        <!DOCTYPE html>
        <html>

        <head>

        </head>
        <?php include('head.php'); ?>

        <body>
            <?php include('../sidebar-index.php'); ?>
            <div class="container-fluid" id="main">
                <div class="row">

                    <div id="content1">
                        <div class="col-12" style="padding: 0;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="container-fluid">
                            <div class="about-inti">
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-3 table-box11">
                                        <h2>Take Your Sign </h2>
                                        <hr>
                                        <form action="" method="POST">
                                            <input type="hidden" name="uid" value="<?= $uid; ?>>
                                            <div style=" width: 100%;">
                                            <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/intiwid-native-base/radiology/pdf/expertise.php?uid=<?= $uid; ?>" target="_blank" name="pdf">
                                                <div class="btn" style="width: 100%; background-color: #d75c67; color: #fff;"><b>PDF</b></div>
                                            </a>
                                            <div style="float: right;">
                                                <button class="btn btn-success" name="approvesign">TAKE SIGN<i class="fas fa-check" style="font-size: 15px;"></i></button>
                                            </div>
                                    </div>

                                    <br>
                                    <br>
                                    <div>
                                        <input type="hidden" id="uid" name="uid" value="<?php echo $uid ?>">
                                    </div>
                                    <div class="btn-bar-1" style="float: right;">

                                        <!-- <button class="btn btn-worklist" name="showpdf">Show Preview Pdf</button> -->
                                    </div>
                                    </form>

                                </div>
                                <!-- <div class="col-xs-1 settingclass">
                    <a href="recyclebinindex.php" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/recyclebin.svg">
                        <center>Recycle Bin</center>
                      </div>
                    </a>
                  </div> -->
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="changeLanguage" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><?= $lang['change_language'] ?></h4>
                                        </div>
                                        <div class="modal-body">


                                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                                <div class="btn-group" role="group">
                                                    <a style="text-decoration: none;" href="?lang=en"><button type="button" class="btn btn-primary"><img style="width: 20px;" src="../image/usa.png"> English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a style="text-decoration: none;" href="?lang=id"><button type="button" class="btn btn-primary"><img style="width: 20px;" src="../image/indonesia.png"> Bahasa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Modal -->


                            <!-- Modal -->
                            <div class="modal fade" id="changePw" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><?= $lang['change_pw'] ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
                                                <input class="form-control" type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
                                                <label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
                                                <input class="form-control" type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required><br>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" name="submit"><?= $lang['change_pw'] ?></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

                            <br>


                        </div>
                    </div>
                </div>

            </div>
            </div>


            <?php include('script-footer.php'); ?>
        </body>

        </html>
<?php
    } else {
        header('location:otp.php');
    }
}
?>