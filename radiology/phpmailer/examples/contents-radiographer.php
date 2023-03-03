<?php
require '../../../koneksi/koneksi.php';
$uid = $_GET["uid"];

$result = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>PHPMailer Test</title>
</head>

<body>
  <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">

  </div>
</body>

</html>