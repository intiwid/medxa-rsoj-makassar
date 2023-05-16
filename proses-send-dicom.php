<?php
require 'log.php';

$aet = $_POST['aet'];
$uid = $_POST['uid'];
$inputcd = 'cd C:\dcmsyst\tool-intiwid\bin &&';
$inputdcm = ' dcmqr dcmPACS@' . $_SERVER['SERVER_NAME'] . ':11118 -qStudyInstanceUID=' . $uid . ' -cmove ' . $aet;
$input = $inputcd . $inputdcm;
exec($input, $output);

$message = implode(PHP_EOL, $output);

logging(PHP_EOL . PHP_EOL . "['uid' : $uid, 'aet' : $aet]" . PHP_EOL . $message, "log/send-dicom.log");

echo json_encode([
    'status' => 200,
    'output' => implode('<br />', $output),
    'input' => $inputdcm
]);
