<?php
require 'function_radiographer.php';
session_start();
//ambil data di url
$contract_query = mysqli_query($conn, 'SELECT * FROM xray_contract');
$row_query = mysqli_fetch_assoc($contract_query);
if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_dokter.php';
</script>
";
    } else {
        echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'view_dokter.php';
</script>";
    }
}
if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Ubah Data Dokter</title>
        <?php include('head.php'); ?>

    </head>

    <body>

        <div id="container1">
            <div id="content1">
                <div class="body">
                    <h1>Ubah Data Dokter</h1>
                    <div class="container-fluid">
                        <div class="row form-dokter">
                            <form action="" method="post">
                                <input type="hidden" name="dokterid" value="<?= $row_query['id']; ?>">
                                <ul>
                                    <li>
                                        <input type="text" name="contract_date" id="contract_date" class="form-control" placeholder="Contract Date" value="<?= $row_query['contract_date']; ?>" autocomplete="off" /><br>
                                        <label for="named"><b>Tanggal Mulai Contract</b></label><br>
                                        <input type="datetime" name="named" id="named" required value="<?= $row_query['contract_date']; ?>">
                                    </li>
                                    <li>
                                        <input type="datetime-local" value="<?php echo date('Y-m-d H:i:s', $row_query['contract_date ']); ?>" class="date" name="start" REQUIRED>
                                        <?php echo date("Y-m-d\TH:i:s");
                                        $timestamp = date("Y-m-d\TH:i:s");
                                        ?><br>
                                        <?php
                                        echo $timestamp; ?>
                                        <input type="datetime-local" value="<?= $timestamp; ?>" />
                                    </li>
                                    <li>
                                        <label for="lastnamed"><b>EXP</b></label><br>
                                        <input type="datetime" name="lastnamed" id="lastnamed" value="<?= $row_query['contract_duedate']; ?>">
                                    </li>
                                    <li>
                                        <button class="button1" type="submit" name="submit">Ubah Data</button>
                                    </li>
                                </ul>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerindex">
                <div class="">
                    <div class="footer-login col-sm-12"><br>
                        <center>
                            <p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php include('script-footer.php'); ?>
        <script>
            $('#contract_date').datetimepicker({
                format: 'd-m-Y H:i',
                allowTimes: ['00:00',
                    '01:00',
                    '02:00',
                    '03:00',
                    '04:00',
                    '05:00',
                    '06:00',
                    '07:00',
                    '08:00',
                    '09:00',
                    '10:00',
                    '11:00',
                    '12:00',
                    '13:00',
                    '14:00',
                    '15:00',
                    '16:00',
                    '17:00',
                    '18:00',
                    '19:00',
                    '20:00',
                    '21:00',
                    '22:00',
                    '23:00',
                    '23:59'
                ]
            });
            $('#range').click(function() {
                var From = $('#contract_date').val();
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

    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>