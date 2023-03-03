<?php

require '../../../koneksi/koneksi.php';

session_start();

$uid = $_GET["uid"];

// -------------------------------xray_workload-----------------------------------

// $query1 = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid' ";

// $result1 = mysqli_query($conn, $query1);

// $row1 = mysqli_fetch_assoc($result1);
// $signature = $row1['signature'];

$query = "SELECT * FROM xray_workload WHERE uid = '$uid' ";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

$query2 = "SELECT * FROM xray_testpdf ORDER BY pdf_id DESC";

$result2 = mysqli_query($conn, $query2);

$row2 = mysqli_fetch_assoc($result2);

$dokradid = $row['dokradid'];
$name = $row['name'] . ' ' . $row['lastname'];
$name1 = str_replace('^', '', $name);
$name2 = substr($name1, 0, 24);
$lastname = $row['lastname'];
$patientid = $row['patientid'];
$mrn = $row['mrn'];
$address = $row['address'];
$sex = $row['sex'];
$birth_date = $row['birth_date'];
$birth_date1 = date("d-m-Y", strtotime($birth_date));
$query4 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
$row4 = mysqli_fetch_assoc($query4);
$body_part_series = $row4['body_part'];
$prosedur = $row['prosedur'];
if ($prosedur == '') {
    $prosedur1 = $body_part_series;
} else {
    $prosedur1 = $prosedur;
}
$prosedur1 = substr($prosedur1, 0, 29);
$schedule_date = $row['schedule_date'];
$name_dep = $row['name_dep'];
$name_dep = substr($name_dep, 0, 29);
$named = $row['named'];
$lastnamed = $row['lastnamed'];
$named = str_replace('^', '', $named);
$email = $row['email'];
$lastnamed = str_replace('^', '', $lastnamed);
$fullnamed = $named . ' ' . $lastnamed;
$fullnamed = substr($fullnamed, 0, 29);
$bday = new DateTime($birth_date);
$today = new DateTime(date('y-m-d'));
$diff = $today->diff($bday);
$updated_time = $row['updated_time'];
$updated_time1 = date("d-m-Y H:i", strtotime($updated_time));
$approve_date = $row['approve_date'];
$approve_time = $row['approve_time'];
$approve_date1 = date("d-m-Y", strtotime($approve_date));
$approve_time1 = date("H:i", strtotime($approve_time));
$spc_needs = $row['spc_needs'];
$spc_needs = substr($spc_needs, 0, 75);
$signature = $row['signature'];
$dokterid = $row['dokterid'];
$query_dokter = "SELECT * FROM xray_dokter WHERE dokterid = '$dokterid' ";
$result_dokter = mysqli_query($conn, $query_dokter);
$row_dokter = mysqli_fetch_assoc($result_dokter);
$email_dokter = $row_dokter['email'];

$fill = $row['fill'];

$query3 = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid' ";

$result3 = mysqli_query($conn, $query3);

$row3 = mysqli_fetch_assoc($result3);

$imgtemp = $row3['imgtemp'];
$dokrad_name = $row3['dokrad_name'];
$dokrad_lastname = $row3['dokrad_lastname'];
$dokrad_email = $row3['dokrad_email'];



require('../../pdf/fpdf.php');

