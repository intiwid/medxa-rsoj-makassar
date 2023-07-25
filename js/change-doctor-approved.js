// change doctor approved
function changeDoctorApproved(e, study_iuid, dokradid, workload_status) {
  e.preventDefault();
  let href = `changedoctorworklist.php?uid=${study_iuid}&dokradid=${dokradid}&status=${workload_status}`;
  if (workload_status == "approved") {
    swal({
      title: workload_status,
      text: `Pasien sudah diexpertise. Yakin Ingin Update ?`,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((result) => {
      if (result) {
        window.location.href = `${href}`;
      }
    });
  } else {
    window.location.href = `${href}`;
  }
}
