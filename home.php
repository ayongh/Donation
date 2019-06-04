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
		
		<div class="container">
		  <br>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
			  <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu1">Add Donator</a>
			</li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		  
				<!--#########################################################################################################-->
				<!--List of Donator-->
				<div id="home" class="container tab-pane active"><br>
					<div class="content" >
						<!-- Donator info Table -->
						<div class="container text-center">
							<h3>Donator Data</h3>
							<hr>
							<div class="table-responsive">
								<table class="table table-striped ">
									<thead>
										<tr>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Phone Number</th>
											<th>City</th>
											<th>State</th>
										</tr>
									</thead>
									<tbody>                        
										<?php
											$query = "SELECT * FROM donator_info";
											$fire = mysqli_query($con,$query) or die("Can not fetch data from database ".mysqli_error($con));
											//if($fire) echo "We got the data from database.";

											if(mysqli_num_rows($fire)>0)
											{                           
												while($user = mysqli_fetch_assoc($fire))
												{ ?>                                          
											<tr>
												<td><?php echo $user['FirstName'] ?></td>
												<td><?php echo $user['LastName'] ?></td>
												<td><?php echo $user['PhoneNumber'] ?></td>        
												<td><?php echo $user['City'] ?></td>  
												<td><?php echo $user['State'] ?></td>                                    
												
												<td>
													<a class="btn btn-sm btn-danger" href="config/actions.php?del=<?php echo $user['DonatorID'] ?>">Delete</a>
												</td> 
												
												<td>
													<a class="btn btn-sm btn-warning" href="update.php?upd=<?php echo $user['DonatorID'] ?>">Update</a>
												</td> 
												
												<td>
													<a class="btn btn-sm btn-primary" href="transaction.php?his=<?php echo $user['DonatorID'] ?>">History</a>
												</td>  										
											</tr>

										<?php
												}      
											}
											else
											{ 
										?>
												<tr>
													<h2>There is No Data to Show !!</h2>
												</tr>      
										<?php 
											} 
										?>
									</tbody>
								</table>
							</div>
						</div>			
						<!-- End Donaator info Table -->			
					</div>
				</div>
			
			<!--#########################################################################################################-->
			<!--Add Donator-->
			<div id="menu1" class="container tab-pane fade"><br>
			
				<div class= "content">
					<!--Donator info Form-->
					<div class="Container">
						<h3>Insert Donator</h3>
						<hr>
						<?php
						if(isset($_GET['msg'])) echo $_GET['msg'];
						?>
						<form name="update" id="update" action="config/actions.php" method="POST">
							<div class = "form-row">
								<div class="form-group col-md-6">
									<label  for="FirstName">First Name</label>
									<input  name="FirstName" id="FirstName" type="text" class="form-control" placeholder="First Name">
								</div>
								<div class="form-group col-md-6">
									<label for="LastName">Last Name</label>
									<input name="LastName" id="LastName" type="text" class="form-control" placeholder="Last Name">
								</div>
							</div>
							
							<div class="form-group">
								<label for="Contact">Contact</label>
								<input name="Contact" id="Contact" type="text" class="form-control" placeholder="Phone Number" >
							</div>
							
							<div class="form-group">
								<label for="Address1">Address 1 </label>
								<input name="Address1" id="Address1" type="text" class="form-control" placeholder="1233 Berk Ave" >
							</div>
							<div class="form-group">
								<label for="Address2">Address2</label>
								<input name="Address2" id="Address2" type="text" class="form-control" placeholder="Apt J" >
							</div>
							
							<div class = "form-row">
								<div class="form-group col-md-6">
									<label for="City">City</label>
									<input name="City" id="City" type="text" class="form-control" placeholder="City" >
								</div>
								
								<div class="form-group col-md-4">
								  <label for="State">State</label>
								  <select id="State" name ="State" class="form-control">
									<option selected>State</option>
									<option>MD</option>
									<option>PA</option>
									<option>VA</option>
									<option>GA</option>
								  </select>
								</div>
								
								<div class="form-group col-md-2">
									<label for="Zip">Zip</label>
									<input name="Zip" id="Zip" type="text" class="form-control" placeholder="Zip" >
								</div>
							</div>
							
							<div class="form-group">                            
							   <button name="Insert" id="Insert" class="btn btn-primary btn-block">Insert</button>
							</div>
						</form>
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