<style>
    .sidebarnew {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 260px;
        background: #377D71;
        z-index: 100;
        transition: all 0.3s ease;
    }

    .sidebarnew.closenew {
        width: 55px;
    }

    .sidebarnew .logo-details {
        height: 60px;
        width: 100%;
        display: flex;
        align-items: center;
    }

    .sidebarnew .logo-details i {
        font-size: 20px;
        color: #fff;
        height: 50px;
        min-width: 50px;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
    }

    .sidebarnew .logo-details .logo_name {
        font-size: 22px;
        color: #fff;
        font-weight: 600;
        transition: 0.1s ease-in-out;
        transition-delay: 0.1s;
    }

    .sidebarnew.closenew .logo-details .logo_name {
        transition-delay: 0s;
        opacity: 0;
        pointer-events: none;
    }

    .sidebarnew .nav-links {
        height: 100%;
        padding: 30px 0 150px 0;
        overflow: auto;
    }

    .sidebarnew.closenew .nav-links {
        overflow: visible;
    }

    .sidebarnew .nav-links::-webkit-scrollbar {
        display: none;
    }

    .sidebarnew .nav-links li {
        position: relative;
        list-style: none;
        transition: all 0.4s ease;
    }

    .sidebarnew .nav-links li:hover {
        background: #2b6c61;
    }

    .sidebarnew .nav-links li .iocn-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sidebarnew.closenew .nav-links li .iocn-link {
        display: block
    }

    .sidebarnew .nav-links li i {
        height: 50px;
        min-width: 50px;
        text-align: center;
        line-height: 50px;
        color: #fff;
        font-size: 18px;
        /* cursor: pointer; */
        transition: all 0.3s ease;
    }

    .sidebarnew .nav-links li.showMenu i.arrow {
        transform: rotate(-90deg);
    }

    .sidebarnew.closenew .nav-links i.arrow {
        display: none;
    }

    .sidebarnew .nav-links li a {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .sidebarnew .nav-links li a .link_name {
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        transition: all 0.2s ease;
    }

    .sidebarnew.closenew .nav-links li a .link_name {
        opacity: 0;
        pointer-events: none;
    }

    .sidebarnew .nav-links li .sub-menu {
        padding: 6px 6px 14px 50px;
        margin-top: -10px;
        background: #2b6c61;
        display: none;
    }

    .sidebarnew .nav-links li.showMenu .sub-menu {
        display: block;
    }

    .sidebarnew .nav-links li .sub-menu a {
        color: #fff;
        font-size: 13px;
        font-weight: bold;
        padding: 5px 0;
        white-space: nowrap;
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .sidebarnew .nav-links li .sub-menu a:hover {
        opacity: 1;
    }

    .sidebarnew.closenew .nav-links li .sub-menu {
        position: absolute;
        left: 100%;
        top: -10px;
        margin-top: 0;
        padding: 10px 20px;
        border-radius: 0 6px 6px 0;
        opacity: 0;
        display: block;
        pointer-events: none;
        transition: 0s;
    }

    .sidebarnew.closenew .nav-links li:hover .sub-menu {
        top: 0;
        opacity: 1;
        pointer-events: auto;
        transition: all 0.4s ease;
    }

    .sidebarnew .nav-links li .sub-menu .link_name {
        display: none;
    }

    .sidebarnew.closenew .nav-links li .sub-menu .link_name {
        font-size: 18px;
        opacity: 1;
        display: block;
    }

    .sidebarnew .nav-links li .sub-menu.blank {
        opacity: 1;
        pointer-events: auto;
        padding: 3px 20px 6px 16px;
        opacity: 0;
        pointer-events: none;
    }

    .sidebarnew .nav-links li:hover .sub-menu.blank {
        top: 45%;
        transform: translateY(-50%);
    }

    .sidebarnew .profile-details {
        position: fixed;
        bottom: 0;
        width: 260px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #2b6c61;
        padding: 12px 0;
        transition: all 0.3s ease;
    }

    .sidebarnew.closenew .profile-details {
        background: none;
    }

    .sidebarnew.closenew .profile-details {
        width: 78px;
    }

    .sidebarnew .profile-details .profile-content {
        display: flex;
        align-items: center;
    }

    .sidebarnew .profile-details img {
        height: 52px;
        width: 52px;
        object-fit: cover;
        border-radius: 16px;
        margin: 0 14px 0 12px;
        background: #1d1b31;
        transition: all 0.5s ease;
    }

    .sidebarnew.closenew .profile-details img {
        padding: 10px;
    }

    .sidebarnew .profile-details .profile_name {
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        white-space: nowrap;
    }

    .sidebarnew .profile-details .job {
        color: #cecece;
        font-size: 13px;
        white-space: nowrap;

    }

    .sidebarnew.closenew .profile-details i,
    .sidebarnew.closenew .profile-details .profile_name,
    .sidebarnew.closenew .profile-details .job {
        display: none;
    }

    .sidebarnew .profile-details .job {
        font-size: 12px;
    }

    .home-section {
        position: relative;
        background: #eff1f7;
        height: 100vh;
        left: 260px;
        width: calc(100% - 260px);
        transition: all 0.5s ease;
    }

    .sidebarnew.closenew~.home-section {
        left: 55px;
        width: calc(100% - 78px);
    }

    .home-section .home-content {
        height: 60px;
        /* display: flex;
            align-items: center; */
        position: absolute;
        top: 4px;
        left: -8px;
    }

    .home-section .home-content .fa-stream,
    .home-section .home-content .text {
        color: #11101d;
        font-size: 35px;
    }

    .home-section .home-content .fa-stream {
        margin: 0 15px;
        cursor: pointer;
    }

    .home-section .home-content .text {
        font-size: 26px;
        font-weight: 600;
    }

    #main {
        left: 78px;
        width: calc(100% - 0px);
    }



    @media (max-width: 420px) {
        .sidebarnew.closenew .nav-links li .sub-menu {
            display: none;
        }
    }

    @media (max-width: 1200px) {
        #main {
            width: calc(100% - -4px);
        }
    }
