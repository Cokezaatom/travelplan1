<?php
	include 'dbn.php';	
?>

<?php
session_start();
$ses_userid = $_SESSION[ses_userid];
$ses_email = $_SESSION[ses_email];
$ses_name = $_SESSION[ses_name];
$ses_status = $_SESSION[ses_status];
if($ses_userid <> session_id() or  $ses_email ==””){
echo “คุณยังไม่ได้ทำการเข้าระบบ”;}    

//ตรวจสอบสถานะว่าใช่ user รึเปล่า ถ้าไม่ใช่ให้หยุดอยู่แค่นี้
if($_SESSION[ses_status] != "User") {
echo "This page for User only!";
echo "<a href=index.php>Back</a>";
exit();
}

$intRejectTime = 20; // Minute
$sql = "UPDATE register SET LoginStatus = '0', LastUpdate = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
$query = mysqli_query($conn,$sql);
	
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
            <a class="nav-link active" href="#">หน้าแรก</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">แผนการท่องเที่ยว</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">เกี่ยวกับเรา</a>
          </li>
        </ul>
        <input type="search" name="search" class="form-control w-25" placeholder="ค้นหา ">
		<div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <?php
				$sql = "SELECT name FROM register WHERE UserID = '".$_SESSION['userid']."'	";
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
  <br><br>  
  <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <a href="createplan1.php" class="btn btn-outline-primary text-center w-100 btn-block" data-toggle="">สร้างแผนการท่องเที่ยว</a>
        </div>
        <div class="col-md-4"></div>
      </div>
  
  <div class="p-2 m-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="">แผนการท่องเที่ยวยอดนิยม</h2>
        </div>
      </div>
    </div>
  </div>
  
    <div class="bg-light m-0 p-1">
    <div class="container">
      <div class="row">
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="C:\Users\ZenzujiK\Downloads\shutterstock_284505191(1).jpg" height="">
          <h5><b>อันดับ #1: เที่ยวเชียงใหม่ 3 วัน 2 คืน&nbsp;</b>
            <br><b>งบ 5,000 บาท</b></h5>
          <p class="mt-1">เที่ยวหน้าหนาว สัมผัสบรรยากาศหน้าๆ ฟินๆ ~</p>
        </div>
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="C:\Users\ZenzujiK\Downloads\1_108328222-1024x695.jpg">
          <h5><b>อันดับ #2: เที่ยวกระบี่ 2 วัน 1 คืน&nbsp;</b>
            <br><b>งบ 4,000 บาท</b></h5>
          <p class="mt-1">คลายร้อนเที่ยวเกาะ ชิลๆ ...</p>
        </div>
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="C:\Users\ZenzujiK\Downloads\Khao-Yai-National-Park-1-1070x732.jpg">
          <h5><b>อันดับ #3: เที่ยวนครนายก 1 วัน&nbsp;</b>
            <br><b>งบ 1,000 บาท</b></h5>
          <p class="mt-1">ผ่อนคลาย กับ น้ำตกเย็นๆ ใกล้กรุงเทพไปเช้าเย็นกลับได้สบายๆ</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="C:\Users\ZenzujiK\Downloads\DSC_2983.jpg">
          <h5><b>อันดับ #4: เที่ยวกาญจนบุรี 2 วัน 1 คืน&nbsp;</b>
            <br>งบ 2,000 บาท</h5>
          <p class="mt-1">ล่องแพ สุดหรู ราคาไม่แพงอย่างที่คิด</p>
        </div>
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="C:\Users\ZenzujiK\Downloads\DSC_0375.jpg">
          <h5><b>อันดับ #5: เที่ยวภูเก็ต 3 วัน 2 คืน</b>
            <br>งบ 4,000 บาท</h5>
          <p class="mt-1">...</p>
        </div>
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="C:\Users\ZenzujiK\Downloads\0ab66520-f456-9c83.jpg">
          <h5><b>อันดับ#6: เที่ยงเชียงราย 2 วัน 1 คืน&nbsp;</b>
            <br><b>งบ 1,000 บาท</b></h5>
          <p class="mt-1">...</p>
        </div>
      </div>
    </div>
  </div>
 
  
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