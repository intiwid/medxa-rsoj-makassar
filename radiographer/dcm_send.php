<?php
require '../koneksi/koneksi.php';
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
if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Dicom Send | Radiographer</title>
    <?php include('head.php'); ?>
  </head>

  <body style="background-color: #1f69b7;">
  <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">

        <div id="content1">

          <div class="feb-button">

            <div class="col-md-6 rata-tengah">
              <div class="left-wrap">
                <div class="left">
                  <div><img src="../icon-menubar/new_icon/send.png"></div>
                  <div class="heading">DICOM SEND</div>
                  <div class="site-title">Upload Your Dicom Files</div>
                  <div class="site-slogan">With <a style="color: #e37979; font-weight: bold;" href="index.php">INTIWID</a> Dicom Send</div>
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
                  <label id="largeFile" class="dcm_click" for="files">
                    <input type="file" name="files[]" id="files" multiple directory="" webkitdirectory="" moxdirectory=""></label>
                  <br>
                  <button type="Submit" value="Upload" name="upload" class="more dcm_button"><span>Upload </span></button>
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

    <div class="footerindex">
        <div class="">
          <?php include('footer-itw.php'); ?>
        </div>
    </div>

    <?php include('script-footer.php'); ?>
        <script>
            $(document).ready(function(){
                $("li[id='settings1']").addClass("active");
            });
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
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>