//function hex2dec
//returns an associative array (keys: R,G,B) from a hex html code (e.g. #3FE5AA)
function hex2dec($couleur = "#000000")
{
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R'] = $rouge;
    $tbl_couleur['G'] = $vert;
    $tbl_couleur['B'] = $bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter in 72 dpi
function px2mm($px)
{
    return $px * 25.4 / 72;
}

function txtentities($html)
{
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    return strtr($html, $trans);
}
////////////////////////////////////



class PDF extends FPDF
{
    //variables of html parser
    protected $B;
    protected $I;
    protected $U;
    protected $HREF;
    protected $fontList;
    protected $issetfont;
    protected $issetcolor;
    protected $ALIGN;

    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4')
    {
        //Call parent constructor
        parent::__construct($orientation, $unit, $format);

        //Initialization
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
        $this->ALIGN = '';

        $this->tableborder = 0;
        $this->tdbegin = false;
        $this->tdwidth = 0;
        $this->tdheight = 0;
        $this->tdalign = "L";
        $this->tdbgcolor = false;

        $this->oldx = 0;
        $this->oldy = 0;

        $this->fontlist = array("arial", "times", "courier", "helvetica", "symbol");
        $this->issetfont = false;
        $this->issetcolor = false;
    }

    //////////////////////////////////////
    //html parser

    function WriteHTML($html)
    {
        $html = strip_tags($html, "<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>"); //remove all unsupported tags
        $html = str_replace("\n", '', $html); //replace carriage returns with spaces
        $html = str_replace("\t", '', $html); //replace carriage returns with spaces
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE); //explode the string
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                //Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                elseif ($this->tdbegin) {
                    if (trim($e) != '' && $e != "&nbsp;") {
                        $this->Cell($this->tdwidth, $this->tdheight, $e, $this->tableborder, '', $this->tdalign, $this->tdbgcolor);
                    } elseif ($e == "&nbsp;") {
                        $this->Cell($this->tdwidth, $this->tdheight, '', $this->tableborder, '', $this->tdalign, $this->tdbgcolor);
                    }
                } elseif ($this->ALIGN == 'center')
                    $this->Cell(0, 0, $e, 0, 1, 'C');
                elseif ($this->ALIGN == 'right')
                    $this->Cell(0, 0, $e, 0, 1, 'R');
                elseif ($this->ALIGN == 'left')
                    $this->Cell(0, 0, $e, 0, 1, 'L');
                else
                    $this->Write(5, stripslashes(txtentities($e)));
            } else {
                //Tag
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    //Extract attributes
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        //Opening tag
        switch ($tag) {

            case 'SUP':
                if (!empty($attr['SUP'])) {
                    //Set current font to 6pt     
                    $this->SetFont('', '', 6);
                    //Start 125cm plus width of cell to the right of left margin         
                    //Superscript "1" 
                    $this->Cell(2, 2, $attr['SUP'], 0, 0, 'L');
                }
                break;

            case 'TABLE': // TABLE-BEGIN
                if (!empty($attr['BORDER'])) $this->tableborder = $attr['BORDER'];
                else $this->tableborder = 0;
                break;
            case 'TR': //TR-BEGIN
                break;
            case 'TD': // TD-BEGIN
                if (!empty($attr['WIDTH'])) $this->tdwidth = ($attr['WIDTH'] / 4);
                else $this->tdwidth = 40; // Set to your own width if you need bigger fixed cells
                if (!empty($attr['HEIGHT'])) $this->tdheight = ($attr['HEIGHT'] / 6);
                else $this->tdheight = 6; // Set to your own height if you need bigger fixed cells
                if (!empty($attr['ALIGN'])) {
                    $align = $attr['ALIGN'];
                    if ($align == 'LEFT') $this->tdalign = 'L';
                    if ($align == 'CENTER') $this->tdalign = 'C';
                    if ($align == 'RIGHT') $this->tdalign = 'R';
                } else $this->tdalign = 'L'; // Set to your own
                if (!empty($attr['BGCOLOR'])) {
                    $coul = hex2dec($attr['BGCOLOR']);
                    $this->SetFillColor($coul['R'], $coul['G'], $coul['B']);
                    $this->tdbgcolor = true;
                }
                $this->tdbegin = true;
                break;

            case 'HR':
                if (!empty($attr['WIDTH']))
                    $Width = $attr['WIDTH'];
                else
                    $Width = $this->w - $this->lMargin - $this->rMargin;
                $x = $this->GetX();
                $y = $this->GetY();
                $this->SetLineWidth(0.2);
                $this->Line($x, $y, $x + $Width, $y);
                $this->SetLineWidth(0.2);
                $this->Ln(1);
                break;
            case 'STRONG':
                $this->SetStyle('B', true);
                break;
            case 'EM':
                $this->SetStyle('I', true);
                break;
            case 'B':
            case 'I':
            case 'U':
                $this->SetStyle($tag, true);
                break;
            case 'A':
                $this->HREF = $attr['HREF'];
                break;
            case 'IMG':
                if (isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                    if (!isset($attr['WIDTH']))
                        $attr['WIDTH'] = 0;
                    if (!isset($attr['HEIGHT']))
                        $attr['HEIGHT'] = 0;
                    $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
                }
                break;
            case 'BLOCKQUOTE':
            case 'BR':
                $this->Ln(5);
                break;
            case 'P':
                $this->Ln(5);
                $this->ALIGN = $attr['ALIGN'];
                break;
            case 'FONT':
                if (isset($attr['COLOR']) && $attr['COLOR'] != '') {
                    $coul = hex2dec($attr['COLOR']);
                    $this->SetTextColor($coul['R'], $coul['G'], $coul['B']);
                    $this->issetcolor = true;
                }
                if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                    $this->SetFont(strtolower($attr['FACE']));
                    $this->issetfont = true;
                }
                if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist) && isset($attr['SIZE']) && $attr['SIZE'] != '') {
                    $this->SetFont(strtolower($attr['FACE']), '', $attr['SIZE']);
                    $this->issetfont = true;
                }
                break;
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if ($tag == 'SUP') {
        }

        if ($tag == 'P')
            $this->ALIGN = '';

        if ($tag == 'TD') { // TD-END
            $this->tdbegin = false;
            $this->tdwidth = 0;
            $this->tdheight = 0;
            $this->tdalign = "L";
            $this->tdbgcolor = false;
        }
        if ($tag == 'TR') { // TR-END
            $this->Ln();
        }
        if ($tag == 'TABLE') { // TABLE-END
            $this->tableborder = 0;
        }

        if ($tag == 'STRONG')
            $tag = 'B';
        if ($tag == 'EM')
            $tag = 'I';
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';
        if ($tag == 'FONT') {
            if ($this->issetcolor == true) {
                $this->SetTextColor(0);
            }
            if ($this->issetfont) {
                $this->SetFont('arial');
                $this->issetfont = false;
            }
        }
    }

    function SetStyle($tag, $enable)
    {
        //Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s) {
            if ($this->$s > 0)
                $style .= $s;
        }
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }
} //end of class


