<?php
require 'koneksi/koneksi.php';
$template_id = $_POST['template_id'];
$row = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM xray_template 
    WHERE template_id = '$template_id'"
));
?>

<div class="fill">
    <h6 class="text-center font-weight-bold">
        <label><?= $row['title']; ?></label></button>
    </h6>
    <!-- <button onclick="selectText('divid')">Select</button> -->
    <div id="divid">
        <?= $row['fill']; ?>
    </div>


</div>