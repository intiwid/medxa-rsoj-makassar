<?php
$dokterid = $_POST['dokterid'];
require '../koneksi/koneksi.php';
session_start();
$username = $_SESSION['username'];
$result2 = mysqli_query($conn, "SELECT * FROM xray_dokter WHERE dokterid = '$dokterid'");
($row2 = mysqli_fetch_array($result2));
$result = mysqli_query($conn, "SELECT * FROM xray_patient_order ORDER BY patientorderid DESC");
($row = mysqli_fetch_array($result));
$patientid = $row['patientid'];
$mrn = $row['mrn'];
$name = $row['name'];
$lastname = $row['lastname'];
$sex = $row['sex'];
$birth_date = $row['birth_date'];
$weight = $row['weight'];
$named = $row2['named'];
$lastnamed = $row2['lastnamed'];
$email = $row2['email'];
$q2 = mysqli_query($conn, 'SELECT MAX(dokterorderid) as user_id2 from xray_dokter_order');
$w2 = mysqli_fetch_array($q2);
$ai2 = $w2['user_id2'] + 1;
$query = "INSERT INTO xray_dokter_order
VALUES
('$ai2', '$dokterid', '$named', '$lastnamed','$email')";
mysqli_query($conn, $query);
if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <?php include('head.php'); ?>
    <title>Departmen</title>
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
          <div class="row">
            <div class="col-md-6">
              <h2>
                <center>INFORMASI PASIEN</center>
              </h2>
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
            </div>
            <div class="col-md-6">
              <h2>
                <center>INFORMASI DOKTER</center>
              </h2>
              <p></p>
              <table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
                <tr>
                  <th>DOKTER ID</th>
                  <th>NAMA DOKTER</th>
                </tr>
                <tr>
                  <td><?php echo $row2["dokterid"]; ?></td>
                  <td><?php echo $row2["named"] . " " . $row2['lastnamed']; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>


        <h2>
          <center>PILIH DEPARTMENT</center>
        </h2>
        <div class="container-fluid">
          <?php $result3 = mysqli_query($conn, "SELECT * FROM xray_department"); ?>
          <div class="table-view" style="overflow-x:auto;">
            <table class='table-dicom' border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
              <tr bgcolor=#CCCCCC>
                <th>
                  <center>DEPARTMENT ID</center>
                </th>
                <th>
                  <center>NAMA DEPARTMENT</center>
                </th>
                <th>
                  <center>PILIH</center>
                </th>
              </tr>
              <?php while ($row3 = mysqli_fetch_array($result3)) : ?>

                <tr>
                  <td> <?= $row3['depid'] ?> </td>
                  <td> <?= $row3['name_dep'] ?> </td>
                  <td>
                    <form id="order" name="order" method="post" action="type.php">
                      <input name="depid" type="hidden" id="depid" value=<?= $row3['depid'] ?>>
                      <button class="btn-worklist" type="submit" name="button" id="button" value="SELECT">SELECT
                    </form>
                </tr>
              <?php endwhile; ?>
            </table>
          </div>
          <?php ?>
        </div>
      </div>


      <div class="footerindex">
        <div class="footer-login col-sm-12"><br>
          <center>
            <p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
          </center>
        </div>
      </div>
    </div>
    <?php include('script-footer.php'); ?>

  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>