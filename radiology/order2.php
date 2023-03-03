<?php
require '../koneksi/koneksi.php';

session_start();


if ($_SESSION['level'] == "radiology") {
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('head.php'); ?>
	<title>Order | Radiology</title>
</head>

<body>

<?php include('menu-bar.php'); ?>

</div>
<br><br>
<!-- <h1><center>ORDER</center></h1>
<p></p>
<table border="1" cellpadding="10" cellspacing="0" align="center">
<tr>
  <th>MRN</th>
  <th>NAMA PASIEN</th>
  <th>JENIS KELAMIN</th>
  <th>TIPE</th>
  <th>PROSEDURE</th>
  <th>NAMA DOKTER</th>
  <th>WAKTU DAFTAR</th>
</tr>
<tr>
  <td><?php echo $row6["mrn"]; ?></td>
  <td><?php echo $row6["name"]; ?></td>
  <td><?php echo $row6["sex"]; ?></td>
  <td><?php echo $row6["type"]; ?></td>
  <td><?php echo $row6["prosedur"]; ?></td>
  <td><?php echo $row6["named"]; ?></td>
  <td><?php echo $row6["time"]; ?></td>
</tr>
</table>

</table> -->
<?php
 $result = mysqli_query($conn,"SELECT * FROM xray_order ORDER BY create_time ASC LIMIT 0,99"); ?>

						
						<div class="table-view" style="overflow-x:auto;">
		<table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
						<tr bgcolor=#CCCCCC>
						<th><center>ACC NUMBER</center></th>
						<th><center>MRN</center></th>
						<th><center>NAMA</center></th>
						<th><center>JENIS KELAMIN</center></th>
						<th><center>TIPE</center></th>
						<th><center>PROSEDUR</center></th>
						<th><center>NAMA DOKTER</center></th>
						<th><center>WAKTU ORDER</center></th>
						<th><center>AKSI</center></th>
						</tr>
						<?php while($row = mysqli_fetch_array($result))
									:?>
										<tr>
										<td align=center><?= $row['acc'] ?></td>
										<td align=center><?= $row['mrn'] ?></td>
										<td align=center><?= $row['name'] .' '. $row['lastname'] ?></td>
										<td align=center><?= $row['sex'] ?></td>
										<td align=center><?= $row['type'] ?></td>
										<td align=center><?= $row['prosedur'] ?></td>
										<td align=center><?= $row['named'] .' '. $row['lastnamed'] ?></td>
										<td align=center><?= $row['create_time'] ?></td>

										<td align=center><form id=order  name=order method=post action="	exam.php">
											 <input name="acc" type="hidden" id="acc" value="<?= $row['acc'] ?>">
											 <button class ="button button1" type="submit" name="button" id="button" value="Create Order">ARRIVE
											 </form>
										</tr>
									<?php endwhile; ?>
						</table>
						 <?php  ?>
						</div>
						 <?php 
mysqli_query($conn, "DELETE FROM xray_patient_order");
mysqli_query($conn, "DELETE FROM xray_dokter_order");
mysqli_query($conn, "DELETE FROM xray_department_order");
mysqli_query($conn, "DELETE FROM xray_type_order");
mysqli_query($conn, "DELETE FROM xray_price_order");
return mysqli_affected_rows($conn);
						  ?>


 </body>
 </html>
  <?php } else {header("location:../index.php");} ?>
