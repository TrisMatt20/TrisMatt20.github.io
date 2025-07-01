<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'chrewawi@gmail.com';
    $mail->Password   = 'qvluhpubeoctadqd';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('no-reply.skillstation@gmail.com', 'SkillStation');
    $mail->addAddress($email, $name);
    $mail->AddEmbeddedImage('assets/img/events/' . $eventBanner, 'eventBanner');

    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->isHTML(true);
    $mail->Subject = 'You’re Confirmed for the Event!';
    $mail->Body    = "
        <div style='width: 100%;'>
            <div style='max-width: 600px; margin: 0 auto; font-family: Helvetica, sans-serif;'>
                <img src='cid:eventBanner' alt='Event Banner' style='width: 100%; max-width: 600px; display: block; border-radius: 8px; margin-bottom: 20px;'>

                <h2 style='color: #3F51B5; text-align: center;'>Thank you for registering, $name!</h2>
                <p>You have successfully confirmed your attendance for the upcoming event.</p>

                <h3 style='margin-top: 20px;'>Event Details:</h3>
                <ul style='padding-left: 20px;'>
                    <li><strong>Event:</strong> $eventName</li>
                    <li><strong>Date:</strong> $eventDate</li>
                    <li><strong>Time:</strong> $eventTime</li>
                    <li><strong>Venue:</strong> $eventLocation</li>
                </ul>

                <p>See you there!</p>
            </div>
        </div>
    ";

    $mail->send();
    $successModal = true;
} catch (Exception $e) {
    echo "
    <script>
        alert('Email failed to send.');
        console.error('Error: " . addslashes($mail->ErrorInfo) . "');
        window.location.href = './';
    </script>
    ";
}
?>
