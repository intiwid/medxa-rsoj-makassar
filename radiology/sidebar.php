<?php
require '../koneksi/koneksi.php';
// include '../contract-service.php';


if (isset($_SESSION["username"])) {
    if ((time() - $_SESSION['last_login_timestamp']) > 3600) // 3600 = 60 * 60
    {
        header("location:logout.php");
    } else {
        $_SESSION['last_login_timestamp'] = time();
    }
} else {
    header('location:../index.php');
}


// $username = $_SESSION['username'];
// $result10 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username'");
// $row10 = mysqli_fetch_assoc($result10);
// $name = $row10['dokrad_name'] . ' ' . $row10['dokrad_lastname'];
?>

<!-- ------loader------ -->
<div class="disokin">
    <div class="spinner">
        <div><img src="../image/intiwid-logo-new-putih-2.png" style="width: 200px;margin-left: -75px; margin-bottom: 9px;"></div>
        <div class="back-loader">
            <span class="ball-1"></span>
            <span class="ball-2"></span>
            <span class="ball-3"></span>
            <span class="ball-4"></span>
            <span class="ball-5"></span>
            <span class="ball-6"></span>
            <span class="ball-7"></span>
            <span class="ball-8"></span>
        </div>
    </div>
</div>
<!-- ------loader------ -->
<?php include "../bahasa.php"; ?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="nav-side-menu">
    <div class="brand">
        <div style="width: 195px; padding: 0 0 0 15px; margin: 7px 0;"><img style="width: 100%;" src="../image/intiwid-logo-new-putih-2.png"></div>
    </div>
    <!-- <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content1"></i> -->
    <div class="toggle-btn">
        <label for="burger" class="burger-bar">
            <input id="burger" type="checkbox" data-toggle="collapse" data-target="#menu-content1">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="menu-list1">
        <ul id="menu-content1" class="menu-content1 collapse out">
            <li data-target="#home1">
                <a href="index.php">
                    <i class="fa fa-home fa-lg"></i> <?= $lang['home'] ?>
                </a>
            </li>

            <li id="worklist1">
                <a href="dicom.php">
                    <i class="fas fa-user-edit fa-lg"></i> Worklist
                </a>
            </li>

            <li data-toggle="collapse" data-target="#service" class="collapsed">
                <a href="#" class="products1"><i class="fa fa-file-alt fa-lg"></i> <?= $lang['report'] ?> <label class="products1-arrow"><span class="arrow"></label></span></a>
            </li>
            <ul class="sub-menu1 collapse" id="service">
                <li id="workload1"><a href="workload.php">Expertise Approved</a></li>
                <li id="report1"><a href="report.php"><?= $lang['download_excel'] ?></a></li>
            </ul>

            <li data-toggle="collapse" data-target="#template" class="collapsed">
                <a href="#" class="services"><i class="fas fa-file-medical fa-lg"></i> Template Expertise <label class="services-arrow"><span class="arrow"></label></span></a>
            </li>
            <ul class="sub-menu1 collapse" id="template">
                <li id="newt1"><a href="new_template.php">New Template</a></li>
                <li id="viewt1"><a href="view_template.php">View Template</a></li>
            </ul>


            <li id="settings1">
                <a href="settings.php">
                    <i class="fa fa-wrench fa-lg"></i> <?= $lang['settings'] ?>
                </a>
            </li>
            <li id="logout2" class="logout1">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt fa-lg"></i> <?= $lang['logout'] ?>
                </a>
            </li>
        </ul>


    </div>
</div>