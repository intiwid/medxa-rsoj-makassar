<div class="row">
    <div class="col-12" style="padding: 0;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Report Chart</li>
            </ol>
        </nav>
    </div>
    <div id="content1">
        <div class="container-fluid">
            <div class="about-inti">
                <form method="post" id="form-result-chart">
                    <div>
                        <div class="container-fluid search_chart2">
                            <div class="row">
                                <div class="col-md-8" style="min-height: 140px; padding: 0px; border: 3px solid #cacaca; border-radius: 5px; background: whitesmoke;">
                                    <label class="work-1"><?= $lang['search_mod'] ?> <div style="float: right; margin-right: 10px;"><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></div></label><br>
                                    <div class="wrap-search wrap-search2" style="height: auto;">
                                        <?php
                                        $study = mysqli_query(
                                            $conn_pacsio,
                                            "SELECT mods_in_study FROM study GROUP BY mods_in_study LIMIT 15"
                                        );
                                        while ($row = mysqli_fetch_assoc($study)) { ?>
                                            <tr>
                                                <td>
                                                    <label class="c1">
                                                        <input class="common_selector cbox search-input-workload" type="checkbox" id="mods_in_study" name="mods_in_study" value="<?= $row['mods_in_study']; ?>" checked>
                                                        <span class="checkmark1"></span>
                                                </td>
                                                <td><?= $row['mods_in_study'] ?></label></td>
                                            </tr>
                                        <?php } ?>
                                    </div>
                                    <label class="work-1">Type Chart</label><br>
                                    <div class="wrap-search">
                                        <div class="status">
                                            <label class="radio-admin">
                                                <input type="radio" name="type_chart" id="type_chart" value="bar" checked> Bar
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-admin">
                                                <input type="radio" name="type_chart" id="type_chart" value="line"> Line
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-admin">
                                                <input type="radio" name="type_chart" id="type_chart" value="pie"> Pie
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-admin">
                                                <input type="radio" name="type_chart" id="type_chart" value="doughnut"> Doghnut
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-admin">
                                                <input type="radio" name="type_chart" id="type_chart" value="polarArea"> Polar
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="padding: 0px; min-height: 140px; border: 3px solid #cacaca; border-radius: 5px; background: whitesmoke;">
                                        <label class="work-1"><?= $lang['search_date'] ?></label><br>
                                        <div class="wrap-search">
                                            <label for="from"><b>From</b></label><br>
                                            <input type="text" name="from" id="from" placeholder="from" required style="width: 100%;" autocomplete="off"></input><br>
                                            <label for="to"><b>To</b></label><br>
                                            <input type="text" name="to" id="to" placeholder="to" required style="width: 100%;" autocomplete="off"></input><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
            </div>
        </div>
        <div class="col-md-6">
            <button id="btn-worklist1" class="btn btn-warning btn-lg" name="submit" style="box-shadow: none; font-weight: bold; border-radius: 5px;">
                <span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                <p class="loading" style="display:inline;">Loading...</p>
                <p class="ubah" style="display:inline;">Submit</p>
            </button>
        </div>
        </form>
    </div>
    <br>
    <br>
    <div id="result-chart" class="container-fluid">
        <center>
            <h4>
                <?= $lang['radiology_data'] ?>
            </h4>
            <p>
            <div class="tanggal"></div>
            </p>
        </center>
        <div style="overflow-x:auto;">
            <div class="chart1" style="width: 800px;margin: 0px auto;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <br>
        <br />
        <br />
        <!-- TABEL -->
        <!-- <div class="back-search">
            <?php
            ?>
            <table class="table-dicom table-paginate" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama </th>
                        <th>mrn/No. Foto</th>
                        <th>MODALITY</th>
                        <th>COMPLETE DATE</th>
                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
            <?php  ?>
        </div> -->
    </div>
</div>