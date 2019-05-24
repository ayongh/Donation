<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

//connects to database
require "config.php";    

//simply displays a message when called.
function alert($msg) 
{
	echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>

<?php   
	
	//When Insert New Donator
    if(isset($_POST['Insert']))
	{
        $msg ="";
        $FirstName = mysqli_real_escape_string($con,trim($_POST['FirstName']));
        $LastName = mysqli_real_escape_string($con,trim($_POST['LastName']));
        $Contact = mysqli_real_escape_string($con,trim($_POST['Contact']));
		$Address1 = mysqli_real_escape_string($con,trim($_POST['Address1']));
		$Address2 = mysqli_real_escape_string($con,trim($_POST['Address2']));
		$City = mysqli_real_escape_string($con,trim($_POST['City']));
        $State = mysqli_real_escape_string($con,trim($_POST['State']));
        $Zip = mysqli_real_escape_string($con,trim($_POST['Zip']));

		//Logic to Check the Fileds are empty or not
		echo $FirstName . $LastName. $Contact. $Address1. $Address2. $City. $State. $Zip;
		$query = "INSERT INTO donator_info(FirstName,LastName,PhoneNumber,Address1,Address2,City,State,Zip) 
		VALUES('$FirstName','$LastName','$Contact','$Address1','$Address2','$City','$State','$Zip')";
		$fire = mysqli_query($con,$query) or die("Can not insert data into database. ".mysqli_error($con));
		
		if($fire) 
		{                
			$msg = "Data inserted successfully";
			header("Location: ../home.php?msg=".$msg);
		}
    }
?>

<?php
	//Delete Entries
	if(isset($_GET['del']))
	{
		$id = $_GET['del'];
		$query = "DELETE FROM donator_info WHERE DonatorID = $id";
		$fire = mysqli_query($con,$query) or die("Can not delete the data from database.". mysqli_error($con));
		if($fire) {
			echo "Data deleted from database";
			header("Location:../home.php");
		};
	}
?>


<?php
	//Insert Transaction
    if(isset($_GET['donatorID']))
	{
		$iteamType = mysqli_real_escape_string($con,trim($_GET['iteamType']));
		$iteamAmount = $_GET['iteamAmount'];
		$DonatorID= $_GET['donatorID'];
		$transactionholder = mysqli_real_escape_string($con,trim($_SESSION['name']));
		
		alert($iteamAmount +1);
		$query = "INSERT INTO donated_iteams(Iteam_type,Amount_of_iteam,date_Donated,donatorID,accountID) 
		VALUES('$iteamType',$iteamAmount,CURRENT_TIME(),$DonatorID, '$transactionholder')";
		$fire = mysqli_query($con,$query) or die("Can not insert data into database. ".mysqli_error($con));
		
		 if($fire) 
		{                
			$msg = "Data inserted successfully";
			header("Location: ../transaction.php?his=".$DonatorID);
		}
	}
?>