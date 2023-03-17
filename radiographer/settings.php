<?php

require 'function_radiographer.php';
include '../contract-service.php';

session_start();

ini_set("upload_max_filesize", "1000000M");
if (isset($_POST['upload'])) {
  if (!is_dir('dcm_temp')) mkdir('dcm_temp');
  foreach ($_FILES['files']['name'] as $i => $name) {
    if (strlen($_FILES['files']['name'][$i]) > 1) {
      move_uploaded_file($_FILES['files']['tmp_name'][$i], "dcm_temp/" . $name);
    }
  }
  echo "Folder is successfully uploaded";
  header('location:dcmsend.php');
}

if (isset($_POST["submit2"])) {
  if (new_temp($_POST) > 0) {
    echo "
<script>
  alert('Template Berhasil ditambahkan');
  document.location.href= 'view_template.php';
</script>
";
  } else {
    echo "
<script>
  alert('Template Gagal ditambahkan');
  document.location.href= 'new_template.php';
</script>";
  }
}

$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");


$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
  $password = $_POST['password'];
  $passwordulang = $_POST['passwordulang'];

  if ($password == $passwordulang) {
    password($_POST);
    echo "<script>alert('Password Changed');
document.location.href='settings.php';
</script>";
  } else {
    echo "<script>alert('password tidak sama');</script>";
  }
}

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Setting | radiographer</title>
    <?php include('head.php'); ?>
  </head>

  <body>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
        <div class="row">
          <div class="col-12" style="padding: 0;">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">
                  <?= $lang['settings'] ?>
                </li>
              </ol>
            </nav>
          </div>
          <div id="content1">

            <div class="container-fluid settings-card">





              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border-bottom: 2px solid #377d71;">
                <li class="nav-item">
                  <a class="nav-link active" id="upload-dicom-tab" data-toggle="pill" href="#upload-dicom" role="tab" aria-controls="upload-dicom" aria-selected="true" style="border-radius: 5px 0 0 0;"><i class="fa-solid fa-file-import"></i> Upload Dicom</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-change-pass-tab" data-toggle="pill" href="#pills-change-pass" role="tab" aria-controls="pills-change-pass" aria-selected="false"><i class="fa-solid fa-key"></i> <?= $lang['change_pw'] ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-change-language-tab" data-toggle="pill" href="#pills-change-language" role="tab" aria-controls="pills-change-language" aria-selected="false"><i class="fa-solid fa-language"></i> <?= $lang['change_language'] ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-template-expertise-tab" data-toggle="pill" href="#pills-template-expertise" role="tab" aria-controls="pills-template-expertise" aria-selected="false"><i class="fa-solid fa-file-medical"></i> Template Expertise</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-storage-tab" data-toggle="pill" href="#pills-storage" role="tab" aria-controls="pills-storage" aria-selected="false"><i class="fa-solid fa-file-medical"></i> Storage</a>
                </li>
              </ul>

              <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                <div class="tab-pane fade show active" id="upload-dicom" role="tabpanel" aria-labelledby="upload-dicom-tab">
                  <div class="container-fluid">
                    <div class="row">

                      <div id="content1">
                        <div class="feb-button">
                          <div class="container rata-tengah">
                            <div class="left-wrap">
                              <div class="left">
                                <div><img src="../image/upload_med.png"></div>
                                <div class="heading">DICOM SEND</div>
                                <div class="site-title">Upload Your Dicom Files Here</div>
                                <!-- <div class="site-slogan">With <a style="color: #ac0061; font-weight: bold;" href="index.php">Multimed</a> Dicom Send</div> -->
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="dashboard-home text-dark">

                              <form action="" method="post" enctype="multipart/form-data">
                                <!--<select name="fromrs" id="formrs">
                                      <option value="A">RS A</option>
                                      <option value="B">RS B</option>
                                    </select>-->
                                <label id="largeFile" class="dcm_click" for="files" style="width: 100%;">
                                  <input type="file" name="files[]" id="files" multiple directory="" webkitdirectory="" moxdirectory=""></label>
                                <br>
                                <button type="Submit" value="Upload" name="upload" class="more dcm_button" style="float: right;"><span>Upload </span></button>
                              </form>
                              <div id="info"><br>
                                <p id="name">File Name : <span></span></p>
                                <p id="size">Number of files : <span></span></p>
                                <p id="type">File Type : <span></span></p>
                              </div>
                              <br>
                              <div style="display: flex;">
                                <div style="font-size: 22px; font-weight: 1000; color: red; margin-top: -2px;">*</div>
                                <div class="dcm-note">
                                  <p>
                                    Data dicom harus berada di dalam folder <br>
                                    Pastikan dicom yang dikirim mempunyai Patient ID <br>
                                    Upload membutuhkan waktu sesuai banyaknya data dicom
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="pills-change-pass" role="tabpanel" aria-labelledby="pills-change-pass-tab">
                  <div class="container">
                    <form action="" method="post">
                      <div class="row justify-content-center align-items-center">
                        <div class="col-8" style="background: #ececec; padding: 20px; border-radius: 5px;">
                          <div class="input-group input-group-regist input-regist input-group-icon"><input type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>" />
                            <div class="input-icon"><i class="fa-solid fa-lock-open"></i></div>
                          </div>
                          <div class="input-group input-group-regist input-regist input-group-icon"><input type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['change_pw'] ?>" />
                            <div class="input-icon"><i class="fa-solid fa-lock"></i></div>
                          </div>
                          <div style="text-align: right;"><input type="checkbox" onclick="myFunction()"> Show Password</div>

                          <!-- <label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
                         <input class="form-control" type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
                         <label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
                         <input class="form-control" type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required><br> -->
                          <div class="">
                            <button type="submit" class="btn btn-green-ms text-light" name="submit" style="margin: 0;"><?= $lang['change_pw'] ?></button>
                            <!-- <button type="button" class="btn btn-green-ms text-light" data-dismiss="modal">Close</button> -->
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="tab-pane fade" id="pills-change-language" role="tabpanel" aria-labelledby="pills-change-language-tab">
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                          <a style="text-decoration: none;" href="?lang=en"><button type="button" class="btn btn-green-ms btn-en"> English</button></a>
                        </div>
                        <div class="btn-group" role="group">
                          <a style="text-decoration: none;" href="?lang=id"><button type="button" class="btn btn-green-ms btn-id">Bahasa</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="pills-template-expertise" role="tabpanel" aria-labelledby="pills-template-expertise-tab">
                  <div class="container">

                    <div class="about-inti back-search" style="padding: 10px;">

                      <center>
                        <h1 style="color: #377d71;"><?= $lang['create_template'] ?></h1>
                      </center>

                      <?php include('../template-create.php'); ?>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="pills-storage" role="tabpanel" aria-labelledby="pills-storage-tab">
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="btn-group btn-group-justified" role="group" aria-label="...">

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
                </div>

              </div>






              <!-- <div class="">
                <div class="row">
                  <?php if ($username != "demo") { ?>
                    <div class="col-xs-1 settingclass">
                      <a href="#" data-toggle="modal" data-target="#changePw" style="text-decoration: none;">
                        <div class="thumbnail">
                          <img src="../icon-menubar/password.svg">
                          <center><?= $lang['change_pw'] ?></center>
                        </div>
                      </a>
                    </div>
                  <?php } ?>
                  <div class="col-xs-1 settingclass">
                    <a href="#" data-toggle="modal" data-target="#changeLanguage" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/language.svg">
                        <center><?= $lang['change_language'] ?></center>
                      </div>
                    </a>
                  </div>

                  <div class="col-xs-1 settingclass">
                    <a href="dcm_send.php" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/upload.svg">
                        <center>Upload Dicom</center>
                      </div>
                    </a>
                  </div>

                  <div class="col-xs-1 settingclass">
                    <a href="new_template.php" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/template.svg">
                        <center>Template Expertise</center>
                      </div>
                    </a>
                  </div>

                  <div class="col-xs-1 settingclass">
                    <a href="recyclebinindex.php" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/recyclebin.svg">
                        <center>Recycle Bin</center>
                      </div>
                    </a>
                  </div>

                  <div class="col-xs-1 settingclass">
                    <a href="about.php" style="text-decoration: none;">
                      <div class="thumbnail">
                        <img src="../icon-menubar/about.svg">
                        <center><?= $lang['about'] ?></center>
                      </div>
                    </a>
                  </div>

                  <div class="col-xs-6 col-md-2">
                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#aetitle" style="text-decoration: none;">
                      <img src="../icon-menubar/bone.png">
                      <center>Input AE-TITLE Modality</center>
                    </a>
                  </div>

                </div>


                <div class="modal fade" id="aetitle" role="dialog">
                  <div class="modal-dialog">

                  
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">AE-TITLE</h4>
                      </div>
                      <div class="modal-body">


                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a style="text-decoration: none;" href="aetitle.php"><button type="button" class="btn btn-default"> Create AE-TITLE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a style="text-decoration: none;" href="view_aetitle.php"><button type="button" class="btn btn-default"> View AE-TITLE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                          </div>
                        </div>





                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>





                <div class="modal fade" id="changeLanguage" role="dialog">
                  <div class="modal-dialog">

                   
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= $lang['change_language'] ?></h4>
                      </div>
                      <div class="modal-body">


                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a style="text-decoration: none;" href="?lang=en"><button type="button" class="btn btn-default"><img style="width: 20px;" src="../image/usa.png"> English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a style="text-decoration: none;" href="?lang=id"><button type="button" class="btn btn-default"><img style="width: 20px;" src="../image/indonesia.png"> Bahasa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                          </div>
                        </div>





                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>




                <div class="modal fade" id="changePw" role="dialog">
                  <div class="modal-dialog">

                  
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


                <br>

              </div> -->

            </div>
          </div>

        </div>
      </div>
    <!-- <div class="footerindex">
      <div class="">
        <?php include('footer-itw.php'); ?>
      </div>
    </div> -->

    <?php include('script-footer.php'); ?>
    <script>
      function myFunction() {
        var y = document.getElementById("passwordulang");
        if (y.type === "password") {
          y.type = "text";
        } else {
          y.type = "password";
        }

        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>

    <script type="text/javascript">
      $(function() {

        $("[type=file]").on("change", function() {
          var file = this.files[0];
          var formdata = new FormData();
          formdata.append("file", file);
          $('#info').slideDown();
          if (file.name.length >= 30) {
            $('#name span').empty().append(file.name.substr(0, 30) + '..');
          } else {
            $('#name span').empty().append(file.name);
          }
          if (file.size >= 1073741824) {
            $('#size span').empty().append(Math.round(this.files.length / 1073741824) + " Files");
          } else if (this.files.length >= 1048576) {
            $('#size span').empty().append(Math.round(this.files.length / 1048576) + " Files");
          } else if (this.files.length >= 1024) {
            $('#size span').empty().append(Math.round(this.files.length / 1024) + " Files");
          } else {
            $('#size span').empty().append(Math.round(this.files.length) + " Files");
          }
          $('#type span').empty().append(file.type);
          // if(file.name.length >= 30){
          // $('label').text("Chosen : " + file.name.substr(0,30) + '..');
          // }else {
          // $('label').text("Chosen : " + file.name);
          // }

          var ext = $('#file').val().split('.').pop().toLowerCase();
          if ($.inArray(ext, ['php', 'html']) !== -1) {
            $('#info').hide();
            $('label').text('Choose File');
            $('#file').val('');
            alert('This file extension is not allowed!');
          }

        });
      });
    </script>
    <script type="text/javascript">
      var $btn = $('.more');
      $btn.on('click', function() {
        $(this).addClass('load');
        setTimeout(function() {
          $('.more').removeClass('load');
        }, 100000000);
      });
    </script>
    <script>
      $(document).ready(function() {
        $(".dcm_button").hide();
        $(".dcm_click").click(function() {
          $(".dcm_button").show();
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $("li[id='settings1']").addClass("active");
        $("li[id='settings1'] a i").css('color', '#bdbdbd');
      });
    </script>

  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>