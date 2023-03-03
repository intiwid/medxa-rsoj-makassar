<?php
require 'model/query-base-workload.php';
require 'model/query-base-study.php';

$query = "SELECT COUNT(*) AS total
FROM $table_study
JOIN $table_workload
ON study.study_iuid = xray_workload.uid ";

// total studies
$total = mysqli_fetch_assoc(mysqli_query(
  $conn_pacsio,
  $query . 'WHERE DATE(study_datetime) = CURRENT_DATE()'
));

// total waiting
$waiting = mysqli_fetch_assoc(mysqli_query(
  $conn_pacsio,
  $query . 'WHERE DATE(study_datetime) = CURRENT_DATE() AND status = "waiting"'
));

// total approved
$approved = mysqli_fetch_assoc(mysqli_query(
  $conn_pacsio,
  $query . ' WHERE DATE(approved_at) = CURRENT_DATE() AND status = "approved"'
));

?>
<style type="text/css">
  .chart_index {
    background-color: #f7f7f7;
    padding: 10px;
    opacity: 0.9;
    border-radius: 0 0 5px 5px;
  }

  .footerindex {
    position: fixed;
  }
</style>
<meta http-equiv="refresh" content="600" />
<br>
<div class=" container-fluid ovrflow scroller-itwd">
  <div class="row">
    <div class="col-12" style="padding: 0;">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Multimed Solution</a></li>
          <li class="breadcrumb-item active"><?= $lang['ris'] ?></li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 card-daily">
      <div class="box-daily">
        <div class="icon-daily">
          <img src="../image/studies.svg">
        </div>
        <div class="count_content">
          <h3><span class="counter"><?php // echo $waitingtotal1;
                                    ?> 52</span> </h3>
          <p><?= $lang['studies'] ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-daily">
        <div class="box-daily">
          <div class="icon-daily">
            <img src="../image/waitingstudies.svg">
          </div>
          <div class="count_content">
            <h3><span class="counter"><?php //echo $waitingapprove1; 
                                      ?>12</span></h3>
            <p><?= $lang['waiting_report'] ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 card-daily">
      <div class="box-daily">
        <div class="icon-daily">
          <img src="../image/approvestudies.svg">
        </div>
        <div class="count_content">
          <h3><span class="counter"><? // php  echo $approved1; 
                                    ?>33</span> </h3>
          <p><?= $lang['approved_report'] ?></p>
        </div>
      </div>
    </div>


  </div>


  <div class="table-box row ovrflow">
    <table class="table-dicom" id="example" style="margin-top: 3px; width: 100px;" cellpadding="8" cellspacing="0">
      <thead class="thead1">
        <?php require 'thead.php'; ?>
      </thead>
    </table>
    <?php require 'modal.php'; ?>
  </div>
</div>


<script src="js/3.1.1/jquery.min.js"></script>
<script>
  $('document').ready(function() {
    var table = $('#example').dataTable({
      "ajax": {
        "url": "../getAll.php",
        "dataSrc": ""
      },
      "columns": [{
          "data": "no"
        },
        {
          "data": "report"
        },
        {
          "data": "status"
        },
        {
          "data": "pat_name"
        },
        {
          "data": "mrn"
        },
        {
          "data": "no_foto"
        },
        {
          "data": "pat_birthdate"
        },
        {
          "data": "pat_sex"
        },
        {
          "data": "study_desc"
        },
        {
          "data": "series_desc"
        },
        {
          "data": "mods_in_study"
        },
        {
          "data": "named"
        },
        {
          "data": "name_dep"
        },
        {
          "data": "dokrad_name"
        },
        {
          "data": "radiographer_name"
        },
        {
          "data": "study_datetime"
        },
        {
          "data": "approve_date"
        },
        {
          "data": "spendtime"
        }
      ]
    });
  });
</script>