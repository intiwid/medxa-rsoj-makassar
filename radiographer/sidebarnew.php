<style>
    .sidebarnew {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 260px;
        background: #1f69b7;
        z-index: 100;
        transition: all 0.5s ease;
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
        color: #dcf912;
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
        background: #165aa2;
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
        cursor: pointer;
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
        padding: 6px 6px 14px 80px;
        margin-top: -10px;
        background: #165aa2;
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
        background: #165aa2;
        padding: 12px 0;
        transition: all 0.5s ease;
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
        background: #f9f9f9;
        height: 100vh;
        left: 260px;
        width: calc(100% - 260px);
        transition: all 0.5s ease;
    }

    .sidebarnew.closenew~.home-section {
        left: 78px;
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
        width: calc(100% - 20px);
        float: right;
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
<div class="sidebarnew">
    <div class="logo-details">
        <div class="home-content">

            <i class="fas fa-stream"></i>
            <!-- <span class="text">Drop Down Sidebarnew</span> -->
        </div>
        <div class="logo_name">
            <div style="width: 200px; margin-top:6px; margin-left: -5px;"><img style="width: 100%;" src="../image/intiwid-logo-new-putih-2.png"></div>
        </div>
    </div>
    <ul class="nav-links">
        <li data-target="#home1">
            <a href="index.php">
                <i class="fa fa-home fa-lg"></i>
                <span class="link_name"><?= $lang['home'] ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="index.php"><?= $lang['home'] ?></a></li>
            </ul>
        </li>
        <li data-target="#products1">
            <div class="iocn-link">
                <a href="#">
                    <i class="fa fa-user fa-lg"></i>
                    <span class="link_name"><?= $lang['patient_order'] ?></span>
                </a>
                <i class="fas fa-angle-down arrow"></i>
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
                    <i class="fa fa-file-alt fa-lg"></i>
                    <span class="link_name"><?= $lang['report'] ?></span>
                </a>
                <i class="fas fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#"><?= $lang['report'] ?></a></li>
                <li><a href="workload.php"><?= $lang['workload'] ?></a></li>
                <li><a href="report.php"><?= $lang['download_excel'] ?></a></li>
                <li><a href="uploadexcel.php"><?= $lang['backup_excel'] ?></a></li>
                <li><a href="downloadexcel.php">Storage Excel</a></li>
                <li><a href="chart.php"><?= $lang['chart'] ?></a></li>
            </ul>
        </li>
        <li id="storage1">
            <a href="storage.php">
                <i class="fa fa-database fa-lg"></i>
                <span class="link_name"></i> <?= $lang['storage'] ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="storage.php"></i> <?= $lang['storage'] ?></a></li>
            </ul>
        </li>
        <li id="settings1">
            <a href="settings.php">
                <i class="fa fa-wrench fa-lg"></i>
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
                    <!--<img src="image/profile.jpg" alt="profileImg">-->
                </div>
                <div class="name-job">
                    <div class="profile_name">Radiographer name</div>
                    <div class="job">Radiographer</div>
                </div>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </li>
    </ul>
</div>
<!-- <section class="home-section">



        <div class="container-fluid" id="main">
            <div class="row">

                <div id="content1">
                    <div class="col-12" style="padding: 0;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">
                                    <?= $lang['about'] ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="container-fluid">
                        <div class="about-inti">
                            <h2><?= $lang['about_us'] ?></h2><br>
                            <?= $lang['about_content'] ?>
                            <img style="width: 30px;" src="../image/whatsapp.svg">&nbsp;&nbsp;<label>+62 822-2022-7912</label>&nbsp; (IT SERVICE)<br><br>
                            <img style="width: 30px;" src="../image/gmail.svg">&nbsp;&nbsp;<label>itservice@intimedika.com</label>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </section>



    <?php include('script-footer.php'); ?>

</body>

</html> -->