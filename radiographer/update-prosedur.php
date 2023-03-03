<?php

require 'function_radiographer.php';

//fetch.php
if(isset($_POST["action"]))
{
	
 $output = '';
  $query2 = "SELECT * FROM xray_price WHERE type = '".$_POST["query"]."' ORDER BY prosedur ASC";
  $result2 = mysqli_query($conn, $query2);
  $output .= '<option value="" >----Pilih Prosedur----</option>';
  while($row2 = mysqli_fetch_array($result2))
  {
   $output .= '<option value="'.$row2["code_xray"].'">'.$row2["prosedur"].'</option>';
  }
 echo $output;
}
?>