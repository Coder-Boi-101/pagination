require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'amirnoor.ocanalytica@gmail.com';                     //SMTP username
    $mail->Password   = 'nnudtwinbjxrmqfm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    // //1
    // $mail->setFrom('amirnoor.ocanalytica@gmail.com', 'Amir Khan');
    // $mail->addAddress('harisnaved5101996@gmail.com', 'Haris Khan');     //Add a recipient
    // // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('amirnoor.ocanalytica@gmail.com', 'Amir Khan');
    // //2
    // $mail->setFrom('amirnoor.ocanalytica@gmail.com', 'Amir Khan');
    // $mail->addAddress('mamirnoor101@gmail.com', 'Amir Noor');     //Add a recipient
    // // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('amirnoor.ocanalytica@gmail.com', 'Amir Khan');
    // //3
    // $mail->setFrom('amirnoor.ocanalytica@gmail.com', 'Amir Khan');
    // $mail->addAddress('musharaf.workspace@gmail.com', 'Musharaf Khan');     //Add a recipient
    // // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('amirnoor.ocanalytica@gmail.com', 'Amir Khan');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<h1>Message has been sent</h1>';
} catch (Exception $e) {
    echo '<h1>Message could not be sent. Mailer Error:' .$mail->ErrorInfo.'</h1>';
}
}
else{
    echo '<h1>Sorry no Emails Found</h1>';