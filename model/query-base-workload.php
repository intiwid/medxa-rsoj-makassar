<?php

$select_workload = "xray_workload.pk_dokter_radiology,
xray_workload.study_desc_pacsio,
xray_workload.status,
xray_workload.fill,
xray_workload.priority_doctor,
xray_workload.approved_at,
xray_workload.signature";

$table_workload = "$database_ris.xray_workload AS xray_workload";
