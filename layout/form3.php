
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require_once '/xampp/htdocs/hotel/PHPMailer/src/Exception.php';
    require_once '/xampp/htdocs/hotel/PHPMailer/src/SMTP.php';
    require_once '/xampp/htdocs/hotel/PHPMailer/src/PHPMailer.php';
    include('connection.php');
    
    $name = $_POST['full_name'];
    $email = $_POST['email_adress'];
    $number = $_POST['mobile_number'];
    $subject = $_POST['Email_Subject'];
    $message = $_POST['message'];
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'anibadoha9@gmail.com';
    $mail->Password = 'kirbsqyxsirzlmrs';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    // Sender and recipient settings
    $mail->setFrom($email);
    $mail->addAddress('anibadoha9@gmail.com');
    // Email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = 'client email : ' . $email .'<br>client name : ' . $name . ',<br><br>subject : '. $subject . '.<br><br>message:<br>'.$message.'<br>';
    
    // Send email
    if ($mail->send()) {
        echo 'message email sent';
        header('location:message_success.html?');
    } else {
        echo 'Error sending email';
    }
?>