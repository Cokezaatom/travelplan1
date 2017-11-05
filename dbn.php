<?php


return $conn = mysqli_connect("localhost","root","123456789","travelplan");
if(!$conn){
	die("Connecttion failed:".mysqli_connect_error());
}

$intRejectTime = 1; // Minute
	$sql = "UPDATE register SET LoginStatus = '0', LastUpdate = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
	$query = mysqli_query($conn,$sql);

	
?>