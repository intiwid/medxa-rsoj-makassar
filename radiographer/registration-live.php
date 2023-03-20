<?php
require 'function_radiographer.php';
session_start();

$pk = $_GET['pk'];
$patient_get = mysqli_fetch_assoc(mysqli_query(
  $conn,
  "SELECT * FROM xray_patient WHERE pk = '$pk'"
));

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <?php include('head.php'); ?>
    <script>
    </script>
    <title>Registration | Radiographer</title>
  </head>

  <body>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">
        <div id="content1">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12" style="padding: 0;">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="registration.php">Registration</a></li>
                    <li class="breadcrumb-item active">Information Order</li>
                  </ol>
                </nav>
              </div>
              <div class="container-fluid">
                <form method="POST" id="registration-live">

                  <div class="row justify-content-center">
                    <div class="col-md-6 left-information">
                      <!-- patient -->
                      <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px; margin-bottom: 15px;">
                        <h4>Patient Name </h4><br>
                        <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="mrn" id="mrn" data-style="btn-info">
                          <option value="null">--pilih--</option>
                          <?php
                          $query_patient = mysqli_query($conn, "SELECT * FROM xray_patient");
                          while ($patient = mysqli_fetch_array($query_patient)) { ?>
                            <option value="<?= $patient['mrn'] . '|' . $patient['name'] . '|' . $patient['sex'] . '|' . $patient['birth_date'] . '|' . $patient['address'] . '|' . $patient['weight']; ?>" <?= $patient_get['mrn'] == $patient['mrn'] ? 'selected' : ""; ?>><?= $patient['name']; ?></option>
                          <?php } ?>
                        </select><br>
                      </div>

                      <!-- dokter pengirim -->
                      <div>
                        <!-- <div class="dokteravail">
                          <label for="dokterid"><?= $lang['referral_physician'] ?> :</label><br>
                          <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="dokterid" id="dokterid" data-style="btn-info">
                            <option value="null">--pilih--</option>
                            <?php
                            $query_dokter = mysqli_query($conn, "SELECT * FROM xray_dokter");
                            while ($dokter = mysqli_fetch_assoc($query_dokter)) { ?>
                              <option value="<?= $dokter['dokterid'] . '|' . $dokter['named']; ?>"><b><?= $dokter['named'] . ' ' . $dokter['lastnamed']; ?></b></option>
                            <?php } ?>
                          </select>
                        </div> -->


                        <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px;">
                          <h4><?= $lang['referral_physician'] ?></h4>
                          <div class="input-group input-group-regist input-regist input-regist-gender">
                            <?php
                            $query_dokter = mysqli_query($conn, "SELECT * FROM xray_dokter");
                            while ($dokter = mysqli_fetch_assoc($query_dokter)) { ?>
                              <input name="dokterid" id="<?= $dokter['dokterid']; ?>" type="radio" value="<?= $dokter['dokterid']; ?>" required /><label for="<?= $dokter['dokterid']; ?>"><?= $dokter['named'] . ' ' . $dokter['lastnamed']; ?></label>
                            <?php } ?>
                            <input name="dokterid" id="dokter_lain" type="radio" value="" data-toggle="collapse" data-target="#demo" class="dok_lain" /><label for="dokter_lain" style="font-weight: bold;"><?= $lang['other_physician'] ?></label>
                          </div>
                        </div>
                        <br>
                        <div id="demo" class="collapse">
                          <label><?= $lang['f_name'] ?></label>
                          <input type="text" name="namedluar" placeholder="<?= $lang['input_f_name'] ?>">
                          <label><?= $lang['l_name'] ?></label>
                          <input type="text" name="lastnamedluar" placeholder="<?= $lang['input_l_name'] ?>"><br>
                          <hr>
                        </div>
                      </div>
                      <!-- end of dokter pengirim -->

                      <!-- department -->
                      <!-- <label><?= $lang['select_poly'] ?> :</label><br>
                      <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="dep_id" id="dep_id" data-style="btn-info">
                        <option value="null">--pilih--</option>
                        <?php
                        $query_department = mysqli_query($conn, "SELECT * FROM xray_department");
                        while ($department = mysqli_fetch_array($query_department)) { ?>
                          <option value="<?= $department['dep_id'] . '|' . $department['name_dep']; ?>"><?= $department['name_dep']; ?></option>
                        <?php } ?>
                      </select><br> -->

                      <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px; margin-bottom:15px;">
                        <h4><?= $lang['select_poly'] ?></h4>
                        <div class="input-group input-group-regist input-regist input-regist-gender">
                          <?php
                          $query_department = mysqli_query($conn, "SELECT * FROM xray_department");
                          while ($department = mysqli_fetch_array($query_department)) { ?>
                            <input name="dep_id" id="<?= $department['dep_id'] . '|' . $department['name_dep']; ?>" type="radio" value="<?= $department['dep_id']; ?>" required /><label for="<?= $department['dep_id']; ?>"><?= $department['name_dep']; ?></label>
                          <?php } ?>
                        </div>
                      </div>
                      <!-- end department -->


                      <!-- Payment -->
                      <!-- <label>Select Payment :</label> <br>
                      <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="id_payment" id="id_payment" data-style="btn-info">
                        <option value="null">--pilih--</option>
                        <?php
                        $query_payment = mysqli_query($conn, "SELECT * FROM xray_payment_insurance");
                        while ($payment = mysqli_fetch_array($query_payment)) { ?>
                          <option value="<?= $payment["id_payment"] . '|' . $payment["payment"]; ?> "><?= $payment['payment']; ?></option>
                        <?php } ?>
                      </select> -->

                      <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px; margin-bottom:15px;">
                        <h4><?= $lang['select_poly'] ?></h4>
                        <div class="input-group input-group-regist input-regist input-regist-gender">
                          <?php
                          $query_payment = mysqli_query($conn, "SELECT * FROM xray_payment_insurance");
                          while ($payment = mysqli_fetch_array($query_payment)) { ?>
                            <input name="payment_id" id="<?= $payment['payment']; ?>" type="radio" value="<?= $payment["payment"]; ?>" required /><label for="<?= $payment['payment']; ?>"><?= $payment['payment']; ?></label>
                          <?php } ?>
                        </div>
                      </div>
                      <!-- End of Payment -->

                      <!-- modalitas -->
                      <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px; margin: 15px 0 15px 0;">
                        <h4><?= $lang['select_mod'] ?> :</h4> <br>
                        <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="id_modality" id="id_modality" data-style="btn-info">
                          <option value="null">--pilih--</option>
                          <?php
                          $query_modality = mysqli_query($conn, "SELECT * FROM xray_modalitas");
                          while ($modality = mysqli_fetch_array($query_modality)) { ?>
                            <option value="<?= $modality["id_modality"] . '|' . $modality["xray_type_code"]; ?> " data-subtext="<?= $modality['xray_type_code']; ?>"><?= $modality['xray_type_code']; ?></option>
                          <?php } ?>
                        </select>

                        <!-- study -->
                        <div class="select-procedure">
                          <label><?= $lang['select_procedure']; ?> :</label> <br>
                          <select data-size="10" data-live-search="true" style="height: 242px;" class="form-control select2" multiple="multiple" name="id_prosedur[]" id="id_prosedur" required>
                          </select>
                        </div>
                      </div>



                      <!-- Radiographer -->
                      <!-- <label>Select Radiographer :</label><br>
                      <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="radiographer_id" id="radiographer_id" data-style="btn-info">
                        <option value="null">--pilih--</option>
                        <?php
                        $query_radiographer = mysqli_query($conn, "SELECT * FROM xray_radiographer");
                        while ($radiographer = mysqli_fetch_array($query_radiographer)) { ?>
                          <option value="<?= $radiographer['radiographer_id'] . '|' . $radiographer['radiographer_name']; ?>"><?= $radiographer['radiographer_name'] . ' ' . $radiographer['radiographer_lastname']; ?></option>
                        <?php } ?>
                      </select><br> -->

                      <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px; margin-bottom:15px;">
                        <h4>Select Radiographer</h4>
                        <div class="input-group input-group-regist input-regist input-regist-gender">
                          <?php
                          $query_radiographer = mysqli_query($conn, "SELECT * FROM xray_radiographer");
                          while ($radiographer = mysqli_fetch_array($query_radiographer)) { ?>
                            <input name="radiographer_id" id="<?= $radiographer['radiographer_name']; ?>" type="radio" value="<?= $radiographer['radiographer_name']; ?>" required /><label for="<?= $radiographer['radiographer_name']; ?>"><?= $radiographer['radiographer_name']; ?></label>
                          <?php } ?>
                        </div>
                      </div>
                      <!-- End of Radiographer -->

                      <!-- dokter radiologi -->
                      <!-- <label>Select Radiologist :</label><br>
                      <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="dokradid" id="dokradid" data-style="btn-info">
                        <option value="null">--pilih--</option>
                        <?php
                        $query_dokter_radiologi = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");
                        while ($dokter_radiologi = mysqli_fetch_array($query_dokter_radiologi)) { ?>
                          <option value="<?= $dokter_radiologi['dokradid'] . '|' . $dokter_radiologi['dokrad_name']; ?>"><?= $dokter_radiologi['dokrad_name'] . ' ' . $dokter_radiologi['dokrad_lastname']; ?></option>
                        <?php } ?>
                      </select><br> -->

                      <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px;">
                        <h4>Select Radiologist</h4>
                        <div class="input-group input-group-regist input-regist input-regist-gender">
                          <?php
                          $query_dokter_radiologi = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");
                          while ($dokter_radiologi = mysqli_fetch_array($query_dokter_radiologi)) { ?>
                            <input name="dokradid" id="<?= $dokter_radiologi['dokrad_name']; ?>" type="radio" value="<?= $dokter_radiologi['dokrad_name']; ?>" required /><label style="width: 50%;" for="<?= $dokter_radiologi['dokrad_name']; ?>"><?= $dokter_radiologi['dokrad_name'] . ' ' . $dokter_radiologi['dokrad_lastname'];; ?></label>
                          <?php } ?>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-6">
                      <div class="left-information">
                        <div class="input-tambahan">
                          <center>
                            <h1 class="informasi-tambahan"><?= $lang['additional_form'] ?></h1>
                          </center>
                          <hr>
                          <div class="input_adm">
                            <!-- schedule date time -->
                            <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px;"><br>
                              <div class="container-fluid">
                                <label style="font-weight: bold;">Exam Schedule</label>
                              </div>
                              <div class="container-fluid">
                                <!-- <div class="row">
                                  <div class="col-md-6"><br>
                                    <label style="font-weight: bold;" for="schedule_date"><b><?= $lang['exam_date'] ?></b></label>
                                    <input type="text" name="schedule_date" id="schedule_date" autocomplete="off" style="height: 31px; border: 2px solid #d2c8c8; border-radius: 4px;"></input>
                                  </div>
                                  <div class="col-md-6"><br>
                                    <label style="font-weight: bold;" for="schedule_time"><b><?= $lang['exam_time'] ?></b></label><br>
                                    <input type="text" name="schedule_time" id="schedule_time" autocomplete="off" style="height: 31px; border: 2px solid #d2c8c8; border-radius: 4px;"></input>
                                  </div>
                                </div> -->

                                <div class="col-half">
                                  <div class="input-group input-group-regist input-regist input-group-icon">
                                    <input type="text" name="schedule_date" id="schedule_date" placeholder="<?= $lang['exam_date'] ?>" autocomplete="off" />
                                    <div class="input-icon"><i class="fas fa-calendar-alt"></i></div>
                                  </div>
                                </div>
                                <div class="col-half">
                                  <div class="input-group input-group-regist input-regist input-group-icon">
                                    <input type="text" name="schedule_time" id="schedule_time" placeholder="<?= $lang['exam_time'] ?>" autocomplete="off" />
                                    <div class="input-icon"><i class="fas fa-clock"></i></div>
                                  </div>
                                </div>
                              </div>
                              <!-- End of  schedule date time -->



                              <!-- kontras -->
                              <div class="container-fluid">
                                <label for="contrast" style="font-weight: bold;">Contrast</label><br>
                                <!-- <label class="radio-admin">
                                  <input type="radio" name="contrast" id="contrast" value="0"> <?= $lang['not_using_contrast'] ?>
                                  <span class="checkmark"></span>
                                </label>
                                <label class="radio-admin">
                                  <input type="radio" name="contrast" id="contrast" value="1"> <?= $lang['using_contrast'] ?>
                                  <span class="checkmark"></span>
                                </label><br><br> -->

                                <div class="input-group input-group-regist input-regist input-regist-gender">
                                  <input type="radio" name="contrast" value="0" id="<?= $lang['using_contrast'] ?>" required /><label style="width: 50%;" for="<?= $lang['using_contrast'] ?>"><?= $lang['using_contrast'] ?></label>
                                  <input type="radio" checked="checked" name="contrast" value="1" id="<?= $lang['not_using_contrast'] ?>" required /><label style="width: 50%;" for="<?= $lang['not_using_contrast'] ?>"><?= $lang['not_using_contrast'] ?></label>
                                </div>
                              </div>


                              <!-- kontras alergi -->
                              <!-- <label style="font-weight: bold;" for="contrast_allergies"><b><?= $lang['contrast_allergy'] ?></b></label><br>
                              <label class="radio-admin">
                                <input type="radio" name="contrast_allergies" id="contrast_allergies" value="0"> <?= $lang['no'] ?>
                                <span class="checkmark"></span>
                              </label>
                              <label class="radio-admin">
                                <input type="radio" name="contrast_allergies" id="contrast_allergies" value="1"> <?= $lang['yes'] ?>
                                <span class="checkmark"></span>
                              </label><br><br> -->

                              <div class="container-fluid">
                                <label><b><?= $lang['contrast_allergy'] ?></b></label><br>
                                <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px;">
                                  <div class="input-group input-group-regist input-regist input-regist-gender">
                                    <input type="radio" name="contrast_allergies" value="0" id="contrast_allergies0" checked="checked" required /><label for="contrast_allergies0"><?= $lang['no'] ?></label>
                                    <input type="radio" name="contrast_allergies" value="1" id="contrast_allergies1" required /><label for="contrast_allergies1"><?= $lang['yes'] ?></label>
                                  </div>
                                </div>
                              </div>
                              <!-- End of kontras alergi -->

                              <!-- prioritas -->
                              <!-- <label style="font-weight: bold;" for="priority"><b><?= $lang['priority'] ?></b></label><br>
                              <label class="radio-admin">
                                <input type="radio" name="priority" id="priority" value="normal"> Normal
                                <span class="checkmark"></span>
                              </label>
                              <label class="radio-admin">
                                <input type="radio" name="priority" id="priority" value="cito"> Cito
                                <span class="checkmark"></span>
                              </label>
                              <br><br> -->

                              <div class="container-fluid">
                                <label><b><?= $lang['priority'] ?></b></label><br>
                                <div class="container-fluid cont-regist" style="background: #ececec;   box-shadow: none; padding: 11px; border-radius: 5px;">
                                  <div class="input-group input-group-regist input-regist input-regist-gender">
                                    <input type="radio" name="priority" value="normal" id="priority0" checked="checked" required /><label for="priority0">Normal</label>
                                    <input type="radio" name="priority" value="cito" id="priority1" required /><label for="priority1">Cito</label>
                                  </div>
                                </div>
                              </div>

                              <!-- End of prioritas -->

                              <!-- special needs -->
                              <div class="container-fluid">
                                <label style="font-weight: bold;" for="spc_needs"><b><?= $lang['spc_needs'] ?></b></label><br>
                                <textarea rows="4" cols="50" type="text" name="spc_needs" id="spc_needs" style="width: 315; height: 90px;"></textarea><br><br>
                              </div>
                              <!-- from order -->
                              <input type="hidden" name="fromorder" id="fromorder" value="RIS">
                              <!-- create time -->
                              <input type="hidden" name="create_time" id="create_time" value="<?= date('Y-m-d H:i:s'); ?>">
                              <button class="btn btn-lg waves-effect waves-light" type="submit" id="submit" name="submit" style="border-radius: 5px; box-shadow:none; background-color:#9f015d; color: #fff;">
                                <span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                                <p class="loading" style="display:inline;">Loading...</p>
                                <p class="ubah" style="display:inline;">Order</p>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
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
    <script src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
    <script src="../js/proses/registration-live.js?v=2"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
    <script>
      $(document).ready(function() {
        $(".select2").select2();
        $("li[data-target='#products1']").addClass("active");
        $("ul[id='products1'] li[id='regist1']").addClass("active");
        $("li[data-target='#products1'] a i").css('color', '#bdbdbd');

        $('#schedule_date').datetimepicker({
          timepicker: false,
          format: 'Y-m-d'
        });

        $('#schedule_time').datetimepicker({
          datepicker: false,
          step: 1,
          format: 'H:i:s'
        });

        $('#id_modality').change(function() {
          if ($(this).val() != '') {
            var action = $(this).attr("id");
            var id_modality = $(this).val().split('|');
            var result = '';
            if (action == "id_modality") {
              result = 'id_prosedur';
            }
            $.ajax({
              url: "registration-prosedur.php",
              method: "POST",
              data: {
                action: action,
                id_modality: id_modality[0]
              },
              success: function(data) {
                $('#' + result).html(data);
              }
            })
          }
        });
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>