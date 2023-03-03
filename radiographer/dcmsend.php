 <?php
  ini_set('MAX_EXECUTION_TIME', '-1');

  exec('c:\Windows\System32\cmd.exe /c START C:\xampp\htdocs\intiwid\radiographer\313.bat');
  sleep(4);
  header('location:dcmdelete.php');
