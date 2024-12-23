<?php

namespace Utils\Functions;

use DateTime;
use DateTimeZone;
use PHPMailer\PHPMailer\PHPMailer;

function getDateTime()
{
    $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
    return $date->format('Y-m-d H:i:s');
}

function handleImage($path, $filePathName, $old_image = null)
{
    if (!empty($old_image) && file_exists($old_image)) {
        unlink($old_image);
    }

    $targetDir = "$path";
    $imageFileName = 'image' . '_' . bin2hex(random_bytes(4)) . '.' . strtolower(pathinfo($_FILES[$filePathName]['name'], PATHINFO_EXTENSION));
    $extension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
    $targetFile = $targetDir . $imageFileName;
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    if (in_array($extension, $allowedExtensions)) {
        if (move_uploaded_file($_FILES[$filePathName]['tmp_name'], $targetFile)) {
            return $targetFile;
        } else {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Upload image failed, please try again'
            ];
        }
    } else {
        $_SESSION['toastrNotify'] = [
            'alert-type' => 'error',
            'message' => 'Image have to JPG, JPEG, PNG'
        ];
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function mailer()
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "duonganhhao4751@gmail.com";
    $mail->Password = $_ENV['APP_PASSWORD'];

    $mail->isHTML(true);

    return $mail;
}
