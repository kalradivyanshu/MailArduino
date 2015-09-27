<?php
set_time_limit(4000);
error_reporting(0);
// Connect to gmail
$imapPath = '{imap.gmail.com:993/ssl/novalidate-cert}[Gmail]/All Mail';
$username = 'Gmail-email-Id';
$password = 'password';
 
// try to connect
$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

$emails = imap_search($inbox,'UNSEEN from "kalradivyanshu@gmail.com"');
 
$output = '';
$i = 0;

foreach($emails as $mail) {
    $headerInfo = imap_headerinfo($inbox,$mail);
    $output[$i] = array("Subject"=>$headerInfo->subject, "Date"=>$headerInfo->date, "From"=>$headerInfo->fromaddress);
    $i++;
}

echo json_encode($output);
imap_expunge($inbox);
imap_close($inbox);
?>