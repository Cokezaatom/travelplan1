<?php
	session_start();
?>

<?php 


include 'dbn.php';
$UserID = $_POST['UserID'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$loginstatus = $_POST['loginstatus'];
$statususer = $_POST['statususer'];


$sql = "SELECT * FROM register WHERE email='$email' AND password='$password'";
$result = $conn -> query($sql);

if(!$row = $result->fetch_assoc()){
	echo "Your Email or Password is incorrect!!<br>";
	echo '<A HREF = "login.php">try login again</A>';
}else{
	
	if($row["LoginStatus"] == "1")
	{
		echo "Exists login!";
		exit();
	}
	
	else{
		
		if($row["statususer"] == User){
			echo "Hi Welcome Back User<br/>";
			$_SESSION[ses_userid] = session_id(); //สร้าง session สำหรับเก็บค่า ID
			$_SESSION[ses_email] = $email; //สร้าง session สำหรับเก็บค่า email
			$_SESSION[ses_name] = $name;
			$_SESSION[name] = $row["name"];
			$_SESSION[userid] = $row["UserID"];
			$_SESSION[loginstatus] = $row["loginstatus"];
			$_SESSION[ses_status] = "User";
			$sql = "UPDATE register SET LoginStatus = '0' , LastUpdate = NOW() WHERE UserID = '".$row['UserID']."' ";
			$query = mysqli_query($conn,$sql);
			echo "<meta http-equiv='refresh' content='1;URL=main.php'>";
			//echo $_SESSION["userid"];
			//echo $_SESSION["ses_status"];
			//echo $_SESSION["ses_email"];
			//echo $_SESSION["name"];
			
	}
	
	
		if($row["statususer"] == Admin){
			echo "Hi Welcome Back Admin<br/>";
			$_SESSION[ses_userid] = session_id(); //สร้าง session สำหรับเก็บค่า ID
			$_SESSION[ses_email] = $email; //สร้าง session สำหรับเก็บค่า email
			$_SESSION[ses_name] = $name;
			$_SESSION[name] = $row["name"];
			$_SESSION[userid] = $row["UserID"];
			$_SESSION[loginstatus] = $row["loginstatus"];
			$_SESSION[ses_status]  = "Admin";
			$sql = "UPDATE register SET LoginStatus = '0' , LastUpdate = NOW() WHERE UserID = '".$row['UserID']."' ";
			$query = mysqli_query($conn,$sql);
			echo "<meta http-equiv='refresh' content='1;URL=main_admin.php'>";
			//echo $_SESSION["userid"];
			//echo $_SESSION["ses_status"];
			//echo $_SESSION["ses_email"];
			//echo $_SESSION["name"];
			
	}
	
}
}
	
?>