</style>




<!-- ------loader------ -->
<div class="disokin">
    <div class="spinner">
        <div><img src="../image/multimed_3_logo_putih.png" style="width: 200px;margin-left: 17px; margin-bottom: 9px;"></div>
        <div class="back-loader">
            <span class="loader_new"></span>
        </div>
    </div>
</div>
<!-- ------loader------ -->



<?php include "../bahasa.php"; ?>
<div class="sidebarnew closenew">
    <div class="logo-details">
        <div class="home-content">

            <i class="fa-solid fa-bars-staggered"></i>
            <!-- <span class="text">Drop Down Sidebarnew</span> -->
        </div>
        <div class="logo_name">
            <div style="width: 165px; margin-top:10px; margin-left: 10px;"><img style="width: 100%;" src="../image/multimed_3_logo_putih.png"></div>
        </div>
    </div>
    <ul class="nav-links">
        <li data-target="#home1">
            <a href="index.php">
                <i class="fa-solid fa-house"></i>
                <span class="link_name"><?= $lang['home'] ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="index.php"><?= $lang['home'] ?></a></li>
            </ul>
        </li>

        <!-- =================SIDEBAR RADIOGRAPHER====================== -->
        <?php if($_SESSION['level'] == 'radiographer') {?>
        <li data-target="#products1">
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span class="link_name"><?= $lang['patient_order'] ?></span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#"><?= $lang['patient_order'] ?></a></li>
                <li><a href="registration.php"><?= $lang['registration'] ?></a></li>
                <li><a href="order2.php"><?= $lang['all_order'] ?></a></li>
                <li><a href="exam2.php"><?= $lang['examroom'] ?></a></li>
            </ul>
        </li>
        <li data-target="#service">
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-book-medical"></i>
                    <span class="link_name"><?= $lang['report'] ?></span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#"><?= $lang['report'] ?></a></li>
                <li><a href="workload.php"><?= $lang['workload'] ?></a></li>
                <li><a href="report.php"><?= $lang['download_excel'] ?></a></li>
                <li><a href="uploadexcel.php"><?= $lang['backup_excel'] ?></a></li>
                <li><a href="downloadexcel.php">Storage Excel</a></li>
                <li><a href="chart1.php"><?= $lang['chart'] ?></a></li>
            </ul>
        </li>
        <!-- <li id="storage1">
            <a href="storage.php">
                <i class="fa-solid fa-box-archive"></i>
                <span class="link_name"></i> <?= $lang['storage'] ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="storage.php"></i> <?= $lang['storage'] ?></a></li>
            </ul>
        </li> -->
        <?php } ?>
        <!-- =================END OF SIDEBAR RADIOGRAPHER====================== -->
        
        <!-- =================SIDEBAR DOKTER RADIOLOGI====================== -->
        <?php if($_SESSION['level'] == 'radiology') {?>
            <li id="settings1">
                <a href="dicom.php">
                    <i class="fa-solid fa-book-medical"></i>
                    <span class="link_name">Expertise</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="dicom.php">Expertise</a></li>
                </ul>
            </li>

            <li data-target="#service">
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-book-medical"></i>
                        <span class="link_name"><?= $lang['report'] ?></span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#"><?= $lang['report'] ?></a></li>
                    <li><a href="workload.php">Expertise Approved</a></li>
                    <li><a href="report.php"><?= $lang['download_excel'] ?></a></li>
                </ul>
            </li>

            <li data-target="#template">
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-file-word"></i>
                        <span class="link_name">Template Expertise</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Template Expertise</a></li>
                    <li><a href="new_template.php">New Template</a></li>
                    <li><a href="view_template.php">View Template</a></li>
                </ul>
            </li>
        <?php }?>
        <!-- =================End of SIDEBAR DOKTER RADIOLOGI====================== -->
        
        <!-- =================END OF SIDEBAR POLI====================== -->
        <?php if($_SESSION['level'] == 'refferal') {?>
            <li data-target="#worklist1">
            <a href="query-search.php">
                <i class="fa-solid fa-laptop-file"></i>
                <span class="link_name">Query </span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="query-search.php">Query </a></li>
            </ul>
        </li>
        <?php }?>
        
        
        
        
        
        
        
        <li id="settings1">
            <a href="settings.php">
                <i class="fa-solid fa-gears"></i>
                <span class="link_name"><?= $lang['settings'] ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="settings.php"><?= $lang['settings'] ?></a></li>
            </ul>
        </li>

        <li class="logout1" style="position: absolute; width: 55px; bottom: 15px;">

            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span class="link_name">Logout</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="logout.php">Logout</a></li>
            </ul>
        </li>

        <li>
            <div class="profile-details">
                <div class="profile-content">
                <i class="fas fa-user"></i> 
                </div>
                <div class="name-job" style="margin-left: -90px;">
                    <div class="profile_name"><label style="margin: 0;"><?=  $_SESSION['username']; ?></label></div>
                    <div class="job"><?= $_SESSION['level']?></div>
                </div>
                <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </li>
    </ul>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<section class="home-section">