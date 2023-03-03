<?php

require 'js/proses/function.php';

$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");
$level = $_SESSION['level'];
if (isset($_POST["submit"])) {
    if (new_template($_POST) > 0) {
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
              window.location.replace('view_template.php');
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
              window.location.replace('new_template.php');
              } ,1000); 
          </script>";
    }
}

// save dan lanjutkan

if (isset($_POST["save_lanjutkan"])) {
    if (new_template($_POST) > 0) {
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
              window.location.replace('new_template.php');
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
              window.location.replace('new_template.php');
              } ,1000); 
          </script>";
    }
}

?>
<div class="row">
    <div id="content1">
        <div class="col-12" style="padding: 0;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">
                        New Template
                    </li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="about-inti back-search" style="padding: 10px;">
                <h1><?= $lang['create_template'] ?></h1>
                <form action="" method="post">
                    <input class="form-control" type="text" name="title" placeholder="<?= $lang['insert_tittle'] ?>.." style="width: 100%; margin-bottom: 7px;" required>
                    <textarea class="ckeditor" name="fill" style="width: 100%; height: 250px;" id="ckeditor" required></textarea>
                    <?php if ($level == 'radiology') { ?>
                        <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                    <?php } else { ?>
                        <select name="username">
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?= $row['username']; ?>"><?= $row['dokrad_name'] . ' ' . $row['dokrad_lastname']; ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                    <br>
                    <button class="btn-worklist" type="submit" name="submit"><?= $lang['save_template'] ?></button>
                    <?php
                    if ($level == 'superadmin') { ?>
                        <button class="btn-worklist" type="submit" name="save_lanjutkan">Save Dan Lanjutkan</button>
                    <?php } ?>
                    <a href="view_template.php" class="btn btn-worklist3 waves-effect waves-light" style="box-shadow: none; font-size: 11px;">View Template</a>
                </form>
            </div>
        </div>
    </div>
</div>