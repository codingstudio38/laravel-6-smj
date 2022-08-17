<?php
error_reporting(0);
$phone = trim($_REQUEST['phone']);
$email = trim($_REQUEST['email']);
$name = trim($_REQUEST['name']);
$country = trim($_REQUEST['country']);
$contact_date = trim($_REQUEST['date']);
$subject = trim($_REQUEST['subject']);
if($subject==""){
    if($name==""){
        $sub = "Polosoft Call Request";
    } else {
        $sub = "Polosoft Call Request || ".$name;
    }
} else {
    if($name==""){
        $sub = $subject;
    } else {
        $sub = $subject." || ".$name;
    }
}
$sponsormail="mondalbidyut38@gmail.com";
$nbody="<div class='dib12'>
 <div>
   <b>".$sub."</b>
 </div>
 <table width='100%'  align='center'>
<tr>
  <td>Name: ".$name."</td>
</tr>
<tr>
  <td>Email Id: ".$email."</td>
</tr>
<tr>
  <td>Phone: ".$phone."</td>
</tr>
<tr>
  <td>Country: ".$country."</td>
</tr>
<tr>
  <td>Schedule date: ".$contact_date."</td>
</tr>
</table>
";
//echo $nbody;exit;
date_default_timezone_set('Etc/UTC');
require '../PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = 'sg2plcpnl0129.prod.sin2.secureserver.net';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "formsubmission@2designnerds.com";
$mail->Password = "@GV*{%,7#ByK";
$mail->setFrom('formsubmission@2designnerds.com', 'noreply');
$mail->addReplyTo('formsubmission@2designnerds.com', 'noreply');
$mail->addAddress($sponsormail);
$mail->Subject = $sub;
$mail->msgHTML($nbody);
$mail->AltBody = 'This is a plain-text message body';
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
$mail->ClearAllRecipients( );
function save_mail($mail) {
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}

