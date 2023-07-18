// $(document).ready(function () {
// let study_iuid = $("#study_iuid").val();
$(".loading").hide();

function isDefault(e, uid, pk) {
  e.preventDefault();
  swal({
    title: "Edit Expertise",
    text: `Yakin Ingin Update Expertise ?`,
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((result) => {
    if (result) {
      $.ajax({
        type: "POST",
        url: `http://${location.hostname}:8000/api/workload-fill`,
        data: {
          pk: pk,
        },
        beforeSend: function () {
          $(".loading").show();
          $(".ubah").hide();
        },
        complete: function () {
          $(".loading").hide();
          $(".ubah").show();
        },
        success: function (response) {
          swal({
            title: response.status,
            icon: "success",
            timer: 1000,
          });
          setTimeout(function () {
            window.location.href = "workload-fill-detail.php?study_iuid=" + uid;
          }, 1000);
        },
        error: function (xhr, textStatus, error) {
          swal({
            title: "error" + ", Hubungi IT",
            icon: "error",
            timer: 1500,
          });
        },
      });
    }
  });
}
// });
