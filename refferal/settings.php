<?php

require 'function_refferal.php';

session_start();

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
$username = $_SESSION['username'];
if ($_SESSION['level'] == "refferal") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Settings | Refferal</title>
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
                <li class="breadcrumb-item active">Settings</li>
              </ol>
            </nav>
          </div>

        <div id="content1">

          <div class="container-fluid settings-card">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border-bottom: 2px solid #377d71;">
             <li class="nav-item">
                <a class="nav-link active" id="pills-change-pass-tab" data-toggle="pill" href="#pills-change-pass" role="tab" aria-controls="pills-change-pass" aria-selected="false"><i class="fa-solid fa-key"></i> <?= $lang['change_pw'] ?></a>
              </li>
            </ul>
          </div>


              <div class="tab-pane fade  show active" id="pills-change-pass" role="tabpanel" aria-labelledby="pills-change-pass-tab">
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
    <script>
      $(document).ready(function() {
        $("li[id='settings1']").addClass("active");
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>