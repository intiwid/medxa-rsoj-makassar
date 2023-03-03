$(document).ready(function () {
  let study_iuid = $("#study_iuid").val();
  $(".loading").hide();

  $("#registration").validate({
    rules: {
      mrn: "required",
      name: "required",
      birth_date: "required",
      sex: { required: true },
    },
    errorPlacement: function (error, element) {
      if (element.is(":radio")) {
        error.appendTo(element.parents("td"));
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element) {
      $(element).closest("td").addClass("has-error");
      $(element).addClass("invalid");
    },
    unhighlight: function (element) {
      $(element).closest("td").removeClass("has-error");
      $(element).removeClass("invalid");
    },
    errorClass: "invalid-text",
    ignoreTitle: true,
    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: `http://${location.hostname}:8000/api/registration`,
        data: $(form).serialize(),
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
            window.location.href = "registration-live.php?pk=" + response.pk;
          }, 1000);
        },
        error: function (xhr, textStatus, error) {
          try {
            if (xhr.responseJSON.status.mrn) {
              swal({
                title: "mrn sudah ada!",
                text: `nama : ${xhr.responseJSON.name} \n MRN : ${xhr.responseJSON.mrn}`,
                icon: "error",
                timer: 2000,
              });
            }
          } catch (error) {
            swal({
              title: "error" + ", Hubungi IT",
              icon: "error",
              timer: 1500,
            });
          }
        },
      });
    },
  });
});