$file_name = 'Data Patient.pdf';
// $html_code = fetch_customer_data($connect);
$pdf = new PDF('P', 'mm', 'A4');

// $pdf->SetTopMargin(10);
// membuat halaman baru
$pdf->SetMargins(10, 22, 8);
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', '', 10);
// mencetak string 

$pdf->SetTitle('Hasil expertise');

$pdf->image('header-rs.jpg', 7, 2, 198);
$pdf->MultiCell(0, 1, ' 




                    ', 0, "J", false);


// ------------------------------------------------------------


$pdf->Cell(28, 5, 'No Foto', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $patientid, 0, 0, 'L');
// ------------------
$pdf->Cell(35, 5, 'Ruang', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $name_dep, 0, 1, 'L');
// ------------------
$pdf->Cell(28, 5, 'No RM', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $mrn, 0, 0, 'L');
// ------------------
$pdf->Cell(35, 5, 'Dokter Pengirim', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $fullnamed, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Nama', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $name2, 0, 0, 'L');
// -----------------
$pdf->Cell(35, 5, 'Dokter Radiologi', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $dokrad_name . ' ' . $dokrad_lastname, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Tgl Lahir / Umur', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $birth_date1 . ' / ' . $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D', 0, 0, 'L');
// -------------------
$pdf->Cell(35, 5, 'Waktu Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $updated_time1, 0, 1, 'L');
//-------------------
$pdf->Cell(28, 5, 'Jenis Kelamin', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $sex, 0, 0, 'L');
// -----------------
$pdf->Cell(35, 5, 'Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $prosedur1, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Klinis', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(158, 5, $spc_needs, 0, 2, 'L');
$pdf->Line(10, 59, 200, 59);
// $pdf->Cell(35, 5, '', 0, 0, 'L');
// $pdf->Cell(3, 5, '', 0, 0, 'L');
// $pdf->Cell(55, 5, '', 0, 1, 'L');
// // -----------------
// $pdf->Cell(35, 5, '', 'B', 0, 'L');
// $pdf->Cell(3, 5, '', 'B', 0, 'L');
// $pdf->Cell(55, 5, '', 'B', 0, 'L');
// // ------------------
// $pdf->Cell(40, -35, 'Klinis', 'T', 0, 'L');
// $pdf->Cell(3, -35, ':', 0, 0, 'L');
// $pdf->MultiCell(55, 5, 'ASDSADSADSADSADSADSADSADSADSADSADSADSADSADA', 'RB', 'L');
// ------------------
// $pdf->SetLineWidth(0.1);



$fill = str_replace("&nbsp;", " ", $fill);
$fill = str_replace("&amp;", "&", $fill);
$fill = str_replace("&quot;", "\"", $fill);
$fill = str_replace("&#39;", "'", $fill);
$fill = str_replace("&middot;", "-", $fill);
$fill = str_replace("<ul>", "<br />", $fill);
$fill = str_replace("<li>", "   " . chr(149) . " ", $fill);
$fill = str_replace("</li>", "<br />", $fill);
$fill = str_replace("</ul>", "<br />", $fill);
// <p align="left"></p> read pdf
// <div style="text-align:center;"></div> FROM CK EDITOR

$fill = str_replace('<div style="text-align: center;">', '<br /><p align="center">', $fill);
$fill = str_replace('<div style="text-align: left;">', '<br /><p align="left">', $fill);
$fill = str_replace('<div style="text-align: right;">', '<br /><p align="right">', $fill);
// $fill = str_replace('<div>', '', $fill);
$fill = str_replace('<div style="text-align:center;">', '<br /><p align="center">', $fill);
$fill = str_replace('<div style="text-align:left;">', '<br /><p align="left">', $fill);
$fill = str_replace('<div style="text-align:right;">', '<br /><p align="right">', $fill);
// $fill = str_replace("</div>", "", $fill);

// $pdf->WriteHTML("<br>");
$pdf->WriteHTML("<strong><u><p align='center'>Hasil Pemeriksaan Radiology</p></u></strong>");
$pdf->WriteHTML("<br>");
$pdf->WriteHtml($fill);
$pdf->WriteHTML("<br>");
$pdf->WriteHTML("<br>");
// KALAU PAKAI IMAGE DI TTD
$pdf->image('../../../image/' . $imgtemp, 135, 245, 65);
if ($signature) {
    $pdf->image('../../phpqrcode/ttddokter/' . $signature, 155, 257, -250);
}
// KALAU PAKAI IMAGE DI TTD
// KALAU PAKAI WRITE HTML

// if (!empty($signature)) {
//     $pdf->WriteHTML(
//         "<b><p align='left' margin-left='50px;'>Pemeriksa,</p></b><br>
// <b><p align='left' margin-left='50px;'>BTK</p></b><br>
// "
//     );
//     $pdf->image('../phpqrcode/ttddokter/' . $signature, NULL, NULL, 25);
// } else {
//     $pdf->WriteHTML(
//         "<b><p align='left' margin-left='50px;'>Pemeriksa,</p></b><br>
// <br><br><br><br><br>
// "
//     );
// }
// $pdf->WriteHTML(
//     '<b><u>(' . $dokrad_name . ' ' . $dokrad_lastname . ')</u></b>',
//     0,
//     'L'
// );
// KALAU PAKAI WRITE HTML

$pdf->output('F', $file_name);

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
$mail->addReplyTo($dokrad_email, $dokrad_name . ' ' . $dokrad_lastname);

//Set who the message is to be sent to
$mail->addAddress($email_dokter, $named . ' ' . $lastnamed);

//Set the subject line
$mail->Subject = 'Notifikasi Patient Ruangan Radiology';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents-radiographer.php'), __DIR__);

//Replace the plain text body with one created manually
$mail->Body =
    '<div style="width: 1000px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<h1>Pasien Atas Nama :
' . ' ' . $name2 . ' ' . 'Sudah Selesai</h1><br>
<h2>Terimakasih Atas Kepercayaan Anda</h2>
</div>';

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
    # echo "Message saved!";
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
