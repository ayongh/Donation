<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	</head>
	
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="authentication.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<!--<input type="checkbox" onclick="myFunction()">Show Password-->
				<input type="submit" value="Login">
			</form>
		</div>
		
		<?php
			$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			if(strpos($fullurl,"username=incorrect") == true)
			{
				echo "	<div class='alert alert-danger alert-dismissible' style='margin-left: 30%; margin-right: 30%; text-align: center;'> 
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Incorrect Username! </strong>please enter correct <strong>username</strong>.
						</div>";
			}
			else if (strpos($fullurl,"password=incorrect") == true)
			{
				echo "	<div class='alert alert-danger alert-dismissible' style='margin-left: 30%; margin-right: 30%; text-align: center;'> 
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Incorrect Password! </strong>please enter correct <strong>password</strong>.
						</div>";
			}
		?>
		<script>
			function myFunction() 
			{
			  var x = document.getElementById("password");
			  if (x.type === "password") 
			  {
				x.type = "text";
			  } 
			  else 
			  {
				x.type = "password";
			  }
			}
		</script>

	</body>
</html>