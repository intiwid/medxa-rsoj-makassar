<?php

$select_mwl_item = "mwl_item.sps_id, 
mwl_item.study_iuid AS study_iuid_mppsio,
mwl_item.created_time,
station_aet,
perf_physician,
req_proc_id";

$table_mwl_item = "$database_mppsio.mwl_item AS mwl_item";
