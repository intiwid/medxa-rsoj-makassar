    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <script src="../radiology/ckeditor/ckeditor.js?v=5"></script>
    <script src="js/script.js"></script>
    <script src="navbar.js"></script>
    <!-- <script src="ckeditor/ckeditor.js"></script> -->
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.js"></script>
    <script src="../js/moment.min.js" />
    </script>
    <script src="../js/datetime-moment.js" />
    </script>
    <script type="text/javascript" src="../js/jquery.validate.min.js" />
    </script>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $.fn.dataTable.moment('DD-MM-YYYY HH:mm');
            $('.table-paginate').dataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, "asc"]
                ],
                "deferRender": true
            });
        });
    </script>
    <script>
        // untuk menampilkan data popup
        $(function() {
            $(document).on('click', '.view-template', function(e) {
                e.preventDefault();
                $("#view-template").modal('show');
                $.post('../hasil-template.php', {
                        template_id: $(this).attr('data-id')
                    },
                    function(html) {
                        $(".modal-body").html(html);
                    }
                );
            });
        });
        // end untuk menampilkan data popup
    </script>

    <!-- =======menghapus border pada div======== -->
    <script>
        $(document).ready(function() {
            $(".table-paginate").removeAttr("border", "1");
        })
    </script>
    <!-- =======menghapus border pada div======== -->