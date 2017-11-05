<?php
	session_start();
	if(!session_is_registered(email)){
		header("main.php");
	}
?>
<html>
<body>
Login Successful!!
</body>
</html>