<?php
require '../koneksi/koneksi.php';

$id = $_POST['id'];
$query = "SELECT * FROM xray_complaint where id = '$id'";
$value = mysqli_query($conn, $query);
$row2 = mysqli_fetch_assoc($value);

?>
<style>
	.fill {
		padding: 10px;
	}
</style>

<div class="fill">


</div>
<h4><strong><label style="color: forestgreen;">Explanation </label>&nbsp;<label></label></strong></h4>
<h4><strong>
		<?= $row2['explanation']; ?>
	</strong></h4>
<br>
<p>
	</div>