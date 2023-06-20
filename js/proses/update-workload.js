// variabel masing2 kolom
let pat_id = $("#pat_id");
let accession_no = $("#accession_no");
let study_iuid = $("#study_iuid").val();
let no_foto = $("#no_foto").val();
let pat_name = $("#pat_name").val();
let pat_birthdate = $("#pat_birthdate").val();
let pat_sex = $("#pat_sex").val();
let address = $("#address").val();
let weight = $("#weight").val();
let dep_id = $("#dep_id").val();
let mods_in_study = $("#mods_in_study").val();
let dokterid = $("#dokterid").val();
let contrast = $("#contrast").val();
let radiographer_id = $("#radiographer_id").val();
let priority = $("#priority").val();
let payment = $("#payment").val();
let contrast_allergies = $("#contrast_allergies").val();
let spc_needs = $("#spc_needs").val();
let kv = $("#kv").val();
let mas = $("#mas").val();
$(".loading").hide();
$(".loading-acc").hide();

// generate acc number
// ketika acc number kosong, generate auto
if (!accession_no.val() || accession_no.val() == " ") {
  accession_no.val(pat_id.val() + Math.floor(Math.random() * 10000));
}
// acc number diklik, generate
$("#generate").click(function () {
  accession_no.val(pat_id.val() + Math.floor(Math.random() * 10000));
});

// action ketika update acc number
$("#post-acc-number").validate({
  rules: {
    accession_no: "required",
  },
  highlight: function (element) {
    $(element).closest("li").addClass("has-error");
    $(element).addClass("invalid");
  },
  unhighlight: function (element) {
    $(element).closest("li").removeClass("has-error");
    $(element).removeClass("invalid");
  },
  errorClass: "invalid-text",
  ignoreTitle: true,
  submitHandler: function (form) {
    // submit pengecekan acc, mrn, alat
    $.ajax({
      type: "POST",
      url: `http://${
        location.hostname
      }:8000/api/validation-workload-accession-no/${accession_no.val()}/${pat_id.val()}/${mods_in_study}`,
      data: {
        study_iuid: study_iuid,
        accession_no: accession_no.val(),
        pat_id: pat_id.val(),
        mods_in_study: mods_in_study,
      },
      beforeSend: function () {
        $(".loading-acc").show();
        $(".ubah-acc").hide();
      },
      complete: function () {
        $(".loading-acc").hide();
        $(".ubah-acc").show();
      },
      success: function (response) {
        // jika status validasi alat simrs dengan alat ris berbeda
        if (response.status == "validation") {
          swal({
            title: "Perbedaan Modality \n (SIMRS)",
            text: `Name ${response.name} \n Modality ${response.xray_type_code} \n Prosedur ${response.prosedur} \n \n Yakin Ingin Update ?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((result) => {
            if (result) {
              $.ajax({
                type: "POST",
                url: `http://${
                  location.hostname
                }:8000/api/update-workload-accession-no/${accession_no.val()}/${pat_id.val()}/${mods_in_study}`,
                data: {
                  study_iuid: study_iuid,
                  accession_no: accession_no.val(),
                  pat_id: pat_id.val(),
                  mods_in_study: mods_in_study,
                },
                beforeSend: function () {
                  $(".loading-acc").show();
                  $(".ubah-acc").hide();
                },
                complete: function () {
                  $(".loading-acc").hide();
                  $(".ubah-acc").show();
                },
                success: function (response) {
                  swal({
                    title: response,
                    icon: "success",
                    timer: 1000,
                  });
                  setTimeout(function () {
                    window.location.reload();
                  }, 1000);
                },
              });
            }
          });
        } else {
          // jika sukses update acc number (tanpa munculkan pop up perbedaan modality)
          swal({
            title: response,
            icon: "success",
            timer: 1000,
          });
          setTimeout(function () {
            window.location.reload();
          }, 1000);
        }
      },
      error: function (xhr, textStatus, error) {
        swal({
          title: xhr.responseJSON,
          icon: "error",
          timer: 1500,
        });
      },
    });
  },
});

// key up untuk harga prosedur
$(function () {
  $("#harga_prosedur").keyup(function (e) {
    $(this).val(format($(this).val()));
  });
});

// format rupiah
var format = function (num) {
  var str = num.toString().replace("", ""),
    parts = false,
    output = [],
    i = 1,
    formatted = null;
  if (str.indexOf(".") > 0) {
    parts = str.split(".");
    str = parts[0];
  }
  str = str.split("").reverse();
  for (var j = 0, len = str.length; j < len; j++) {
    if (str[j] != ",") {
      output.push(str[j]);
      if (i % 3 == 0 && j < len - 1) {
        output.push(",");
      }
      i++;
    }
  }
  formatted = output.reverse().join("");
  return "" + formatted + (parts ? "." + parts[1].substr(0, 2) : "");
};

$.validator.addMethod(
  "valueNotEquals",
  function (value, element, arg) {
    return arg !== value;
  },
  "Please select an item!"
);

$("#edit-workload").validate({
  rules: {
    accession_no: "required",
    no_foto: "required",
    pat_id: "required",
    pat_name: "required",
    pat_sex: { required: true },
    // contrast: { required: true },
    // contrast_allergies: { required: true },
    pat_birthdate: "required",
    address: "required",
    dep_id: { valueNotEquals: "null" },
    id_payment: { valueNotEquals: "null" },
    mods_in_study: "required",
    dokterid: { valueNotEquals: "null" },
    radiographer_id: { valueNotEquals: "null" },
    weight: "number",
    harga_prosedur: {
      number: true,
      required: true,
    },
    film_small: "number",
    film_medium: "number",
    film_large: "number",
    film_reject_small: "number",
    film_reject_medium: "number",
    film_reject_large: "number",
    priority: "required",
    spc_needs: "required",
    kv: {
      required: true,
    },
    mas: {
      required: true,
    },
  },
  errorPlacement: function (error, element) {
    if (element.is(":radio")) {
      error.appendTo(element.parents("li"));
      // console.log(element.parents("li"));
      console.log(error.insertAfter());
    } else {
      error.insertAfter(element);
    }
  },
  highlight: function (element) {
    $(element).closest("li").addClass("has-error");
    $(element).addClass("invalid");
  },
  unhighlight: function (element) {
    $(element).closest("li").removeClass("has-error");
    $(element).removeClass("invalid");
  },
  errorClass: "invalid-text",
  ignoreTitle: true,
  submitHandler: function (form) {
    // ketika tombol ubah data diklik
    $.ajax({
      type: "POST",
      url: `http://${location.hostname}:8000/api/update-workload/${study_iuid}`,
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
          title: response,
          icon: "success",
          timer: 1000,
        });
        setTimeout(function () {
          history.go(-1);
        }, 1000);
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
