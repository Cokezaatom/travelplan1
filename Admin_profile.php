<?php
session_start();
$ses_userid = $_SESSION[ses_userid];
$ses_email = $_SESSION[ses_email];
$ses_name = $_SESSION[ses_name];
$ses_status = $_SESSION[ses_status];
if($ses_userid <> session_id() or  $ses_email ==””){
echo “คุณยังไม่ได้ทำการเข้าระบบ”;}
	//ตรวจสอบสถานะว่าใช่ admin รึเปล่า ถ้าไม่ใช่ให้หยุดอยู่แค่นี้
	

//ตรวจสอบสถานะว่าใช่ admin รึเปล่า ถ้าไม่ใช่ให้หยุดอยู่แค่นี้
if($_SESSION[ses_status] != "Admin") {
echo "This page for Admin only!";
echo "<a href=index.php>Back</a>";
exit();
}

?>

<?php
	include 'dbn.php';	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist\css\cssss.css" type="text/css"> 
  <script>
	var name = '<?php echo $_SESSION["name"];?>';
	console.log(name);
	</script>
  </head>

<body>
  <nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" href="main.php">หน้าแรก</a>
          </li>
        </ul>
		<div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <?php
				$sql = "SELECT name FROM register WHERE UserID = '".$_SESSION['userid']."'";
				$result = $conn -> query($sql);
					while($row = $result-> fetch_assoc()){
				echo " 
				".$row['name']." 
			";
			}
			
		?> 
		</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  
  <div class="py-5">
    <div class="container">
      <div class="row">
	 
 <center>
	<div class="col-md-4"></div>
		<img class="circle" src="img/admin.jpg" height="190px" width="190px"><br><br>
         <h4 class="w-100 text-left"><?php
					$sql = "SELECT name FROM register WHERE UserID = '".$_SESSION['userid']."'";
					$result = $conn -> query($sql);
					while($row = $result-> fetch_assoc()){
					echo " 
					".$row['name']." 
				";
				}
			
			?> </h4>
       </center>
  </div>
   </div>
    </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="planme.php" class="active nav-link">&nbsp;จัดการบัญชีผู้ใช้งาน</a>
            </li>
            <li class="nav-item">
              <a class="active nav-link" href="boxme.php">กล่องข้อความ</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
 
  
 <br><br><br><br><br>
  
  <div class="bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center text-white">© Copyright 2017 Travel Plan - All rights reserved. </p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>