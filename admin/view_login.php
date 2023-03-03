<?php

require 'function_dokter.php';

session_start();

$username = $_SESSION['username'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM xray_login"
);

if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>View Login | radiographer</title>
        <?php include('head.php'); ?>
    </head>

    <body>

        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">View Login</li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="container-fluid">
                    <h1 style="color: #ee7423">List Data Login</h1>
                    <a class="ahref" href="new_login.php"><i class="fas fa-plus"></i>Add Login</a>
                    <br><br>
                    <div class="about-inti table-box">
                        <table class="table-dicom table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['username']; ?></td>
                                    <td><?= $row['level']; ?></td>
                                    <td><?= $row['date'] == null ? '-' : date('d-m-Y', strtotime($row['date'])); ?></td>
                                    <td>
                                        <a href="update_login.php?id_table=<?= $row["id_table"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png" style="height: 20px;"></a>
                                        <a href="update_login_password.php?id_table=<?= $row["id_table"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png" style="height: 20px;"></a>
                                        <a href="delete_login.php?id_table=<?= $row["id_table"]; ?>" class="tombol-hapus"><img style="height: 20px;" data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>
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