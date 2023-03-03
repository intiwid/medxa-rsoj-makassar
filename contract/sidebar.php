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
<script type="text/javascript" src="js/jquery.min.js"></script>
<?php include "../bahasa.php"; ?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="nav-side-menu">
    <div class="brand">
        <div style="width: 195px; padding: 0 0 0 15px; margin: 7px 0;"><img style="width: 100%;" src="../image/intiwid-logo-new-putih-2.png"></div>
    </div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content1"></i>
    <div class="menu-list1">
        <ul id="menu-content1" class="menu-content1 collapse out">
            <li data-target="#home1">
                <a href="index.php">
                    <i class="fa fa-home fa-lg"></i> Home
                </a>
            </li>

            <li id="query1">
                <a href="workload.php">
                    <i class="fa fa-file-alt fa-lg"></i> Query
                </a>
            </li>

            <li id="settings1">
                <a href="settings.php">
                    <i class="fa fa-wrench fa-lg"></i> <?= $lang['settings'] ?>
                </a>
            </li>
            <!-- <li id="about1">
                <a href="about.php">
                    <i class="fas fa-info-circle fa-lg"></i> About
                </a>
            </li> -->
            <li id="logout2" class="logout1">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt fa-lg"></i> Logout
                </a>
            </li>
        </ul>


    </div>
</div>