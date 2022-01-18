<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Wash Inn Garage</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="icon" type="image/png" href="assets/img/logo.png">
	<link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
</head>
<body>

	<div class="container">
		<div class="col-md-6 offset-md-3 style="margin-top: 10%;">
			<div class="card shadow" style="border-top-left-radius: 10px; border-top-right-radius: 10px">
				<div class="card-header text-white" style="background-color: #4e73df; border-top-left-radius: 10px; border-top-right-radius: 10px;">
					<h4 class="display-6">Control Panel Login</h4>
				</div>
				<div class="card-body">
					<form>
					  <div class="mb-3">
					    <label for="inputUsername" class="form-label">Username</label>
					    <input type="text" class="form-control shadow-sm" id="inputUsername" autofocus autocomplete="off">
					  </div>
					  <div class="mb-3">
					    <label for="inputPassword" class="form-label">Password</label>
					    <input type="password" class="form-control shadow-sm" id="inputPassword">
					  </div>
					  <div class="mb-3">
					  	<small class="text-danger"><strong>Password Incorrect</strong>&nbsp;&nbsp;<i class="fas fa-exclamation-triangle"></i> </small>
                    	<br>
                    	<small class="text-danger"><strong>User Not Found</strong>&nbsp;&nbsp;<i class="fas fa-exclamation-triangle"></i> </small>
					  </div>
					  <input type="submit" class="btn btn-primary shadow" value="Log In">
					</form>
				</div>
				<div class="card-footer text-center text-white" style="background-color: #4e73df;">
					<small class="">Copyright &copy; 2022 Wash Inn Garage. All Rights Reserved</small>
				</div>
			</div>
		</div>
	</div>



</body>
</html>