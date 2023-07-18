<?php

$select_workload_fill = "xray_workload_fill.pk,
xray_workload_fill.pk_dokter_radiology,
xray_workload_fill.dokradid,
xray_workload_fill.dokrad_name,
xray_workload_fill.uid,
xray_workload_fill.fill,
xray_workload_fill.is_default,
xray_workload_fill.change_doctor_approved,
xray_workload_fill.created_at,
xray_workload_fill.updated_at,
xray_workload_fill.deleted_at";

$table_workload_fill = "$database_ris.xray_workload_fill AS xray_workload_fill";
