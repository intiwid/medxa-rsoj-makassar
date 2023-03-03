// $("document").ready(function () {
function inobitec(uid) {
  let inobitec = document.querySelector("#inobitec");
  var text = `<?xml version="1.0" encoding="utf-8"?>
    <methodCall>
        <methodName>DownloadAndOpenStudy</methodName>
        <params>
        <param>
            <value>
            <struct>
                <member>
                <name>PatientID</name>
                <value>
                    <string></string>
                </value>
                </member>
                <member>
                <name>StudyInstanceUID</name>
                    <value>
                    <string>${uid}</string>
                    </value>
                </member>
                <member>
                <name>AET</name>
                    <value>
                    <string>dcmPACS</string>
                    </value>
                </member>
                <member>
                <name>IP</name>
                    <value>
                    <string>${inobitec.dataset.ip}</string>
                    </value>
                </member>
                <member>
                <name>port</name>
                    <value>
                    <string>11118</string>
                    </value>
                </member>
                <member>
                <name>CommandType</name>
                    <value>
                    <string>C-GET</string>
                    </value>
                </member>
            </struct>
            </value>
        </param>
        </params>
    </methodCall>`;
  $.ajax({
    type: "POST",
    url: "http://localhost:9091",
    data: text,
    contentType: "text/plain",
    dataType: "xml",
    cache: false,
    success: function (response) {
      // alert("Buka Viewer INOBITEC");
    },
    error: function (response) {
      alert("gagal, konfigurasi client!");
    },
  });
}
// });
