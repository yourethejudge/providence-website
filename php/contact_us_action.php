<?php
// [ATTENTION] Change this if you want to check for a different field 
// Program doesn't continue if email field is missing
if(isset($_POST['email'])) {
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "contactus@myprovidence.net.au";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
    // validation expected data exists
    // [ATTENTION] This part makes sure that 'name', 'message' and 
    // 'email' fields were submitted. Add more or remove some.  
    if(!isset($_POST['name']) ||
        !isset($_POST['message']) ||
        !isset($_POST['email'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    // [ATTENTION] Change these fields accordingly. 
    // Change the value for $email_from_default
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $email_from = $_POST['email'];
    $email_subject = "CHANGE_TO_YOUR_SUBJECT";
    $email_from_default = "CHANGE_TO_YOUR_HOST_DOMAIN_EMAIL";

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "message: ".clean_string($message)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";

    // create email headers
    $headers = 'From: '.$email_from_default."\r\n".
    'Reply-To: '.$email_from_default."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="images/icon.ico">
  <title>CHANGE_TO_YOUR_TITLE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Thank you for contacting us" />
</head>
<body>
  <h1>Thank You!</h1>
</body>
</html>

<?php
}
?>