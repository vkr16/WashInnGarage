<?php
require_once "../../core/init.php";
$JSON_creds     = file_get_contents("../../core/mail-credentials.json");
$credentials    = json_decode($JSON_creds, true);
$email_address  = $credentials['creds']['email'];
$email_password = $credentials['creds']['password'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../assets/vendor/phpmailer/phpmailer/src/Exception.php';
require '../../assets/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../assets/vendor/phpmailer/phpmailer/src/SMTP.php';
function generateRandomString($length)
{
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if (isset($_POST['btnEditUser'])) {
    $oldUsername = $_POST['oldone'];
    $username    = $_POST['username'];
    $fullname    = $_POST['fullname'];
    $email       = $_POST['email'];
    $role        = $_POST['role'];
    $phone       = $_POST['phone'];
    $userid      = $_POST['userid'];
    $username    = rm_special_char($username);
    $fullname    = rm_special_char($fullname);
    $phone       = rm_special_char($phone);
    if ($username != $oldUsername) {
        if (isExist($username)) {
            setcookie('returnstatus', 'usernameconflict', time() + (10), "/");
            header("Location: ../manage-user.php");
        }
    }
    if (isset($_POST['resetpass']) && $_POST['resetpass'] == 'reset') {
        $resetpass      = generateRandomString(6);
        $additionalbody = "\nPassword : " . $resetpass . "\n\nPlease change your password immediately after first login.";
    } else {
        $resetpass      = 'no';
        $additionalbody = "";
    }
    if (updateUser($userid, $fullname, $email, $username, $phone, $role, $resetpass)) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host     = 'smtp.gmail.com';
        $mail->Port     = 587;
        $mail->Username = $email_address;
        $mail->Password = $email_password;
        $mail->setFrom($email_address);
        $mail->addAddress($email);
        $mail->Subject = 'Wash Inn Garage Account Update ';
        $mail->Body    = "Hi " . $fullname . ", Your account information has been updated.\nHere is your new account details.\n\nFull Name : " . $fullname . "\nUsername : " . $username . "\nEmail : " . $email . "\nPhone Number : " . $phone . "\nRole : " . $role . $additionalbody . "\n\n\nCopyright © 2022, Wash Inn Garage. All Rights Reserved.";
        if (!$mail->send()) {
            setcookie('returnstatus', 'offlinewarning', time() + (10), "/");
            header("Location: ../manage-user.php");
        } else {
            setcookie('returnstatus', 'updatesuccess', time() + (10), "/");
            header("Location: ../manage-user.php");
        }
    } else {
        echo "Failed! Unknown Error, please contact developer for help. [ERR-676]";
    }
} else {
    header("Location: ../manage-user.php");
}
?>

<!-- ==============================================

FFFFFFFFFFFFFFFFFFFFFFFFFF
 FFFFFFFFFFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFFFFFFFFF
  FFFFF                FFF
  FFFFF
  FFFFF         FFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFF         FFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
 FFFFFFF
FFFFFFFFF

==============================================  -->