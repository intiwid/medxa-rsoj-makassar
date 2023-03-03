<?php

$hostname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM xray_hostname_publik"));

// PDF
define('PDFFIRST', '<a style="text-decoration:none;" class="" href="../radiology/pdf/expertise.php?uid=');
define('PDFLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/new/pdf-new.svg" data-toggle="tooltip" title="PDF" style="width: 100%;"></span></a>');

// DICOM
define('DICOMFIRST', '<a style="text-decoration:none;" href="jnlp://' . $_SERVER['SERVER_NAME'] . ':19898/weasis-pacs-connector/DCM_viewer.jnlp?studyUID=');
define('DICOMLAST', '"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyered.svg" data-toggle="tooltip" title="Dicom Viewer" style="width: 100%;"></span></a>');

// HTML
define('HTMLFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':19898/intiwid/viewer.html?studyUID=');
define('HTMLLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyeyellow.svg" data-toggle="tooltip" title="HTML Viewer" style="width: 100%;"></span></a>');

// Mobile
define('MOBILEFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':19898/dwv-viewer/index.html?type=manifest&input=%2Fweasis-pacs-connector%2Fmanifest%3FseriesUID%3D');
define('MOBILELAST', '"target="_blank"><span class="btn btn-warning btn-inti"><i class="fas fa-eye" data-toggle="tooltip" title="Web Viewer"></i></span></a>');

// Change doctor
define('CHANGEDOCTORICONYES', '<img src="../image/new/user-doctor.svg" data-toggle="tooltip" title="choose Physician" style="width: 100%;">');
define('CHANGEDOCTORICONNO', '<img src="../image/new/user-doctor-no.svg" data-toggle="tooltip" title="choose Physician" style="width: 100%;">');
define('CHANGEDOCTORFIRST', '<a style="text-decoration: none;" href="changedoctorworklist.php?uid=');
define('CHANGEDOCTORMID', '&dokradid=');
define('CHANGEDOCTORSTAT', '&status=');
define('CHANGEDOCTORLAST', '"><span class="btn rgba-stylish-slight darken-1 btn-inti2">');
define('CHANGEDOCTORVERYLAST', '</span></a>');

// Ambil hasil expertise
define('GETEXPERTISEICONYES', '<img src="../image/new/envelop.svg" data-toggle="tooltip" style="width: 100%;">');
define('GETEXPERTISEICONNO', '<i class="fas fa-envelope-open fa-lg deep-orange-text"></i>');
define('GETEXPERTISEICONWAITING', '<img src="../image/new/envelop-not.svg" data-toggle="tooltip" class="not-allowed" style="width: 100%;">');
define('GETEXPERTISEFIRST', '<a style="text-decoration: none;" title="');
define('GETEXPERTISEHREFYES', '" href="take-envelope.php?uid=');
define('GETEXPERTISEHREFNO', '" href="#');
define('GETEXPERTISELAST', '"><span class="btn rgba-stylish-slight darken-1 btn-inti2">');
define('GETEXPERTISEVERYLAST', '</span></a>');

// DELETE
define('DELETEFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="deleteworkload.php?uid=');
define('DELETELAST', '"onclick=\'return confirm("Delete data?");\'><span class="btn red lighten-1 btn-intiwid1"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></span></a>');

// EDIT PASIEN
define('EDITPASIENFIRST', '<a href="update-workload.php?uid=');
define('EDITPASIENLAST', '"<span class="btn text-primary rgba-stylish-slight btn-inti2"><img src="../image/new/update-new.svg" data-toggle="tooltip" title="Update" style="width: 100%;"></span></a>');

// EDIT WORKLOAD
define('EDITWORKLOADFIRST', '<a href="workload-edit.php?uid=');
define('EDITWORKLOADLAST', '"><span class="btn text-info rgba-stylish-slight btn-inti2"><img src="../image/edit.svg" data-toggle="tooltip" title="Edit Report" style="width: 100%;"></span></a>');

// telegram dokter pengirim
define('TELEDOKTERPENGIRIMFIRST', '<a style="text-decoration: none;" href="../radiology/telenotif.php?uid=');
define('TELEDOKTERPENGIRIMLAST', '" target="_blank"><span class="btn deep-orange-text rgba-stylish-slight btn-inti2"><img src="../image/telegram2.svg" data-toggle="tooltip" title="Telegram" style="width: 100%;"></span></a>');

// telegram signature
define('TELEGRAMSIGNATUREFIRST', '<a style="text-decoration:none;" href="otp.php?uid=');
define('TELEGRAMSIGNATURELAST', '"><span class="btn text-secondary rgba-stylish-slight btn-inti2"><img src="../image/signature.svg" data-toggle="tooltip" title="Signature" style="width: 100%;"></span></a>');

// pop up read more series
define('READMORESERIESFIRST', '<a href="#" class="hasil-series penawaran-a" data-id="');
define('READMORESERIESLAST', '">Read More</a>');

// integrasi simrs
define('SIMRS', '<i class="fas fa-exchange-alt text-info" style="font-size:0.5rem;" title="terintegrasi dengan SIMRS"></i>');

// priority NORMAL
define('PRIORITYNORMAL', '<i style="color: #2d2; font-size:0.4rem;" class="fas fa-circle"></i>');

// PIORITY CITO
define('PRIORITYCITO', '<i style="color: red; font-size:0.4rem;" class="fas fa-circle"></i>');

// WORKLIST DOKTER BELUM DIBACA
define('WORKLISTFIRST', '<a href="worklist.php?uid=');
define('WORKLISTLAST', '"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/write2.svg" data-toggle="tooltip" title="Go to Expertise" style="width: 110%;"></span></a>');

// DRAFT DOKTER 
define('DRAFTFIRST', '<a href="worklist.php?uid=');
define('DRAFTLAST', '"><span class="btn btn-warning btn-inti"><i class="fas fa-edit" data-toggle="tooltip" title="Go to expertise"></i></span></a>');

//radiant
define('RADIANTFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22');
define('RADIANTLAST', '%22" "target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/radiAnt.png" data-toggle="tooltip" title="Radiant Viewer" style="width: 100%;"></span></a>');

//ipiview
define('IPIVIEWFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://192.168.10.144:8089/ipiview/ipiview/html/start.html?StudyInstanceUID=');
define('IPIVIEWLAST', '" target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyeyellow.svg" data-toggle="tooltip" title="IPI Viewer" style="width: 100%;"></span></a>');

// inobitec
define('INOBITECFIRST', '<a href="#" class="ahref-edit" onclick="inobitec(');
define('INOBITECLAST', ')"id="inobitec" data-ip="' . $_SERVER['SERVER_NAME'] . '"><span class="btn btn-warning btn-inti"><i class="fas fa-eye" data-toggle="tooltip" title="Web Viewer"></i></span></a>');

// HOROS
$horos = '<a href="Horos://?methodName=displayStudy&StudyInstanceUID=';
define('HOROSFIRST', "$horos");
define('HOROSLAST', '"class="ahref-edit" style="text-decoration:none;" target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/horos.png" data-toggle="tooltip" title="Radiant Viewer" style="width: 100%;"></span></a>');


// untuk icon OHIF LARGE DI WORKLIST
$ohif_large = '"class="button8 delete1" target="_blank"><img src="../image/web.svg" style="width: 50px;"><br> <span> Web Viewer</span></a>';
// untuk icon OHIF small DI WORKLIST
$ohif_small = '"style="text-decoration:none;" class="ahref-edit" target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyegreen.svg" data-toggle="tooltip" title="Tab Viewer" style="width: 100%;"></span></a>';

// OHIF TERBARU
if ($_SERVER['SERVER_NAME'] == $hostname['ip_publik']) {
    // jika menggunakan ip publik
    define('OHIFNEWFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':82/viewer?StudyInstanceUIDs=');
    define('OHIFNEWLAST', "$ohif_small");
    // jika menggunakan ohif baru icon(large)
    define('OHIFNEWWORKLISTFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':82/viewer?StudyInstanceUIDs=');
    define('OHIFNEWWORKLISTLAST', "$ohif_large");
} else {
    define('OHIFNEWFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':81/viewer?StudyInstanceUIDs=');
    define('OHIFNEWLAST', "$ohif_small");
    // jika menggunakan ohif baru icon(large)
    define('OHIFNEWWORKLISTFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':81/viewer?StudyInstanceUIDs=');
    define('OHIFNEWWORKLISTLAST', "$ohif_large");
}

// OHIF LAMA
if ($_SERVER['SERVER_NAME'] == $hostname['ip_publik']) {
    // jika menggunakan ip publik
    // jika menggunakan ohif lama icon (small)
    define('OHIFOLDFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':92/viewer/');
    define('OHIFOLDLAST', "$ohif_small");
    // jika menggunakan ohif lama icon(large)
    define('OHIFOLDWORKLISTFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':92/viewer/');
    define('OHIFOLDWORKLISTLAST', "$ohif_large");
} else {
    // jika menggunakan ip lokal
    // jika menggunakan ohif lama icon (small)
    define('OHIFOLDFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':91/viewer/');
    define('OHIFOLDLAST', "$ohif_small");
    // jika menggunakan ohif lama icon(large)
    define('OHIFOLDWORKLISTFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':91/viewer/');
    define('OHIFOLDWORKLISTLAST', "$ohif_large");
}

// VIEWER DI WORKLIST ICON LARGE
define('DICOMWORKLISTFIRST', '<a href="jnlp://' . $_SERVER['SERVER_NAME'] . ':19898/weasis-pacs-connector/DCM_viewer.jnlp?studyUID=');
define('DICOMWORKLISTLAST', '"class="button8 delete1"><img src="../image/desktop.svg" style="width: 50px;"><br> <span> Dicom Viewer</span></a>');
define('HTMLWORKLISTFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':19898/intiwid/viewer.html?studyUID=');
define('HTMLWORKLISTLAST', '" class="button8 delete1" target="_blank"><img src="../image/html.svg" style="width: 50px;"><br> <span> HTML Viewer</span></a>');
define('RADIANTWORKLISTFIRST', '<a href="radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22');
define('RADIANTWORKLISTLAST', '%22" class="button8 delete1"><img src="../image/radiAnt.png" style="width: 50px;"><br><span> Radiant</span></a>');
// url HOROS -> Horos://?methodName=retrieve&serverName=INTIWID&then=open&retrieveOnlyIfNeeded=yes&filterKey=StudyInstanceUID&filterValue=
// url HOROS -> Horos://?methodName=displayStudy&StudyInstanceUID=
define('HOROSWORKLISTFIRST', "$horos");
define('HOROSWORKLISTLAST', '"class="button8 delete1"><img src="../image/horos.png" style="width: 50px;"><br><span> Horos Viewer</span></a>');
