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
				<div id="home" class="container tab-pane active"><br>

					<!--#########################################################################################################-->
					<!--List of Donator-->
					<div class="content" >
						<!-- Donator info Table -->
						<div class="container text-center">
								<h3>Donator Data</h3>
								<hr>
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Transaction ID</th>
												<th>Iteam Type</th>
												<th>Amount of Iteam</th>
												<th>Date Donated</th>
												<th>Donator ID</th>
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
													<td><?php echo $user['date_Donated'] ?></td>  
													<td><?php echo $user['donatorID'] ?></td>                                    
													
													<td>
														<a class="btn btn-sm btn-danger" href="config/actions.php?his=<?php echo $user['donatorID'] ?>&trandel=<?php echo $user['iteamID'] ?>">Delete</a>
													</td> 
												
													<td>
														<a class="btn btn-sm btn-warning" href="transcationUpdate.php?his=<?php echo $user['donatorID'] ?>&tranupd=<?php echo $user['iteamID'] ?>">Edit</a>
													</td> 

													<td>
														<a class="btn btn-sm btn-primary" href="recipt.php?his=<?php echo $user['donatorID'] ?>&tranupd=<?php echo $user['iteamID'] ?>">Recipt</a>
													</td> 													
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
						<!-- End Donaator info Table -->			
					</div>
				</div>
		
				<!--#########################################################################################################-->
				<!--Insert Donator-->
				<div id="menu1" class="container tab-pane fade"><br>
					<div class= "content">
						<!--Donator info Form-->
						<div class="Container">
							<h3>Insert Transaction</h3>
							<hr>
							<?php
							if(isset($_GET['msg'])) echo $_GET['msg'];
							?>
							<form name="update" id="update" action="config/actions.php" method="GET">
								<div class = "form-row">
									<div class="form-group col-md-6">
										<label  for="iteamType">Iteam Type</label>
										<input  name="iteamType" id="iteamType" type="text" class="form-control" placeholder="Iteam Type">
									</div>
									<div class="form-group col-md-6">
										<label for="iteamAmount">Iteam Amount</label>
										<input name="iteamAmount" id="iteamAmount" type="text" class="form-control" placeholder="Iteam Amount">
									</div>
								</div>
								<div class="form-group">
									<label for="Date">Date</label><br>
									<input type="date" id="start" name="trip-start" value="2018-07-22" min="2000-01-01" max="2020-01-01">					
								</div>
								
								<div class="form-group">
									<label  for="iteamType">Recipt Number</label>
									<input  name="reciptnumber" id="reciptnumber" type="text" class="form-control" placeholder="Recipt Number">	
								</div>
								
								<div class="form-group">           
								   <button name="donatorID" id="donatorID" Type= "Submit" class="btn btn-primary btn-block" value="<?php echo $_GET['his']?>">Insert</button>
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