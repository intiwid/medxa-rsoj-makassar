<?php
include '../contract-service.php';
?>

<!-- ------loader------ -->
<div class="disokin">
    <div class="spinner">
        <div><img src="../image/intiwid-logo-new-putih-2.png" style="width: 201px;margin-left: -75px; margin-bottom: 9px;"></div>
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

            <li data-toggle="collapse" data-target="#products1" class="collapsed">
                <a href="#" class="products1"><i class="fa fa-user fa-lg"></i> <?= $lang['patient_order'] ?> <label class="products1-arrow"><span class="arrow"></span></label></a>
            </li>
            <ul class="sub-menu1 collapse" id="products1">
                <li id="regist1"><a href="registration.php"><?= $lang['registration'] ?></a></li>
                <li id="order3"><a href="order2.php"><?= $lang['all_order'] ?></a></li>
                <li id="exam3"><a href="exam2.php"><?= $lang['examroom'] ?></a></li>
            </ul>

            <li data-toggle="collapse" data-target="#service" class="collapsed">
                <a href="#" class="services"><i class="fa fa-file-alt fa-lg"></i> <?= $lang['report'] ?><label class="services-arrow"><span class="arrow"></span></label></a>
            </li>
            <ul class="sub-menu1 collapse" id="service">
                <li id="workload1"><a href="workload.php"><?= $lang['workload'] ?></a></li>
                <li id="report1"><a href="report.php"><?= $lang['download_excel'] ?></a></li>
                <li id="uploadexcel1"><a href="uploadexcel.php"><?= $lang['backup_excel'] ?></a></li>
                <li id="downloadexcel1"><a href="downloadexcel.php">Storage Excel</a></li>
                <li id="chart2"><a href="chart.php"><?= $lang['chart'] ?></a></li>
            </ul>

            <!-- <li id="billing1">
                <a href="billing.php">
                    <i class="fas fa-credit-card fa-lg"></i> Billing
                </a>
            </li>
            <li id="bhp1">
                <a href="bhp.php">
                    <i class="fas fa-box-open fa-lg"></i> Stock Film/BHP
                </a>
            </li> -->
            <li id="storage1">
                <a href="storage.php">
                    <i class="fa fa-database fa-lg"></i> <?= $lang['storage'] ?>
                </a>
            </li>
            <!-- <?php if (@$exp2 >= -1) { ?>
                <div class="blinking-bg">
                    <li id="maintenance1">
                        <a href="maintenance2.php">
                            <i class=""></i> Maintenance
                        </a>
                    </li>
                </div>
            <?php } ?>
            <?php if (@$exp >= -30) {
            ?><div class="blinking-bg">
                    <li id="maintenance1">
                        <a href="view_pdf_contract.php" target="_blank">
                            <i class=""></i> Contract
                        </a>
                    </li>
                </div>
            <?php } ?> -->
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