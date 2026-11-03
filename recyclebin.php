<?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; }
require 'koneksi/koneksi.php';
$workload = mysqli_query($conn, "SELECT * FROM xray_recyclebin ORDER BY pk DESC");
?>

<div style="width: auto; overflow-x: scroll; white-space: nowrap;" class="dashboard-home container-fluid ovrflow">
  <div class="ovrflow">
    <h2>
      <center>Recycle Bin</center>
    </h2>

    <hr class="hr-home">
    <table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
      <thead class="thead1">
        <tr>
          <th>NO</th>
          <th>MRN</th>
          <th><?= $lang['name'] ?></th>
          <th><?= $lang['age'] ?></th>
          <th><?= $lang['sex'] ?></th>
          <th>Main Prosedur</th>
          <th><?= $lang['procedure'] ?></th>
          <th>#S</th>
          <th>#I</th>
          <th><?= $lang['modality'] ?></th>
          <th><?= $lang['referral_physician'] ?></th>
          <th><?= $lang['departmen'] ?></th>
          <th><?= $lang['radiology_physician'] ?></th>
          <th><?= $lang['name_radiographer'] ?></th>
          <th>PDC</th>
          <th><?= $lang['approve_date'] ?></th>
          <th><?= $lang['spend_time'] ?></th>
          <th>Status</th>
          <th>Report</th>
          <th>Deleted By</th>
        </tr>
      </thead>
      <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; }
      $i = 1;
      while ($row1 = mysqli_fetch_assoc($workload)) :
        $birth_date = $row1['birth_date'];
        $bday = new DateTime($birth_date);
        $today = new DateTime(date('y-m-d'));
        $diff = $today->diff($bday);
        $name = $row1['name'];
        $name1 = str_replace('^', ' ', $name);
        $named = $row1['named'];
        $lastnamed = $row1['lastnamed'];
        $named1 = str_replace('^', '', $named);
        $lastnamed1 = str_replace('^', '', $lastnamed);
        $updated_time = $row1["updated_time"];
        $del = $row1["del"];
        $updated_time1 = date("d-m-Y H:i", strtotime($updated_time));
        $complete = $row1["complete_date"] . ' ' . $row1["complete_time"];
        $approve = $row1["approve_date"] . ' ' . $row1["approve_time"];
        if (!empty($approve == 0)) {
          $approve1 = " ";
        } else {
          $approve1 = date("d-m-Y H:i", strtotime($approve));
        }
        $uid = $row1['uid'];
        $priority = $row1['priority'];
        $text = str_replace('^', '', $priority);
        $radiographer_name = $row1['radiographer_name'] . ' ' . $row1['radiographer_lastname'];
        $radiographer_fullname = str_replace('^', ' ', $radiographer_name);

        $awal  = strtotime($complete); //waktu awal
        $akhir = strtotime($approve); //waktu akhir
        $diff1  = $akhir - $awal;
        $jam   = floor($diff1 / (60 * 60));
        $menit = $diff1 - $jam * (60 * 60);
      ?>
        <tr>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $i; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['mrn']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $name1 . ' ' . $row1['lastname']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D'; ?></td>
          <td>
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } if ($row1['sex'] == 'M') { ?>

              <i style="color: blue;" class="fas fa-mars"></i> M
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } } else if ($row1['sex'] == 'F') { ?>

              <i style="color: #ff637e;" class="fas fa-venus"></i> F
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } } else if ($row1['sex'] == 'O') { ?>

              <i class="fas fa-genderless"></i> O
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } } ?>
          </td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['prosedur']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; }
              $hasil = "";
              $series_desc = $row1['series_desc'];
              $series_desc1 = substr($series_desc, 0, 10);
              if ($series_desc > $series_desc1) {
                $hasil .= '<a href="#" class="edit-record penawaran-a" data-id="' . $row1['uid'] . '">Read More</a>';
              } else {
                echo "";
              }
              if ($series_desc1 >= 2) {
                echo $series_desc1;
              }

              echo $series_desc1 . '<br /> ' . $hasil; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['num_series']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['num_instances']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['xray_type_code']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $named1 . ' ' . $lastnamed1; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['name_dep']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['dokrad_name'] . ' ' . $row1['dokrad_lastname']; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $radiographer_fullname; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $updated_time1; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $approve1; ?></td>
          <td><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; }
              if (!empty($approve == 0) or !empty($complete == 0)) {
                echo '';
              } else {
                echo $jam .  ' jam, ' . floor($menit / 60) . ' menit';
              }
              ?></td>
          <td>
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } if ($row1['status'] == 'ready to approve') { ?>

              <i style="color: #3DA83D;" class="fas fa-sync"> Ready to Approve</i>

            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } } else if ($row1['status'] == 'APPROVED') { ?>

              <i style="color: #329ECF" class="fas fa-check-square"> Approved</i>
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } } ?>
          </td>
          <td>
            <a style="text-decoration:none;" class="" href="../radiology/pdf/testpdf5.php?uid=<?= $row1['uid']; ?>" target="_blank">
              <span class="btn red lighten-1 btn-Multimed1"><i class="fas fa-file-pdf" data-toggle="tooltip" title="PDF"></i></span>
            </a>

            <!-- <a style="font-size: 10px;" class="" type="button" data-toggle="modal" data-target="#myModal"> -->
            <!-- <img data-toggle="tooltip" title="XML Upgrade to Enterprise" src="../image/xml.png" style="width: 25px;"> -->
            <!-- </a> -->
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } if (file_exists(__DIR__ . '/viewer-dicom.php')) include __DIR__ . '/viewer-dicom.php'; ?>
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } if (file_exists(__DIR__ . '/viewer-ohif.php')) include __DIR__ . '/viewer-ohif.php'; ?>
            <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } if (file_exists(__DIR__ . '/viewer-html.php')) include __DIR__ . '/viewer-html.php'; ?>
          </td>
          <td><?= $del; ?></td>
        </tr>
        <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } $i++; ?>
      <?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } endwhile; ?>

    </table>
    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <!-- <h1 class="modal-title">Modal Heading</h1> -->
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h3>Specification</h3>
            <p><?php
if (!isset($lang)) { include_once __DIR__ . '/bahasa.php'; } echo $row1['uid'] ?? ''; ?></p>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <!-- End The Modal -->
    <hr class="hr-home">
  </div>
</div>
<div style="margin-bottom: 100px; width: 100%;">

</div>
