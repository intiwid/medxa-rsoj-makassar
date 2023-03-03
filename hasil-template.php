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
        <label><?= $row['title']; ?></label><button onclick="copyToClipboard('#p1')">Copy</button>
    </h6>
<<<<<<< HEAD
    <p id="p1">
        <?= $row['fill']; ?>
    </p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>
=======
    <!-- <button onclick="selectText('divid')">Select</button> -->
    <div id="divid">
        <?= $row['fill']; ?>
    </div>


</div>
>>>>>>> e7063c3bc7596b52f4177d7a027b716f7da09384
