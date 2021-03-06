<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

//connects to database
require "config/config.php";    

//simply displays a message when called.
function alert($msg) 
{
	echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>

<?php
    // update data
    if(isset($_POST['btnupdate'])){
        $id = $_GET['upd'];
		alert ($id);
		$FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Contact = $_POST['Contact'];
		$Address1 = $_POST['Address1'];
		$Address2 = $_POST['Address2'];
		$City = $_POST['City'];
        $State = $_POST['State'];
        $Zip = $_POST['Zip'];
		
		alert($State);
		
        $query = "UPDATE donator_info SET 
		FirstName = '$FirstName',LastName = '$LastName',
		PhoneNumber = '$Contact',Address1 = '$Address1', Address2= '$Address2', City = '$City', State = '$State', Zip = '$Zip'
		WHERE DonatorID=$id";
        $fire = mysqli_query($con,$query) or die("Can not update the data. ".mysqli_error($con));

        if($fire) header("Location:home.php");

    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Home Page</title>
		<link href="home.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<!-- MDBootstrap link  -->
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="css/mdb.min.css" rel="stylesheet">
		<!-- Your custom styles (optional) -->
		<link href="css/style.css" rel="stylesheet">
		<!-- MDBootstrap Datatables  -->
		<link href="css/addons/datatables.min.css" rel="stylesheet">
		
		
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1 style="padding-left:10px;"><i class="fas fa-user-circle"></i> Welcome, <?=$_SESSION['name']?>!</h1>
				<a href="home.php"><i class="fas fa-user-plus"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		
		<?php
			// get update variables
			if(isset($_GET['upd'])){
				$id = $_GET['upd'];
				$query = "SELECT * FROM donator_info WHERE DonatorID=$id";
				$fire = mysqli_query($con,$query) or die("Can not fetch the data.".mysqli_error($con));
				$user = mysqli_fetch_assoc($fire);  
			}
		?>
		
		<div class= "content">
			<!--Donator info Form-->
			<div class="Container">
				<h3>Update Donator info</h3>
				<hr>
				
                <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
					<div class = "form-row">
						<div class="form-group col-md-6">
							<label  for="FirstName">First Name</label>
							<input  name="FirstName" id="FirstName" type="text" class="form-control" value = "<?php echo $user["FirstName"]?>">
						</div>
						<div class="form-group col-md-6">
							<label for="LastName">Last Name</label>
							<input name="LastName" id="LastName" type="text" class="form-control" value = "<?php echo $user["LastName"]?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="Contact">Contact</label>
						<input name="Contact" id="Contact" type="text" class="form-control" value = "<?php echo $user["PhoneNumber"]?>">
					</div>
					
					<div class="form-group">
						<label for="Address1">Address 1 </label>
						<input name="Address1" id="Address1" type="text" class="form-control" value = "<?php echo $user["Address1"]?>" >
					</div>
					<div class="form-group">
						<label for="Address2">Address2</label>
						<input name="Address2" id="Address2" type="text" class="form-control" value = "<?php echo $user["Address2"]?>" >
					</div>
					
					<div class = "form-row">
						<div class="form-group col-md-6">
							<label for="City">City</label>
							<input name="City" id="City" type="text" class="form-control" value = "<?php echo $user["City"]?>" >
						</div>
						
						<div class="form-group col-md-4">
						  <label for="State">State</label>
						  <select id="State" name ="State" class="form-control">
							<option selected><?php echo $user["State"]?></option>
							<option>MD</option>
							<option>PA</option>
							<option>VA</option>
							<option>GA</option>
						  </select>
						</div>
						
						<div class="form-group col-md-2">
							<label for="Zip">Zip</label>
							<input name="Zip" id="Zip" type="text" class="form-control" value = "<?php echo $user["Zip"]?>">
						</div>
					</div>
					
					<div class="form-group">                            
					   <button name="btnupdate" id="btnupdate" type="submit" value= "<?php echo $user["Zip"]?>"class="btn btn-primary btn-block">Update</button>
					</div>
				</form>
			</div>
		</div>

		
		<!-- SCRIPTS -->
		<!-- JQuery -->
		<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="js/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<!-- MDB core JavaScript -->
		<script type="text/javascript" src="js/mdb.min.js"></script>
		<!-- MDBootstrap Datatables  -->
		<script type="text/javascript" src="js/addons/datatables.min.js"></script>
		<script>
			
		</script>
	</body>
</html>