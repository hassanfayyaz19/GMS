<?php
//recipient

foreach($_POST as $name => $val )
$$name=$val;
//$to = "basitalim606@yahoo.com";
$to = "info@dsafe.com.my";
$from = "no-reply@dsafe.com.my";
$fromName = "D-SAFE";


//email subject
$subject = 'Contact Enquiry Form DSAFE'; 

//email body content
$htmlContent = '
<h3>Client has submitted the Contact Enquiry having following detail.</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%"><b>Name</b>:</td>
	<td>'.$uname.'</td>
  </tr>
  <tr>
    <td><b>Email</b>:</td>
	<td>'.$email.'</td>
  </tr>
  <tr>
    <td><b>Message</b>:</td>
	<td>'.$message.'</td>
  </tr>
</table>

';

//header for sender info
$headers = "From: $fromName"." <".$from.">";

//boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

//headers for attachment 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

//multipart boundary 
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

//send email
$mail = @mail($to, $subject, $message, $headers, $returnpath); 
?>
	<form name="frmsuc" id="frmsuc" method="post" action="contact.html" >
		<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
		<input type="hidden" name="msg" id="msg" value="Email send successfully" /> 
	</form>
  <script>
  	  alert("Email sent successfully");
	  document.frmsuc.submit();
  </script>
<?php 
exit;
?>