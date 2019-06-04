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
	// get update variables
	if(isset($_GET['tranupd'])){
		$his = $_GET['his'];
		$tranupd = $_GET['tranupd'];
		$query = "SELECT * FROM donated_iteams WHERE iteamID=$tranupd AND donatorID = $his";
		$fire = mysqli_query($con,$query) or die("Can not fetch the data.".mysqli_error($con));
		$user = mysqli_fetch_assoc($fire);  
	}
?>
		
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Home Page</title>
		<link href="recipt.css" rel="stylesheet" type="text/css">
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
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body p-0">
							<div class="row p-5">
								<div class="col-md-6">
									<img src="oat.jpg" style="height: 100px; width: 100px;">
								</div>

								<div class="col-md-6 text-right">
									<p class="font-weight-bold mb-1">Recipt # <?php echo $user['ReciptNumber']?> </p>
									<p class="text-muted">Date Donated : <?php echo $user['date_Donated']?> </p>
								</div>
							</div>

							<hr class="my-5">

							<?php
								// get update variables
								if(isset($_GET['tranupd'])){
									$his = $_GET['his'];
									$tranupd = $_GET['tranupd'];
									$query = "SELECT * FROM donator_info WHERE DonatorID = $his";
									$fire = mysqli_query($con,$query) or die("Can not fetch the data.".mysqli_error($con));
									$user = mysqli_fetch_assoc($fire);  
								}
							?>
							
							<div class="row pb-5 p-5">
								<div class="col-md-6">
									<p class="font-weight-bold mb-4">Donator Information</p>
									<p><?php echo $user['FirstName']. " ". $user['LastName']?></p>
									<p class="mb-1"><?php echo $user['Address1']?></p>
									<p class="mb-1"><?php echo $user['City'].", ".$user['State']?></p>
									<p class="mb-1"><?php echo $user['Zip']?></p>
								</div>

								<div class="col-md-6 text-right">
									<p class="font-weight-bold mb-4">Payment Details</p>
									<p class="mb-1"><span class="text-muted">NAME: </span> <?php echo $user['FirstName']. " ". $user['LastName']?></p>
									<p class="mb-1"><span class="text-muted">ADDRESS: </span> <?php echo $user['Address1']?></p>
									<p class="mb-1"> <?php echo $user['City'].", ".$user['State']?></p>
									<p class="mb-1"> <?php echo $user['Zip']?></p>
								</div>
							</div>

							<div class="row p-5">
								<div class="col-md-12">
									<table class="table">
										<thead>
											<tr>
												<th class="border-0 text-uppercase small font-weight-bold">ID</th>
												<th class="border-0 text-uppercase small font-weight-bold">Item</th>
												<th class="border-0 text-uppercase small font-weight-bold">Iteam Amount</th>
												<th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
												
											</tr>
										</thead>
										<tbody>
										
										<?php
											
												$id = $_GET['his'];
												$query = "SELECT * FROM donated_iteams WHERE donatorID = $id";
												$fire = mysqli_query($con,$query) or die("Can not fetch data from database ".mysqli_error($con));
												//if($fire) echo "We got the data from database.";

												if(mysqli_num_rows($fire)>0)
												{                           
													while($user = mysqli_fetch_assoc($fire)){ ?>      
											<tr>
												<td><?php echo $user['iteamID'] ?></td>
												<td><?php echo $user['Iteam_type'] ?></td>
												<td><?php echo $user['Amount_of_iteam'] ?></td>
												<td><?php echo $user['accountID'] ?></td>
											</tr>
											
											
											 <?php
													}      
												}
												else{ ?>
													<tr>
													  <td colspan="5" class="text-center">
														  <p class="text-muted">There is no transaction to display</p>
													  </td>
												  </tr>      
											  <?php } ?>
											  
										</tbody>
									</table>
								</div>
							</div>

							<div class="d-flex flex-row-reverse bg-dark text-white p-4">
							<!--
								<div class="py-3 px-5 text-right">
									<div class="mb-2">Grand Total</div>
									<div class="h2 font-weight-light">$234,234</div>
								</div>

								<div class="py-3 px-5 text-right">
									<div class="mb-2">Discount</div>
									<div class="h2 font-weight-light">10%</div>
								</div>

								<div class="py-3 px-5 text-right">
									<div class="mb-2">Sub - Total amount</div>
									<div class="h2 font-weight-light">$32,432</div>
								</div>
								-->
							</div>
						</div>
					</div>
				</div>
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