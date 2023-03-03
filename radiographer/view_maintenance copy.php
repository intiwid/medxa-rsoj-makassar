<?php
require '../koneksi/koneksi.php';
session_start();
$date = date('d-m-Y', strtotime("-30 days"));
$date2 = date('d-m-Y');

// --------------------------------

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html>

    <head>
        <title>Workload | Radiographer</title>
        <?php include('head.php'); ?>
        <style>
            @media only screen and (max-width: 800px) {
                .menu-size2 {
                    visibility: hidden;
                }
            }

            @media only screen and (max-width: 768px) {
                .footerindex {
                    position: fixed;
                }
            }
        </style>
    </head>

    <body>
        <?php include('../sidebar-index.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">View Maintenance</li>

            </ol>
        </nav>

        <div id="container1">
            <div id="content1">

                <div class="table-view">
                    <!-- <div class="container-fluid label-workload">
						<div class="row">
								<div class="col-sm-3"><label>Search by Date</label></div>
								<div class="col-sm-4"><label>Search by Modality</label><div style="float: right;"><input type="checkbox" class="cboxtombol" checked> Check All</div></div>
										<div class="col-sm-5"><label>Search by Patient</label></div>
						</div>
				</div> -->
                    <form action="prosesexportexcelmaintenance.php" method="post">
                        <div class="container-fluid">
                            <div class="row">
                                <div style="padding: 0px;" class="col-sm-3 input-date">
                                    <div class="wrap-search">
                                        <span class="date-icon">
                                            <input type="text" name="From" id="From" class="form-control" placeholder="From Date" value="<?= $date ?>" autocomplete="off" />
                                        </span>
                                        <span class="date-icon">
                                            <input type="text" name="to" id="to" class="form-control" placeholder="To Date" value="<?= $date2 ?>" autocomplete="off" /><br></span>
                                    </div>
                                </div>
                                <div style="padding: 0px; margin-top:6px;" class="col-sm-9 input-date">
                                    <button class="btn-worklist btn-sm" type="button" name="range" id="range"><i class="fas fa-search"></i> <?= $lang['search'] ?></button>
                                    <button class="btn-worklist1 btn-sm" type="submit" name="export" id="export"><i class="fas fa-file-excel"></i> Export To Excel</button>
                                    <button class="btn-worklist2 btn-sm" type="button" name="refresh" id="refresh"><i class="fas fa-redo"></i> Reset</button><br><br>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 table-box" style="overflow-x:auto;">
                        <table class="table-dicom" id="purchase_order" style="width: 100%;" border="1" cellpadding="8" cellspacing="0">
                            <thead class="thead1">
                                <tr>
                                    <th>NO</th>
                                    <th>No Contract</th>
                                    <th>Maintenance Schedule</th>
                                    <th>Status</th>
                                    <th>Maintenance Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModal1">
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
                        <p><?php echo $row1['uid']; ?></p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="cursor:not-allowed">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- End The Modal -->
        <div class="footerindex" style="z-index: 98; position: fixed;">
            <div class="">
                <?php include('footer-itw.php'); ?>
            </div>
        </div>
        </div>
        <!-- Script -->
        <?php include('script-footer.php'); ?>
        <script>
            $(document).ready(function() {
                $("a[href='view_maintenance.php']").addClass("active-menu");
            });
        </script>

        <script>
            $('#From').datetimepicker({
                format: 'd-m-Y'

            });
            $('#to').datetimepicker({
                format: 'd-m-Y H:i'

            });
        </script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.cboxtombol', function() {
                    $('.cbox').prop('checked', this.checked);
                });
                fetch_data('no');

                function fetch_data(is_date_search, From = '', to = '') {
                    var dataTable = $('#purchase_order').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "searching": false,
                        "ajax": {
                            url: "prosescarimaintenance.php",
                            type: "POST",
                            data: {
                                is_date_search: is_date_search,
                                From: From,
                                to: to
                            }
                        },
                    });
                }

                $('#range').click(function() {
                    var From = $('#From').val();
                    var to = $('#to').val();
                    var keyword = $('#keyword').val();
                    var keyword_mrn = $('#keyword_mrn').val();
                    var keyword_patientid = $('#keyword_patientid').val();
                    var modality = get_filter('checkbox');
                    if (From != '' && to != '') {
                        $('#purchase_order').DataTable().destroy();
                        fetch_data('yes', From, to, modality, keyword, keyword_mrn, keyword_patientid);
                    } else {
                        alert("Please Select Date");
                    }
                });

                $('#refresh').click(function() {
                    window.location.reload()
                });

                function get_filter(class_name) {
                    var filter = [];
                    $('#' + class_name + ':checked').each(function() {
                        filter.push($(this).val());
                    });
                    return filter;
                }
                $('.common_selector').click(function() {
                    purchase_order();
                });
            });
        </script>
        <!-- ------------------hide search di tables--------------------- -->
        <script>
            $(document).ready(function() {
                $(".dataTables_filter").hide();
            });
        </script>
        <!-- ----------------------hide search di tables------------------------ -->
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>