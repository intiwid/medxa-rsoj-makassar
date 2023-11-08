<?php
$date = date('d-m-Y 23:59', strtotime("-30 days"));
$date2 = date('d-m-Y 23:59');
?>
<form action="#" method="post">
    <div class="container-fluid search-workload">
        <div class="row">
            <!-- <div style="padding: 0px;" class="col-lg-3 input-date">
                <label class="work-1"><?= $lang['search_date'] ?></label><br>
                <div class="wrap-search">
                    <span class="date-icon">
                        <input type="text" name="from_study_datetime" id="from_study_datetime" class="form-control" placeholder="From Date" value="<?= $date ?>" autocomplete="off" />
                    </span>
                    <span class="date-icon">
                        <input type="text" name="to_study_datetime" id="to_study_datetime" class="form-control" placeholder="To Date" value="<?= $date2 ?>" autocomplete="off" /><br></span>
                </div>
            </div> -->
            <div style="padding: 0px;" class="col-lg-3 input-date">
                <div class="card rounded border-0 position-relative">
                    <div class="card-body">
                        <div class="d-flex align-items-center"><!--<i class="far fa-calendar-alt fa-4x mr-2"></i>--><img style="width: 55px;" src="../image/new/date.svg" alt="">
                            <div class="ms-3">
                                <h4 class="text-uppercase fw-weight-bold mb-0"><?= $lang['search_date'] ?></h4>
                                <p class="mb-0" style="font-style: italic; color: grey;">Date And Time</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 0; padding: 5px;">
                    <div class="col-half">
                        <div class="input-group input-group-regist input-regist input-group-icon">
                            <input type="text" name="from_study_datetime" id="from_study_datetime" placeholder="From Date" value="<?= $date ?>" autocomplete="off" />
                            <div class="input-icon"><i class="fas fa-calendar-day"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-half">
                        <div class="input-group input-group-regist input-regist input-group-icon">
                            <input type="text" name="to_study_datetime" id="to_study_datetime" placeholder="To Date" value="<?= $date2 ?>" autocomplete="off" />
                            <div class="input-icon"><i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="padding: 0px;" class="col-lg-4 input-checkbox">
                <div class="card rounded border-0 position-relative">
                    <div class="card-body">
                        <div class="d-flex align-items-center"> <!--<i class="fas fa-x-ray fa-4x mr-2"></i> --><img style="width: 55px;" src="../image/new/xray.svg" alt="">
                            <div class="ms-3">
                                <h4 class="text-uppercase fw-weight-bold mb-0"><?= $lang['search_mod'] ?></h4>
                                <p class="mb-0" style="font-style: italic; color: grey;"><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-search">
                    <div class="container">
                        <ul class="ks-cboxtags">
                            <!-- <div class="note5"><label>Search by Modality</label></div> -->
                            <?php
                            $sql = mysqli_query(
                                $conn_pacsio,
                                "SELECT mods_in_study FROM study GROUP BY mods_in_study LIMIT 30"
                            );
                            while ($row = mysqli_fetch_assoc($sql)) { ?>
                                <li><label><input class="common_selector cbox checkbox4" type="checkbox" id="checkbox" name="mods_in_study[]" value="<?= $row['mods_in_study']; ?>" checked><span><?= $row['mods_in_study']; ?></span></label></li>
                            <?php } ?>
                        </ul>
                    </div>


                </div>
            </div>

            <div style="padding: 0px;" s class="col-lg-5 input-name">
                <div class="card rounded border-0 position-relative">
                    <div class="card-body">
                        <div class="d-flex align-items-center"><!-- <i class="fas fa-user-plus fa-4x mr-2"></i>--><img style="width: 55px;" src="../image/new/patient-repo.svg" alt=""> 
                            <div class="ms-3">
                                <h4 class="text-uppercase fw-weight-bold mb-0"><?= $lang['search_patient'] ?></h4>
                                <p class="mb-0" style="font-style: italic; color: grey;">Name, MRN or No foto</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 0; padding: 5px;">
                    <div class="col" style="padding: 5px;">
                        <div class="input-group input-group-regist input-regist input-group-icon">
                            <input type="text" name="pat_name" id="pat_name" placeholder="<?= $lang['input_name'] ?>" />
                            <div class="input-icon"><i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="padding: 5px;">
                        <div class="input-group input-group-regist input-regist input-group-icon">
                            <input type="text" name="mrn" id="mrn" placeholder="<?= $lang['input_mrn'] ?>" />
                            <div class="input-icon"><i class="fas fa-id-card"></i>
                            </div>
                        </div>
                    </div>
                    <!-- jika login radiology mencari berdasarkan fill, else mencari berdasarkan no foto -->
                    <?php if ($level == 'radiology') { ?>
                        <div class="col" style="padding: 5px;">
                            <div class="input-group input-group-regist input-regist input-group-icon">
                                <input type="text" name="fill" id="fill" placeholder="Search Expertise" />
                                <div class="input-icon"><i class="fas fa-image"></i>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($level == 'radiographer' || $level == 'refferal') { ?>
                        <div class="col" style="padding: 5px;">
                            <div class="input-group input-group-regist input-regist input-group-icon">
                                <input type="text" name="patientid" id="patientid" placeholder="Search No Foto" />
                                <div class="input-icon"><i class="fas fa-image"></i>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col" style="padding: 5px;">
                            <div class="input-group input-group-regist input-regist input-group-icon">
                                <input type="text" name="patientid" id="patientid" placeholder="Search No Foto" />
                                <div class="input-icon"><i class="fas fa-image"></i>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <div class="body">
        <div class="">
            <button class="btn-worklist btn-sm" type="button" name="range" id="range"><i class="fas fa-search"></i> <?= $lang['search'] ?></button>
            <!-- <button class="btn-worklist1 btn-sm"  type="submit" name="export" id="export"><i class="fas fa-file-excel"></i> Export To Excel</button> -->
            <button class="btn-worklist2 btn-sm" type="reset" name="range" id="range"><i class="fas fa-redo"></i> Reset</button><br><br>
        </div>
    </div>
</form>