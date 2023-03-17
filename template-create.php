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
       
        <div class="container">
            <div class="about-inti back-search" style="padding: 10px;">
            
                <form action="" method="post">
                    <div class="row" style="margin: 0;">
                        <div class="col-half">
                            <div class="input-group input-group-regist input-regist input-group-icon">
                                <input class="form-control" type="text" name="title" placeholder="<?= $lang['insert_tittle'] ?>.." style="width: 100%; margin-bottom: 7px;" required>
                                <div class="input-icon"><i class="fa-solid fa-newspaper"></i></div>
                            </div>
                        </div>
                        
                        <div class="col-half">
                            <div class="input-group input-group-regist input-regist input-group-icon">
                                <?php if ($level == 'radiology') { ?>
                                    <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                                <?php } else { ?>
                                    <select name="username" class="select-dokrad" style="width: 100%; background-color: #f9f9f9; color:#747474;">
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value="<?= $row['username']; ?>"><?= $row['dokrad_name'] . ' ' . $row['dokrad_lastname']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                                <div class="input-icon"><i class="fa-solid fa-user-doctor"></i></div>
                            </div>
                        </div>
                    </div>

                    <div style="justify-content: center; display: flex;">
                        <textarea class="ckeditor" name="fill" style="width: 100%; height: 250px;" id="ckeditor" required></textarea><br>
                    </div>
                        
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