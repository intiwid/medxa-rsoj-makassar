<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Store the file name into variable
    require 'function_radiographer.php';
    $contract_query = mysqli_query($conn, 'SELECT * FROM xray_contract ORDER BY id DESC');
    $row_query = mysqli_fetch_assoc($contract_query);
    $id = $row_query['id'];
    $no_contract = $row_query['no_contract'];
    $pdf_query = mysqli_query($conn, "SELECT * FROM xray_upload_pdf WHERE contract_id = '$no_contract'");
    $row_pdf = mysqli_fetch_assoc($pdf_query);
    $nama_pdf = $row_pdf['nama_file'];
    if ($nama_pdf) {
        $file = $nama_pdf . '.pdf';
        $host = $_SERVER['SERVER_NAME'];
        $filepath = "http://$host:8089/intiwid2022/contract/pdf/" . $file;
        // Header content type
        header("Content-type: application/pdf");
        header("Location: $filepath");
        // header('Content-Disposition: attachment; filename="downloaded.pdf"');
        // echo '<head><title>test</title></head>';
        // Send the file to the browser.
        readfile($filepath);
    } else {
        echo '
        <script>alert("Contract Belum di Upload")</script>
        <script>window.close();</script>';
    }
    ?>
</body>

</html>