<?php
$date = date('d-m-Y 23:59', strtotime("-30 days"));
$date2 = date('d-m-Y 23:59');
?>
<form action="#" method="post">
    <div class="container-fluid search-workload">
        <div class="row">
            <div style="padding: 0px;" class="col-lg-3 input-date">
                <label class="work-1"><?= $lang['search_date'] ?></label><br>
                <div class="wrap-search">
                    <span class="date-icon">
                        <input type="text" name="from_study_datetime" id="from_study_datetime" class="form-control" placeholder="From Date" value="<?= $date ?>" autocomplete="off" />
                    </span>
                    <span class="date-icon">
                        <input type="text" name="to_study_datetime" id="to_study_datetime" class="form-control" placeholder="To Date" value="<?= $date2 ?>" autocomplete="off" /><br></span>
                </div>
            </div>
            <div style="padding: 0px;" class="col-lg-4 input-checkbox">
                <label class="work-1"><?= $lang['search_mod'] ?>
                    <div style="float: right; cursor: pointer;">
                        <input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?>
                    </div>
                </label>
                <div class="wrap-search">
                    <!-- <div class="note5"><label>Search by Modality</label></div> -->
                    <?php
                    $sql = mysqli_query(
                        $conn_pacsio,
                        "SELECT mods_in_study FROM study GROUP BY mods_in_study LIMIT 30"
                    );
                    while ($row = mysqli_fetch_assoc($sql)) { ?>
                        <tr>
                            <td><label class="c1"><input class="common_selector cbox search-input-workload" type="checkbox" id="checkbox" name="mods_in_study[]" value="<?= $row['mods_in_study']; ?>" checked><span class="checkmark1"></span></td>
                            <td><?= $row['mods_in_study']; ?></label></td>
                        </tr>
                    <?php } ?>
                </div>
            </div>
            <div style="padding: 0px;" s class="col-lg-5 input-name">
                <label class="work-1"><?= $lang['search_patient'] ?></label><br>
                <div class="wrap-search">
                    <span class="search-icon">
                        <i class="ic-search2 fas fa-search"></i>
                        <input class="search-input-workload" style="color: black; width: 33%;" type="text" name="pat_name" id="pat_name" placeholder="<?= $lang['input_name'] ?>">
                    </span>
                    <span class="search-icon">
                        <i class="ic-search2 fas fa-search"></i>
                        <input class="search-input-workload" style="color: black; width: 25%;" type="text" name="mrn" id="mrn" placeholder="<?= $lang['input_mrn'] ?>">
                    </span>
                    <span class="search-icon">
                        <i class="ic-search2 fas fa-search"></i>
                        <input class="search-input-workload" style="color: black; width: 25%;" type="text" name="patientid" id="patientid" placeholder="Input No Foto">
                    </span>
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