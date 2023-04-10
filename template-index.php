<div class="row">
    <div id="content1">
        
        <div class="container-fluid">
            <a href="new_template.php" class="btn btn-worklist3 waves-effect waves-light" style="box-shadow: none; font-size: 11px;">New Template</a>
            <div class="about-inti back-search table-view" style="padding: 10px; overflow-x: scroll;">
                <table class="table table-dicom" id="example1" style="margin-top: 0px; width: 100%;" border="1" cellpadding="8" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th><?= $lang['action'] ?></th>
                            <th><?= $lang['name_template'] ?></th>
                            <th><?= $lang['name'] ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?php require '../modal.php'; ?>
</div>