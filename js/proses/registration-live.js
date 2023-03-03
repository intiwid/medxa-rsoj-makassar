$(document).ready(function () {
  $(".loading").hide();
  $.validator.addMethod(
    "valueNotEquals",
    function (value, element, arg) {
      return arg !== value;
    },
    "Please select an item!"
  );

  $("#registration-live").validate({
    rules: {
      mrn: { valueNotEquals: "null" },
      dokterid: { valueNotEquals: "null" },
      dep_id: { valueNotEquals: "null" },
      id_modality: { valueNotEquals: "null" },
      id_prosedur: { valueNotEquals: "null" },
      id_payment: { valueNotEquals: "null" },
      radiographer_id: { valueNotEquals: "null" },
      dokradid: { valueNotEquals: "null" },
      schedule_date: "required",
      schedule_time: "required",
      contrast: { required: true },
      contrast_allergies: { required: true },
      priority: { required: true },
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
      let patient = $("#mrn").val().split("|");
      let mrn = patient[0] ?? "null";
      let name = patient[1] ?? "null";
      let sex = patient[2] ?? "null";
      let birth_date = patient[3] ?? "null";
      let address = patient[4] ?? "null";
      let weight = patient[5] ?? "null";
      let dokter = $("#dokterid").val().split("|");
      let dokterid = dokter[0] ?? "null";
      let named = dokter[1] ?? "null";
      let department = $("#dep_id").val().split("|");
      let dep_id = department[0] ?? "null";
      let name_dep = department[1] ?? "null";
      let modality = $("#id_modality").val().split("|");
      let id_modality = modality[0] ?? "null";
      let xray_type_code = modality[1] ?? "null";
      let payment = $("#id_payment").val().split("|");
      let id_payment = payment[0] ?? "null";
      let payment_name = payment[1] ?? "null";
      let study = $("#id_prosedur").val();
      let radiographer = $("#radiographer_id").val().split("|");
      let radiographer_id = radiographer[0] ?? "null";
      let radiographer_name = radiographer[1] ?? "null";
      let dokter_radiologi = $("#dokradid").val().split("|");
      let dokradid = dokter_radiologi[0] ?? "null";
      let dokrad_name = dokter_radiologi[1] ?? "null";
      let schedule_date = $("#schedule_date").val();
      let schedule_time = $("#schedule_time").val();
      let contrast = $("#contrast").val();
      let contrast_allergies = $("#contrast_allergies").val();
      let priority = $("#priority").val();
      let spc_needs = $("#spc_needs").val();
      let create_time = $("#create_time").val();
      let fromorder = $("#fromorder").val();

      for (let index = 0; index < study.length; index++) {
        let random_acc = Math.floor(Math.random() * 10000000000);
        let random_nofoto = Math.floor(Math.random() * 10000000000);
        let acc = random_acc.toString().replace(".", "");
        let no_foto = random_nofoto.toString().replace(".", "");
        let study_array = study[index].split("|");
        let id_prosedur = study_array[0] ?? "null";
        let prosedur = study_array[1] ?? "null";
        let harga_prosedur = study_array[2] ?? "null";

        let uid = `1.2.40.0.13.1.${mrn}.${acc}.${no_foto}`;
        $.ajax({
          type: "POST",
          url: `http://${location.hostname}:8000/api/registration-live`,
          data: {
            uid: uid,
            acc: acc,
            mrn: mrn,
            name: name,
            patientid: no_foto,
            sex: sex,
            birth_date: birth_date,
            address: address,
            weight: weight,
            dokterid: dokterid,
            named: named,
            dep_id: dep_id,
            name_dep: name_dep,
            id_modality: id_modality,
            xray_type_code: xray_type_code,
            id_payment: id_payment,
            payment: payment_name,
            id_prosedur: id_prosedur,
            prosedur: prosedur,
            harga_prosedur: harga_prosedur,
            radiographer_id: radiographer_id,
            radiographer_name: radiographer_name,
            dokradid: dokradid,
            dokrad_name: dokrad_name,
            schedule_date: schedule_date,
            schedule_time: schedule_time,
            contrast: contrast,
            contrast_allergies: contrast_allergies,
            priority: priority,
            spc_needs: spc_needs,
            create_time: create_time,
            fromorder: fromorder,
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
              title: response.meta.status,
              text: response.meta.message,
              icon: "success",
              timer: 1000,
            });
            setTimeout(function () {
              window.location.href = "order2.php";
            }, 1000);
          },
          error: function (xhr, textStatus, error) {
            var data = {};
            for (const property in xhr.responseJSON.data) {
              data[
                property
              ] = `${property} : ${xhr.responseJSON.data[property]}`;
            }
            try {
              if (xhr.responseJSON.meta.status == "error") {
                swal({
                  title: xhr.responseJSON.meta.message,
                  text: JSON.stringify(data),
                  icon: "error",
                  timer: 2000,
                });
              }
            } catch (error) {
              swal({
                title: textStatus + ", Hubungi IT",
                icon: "error",
                timer: 1500,
              });
            }
          },
        });
      }
    },
  });
});
