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
        $id = $_GET['his'];
		$his = $_GET['tranupd'];
		$iteamID = $_POST['iteamID'];
        $iteamType = $_POST['iteamType'];
        $iteamAmount = $_POST['iteamAmount'];
		$dateDonated = $_POST['dateDonated'];
		$reciptNum = $_POST['reciptnumber'];
				
        $query = "UPDATE donated_iteams SET Iteam_type = '$iteamType', Amount_of_iteam = '$iteamAmount', date_Donated= '$dateDonated', ReciptNumber='$reciptNum'  WHERE iteamID = '$iteamID'";
        $fire = mysqli_query($con,$query) or die("Can not update the data. ".mysqli_error($con));

        if($fire) header("Location:transaction.php?his=".$id);

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
			if(isset($_GET['tranupd'])){
				$id = $_GET['tranupd'];
				$query = "SELECT * FROM donated_iteams WHERE iteamID=$id";
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
				
					<div class="form-group">
						<label  for="iteamType">Iteam ID</label>
						<input  name="iteamID" id="iteamID" type="text" class="form-control" value = "<?php echo $user["iteamID"]?>" readonly>
					</div>
					
					<div class = "form-row">
						<div class="form-group col-md-6">
							<label  for="iteamType">Iteam Type</label>
							<input  name="iteamType" id="iteamType" type="text" class="form-control" value = "<?php echo $user["Iteam_type"]?>">
						</div>
						
						<div class="form-group col-md-6">
							<label for="iteamAmount">Iteam Amount</label>
							<input name="iteamAmount" id="iteamAmount" type="text" class="form-control" value = "<?php echo $user["Amount_of_iteam"]?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="dateDonated">Date Doated</label>
						<input name="dateDonated" id="dateDonated" type="text" class="form-control" value = "<?php echo $user["date_Donated"]?>">
					</div>
					
					<div class="form-group">
						<label  for="iteamType">Recipt Number</label>
						<input  name="reciptnumber" id="reciptnumber" type="text" class="form-control" value = "<?php echo $user["ReciptNumber"]?>">	
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