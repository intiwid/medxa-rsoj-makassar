<?php
if (!isset($conn)) { include_once __DIR__ . '/koneksi/koneksi.php'; }
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; }
$template_id = $_GET["template_id"] ?? '';
$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");
$res2 = !empty($template_id) ? mysqli_query($conn, "SELECT * FROM xray_template WHERE template_id = '$template_id' ") : false;
$row2 = $res2 ? (mysqli_fetch_assoc($res2) ?: []) : [];
if (isset($_POST["submit"])) {
    if (update_template($_POST) > 0) {
        echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                    title: 'Berhasil Diinput!',
                    text:  '',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: true
                });  
            },10); 
            window.setTimeout(function(){ 
            window.location.replace('view_template.php');
            } ,1000); 
        </script>";
    } else {
        echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                    title: 'Gagal Diinput!',
                    text:  '',
                    icon: 'error',
                    timer: 1000,
                    showConfirmButton: true
                });  
            },10);
        </script>";
    }
}
?>
<div class="form-template">
    <form action="" method="post">
        <input type="hidden" name="template_id" value="<?= $row2["template_id"] ?? ''; ?>">
        <ul>
            <li>
                <input class="form-control" type="text" name="title" id="title" required value="<?= $row2["title"] ?? ''; ?>" style="width: 100%">
            </li>
            <li>
                <textarea class="ckeditor" id="ckeditor" name="fill" id="fill"> <?= $row2["fill"] ?? ''; ?> </textarea>
            </li>
            <li>
                <?php
if (!isset($conn)) { include_once __DIR__ . '/koneksi/koneksi.php'; } if (($_SESSION['level'] ?? '') == 'radiology') { ?>
                    <input type="hidden" name="username">
                <?php
if (!isset($conn)) { include_once __DIR__ . '/koneksi/koneksi.php'; } } else { ?>
                    <select name="username">
                        <?php
if (!isset($conn)) { include_once __DIR__ . '/koneksi/koneksi.php'; } while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?= $row['username'] ?? ''; ?>" <?= ($row['username'] ?? '') == ($row2['username'] ?? '') ? 'selected' : "";  ?>><?= ($row['dokrad_name'] ?? '') . ' ' . ($row['dokrad_lastname'] ?? ''); ?></option>
                        <?php
if (!isset($conn)) { include_once __DIR__ . '/koneksi/koneksi.php'; } } ?>
                    </select>
                <?php
if (!isset($conn)) { include_once __DIR__ . '/koneksi/koneksi.php'; } } ?>
            </li>
            <br>
            <li>
                <button class="btn btn-worklist" type="submit" name="submit"><?= $lang['save_template'] ?? 'Save Template' ?></button>
            </li>
        </ul>
    </form>
</div>