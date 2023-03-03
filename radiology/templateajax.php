<?php
require 'function_radiology.php';

session_start();

$username = $_SESSION['username'];
$keyword = $_GET["keyword"];

$query = "SELECT * FROM xray_template
            WHERE
          title LIKE '%$keyword%' AND username = '$username'
        ";
$mahasiswa = query($query);
?>
<?php include('head.php'); ?>
<table border="1" id="mytemplate" class="type-choice mytemplate">
    <?php foreach ($mahasiswa as $row) : ?>
        <thead>
            <td class="td1" name="title" value="<?php echo $row_lvl['title']; ?>">
                <div id="content"></div>
            </td>
            <!-- <td class="td2"><a id="search-template" href="#<?= $row['template_id']; ?> "><i class="fas fa-search"></i></a></td> -->
        </thead>
    <?php endforeach; ?>

</table>
<!--  SCRIPT AJAX CRUD   -->
<script type="text/javascript">
    $(document).ready(function() {
        loadData();
        $('form69').on('submit37', function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function() {
                    loadData();
                    resetForm();
                }
            });
        })
    })

    function loadData() {
        $.get('data.php', function(data) {
            $('#content').html(data);
            $('.hapusData').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: $(this).attr('href'),
                    success: function() {
                        loadData();
                    }
                });
            });
            $('.showData').click(function(e) {
                e.preventDefault();
                $('[name=fill]').val($(this).attr('fill'));
                $('form').attr('action', $(this).attr('href'));
            });
        })
    }

    function resetForm() {
        $('[textarea]').val();
        $('[name=fill]').focus();
    }
</script>