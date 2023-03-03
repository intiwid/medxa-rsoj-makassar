<?php

require '../koneksi/koneksi.php';
?>
<!-- <option value="null">null</option> -->
<?php
if (isset($_POST["action"])) { ?>
  <?php
  $id_modality = $_POST["id_modality"];
  $result = mysqli_query($conn, "SELECT * FROM xray_study WHERE id_modality = '$id_modality' ORDER BY study ASC");
  while ($study = mysqli_fetch_array($result)) {
  ?>
    <option value="<?= $study["id_study"] . '|' . $study["study"] . '|' . $study["harga"]; ?>"><?= $study["study"]; ?></option>
  <?php } ?>
<?php } ?>