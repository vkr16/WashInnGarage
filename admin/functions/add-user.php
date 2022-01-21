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


	if (isset($_POST['btnAddUser'])) {
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$phone    = $_POST['phone'];
		$role     = $_POST['role'];

		// $message = "Hi".$username.", Here is your new login credentials. \n\n
		// 			Username --> [ ".$username." ] \n
		// 			Password --> [ ".$password." ] \n\n\n
		// 			Please change your password immediately after first login. \n\n\n
		// 			Copyright © 2022, Wash Inn Garage. All Rights Reserved."

		if (isExist($username)) {
			setcookie('returnstatus', 'userexist', time() + (10), "/");
			header("Location: ../manage-user.php");
		}else{
			$password = generateRandomString(6);
			if(addUser($fullname, $username, $email, $phone, $role, $password)){
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 587;
				$mail->Username = 'dev.washinngarage@gmail.com';
				$mail->Password = 'washinngarage';
				$mail->setFrom('dev.washinngarage@gmail.com');
				$mail->addAddress($email);
				$mail->Subject = 'Wash Inn Garage New Account Credentials';
			    $mail->Body = "Hi ".$fullname.", Here is your new login credentials. \n\n
					Username --> [ ".$username." ] \n
					Password --> [ ".$password." ] \n\n\n
					Please change your password immediately after first login. \n\n\n
					Copyright © 2022, Wash Inn Garage. All Rights Reserved.";
				// $mail->isHTML(true);
				//send the message, check for errors
				if (!$mail->send()) {
				    echo "ERROR: " . $mail->ErrorInfo;
				} else {
					setcookie('returnstatus', 'success', time() + (10), "/");
				    header("Location: ../manage-user.php");
				}
			}
		}
	}



 ?>