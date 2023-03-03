<!--  <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/sketch.min.js"></script>

<script src="js/3.1.1/jquery.min.js"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script src="js/script.js"></script>
<script src="navbar.js"></script>
<script src="js/chart.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<script src="../js/moment.min.js" />
</script>
<script src="../js/datetime-moment.js" />
</script>



<!-- =======menghapus border pada div======== -->
<script>
    $(document).ready(function() {
        $.fn.dataTable.moment('DD-MM-YYYY HH:mm');
        $(".table-dicom").removeAttr("border", "1");
    })
</script>
<!-- =======menghapus border pada div======== -->


<script>
    $(document).ready(function() {
        $('#incfont').click(function() {
            curSize = parseInt($('.body').css('font-size')) + 1;
            if (curSize <= 18)
                $('.body').css('font-size', curSize);
        });
        $('#decfont').click(function() {
            curSize = parseInt($('.body').css('font-size')) - 1;
            if (curSize >= 11)
                $('.body').css('font-size', curSize);
        });
    });
</script>



<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('.table-paginate').dataTable();
    });
</script>
<script>
    // untuk menampilkan data popup
    $(function() {
        $(document).on('click', '.edit-record1', function(e) {
            e.preventDefault();
            $("#myModal1").modal('show');
            $.post('hasil1.php', {
                    uid: $(this).attr('data-id')
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
        $(document).on('click', '.edit-record', function(e) {
            e.preventDefault();
            $("#myModal").modal('show');
            $.post('hasil2.php', {
                    uid: $(this).attr('data-id')
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
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    }, false);
</script>



<!-- <script>
        $(document).ready(function() {
            currLoc = $(location).attr('pathname');
            $('a[href="' + currLoc + '"]').addClass("active-menu");
        });
    </script> -->


<script>
    $(document).ready(function() {
        $(".disokin").fadeOut();
    })
</script>

<script>
    $(document).ready(function() {
        $(".dcm_button").click(function() {
            $(".disokin").addClass("displayBlok");
            $(".spinner").fadeIn();
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $(".pagination").addClass("modal-5");
    });
</script>


<!-- chat -->
<script>
    (function() {
        $(document).ready(function() {
            $("#live-chat").hide();
            $(".btn_chat2").click(function() {
                $("#live-chat").animate({
                    height: 'toggle'
                });
            });
        });


        $('#live-chat header').on('click', function() {
            // $('.chat').slideToggle(300, 'swing');
            // $('.chat-message-counter').fadeToggle(300, 'swing');
        });
        $('.chat-close').on('click', function(e) {
            e.preventDefault();
            $('#live-chat').fadeOut(300);
        });
    })();
</script>
<!-- chat -->

<!-- ---------SIDE BAR NEW--------------------- -->
<script>
    if ($(window).width() < 1200) {
        $('.sidebarnew').addClass('closenew');
    }

    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    let sidebarnew = document.querySelector(".sidebarnew");
    let sidebarBtn = document.querySelector(".fa-stream");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
        sidebarnew.classList.toggle("closenew");
    });
</script>
<!-- ---------END SIDE BAR NEW--------------------- -->