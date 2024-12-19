<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function asset($path)
{
    return BASEURL . 'public/' . $path;
}

function uploads($path)
{
    return $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/' . $path;
}

function sendResetEmail($email, $resetLink)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST']; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USERNAME']; // Email
        $mail->Password = $_ENV['EMAIL_PASSWORD']; // App Password Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email configuration
        $mail->setFrom($_ENV['EMAIL_USERNAME'], 'Re-Kos');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Password Anda';
        $mail->Body    = "Klik link berikut untuk reset password Anda: <a href='$resetLink'>$resetLink</a>";

        $mail->send();
        Flasher::setFlash('*Link Reset Password Telah di Kirim ke Email Anda', 'success');
    } catch (Exception $e) {
        error_log("PHPMailer Error: {$mail->ErrorInfo}");
        Flasher::setFlash('*Terjadi kesalahan saat mengirim email, silakan coba lagi.', 'danger');
    }
}
