<?php

require 'function_dokter.php';

session_start();

$username = $_SESSION['username'];

$result = mysqli_query(
    $conn_mppsio,
    "SELECT * FROM ae"
);

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>View AE-TITLE | radiographer</title>
        <?php include('head.php'); ?>
    </head>

    <body>

        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $lang['table_aetitle'] ?> worklist</li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="container-fluid">
                    <h1 style="color: #ee7423"><?= $lang['data_aetitle'] ?> worklist</h1>
                    <a class="ahref" href="new_ae_worklist.php"><i class="fas fa-plus"></i><?= $lang['add_aetitle'] ?> worklist</a>
                    <br><br>
                    <div class="about-inti table-box">
                        <table class="table-dicom table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>AE Title</th>
                                    <th>IP</th>
                                    <th>PORT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['aet']; ?></td>
                                    <td><?= $row['hostname']; ?></td>
                                    <td><?= $row['port']; ?></td>
                                    <td>
                                        <a href="update_ae_worklist.php?pk=<?= $row["pk"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png" style="height: 20px;"></a>
                                        <a href="delete_ae_worklist.php?pk=<?= $row["pk"]; ?>" class="tombol-hapus"><img style="height: 20px;" data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="footerindex">
                <div class="">
                    <div class="footer-login col-sm-12"><br>
                        <center>
                            <p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php include('script-footer.php'); ?>
        <script>
            $(document).ready(function() {
                $('.tombol-hapus').on('click', function(e) {
                    e.preventDefault();
                    const href = $(this).attr('href');
                    swal({
                            title: "Hapus",
                            text: "Yakin ingin menghapus?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((result) => {
                            if (result) {
                                document.location.href = href;
                            }
                        })
                });
            });
        </script>



    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>