<?php

    require '../../../koneksi/koneksi.php';

    session_start();

    $uid = $_GET["uid"];

    // -------------------------------xray_workload-----------------------------------

$query = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid' ";

$result = mysqli_query($conn, $query);




// $name = $row['name'];
// $dokradid = $row['dokradid'];
// $name1 = preg_replace('/[^A-Za-z\ ]/', '', $name); 
// $lastname = $row['lastname'];
// $mrn = $row['mrn'];
// $sex = $row['sex'];
// $birth_date = $row['birth_date'];
// $prosedur = $row['prosedur'];
// $schedule_date = $row['schedule_date'];
// $name_dep = $row['name_dep'];
// $named = $row['named'];
// $lastnamed = $row['lastnamed'];
// $email = $row['email'];
// $bday = new DateTime($birth_date);
// $today = new DateTime(date('y-m-d'));
// $diff = $today->diff($bday);
// $sd = date("d F Y", strtotime($schedule_date)); 
// $fill = $row['fill'];
// ---------------------------dokter radiology------------------------




$dokrad_name = $row3['dokrad_name'];
$dokrad_lastname = $row3['dokrad_lastname'];
$dokrad_email = $row3['dokrad_email'];

$imgtemp = $row3['imgtemp'];

echo $name1;


require '../PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "intimedikarispacs@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "intimed313";

//Set who the message is to be sent from
$mail->setFrom('intimedikarispacs@gmail.com', 'INTIMEDIKA RIS');

//Set an alternative reply-to address
$mail->addReplyTo('', '');

//Set who the message is to be sent to
$mail->addAddress('andikautama034@gmail.com', 'andika');

//Set the subject line
$mail->Subject = 'Notifikasi Patient Ruangan Radiology';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents(''), __DIR__);

//Replace the plain text body with one created manually
$mail->Body = "<h2>INTIWID RISPACS</h2>"."<h3>Pasien Anda Menunggu</h3>".


                     "<table width='100%' border='1' style='margin-top:15px;' align='left class='table table-striped'>". 
                      "<thead><tr>".
                      "<th>NAME</th>".
                      "<th>AGE</th>".
                      "<th>SEX</th>".
                      "<th>PROCEDURE</th>".
                      "<th>MODALITY</th>".
                      "<th>PDC</th>".
                      "</tr></thead><tbody>";
                      
                      while($row = mysqli_fetch_assoc($result)){
                        $birth_date = $row['birth_date'];
                        $bday = new DateTime($birth_date);
                        $today = new DateTime(date('y-m-d'));
                        $diff = $today->diff($bday);
  $mail->Body.=       "<tr>".
                      "<td> ".$row['name'].' '.$row['lastname']."</td>".
                      "<td> ".$diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D'."</td>".
                      "<td> ".$row['sex']."</td>".
                      "<td> ".$row['prosedur']."</td>".
                      "<td> ".$row['xray_type_code']."</td>".
                      "<td> ".$row['updated_time']."</td></tr>";
                      
$mail->Body.=       "</tbody></table>";
$mail->Body.=       "<p>Best Regrads,</p>".
                    "<p>".$row['radiographer_name'].' '.$row['radiographer_lastname']."</p>";}

//Attach an image file
$mail->addAttachment($file_name);

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "<script>
          alert('Email Sent');
          window.close();
          </script>";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
unlink($file_name);

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}

