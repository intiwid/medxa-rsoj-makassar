<?php

require 'function_radiographer.php';

session_start();

if (isset($_POST["submit"])) {
  if (new_complaint($_POST) > 0) {
    echo "
<script>
  alert('Complaint Berhasil ditambahkan');
  document.location.href= 'view_complaint.php';
</script>
";
  } else {
    echo "
<script>
  alert('Complaint Gagal ditambahkan');
  document.location.href= 'new_complaint.php';
</script>";
  }
}

$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");

if ($_SESSION['username'] == 'rafdi') {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Create | radiographer</title>
    <?php include('head.php'); ?>
  </head>

  <body>

    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">


        <div id="content1">
          <div class="col-12" style="padding: 0;">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">
                  Complain
                </li>
              </ol>
            </nav>
          </div>
          <div class="container-fluid">

            <div class="about-inti back-search" style="padding: 10px;">

              <h1>Create Complain</h1>

              <form action="" method="post">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6"><br>
                      <label><b>Complain Date</b></label>
                      <input type="text" class="form-control" name="complaint_date" id="complaint_date" autocomplete="off"></input>
                    </div>
                    <div class="col-md-6"><br>
                      <label><b>Complain Time</b></label><br>
                      <input type="text" class="form-control" name="complaint_time" id="complaint_time" autocomplete="off"></input>
                    </div>
                  </div>
                  <div>
                    <br>
                    <label>Person Call:</label>
                    <!-- <select id="person_call" name="person_call">
                      <option value="NULL">---PILIH---</option>
                      <option value="Hardian">Hardian</option>
                      <option value="Rafli">Rafli</option>
                      <option value="Febrian">Febrian</option>
                      <option value="Andika">Andika</option>
                    </select> -->
                    <input type="text" class="form-control" name="person_call" id="person_call" autocomplete="off"></input>
                  </div>
                  <div>
                    <br>
                    <label>Problem:</label>
                    <textarea class="form-control" name="problem"></textarea>
                  </div>
                  <div class="row">
                    <div class="col-md-6"><br>
                      <label><b>Solve Date From</b></label>
                      <input type="text" class="form-control" name="solve_date" id="solve_date" autocomplete="off"></input>
                    </div>
                    <div class="col-md-6"><br>
                      <label><b>Solve Time From</b></label><br>
                      <input type="text" class="form-control" name="solve_time" id="solve_time" autocomplete="off"></input>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6"><br>
                      <label><b>Solve Date To</b></label>
                      <input type="text" class="form-control" name="solve_date_to" id="solve_date_to" autocomplete="off"></input>
                    </div>
                    <div class="col-md-6"><br>
                      <label><b>Solve Time To</b></label><br>
                      <input type="text" class="form-control" name="solve_time_to" id="solve_time_to" autocomplete="off"></input>
                    </div>
                  </div>
                  <div>
                    <br>
                    <label>Explanation:</label>
                    <textarea class="form-control" name="explanation"></textarea>
                  </div>
                </div>

            </div>

            <button class="btn-worklist" type="submit" name="submit">Submit Complain</button>
            <a href="view_complaint.php" class="btn btn-worklist3 waves-effect waves-light" style="box-shadow: none; font-size: 11px;">View Complaint</a>
            </form>
          </div>
        </div>
      </div>

    </div>
    </div>

    <!-- <div class="footerindex">
      <div class="">
        <?php include('footer-itw.php'); ?>
      </div>
    </div> -->

    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[id='settings1']").addClass("active");
      });

      $('#complaint_date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
      });
      $('#complaint_time').datetimepicker({
        datepicker: false,
        step: 1,
        format: 'H:i:s'
      });

      $('#solve_date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
      });
      $('#solve_time').datetimepicker({
        datepicker: false,
        step: 1,
        format: 'H:i:s'
      });

      $('#solve_date_to').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
      });
      $('#solve_time_to').datetimepicker({
        datepicker: false,
        step: 1,
        format: 'H:i:s'
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>