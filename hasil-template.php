<?php
require 'koneksi/koneksi.php';
$template_id = $_POST['template_id'] ?? $_GET['template_id'] ?? '';
$res = !empty($template_id) ? mysqli_query($conn, "SELECT * FROM xray_template WHERE template_id = '$template_id'") : false;
$row = $res ? (mysqli_fetch_assoc($res) ?: []) : [];
?>

<div class="fill">
    <h6 class="text-center font-weight-bold">
        <label><?= ($row['title'] ?? ''); ?></label>
    </h6>
    <!-- <button onclick="selectText('divid')">Select</button> -->
    <div id="divid">
        <?= ($row['fill'] ?? ''); ?>
    </div>


</div>