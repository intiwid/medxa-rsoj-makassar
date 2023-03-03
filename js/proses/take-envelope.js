$(document).ready(function () {
  let study_iuid = $("#study_iuid").val();
  $(".loading").hide();

  $("#take-envelope").validate({
    rules: {
      name: "required",
      created_at: "required",
      is_taken: { required: true },
    },
    errorPlacement: function (error, element) {
      if (element.is(":radio")) {
        error.appendTo(element.parents("label"));
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element) {
      $(element).closest("label").addClass("has-error");
      $(element).addClass("invalid");
    },
    unhighlight: function (element) {
      $(element).closest("label").removeClass("has-error");
      $(element).removeClass("invalid");
    },
    errorClass: "invalid-text",
    ignoreTitle: true,
    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: `http://${location.hostname}:8000/api/take-envelope/` + study_iuid,
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
            window.location.href = "workload.php";
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
    },
  });
});
