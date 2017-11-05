<?php
session_start();

require_once("dbn.php");

$sql = "UPDATE register SET LoginStatus = '0' , LastUpdate = NOW() WHERE UserID = '".$_SESSION['userid']."' ";
$query = mysqli_query($conn,$sql);

unset ( $_SESSION[‘ses_userid’] );
unset ( $_SESSION[‘ses_email’] );
unset ( $_SESSION[‘ses_status’] );
unset ( $_SESSION[‘ses_name’] );
session_destroy();

header("Location: index.php");
?>