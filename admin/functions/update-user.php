<?php 	
    require_once "../../core/init.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../assets/vendor/phpmailer/phpmailer/src/Exception.php';
    require '../../assets/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../../assets/vendor/phpmailer/phpmailer/src/SMTP.php';

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if (isset($_POST['btnEditUser'])) {

        $oldUsername = $_POST['oldone'];
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email    = $_POST['email'];
        $role     = $_POST['role'];
        $phone    = $_POST['phone'];
        $userid   = $_POST['userid'];

        if ($username != $oldUsername) {
            if (isExist($username)) {
                setcookie('returnstatus', 'usernameconflict', time() + (10), "/");
                header("Location: ../manage-user.php");
            }
        }

        if (isset($_POST['resetpass']) && $_POST['resetpass'] == 'reset') {
            $resetpass = generateRandomString(6);
            $additionalbody = "\nPassword : ".$resetpass."\n\nPlease change your password immediately after first login.";
            // var_dump($resetpass);
        }else{
            $resetpass = 'no';
            $additionalbody = "";
        } 
       
        if (updateUser($userid, $fullname, $email, $username, $phone, $role, $resetpass)) {
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->Username = 'dev.washinngarage@gmail.com';
            $mail->Password = 'washinngarage';
            $mail->setFrom('dev.washinngarage@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = 'Wash Inn Garage Account Update ';
            $mail->Body = "Hi ".$fullname.", Your account information has been updated.\nHere is your new account details.\n\nFull Name : ".$fullname."\nUsername : ".$username."\nEmail : ".$email."\nPhone Number : ".$phone."\nRole : ".$role.$additionalbody."\n\n\nCopyright © 2022, Wash Inn Garage. All Rights Reserved.";

            if (!$mail->send()) {
                // echo "ERROR: " . $mail->ErrorInfo;  //Jangan dihapuss baris ini
                setcookie('returnstatus', 'offlinewarning', time() + (10), "/");
                header("Location: ../manage-user.php");
            } else {
                setcookie('returnstatus', 'updatesuccess', time() + (10), "/");
                header("Location: ../manage-user.php");
            }
        }else{
            echo "Failed! Unknown Error, please contact developer for help. [ERR-676]";
        }
    }
?>