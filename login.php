<?php 
require_once 'core/init.php';

if (isset($_SESSION['wig_user'])) {
	if ($_SESSION['wig_user']=='admin') {
		header("Location: admin/");
	}else{
		header("Location: operator/");
	}
}

$validStatus = $existStatus = '';

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (isExist($username)) {
		if (!empty(trim($username)) && !empty(trim($password))) {
			if (isValid($username, $password)) {
				$_SESSION['wig_user'] = $username;
				if (checkRole($username) == 0) {
					header("Location: admin/");
				}elseif (checkRole($username) == 1) {
					header("Location: operator/");
				}else{
					header("Location: logout.php");
				}
			}else{
				$validStatus = '<small class="text-danger"><strong>Password Incorrect</strong>&nbsp;&nbsp;<i class="fas fa-exclamation-triangle"></i> </small>';
			}
		}
	}else{
		$existStatus = '<small class="text-danger"><strong>User Not Found</strong>&nbsp;&nbsp;<i class="fas fa-exclamation-triangle"></i> </small>';
	}
}

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Style CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/img/logo.png">

    <title>Login - Wash Inn Garage</title>
  </head>
  <body>
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-6">Control Panel Login</h3>
                            <p class="text-muted mb-4">Administrator or Operator Login Only.</p>
                            <form action="" method="post">
                                <div class="form-group mb-3">
                                    <input id="inputUsername" type="text" placeholder="Username" required="" autofocus="" class="form-control border-0 shadow-sm px-4" autocomplete="off" name="username">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputPassword" type="password" placeholder="Password" required="" class="form-control  border-0 shadow-sm px-4 text-primary" autocomplete="off" name="password">
                                </div>
                                <div class="mb-3">
                                	<?= $validStatus . $existStatus ?>
                                </div>
                                <input type="submit" class="btn btn-block mb-2 mx-auto shadow-sm text-white" value="&nbsp;&nbsp;Log In&nbsp;&nbsp;" style="background-color: #4e73df" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>


<style type="text/css">
	
/*
*
* ==========================================
* CUSTOM LOGIN CLASSES
* ==========================================
*
*/
.login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('assets/img/admin.png');
  /*background-image: url('https://bootstrapious.com/i/snippets/sn-page-split/bg.jpg');*/
  background-size: cover;
  background-position: center center;
}
</style>