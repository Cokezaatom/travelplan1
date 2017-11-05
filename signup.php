<?php 
include 'dbn.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$statususer = $_POST['statususer'];

/*echo $username."<br>";
echo $email."<br>";
echo $password."<br>";*/

$sql = "INSERT INTO register (name,email,password,statususer)
VALUES('$name','$email','$password','$statususer')";
$result = $conn -> query($sql);

header("Location: createsuccess.php");

?>