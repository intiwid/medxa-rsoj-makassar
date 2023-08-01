<?php

$select_series_req = "series_req.pk, 
series_req.series_fk,
series_req.accno_issuer_fk, 
series_req.accession_no,
series_req.study_iuid, 
series_req.req_proc_id,
series_req.sps_id";

$table_series_req = "$database_pacsio.series_req AS series_req";
