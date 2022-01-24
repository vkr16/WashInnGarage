<?php 
	require_once '../../core/init.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../../assets/vendor/phpmailer/phpmailer/src/Exception.php';
	require '../../assets/vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require '../../assets/vendor/phpmailer/phpmailer/src/SMTP.php';

	function generateRandomString($length) {
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	if (isset($_POST['btnChangeEmail'])) {
		if (isset($_COOKIE['EmChVeCo']) && isset($_COOKIE['NeEmA'])) {
			$verif_string_decoded = base64_decode($_COOKIE['EmChVeCo']);
			$user_verif = $_POST['otpcode'];
			$id = $_POST['userid'];
			$email = $_COOKIE['NeEmA'];
			if ($user_verif != $verif_string_decoded) {
				setcookie('returnstatus', 'otpmismatch', time() + (10), "/");
			    header("Location: ../my-account.php");
			}else{
				if (updateEmail($id,$email)) {
					setcookie('returnstatus', 'emailupdatedsuccess', time() + (10), "/");
					setcookie('EmChVeCo', $verif_string_encoded, time() - (300), "/");
					setcookie('NeEmA', $newemail, time() - (300), "/");
			   		header("Location: ../my-account.php");

				}else{
					setcookie('returnstatus', 'emailupdatefail', time() + (10), "/");
			   		header("Location: ../my-account.php");
				}
			}
			
		}else{
			$newemail = $_POST['newemail'];
			$id 	  = $_POST['userid'];

			$verif_string = generateRandomString(7);
			$verif_string_encoded = base64_encode($verif_string);
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->Username = 'dev.washinngarage@gmail.com';
			$mail->Password = 'washinngarage';
			$mail->setFrom('dev.washinngarage@gmail.com');
			$mail->addAddress($newemail);
			$mail->Subject = 'Wash Inn Garage - Email Change Verification';
		    $mail->Body = "Hi ".$newemail.", Here is your verification code. \n\nOTP --> [  ".$verif_string."  ] \n\n\nThis code only valid for 5 minute after you request. \n\n\nCopyright © 2022, Wash Inn Garage. All Rights Reserved.";
			if($mail->send()){
				setcookie('EmChVeCo', $verif_string_encoded, time() + (300), "/");
				setcookie('NeEmA', $newemail, time() + (300), "/");
				setcookie('returnstatus', 'otpsent', time() + (10), "/");
			    header("Location: ../my-account.php");
			}else{
				setcookie('returnstatus', 'offlineFailed', time() + (10), "/");
			    header("Location: ../manage-user.php");
			}
		}
	}
?>