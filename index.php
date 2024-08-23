<?php
include_once "libs/class.phpmailer.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'libs/Exception.php';
require 'libs/PHPMailer.php';
require 'libs/SMTP.php';

if(isset($_POST['sendmail'])) {

// Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ramarbalasubramaniyam@gmail.com'."\r\n";
    $headers .= 'reply-to: azarudeen0703@gmail.com'."\r\n";
    // $headers .= 'signed-by: omcmanpower.com' . "\r\n";
    $email= 'azarudeen0703@gmail.com';
    $client_email = $_POST['email'];
    // $resultPageMessage  = "tha";//$row["resultPageMessage"];
    $client_message     = $_POST['message'];//$message;
    $client_subject = $_POST['subject'];
    //Mail
    if(mail($client_email, $client_subject, $client_message, $headers))
    {
        echo "SUCCESS|Your mail send successfully";
    }
    else
    {
        echo "ERROR|Oops something went wrong. Please check carefully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <body>
    <br />
    <div class="container">
	<div class="row">
       <center><h4><b>SEND MAIL</b></h4></center>
       <hr>
    <div class="col-md-9 col-md-offset-2">
        <form role="form" method="post" enctype="multipart/form-data">
        <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="email">Name :</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" maxlength="50">
                </div>
            </div>

        	<div class="row">
                <div class="col-sm-9 form-group">
                    <label for="email"> Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength="50">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter your subject" maxlength="50">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="name">Message:</label>
                    <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Your Message Here" maxlength="6000" rows="4"></textarea>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="name">File:</label>
                    <input name="file[]" multiple="multiple" class="form-control" type="file" id="file">
                </div>
            </div> -->
             <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Send</button>
                </div>
            </div>
        </form>
	</div>
</div>
    </div>
</body>
</html>
