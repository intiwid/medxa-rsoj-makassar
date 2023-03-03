<?php
// if (isset($_POST['submit'])) {
//     $target_dir = "temp/";
//     $target_file = $target_dir . 'rafli.dcm';
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
//     header('location:testdcmsend.php');
// }
ini_set('MAX_EXECUTION_TIME', '600');

if (isset($_POST['upload'])) {

    if (!is_dir('intiwid')) mkdir('intiwid');
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
            move_uploaded_file($_FILES['files']['tmp_name'][$i], "intiwid/" . $name);
        }
    }
    echo "Folder is successfully uploaded";
    header('location:dcmsend.php');
}

?>
<!-- <!DOCTYPE html>
<html>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>

</html> -->
<html>

<head>
    <title></title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">

        Select Folder to Upload: <input type="file" name="files[]" id="files" multiple directory="" webkitdirectory="" moxdirectory="" /><br /><br />
        <input type="Submit" value="Upload" name="upload" />
    </form>
</body>

</html>
<?php

?>