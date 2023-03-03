<?php

require 'function_radiographer.php';

session_start();

if ($_SESSION['username'] == 'rafdi') {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>View Maintenance | radiographer</title>
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
                                <li class="breadcrumb-item"><a href="settings.php">Settings</a></li>
                                <li class="breadcrumb-item active">
                                    View Maintenance
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="container-fluid">

                        <div class="about-inti back-search" style="padding: 10px;">
                            <?php
                            $date = date('d-m-Y', strtotime("-30 days"));
                            $date2 = date('d-m-Y');
                            ?>
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
                                            <button class="btn-worklist2 btn-sm" type="reset" name="range" id="range"><i class="fas fa-redo"></i> Reset</button><br><br>
                                        </div>
                                    </div>
                                </div>



                            </form>

                            <h1>View Maintenance</h1>
                            <div style="overflow-x: scroll;">

                                <table id="purchase_order" class="table-dicom" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
                                    <thead>
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

        <div class=" footerindex">
            <div class="">
                <?php include('footer-itw.php'); ?>
            </div>
        </div>

        <?php include('script-footer.php'); ?>
        <!-- The Modal Problem -->
        <div class="modal" id="myModal3">
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

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- End The Modal Problem-->
        <!-- The Modal Explanation -->
        <div class="modal" id="myModal2">
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

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- End The Modal Explanation-->
    </body>

    </html>
    <script>
        // $('document').ready(function() {
        //   var table = $('#example').dataTable({
        //     "ajax": {
        //       "url": "getComplaint.php",
        //       "dataSrc": ""
        //     },
        //     "columns": [{
        //         "data": "no"
        //       },
        //       {
        //         "data": "report"
        //       },
        //       {
        //         "data": "complaint"
        //       },
        //       {
        //         "data": "person_call"
        //       },
        //       {
        //         "data": "problem"
        //       },
        //       {
        //         "data": "solve"
        //       },
        //       {
        //         "data": "explanation"
        //       }
        //     ]
        //   });
        // });
        $('#From').datetimepicker({
            format: 'd-m-Y',
            timepicker: false

        });
        $('#to').datetimepicker({
            format: 'd-m-Y',
            timepicker: false

        });

        $('.cboxtombol').click(function() {
            $('.cbox').prop('checked', this.checked);
        });

        $('.cboxtombolpay').click(function() {
            $('.cboxpay').prop('checked', this.checked);
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
                        to: to,
                    }
                },
            });
        }

        $('#range').click(function() {
            var From = $('#From').val();
            var to = $('#to').val();
            if (From != '' && to != '') {
                $('#purchase_order').DataTable().destroy();
                fetch_data('yes', From, to);
            } else {
                alert("Please Select Date");
            }
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
    </script>
    <script>
        // untuk menampilkan data popup
        $(function() {
            $(document).on('click', '.edit-record3', function(e) {
                e.preventDefault();
                $("#myModal3").modal('show');
                $.post('hasilproblem.php', {
                        id: $(this).attr('data-id')
                    },
                    function(html) {
                        $(".modal-body").html(html);
                    }
                );
            });
        });
        // end untuk menampilkan data popup
    </script>
    <script>
        // untuk menampilkan data popup
        $(function() {
            $(document).on('click', '.edit-record2', function(e) {
                e.preventDefault();
                $("#myModal2").modal('show');
                $.post('hasilexplanation.php', {
                        id: $(this).attr('data-id')
                    },
                    function(html) {
                        $(".modal-body").html(html);
                    }
                );
            });
        });
        // end untuk menampilkan data popup
    </script>
<?php } else {
    header("location:../index.php");
} ?>