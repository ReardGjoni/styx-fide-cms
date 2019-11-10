<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
require 'mailCredentials.php';

if (isset($_POST['reset_request_submit'])) {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    
    $url = "http://styx-fide.de/php-files/create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $expires = date("U") + 1800;
    $errors = [];

    require_once "dbConfig.php";

    $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($dbConnection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $errors[] = "There was an error.";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires)
            VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($dbConnection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $errors[] = "There was an error.";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close();

    $mail = new PHPMailer(TRUE);

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->isHtml();
    $mail->Username = $emailAddress;
    $mail->Password = $emailPassword;
    $mail->setFrom('noreply@gmail.com', 'Styx Fide');
    $mail->Subject = "Reset your password for Styx Fide";
    $mail->Body = '<p> Hello We received a password reset request. </br>
                       The link to reset your password is below.
                       If you did not make this request, you can ignore this E-Mail.
                   </p>
                   <p> Here is your password reset link: </br>
                   <a href="' . $url . '">' . $url . '</a></p>';
    $mail->addAddress($userEmail);

    if ($mail->Send()) {
        $errors[] = "Check your E-Mail";
    } else {
        $errors[] = "Error sending E-Mail" . $mail->ErrorInfo;
    }

    header("Location: ../reset_password.php?reset=success");
} else {
    header("Location: ../login.php");
}


























