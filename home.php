<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();


// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'test';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
	echo('Failed to connect to MySQL: ' . mysqli_connect_error());
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
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content" >
	
			<!-- Table with panel -->
			<div class="card card-cascade narrower">
				<!--Card image-->
				<div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

					<div>
					  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
						<i class="fas fa-th-large mt-0"></i>
					  </button>
					  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
						<i class="fas fa-columns mt-0"></i>
					  </button>
					</div>

					<a href="" class="white-text mx-3">List of Donator</a>

					<div>
					  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
						<i class="fas fa-pencil-alt mt-0"></i>
					  </button>
					  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
						<i class="far fa-trash-alt mt-0"></i>
					  </button>
					  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
						<i class="fas fa-info-circle mt-0"></i>
					  </button>
					</div>

				</div>
			  <!--/Card image-->
			 

				<div class="px-4">

					<div class="table-wrapper">
						<!--Table-->
						<table id="dtVerticalScrollExample" class="table table-hover table-bordered table-sm mb-0">

							<!--Table head-->
							<thead>
								<tr>	
									<th class="th-md">
									  <a>ID
									  </a>
									</th>
									
									<th class="th-md">
									  <a>First
									  </a>
									</th>
									<th class="th-md">
									  <a href="">Last
									  </a>
									</th>
									<th class="th-md">
									  <a href="">Contact
									  </a>
									</th>
									<th class="th-md">
									  <a href="">Total Donated
									  </a>
									</th>
									<th class="th-sm">
									  <a href="">Info 
									  </a>
									</th>
									<th class="th-sm">
									  <a href=""> History
									  </a>
									</th
								</tr>
							</thead>
							<!--Table head-->

							<!--Table body-->
							<tbody>

								<?php	
									$sql = "SELECT * FROM donator_info";
									$result = $con->query($sql);	
									
									if ($result->num_rows > 0) 
									{
										while ($row = $result->fetch_assoc())
										{
											echo "<tr>"
											."<td input type='text' name='fname'>". $row['DonatorID']. "</td>"
											."<td>". $row['FirstName']. "</td>"
											."<td>". $row['LastName']. "</td>"
											."<td>". $row['PhoneNumber']. "</td>"
											."<td>". $row['DonatorID']. "</td>"
											.'<td><button  onclick="Infofunction()" type="SUBMIT" name="submit" class="btn btn-outline-success btn-sm m-0 waves-effect"style="width:100%;">Info</button></td>'
											.'<td><button  onclick="Historyfunction()" type="SUBMIT" name="submit" class="btn btn-outline-primary btn-sm m-0 waves-effect"style="width:100%;">History</button></td>'
											."</tr>";
										}	
									}
								?>								
							</tbody>
							<!--Table body-->
						</table>
					  <!--Table-->
					</div>

				</div>

			</div>
			<!-- Table with panel -->
		</div>
		<?php	
			$sql = "SELECT * FROM donator_info WHERE DonatorID = 1";
			$result = $con->query($sql);
			
			while ($row = $result->fetch_assoc())
			{
		?>
			
			
		<!-- Donator info -->
		<div id= "donatorInfo" class= "content" style = "display:none;">
			<div class = "container">
			  <div class="form-row">
				<div class="form-group col-md-6">
				  <label for="inputEmail4">First Name</label>
				  <input type="text" class="form-control" id="inputFirstName" value="<?php echo $row['FirstName'];?>">
				</div>
				<div class="form-group col-md-6">
				  <label for="inputPassword4">Last Name</label>
				  <input type="text" class="form-control" id="inputlastName" value="<?php echo $row['LastName'];?>">
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputAddress">Address</label>
				<input type="text" class="form-control" id="inputAddress" value="<?php echo $row['Address1'];?>">
			  </div>
			  <div class="form-group">
				<label for="inputAddress2">Address 2</label>
				<input type="text" class="form-control" id="inputAddress2" value="<?php echo $row['Address2'];?>">
			  </div>
			  <div class="form-row">
				<div class="form-group col-md-6">
				  <label for="inputCity">City</label>
				  <input type="text" class="form-control" id="inputCity" value="<?php echo $row['City'];?>">
				</div>
				<div class="form-group col-md-4">
				  <label for="inputState">State</label>
				  <select id="inputState" class="form-control">
					<option selected><?php echo $row['State'];?></option>
					<option>MD</option>
					<option>PA</option>
					<option>VA</option>
					<option>CA</option>
				  </select>
				</div>
				<div class="form-group col-md-2">
				  <label for="inputZip">Zip</label>
				  <input type="text" class="form-control" id="inputZip" value="<?php echo $row['Zip'];?>">
				</div>
			  </div>
				<button type="submit" class="btn btn-primary">update</button>
				<button type="submit" class="btn btn-danger">Delete</button>
			</div>
		</div>
		<!-- End Donator info -->
		
		<?php 
			}
		?>

		<div id = "tranHistory"class= "content" style = "display:none;">		
			<!-- Table with panel -->
			<div class="card card-cascade narrower">
			
				<div class="view view-cascade gradient-card-header dusty-grass-gradient narrower  mx-4 mb-3 d-flex justify-content-between align-items-center">

					<div>
					  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
						<i class="fas fa-plus-square mt-0"></i>
					  </button>
					  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
						<i class="fas fa-columns mt-0"></i>
					  </button>
					</div>

					<a href="" class="white-text mx-3">Transaction History</a>
				</div>

				<div class="px-4">

					<div class="table-wrapper">
						<!--Table-->
						<table id="dtVerticalScrollExampleTransaction"class="table table-hover table-bordered table-sm mb-0">

							<!--Table head-->
							<thead>
								<tr>
									<th class="th-md">
									  <a> Name</a>
									</th>
									<th class="th-md">
									  <a href="">Transaction Date</a>
									</th>
									<th class="th-md">
									  <a href="">Donation Type</a>
									</th>
									<th class="th-md">
									  <a href="">Amount Donated</a>
									</th>
									<th class="th-md">
									  <a href="">Edit Transaction</a>
									</th>
									<th class="th-md">
									  <a href="">Delete History</a>
									</th>
								</tr>
							</thead>
							<!--Table head-->
							
							<!--Table body-->
							<tbody>
							  <tr>
								<td>Abhishek</td>
								<td>Yonghang</td>
								<td>4109674095</td>
								<td>$ 50,000.00</td>
								<td><button name ="donator"  type="button" class="btn btn-outline-warning btn-sm m-0 waves-effect"style="width:100%;">Edit</button></td>
								<td><button name="donatorHistory" type="button" class="btn btn-outline-danger btn-sm m-0 waves-effect"style="width:100%;">Delete</button></td>
							  </tr>
								
							</tbody>
							<!--Table body-->
						</table>
					  <!--Table-->
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
			$(document).ready(function () {
				$('#dtVerticalScrollExample').DataTable({
				"scrollY": "200px",
				"scrollCollapse": true,
				});
			
				$('.dataTables_length').addClass('bs-select');
				
			});
			
			$('#dtVerticalScrollExample').find('tr').click( function()
			{
				var rowIndex = $(this).index()+1;
				var donatorID = document.getElementById("dtVerticalScrollExample").rows[rowIndex].cells[3].textContent;
				alert(donatorID);
			
			});
			
			function Infofunction() 
			{
				document.getElementById("donatorInfo").style.display = "block";
				document.getElementById("tranHistory").style.display = "none";
								
			}
			
			function Historyfunction() 
			{
				document.getElementById("donatorInfo").style.display = "none";
				document.getElementById("tranHistory").style.display = "block";

			}
			
		</script>
	</body>
</html>