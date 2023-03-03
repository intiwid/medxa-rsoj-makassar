<?php
require '../koneksi/koneksi.php';
session_start();
$result6 = mysqli_query($conn, "SELECT * FROM xray_radiographer_order ORDER BY radiographer_id DESC LIMIT 0,99");
($row6 = mysqli_fetch_array($result6));
$result5 = mysqli_query($conn, "SELECT * FROM xray_price_order ORDER BY priceorderid DESC LIMIT 0,99");
($row5 = mysqli_fetch_array($result5));
$result4 = mysqli_query($conn, "SELECT * FROM xray_modalitas_order ORDER BY typeorderid DESC LIMIT 0,99");
($row4 = mysqli_fetch_array($result4));
$result3 = mysqli_query($conn, "SELECT * FROM xray_department_order ORDER BY deporderid DESC LIMIT 0,99");
($row3 = mysqli_fetch_array($result3));
$result2 = mysqli_query($conn, "SELECT * FROM xray_dokter_order ORDER BY dokterorderid DESC LIMIT 0,99");
($row2 = mysqli_fetch_array($result2));
$result = mysqli_query($conn, "SELECT * FROM xray_patient_order ORDER BY patientorderid DESC LIMIT 0,99");
($row = mysqli_fetch_array($result));
$patientid = $row['patientid'];
$mrn = $row['mrn'];
$name = $row['name'];
$lastname = $row['lastname'];
$sex = $row['sex'];
$birth_date = $row['birth_date'];
$weight = $row['weight'];
$dokterid = $row2['dokterid'];
$named = $row2['named'];
$lastnamed = $row2['lastnamed'];
$email = $row2['email'];
$name_dep = $row3['name_dep'];
$depid = $row3['depid'];
$typemod = $row4['typemod'];
$xray_type_code = $row4['xray_type_code'];
$prosedur = $row5['prosedur'];
$price = $row5['price'];
$code_xray = $row5['code_xray'];
$radiographer_id = $row6['radiographer_id'];
$radiographer_name = $row6['radiographer_name'];
$radiographer_lastname = $row6['radiographer_lastname'];
$radiographer_sex = $row6['radiographer_sex'];
$radiographer_tlp = $row6['radiographer_tlp'];
$radiographer_email = $row6['radiographer_email'];

