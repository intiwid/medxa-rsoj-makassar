$(document).ready(function () {
  let result_chart = $("#result-chart").hide();
  $(".loading").hide();

  // bariable instances chart
  let chart_base;

  // config chart
  let config = {
    type: "bar",
    data: {
      labels: [],
      datasets: [
        {
          label: "Modality",
          data: [],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(238, 130, 238, 0.2)",
            "rgba(106, 90, 205, 0.2)",
            "rgba(255, 99, 71, 0.2)",
            "rgba(255, 176, 71, 0.2)",
            "rgba(255, 176, 173, 0.2)",
            "rgba(93, 176, 173, 0.2)",
            "rgba(93, 176, 47, 0.2)",
            "rgba(93, 59, 80, 0.2)",
            "rgba(255, 59, 80, 0.2)",
            "rgba(156, 201, 193, 0.2)",
            "rgba(156, 201, 255, 0.2)",
            "rgba(156, 255, 186, 0.2)",
            "rgba(229, 255, 186, 0.2)",
            "rgba(229, 239, 245, 0.2)",
            "rgba(229, 79, 245, 0.2)",
            "rgba(229, 187, 26, 0.2)",
            "rgba(91, 187, 173, 0.2)",
            "rgba(91, 11, 173, 0.2)",
            "rgba(91, 11, 17, 0.2)",
            "rgba(91, 183, 17, 0.2)",
          ],
          borderColor: [
            "rgba(255,99,132,1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
            "rgba(238, 130, 238, 1)",
            "rgba(106, 90, 205, 1)",
            "rgba(255, 99, 71, 1)",
            "rgba(255, 176, 71, 1)",
            "rgba(255, 176, 173, 1)",
            "rgba(93, 176, 173, 1)",
            "rgba(93, 176, 47, 1)",
            "rgba(93, 59, 80, 1)",
            "rgba(255, 59, 80, 1)",
            "rgba(156, 201, 193, 1)",
            "rgba(156, 201, 255, 1)",
            "rgba(156, 255, 186, 1)",
            "rgba(229, 239, 245, 1)",
            "rgba(229, 79, 245, 1)",
            "rgba(229, 187, 26, 1)",
            "rgba(91, 187, 173, 1)",
            "rgba(91, 11, 173, 1)",
            "rgba(91, 11, 17, 1)",
            "rgba(91, 183, 17, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
    },
  };

  $("#form-result-chart").validate({
    rules: {
      from: "required",
      to: "required",
    },
    messages: {
      required: "wajib diisi",
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
    focusCleanup: true,
    ignoreTitle: true,
    submitHandler: function (form) {
      let from = $("#from").val();
      let to = $("#to").val();
      let mods_in_study = $("input[id='mods_in_study']:checked");
      let type_chart = $("input[id='type_chart']:checked").val();

      $(".tanggal").text(`Periode tanggal ${from} - ${to}`);

      // mods_in_study
      let push_mods_in_study = [];

      $.each(mods_in_study, function () {
        push_mods_in_study.push($(this).val());
      });

      let join_mods_in_study = push_mods_in_study.join(",");

      let url = `http://${location.hostname}:8000/api/result-chart?from=${from}&to=${to}&mods_in_study=${join_mods_in_study}`;
      $.ajax({
        type: "POST",
        url: url,
        // data: $(form).serialize(),
        beforeSend: function () {
          $(".loading").show();
          $(".ubah").hide();
        },
        complete: function () {
          $(".loading").hide();
          $(".ubah").show();
        },
        success: function (response) {
          // jika data kosong
          if (response.length == 0) {
            swal({
              title: "Data Tidak ada",
              icon: "error",
              timer: 1000,
            });
            result_chart.hide();
            // jika data ada
          } else {
            // chart tampil
            result_chart.show();
            let mods_in_study_array = [];
            let total_array = [];
            $.each(response, function (index, value) {
              mods_in_study_array.push(value.mods_in_study);
              total_array.push(value.total);
              let tbody = $("#tbody");
              // console.log(index + ":" + value.mods_in_study);
              tbody.html(`
              <h1 class="text-center">${index + ":" + value.mods_in_study}</h1>
              <tr>
                  <td>andika</td>
                  <td>10113891</td>
                  <td>kutamz</td>
                  <td class="text-center">CR</td>
                  <td></td>
              </tr>`);
            });

            // ctx chart
            let ctx = document.getElementById("myChart").getContext("2d");

            // kondisi jika type chart nya berubah instansiasi destroy
            if (chart_base) {
              chart_base.destroy();
            }

            // instansiasi chart base
            let temp = jQuery.extend(true, {}, config);
            temp.type = type_chart;
            chart_base = new Chart(ctx, temp);

            // merubah value (tanpa merubah type cchart)
            chart_base.data.labels = mods_in_study_array;
            chart_base.data.datasets[0].data = total_array;
            chart_base.update();

            swal({
              title: "Berhasil",
              icon: "success",
              timer: 500,
            });
          }
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
