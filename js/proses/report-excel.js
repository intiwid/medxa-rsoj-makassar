$(document).ready(function () {
  $(".loading").hide();

  $("#report-excel").validate({
    rules: {
      from_workload: "required",
      to_workload: "required",
    },
    messages: {
      required: "wajib diisi",
    },
    errorClass: "invalid-text",
    focusCleanup: true,
    ignoreTitle: true,
    submitHandler: function () {
      let from_workload = $("#from_workload").val();
      let to_workload = $("#to_workload").val();
      let mods_in_study = $("input[id='mods_in_study']:checked");
      let priority_doctor = $("input[id='priority_doctor']:checked");
      let radiographer = $("#radiographer").find(":selected");

      // mods_in_study
      let push_mods_in_study = [];
      $.each(mods_in_study, function () {
        push_mods_in_study.push($(this).val());
      });
      let join_mods_in_study = push_mods_in_study.join(", ");

      // priority_doctor
      let push_priority_doctor = [];
      $.each(priority_doctor, function () {
        push_priority_doctor.push($(this).val());
      });
      let join_priority_doctor = push_priority_doctor.join(", ");

      // radiographer
      let push_radiographer = [];
      $.each(radiographer, function () {
        push_radiographer.push($(this).val());
      });
      let join_radiographer = push_radiographer.join(", ");

      let url = `http://${location.hostname}:8000/api/export-excel?from_updated_time=${from_workload}&to_updated_time=${to_workload}&mods_in_study=${join_mods_in_study}&priority_doctor=${join_priority_doctor}&radiographer_name=${join_radiographer}`;
      $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
          $(".loading").show();
          $(".ubah").hide();
        },
        complete: function () {
          $(".loading").hide();
          $(".ubah").show();
        },
        success: function () {
          window.location.href = url;
        },
        error: function (xhr, textStatus, error) {
          swal({
            title: textStatus + ", Hubungi IT",
            icon: "error",
            timer: 1500,
          });
        },
      });
    },
  });
});
