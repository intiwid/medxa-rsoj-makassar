<?php

$select_study = "study.pk AS pk_study,
study.study_iuid,
study.study_datetime,
study.accession_no,
study.ref_physician,
study.study_desc,
study.mods_in_study,
study.num_series,
study.num_instances,
study.retrieve_aets,
study.created_time,
study.updated_time";

$table_study = "$database_pacsio.study AS study";
