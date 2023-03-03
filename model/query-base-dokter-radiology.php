<?php

$select_dokter_radiology = "CONCAT(xray_dokter_radiology.dokrad_name,' ',xray_dokter_radiology.dokrad_lastname) AS dokrad_fullname,
xray_dokter_radiology.pk,
xray_dokter_radiology.dokrad_email,
xray_dokter_radiology.dokradid,
xray_dokter_radiology.username,
xray_dokter_radiology.nip,
xray_dokter_radiology.idtele";

$table_dokter_radiology = "$database_ris.xray_dokter_radiology AS xray_dokter_radiology";
