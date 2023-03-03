<?php

$select_dokter_refferal = "CONCAT(xray_dokter.named,' ',xray_dokter.lastnamed) AS dokter_fullname,
xray_dokter.dokterid,
xray_dokter.username,
xray_dokter.idtele";

$table_dokter_refferal = "$database_ris.xray_dokter AS xray_dokter";
