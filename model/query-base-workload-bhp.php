<?php

$select_workload_bhp = "xray_workload_bhp.film_small,
xray_workload_bhp.film_medium,
xray_workload_bhp.film_large,
xray_workload_bhp.film_reject_small,
xray_workload_bhp.film_reject_medium,
xray_workload_bhp.film_reject_large,
xray_workload_bhp.re_photo,
xray_workload_bhp.kv,
xray_workload_bhp.mas
";

$table_workload_bhp = "$database_ris.xray_workload_bhp AS xray_workload_bhp";