if ($_SESSION['level'] == "radiographer") {
?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <?php include('head.php'); ?>
    <script>
      // Ignore this in your implementation
      window.isMbscDemo = true;
    </script>
    <title>registration</title>
  </head>

  <body>
    <div style="position: absolute; z-index: 100;"></div>
    <?php include('menu-bar.php'); ?><br>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb1 breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="registration.php">Registration</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Order</li>
      </ol>
    </nav>

    <div id="container1">
      <div id="content1">


        <div class="container-fluid">
          <div class="col-md-6 left-information">

            <h1 class="informasi-tambahan2">
              <center>Informasi Order</center>
            </h1>
            <hr style="color: black;">


            <h3>
              <center>INFORMASI PASIEN</center>
            </h3>
            <p></p>
            <table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
              <tr>
                <th>MRN</th>
                <th>NAMA PASIEN</th>
              </tr>
              <tr>
                <td><?php echo $row["mrn"]; ?></td>
                <td><?php echo $row["name"] . " " . $row["lastname"]; ?></td>
              </tr>
            </table>

            <h3>
              <center>INFORMASI DOKTER PENGIRIM</center>
            </h3>
            <p></p>
            <table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
              <tr>
                <th>DOKTER ID</th>
                <th>NAMA DOKTER PENGIRIM</th>
              </tr>
              <tr>
                <td><?php echo $row2["dokterid"]; ?></td>
                <td><?php echo $row2["named"] . " " . $row2['lastnamed']; ?></td>
              </tr>
            </table>


            <h3>
              <center>INFORMASI DEPARTMENT</center>
            </h3>
            <p></p>
            <table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
              <tr>
                <th>DEPARTMENT ID</th>
                <th>NAMA DEPARTMENT</th>
              </tr>
              <tr>
                <td><?php echo $row3["depid"]; ?></td>
                <td><?php echo $row3["name_dep"] ?></td>
              </tr>
            </table>

            <h3>
              <center>INFORMASI MODALITAS</center>
            </h3>
            <P></P>
            <table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
              <tr>
                <th>TIPE MODALITAS</th>
                <th>NAMA TIPE</th>
              </tr>
              <tr>
                <td><?php echo $row4["xray_type_code"]; ?></td>
                <td><?php echo $row4["typename"] ?></td>
              </tr>
            </table>

            <h3>
              <center>INFORMASI HARGA</center>
            </h3>
            <P></P>
            <table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
              <tr>
                <th>KODE XRAY</th>
                <th>PROSEDUR</th>
                <th>TIPE</th>
                <th>HARGA</th>
              </tr>
              <tr>
                <td><?php echo $row5["code_xray"]; ?></td>
                <td><?php echo $row5["prosedur"] ?></td>
                <td><?php echo $row5["type"] ?></td>
                <td><?php echo $row5["price"] ?></td>
              </tr>
            </table>

            <!--     <h3><center>INFORMASI RADIOGRAPHER</center></h3>
    <p></p>
    <table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
      <tr>
        <th>RADIOGRAPHER ID</th>
        <th>NAMA RADIOGRAPHER</th>
      </tr>
      <tr>
        <td><?php echo $row6["radiographer_id"]; ?></td>
        <td><?php echo $row6["radiographer_name"] . " " . $row6['radiographer_lastname']; ?></td>
      </tr>
    </table> -->
          </div>




          <div class="col-md-6">
            <div class="regist" style="margin-bottom: 100px;">
              <div class="input-tambahan">
                <h1 class="informasi-tambahan">Form Tambahan</h1>
                <hr>
                <div class="input_adm">
                  <form action="order1.php" method="post">

                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-6"><br>
                          <label for="schedule_date"><b>Tanggal Pemeriksaan</b></label>
                          <input type="text" name="schedule_date" id="schedule_date" autocomplete="off"></input>
                        </div>
                        <div class="col-md-6"><br>

                          <label for="schedule_time"><b>Jam Pemeriksaan</b></label><br>
                          <input type="text" name="schedule_time" id="schedule_time" autocomplete="off"></input>
                        </div>
                      </div>
                    </div>

                    <div class="container-fluid"><br>
                      <label for="contrast">Contrast</label><br>
                      <label class="radio-admin">
                        <input type="radio" checked="checked" name="contrast" value="Perlu Kontras" required> Perlu Kontras
                        <span class="checkmark"></span>
                      </label><br>

                      <label class="radio-admin">
                        <input type="radio" name="contrast" value="Tidak perlu contrast" required> Tidak perlu contrast
                        <span class="checkmark"></span>
                      </label><br><br>
                      <label for="priority"><b>Prioritas</b></label><br>
                      <select name="priority">
                        <option value="4Low">Low</option>
                        <option value="3Medium">Medium</option>
                        <option value="2high">High</option>
                        <option value="1Critical">Critical</option>
                      </select><br>
                      <br>
                      <label for="pat_state"><b>Patient State</b></label><br>
                      <select name="pat_state">
                        <option value="Rawat Inap">Rawat Inap</option>
                        <option value="Rawat Jalan">Rawat Jalan</option>
                      </select><br>
                      <br>
                      <label for="contrast_allergies"><b>Alergi Contrast</b></label><br>
                      <select name="contrast_allergies">
                        <option value="Alergi Contrast">Alergi Contrast</option>
                        <option value="Tidak Alergi Contrast">Tidak Alergi Contrast</option>
                      </select><br>

                      <!-- <label for="payment"><b>Payment</b></label><br>
           <label class="radio-admin">
          <input type="radio" checked="checked" name="payment" value="BPJS" required> BPJS
          <span class="checkmark"></span>
        </label><br>
        <label class="radio-admin">
          <input type="radio" checked="checked" name="payment" value="umum" required> Umum
          <span class="checkmark"></span>
        </label><br>
        <label class="radio-admin">
          <input type="radio" checked="checked" name="payment" value="" required> Asuransi ...
          <span class="checkmark"></span></label>
          <input type="text" name="other_payment" placeholder="Masukan jenis asuransi.."> -->
                      <br>
                      <label for="spc_needs"><b>Special Needs</b></label><br>
                      <textarea rows="4" cols="50" type="text" name="spc_needs" id="spc_needs" style="width: 315; height: 90px;"></textarea><br><br>

                      <button class="button button1" type="submit" name="submit">Order</button>
                    </div>
                  </form>
                </div>
              </div>

            </div>

          </div>
        </div>
        <div class="footerindex">
          <div class="">
            <div class="footer-login col-sm-12"><br>
              <center>
                <p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
              </center>
            </div>
          </div>
        </div>
      </div>

      <?php include('script-footer.php'); ?>

      <script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
      <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
      <script>
        $('#schedule_date').datetimepicker({
          timepicker: false,
          format: 'Y-m-d'
        });
        $('#schedule_time').datetimepicker({
          datepicker: false,
          step: 1,
          format: 'H:i:s'
        });
      </script>

  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>