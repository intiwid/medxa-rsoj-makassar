</section>
<!--  <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/sketch.min.js"></script>
<script src="js/3.1.1/jquery.min.js"></script>
<!-- <script src="js/bootstrap.js"></script> -->
<script type="text/javascript" src="../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../js/bootstrap4.min.js"></script>
<script src="../radiology/ckeditor/ckeditor.js?v=<?= $random; ?>"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script src="js/script.js"></script>
<script src="js/chart.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.bootstrap4.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script> -->
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<script src="../js/moment.min.js" />
</script>
<script src="../js/datetime-moment.js" />
</script>
<script src="../js/inobitec.js?v=<?= $random; ?>"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js" />
</script>
<script type="text/javascript" src="../js/sweetalert.min.js" />
</script>
<script type="text/javascript" src="../js/select2.min.js"></script>
<!-- <script type="text/javascript" src="../js/all.min.js"></script> -->
<script type="text/javascript" src="../js/change-doctor-approved.js?v=<?= $random; ?>"></script>

<!-- =======menghapus border pada div======== -->
<script>
    $(document).ready(function() {
        $.fn.dataTable.moment('DD-MM-YYYY HH:mm');
        $(".table-dicom").removeAttr("border", "1");
    })
</script>
<!-- =======menghapus border pada div======== -->

<script>
    $(".table-dicom").on("click", "tbody tr", function(event) {
        $(this).addClass("highlight").siblings().removeClass("highlight");
    });
</script>



<script>
    // hide show submenu sidebar
    $(document).ready(function() {
        $(".click-orders").click(function() {
            $(".sub-menu-orders").toggle(
                function() {
                    $(".sub-menu-orders").css({
                        "opacity": 1
                    });
                }
            );
            $(".sub-menu-management").hide();
        });

        $(".click-management").click(function() {
            $(".sub-menu-management").toggle(
                function() {
                    $(".sub-menu-management").css({
                        "opacity": 1
                    });
                }
            );
            $(".sub-menu-orders").hide();
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(".services").click(function() {
            $(".services-arrow").toggleClass('flip1');
        });

        $(".products1").click(function() {
            $(".products1-arrow").toggleClass('flip2');
        });
    });
</script>

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
        $('.table-paginate').dataTable({
            responsive: true
        });
    });
</script>
<script>
    // untuk menampilkan data popup
    $(function() {
        $(document).on('click', '.hasil-all', function(e) {
            e.preventDefault();
            $("#modal-all").modal('show');
            $.post('../hasil-all.php', {
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
        $(document).on('click', '.hasil-series', function(e) {
            e.preventDefault();
            $("#modal-series").modal('show');
            $.post('../hasil-series.php', {
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
        $(document).on('click', '.hasil-acc', function(e) {
            e.preventDefault();
            $("#modal-acc").modal('show');
            $.post('../hasil-acc.php', {
                    pat_id: $("#pat_id").val(),
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
    // untuk menampilkan data popup
    $(function() {
        $(document).on('click', '.order2', function(e) {
            e.preventDefault();
            $("#modal-order2").modal('show');
            $.post('hasil-order2.php', {
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
<!-- <script>
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    }, false);
</script> -->



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


<script>
    if ($(window).width() < 1115) {
        $('#logout2').removeClass('logout1');
    }
</script>






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
    let sidebarBtn = document.querySelector(".fa-bars-staggered");
    sidebarBtn.addEventListener("click", () => {
        sidebarnew.classList.toggle("closenew");
    });
</script>
<!-- ---------END SIDE BAR NEW--------------------- -->

<script>
    const container = document.querySelector('.scroller-itwd , .table-box , .back-search');

    let startY;
    let startX;
    let scrollLeft;
    let scrollTop;
    let isDown;

    container.addEventListener('mousedown', e => mouseIsDown(e));
    container.addEventListener('mouseup', e => mouseUp(e))
    container.addEventListener('mouseleave', e => mouseLeave(e));
    container.addEventListener('mousemove', e => mouseMove(e));

    function mouseIsDown(e) {
        isDown = true;
        startY = e.pageY - container.offsetTop;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
        scrollTop = container.scrollTop;
    }

    function mouseUp(e) {
        isDown = false;
    }

    function mouseLeave(e) {
        isDown = false;
    }

    function mouseMove(e) {
        if (isDown) {
            e.preventDefault();
            //Move vertcally
            const y = e.pageY - container.offsetTop;
            const walkY = y - startY;
            container.scrollTop = scrollTop - walkY;

            //Move Horizontally
            const x = e.pageX - container.offsetLeft;
            const walkX = x - startX;
            container.scrollLeft = scrollLeft - walkX;

        }
    }
</script>