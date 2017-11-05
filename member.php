<?php
session_start();
$ses_userid = $_SESSION[ses_userid];
$ses_email = $_SESSION[ses_email];
$ses_name = $_SESSION[ses_name];
$ses_status = $_SESSION[ses_status];

if($ses_userid <> session_id() or  $ses_email ==””){
echo “คุณยังไม่ได้ทำการเข้าระบบ”;}    

//ตรวจสอบสถานะว่าใช่ admin รึเปล่า ถ้าไม่ใช่ให้หยุดอยู่แค่นี้
elseif($_SESSION[ses_status] != "Admin") {
echo "This page for Admin only!";
echo "<a href=index.php>Back</a>";
exit();
}
else {
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
  <link rel="stylesheet" href="bootstrap-3.3.7-dist\css\bootstrap.css" type="text/css">
  <script>
	var name = '<?php echo $_SESSION["name"];?>';
	console.log(name);
	
	$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="icon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="icon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    $('button').click(function(e) {
        e.preventDefault();
        alert("This is a demo.\n :-)");
    });
});
	</script>
  </head>
 

<body>
	
	
  <nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" href="main_admin.php">หน้าแรก</a>
          </li>
		    <li class="nav-item">
		  <a class="nav-link active" href="logout.php">ออกจากระบบ</a>
		  </li>
        </ul>	
      </div>
    </div>
  </nav>
  
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="main_admin.php" class="nav-link" href=""><i class="glyphicon glyphicon-th-list"></i>&nbsp;รายการแผนท่องเที่ยว</a>
            </li>
            <li class="nav-item">
              <a class="active nav-link"><i class="glyphicon glyphicon-user"></i>สมาชิก</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link"><i class="glyphicon glyphicon-envelope"></i>ข้อความ</a>
            </li>
          </ul>
		  <br><br>
    </div>
  </div>
  </div>
  <div class="container">
		<div class="well span8 offset2">
			<div class="row-fluid user-row">
				<div class="span1">
					<img class="img-circle"
                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50"
                     alt="User Pic">
            </div>
            <div class="span10">
                <strong>Cyruxx</strong><br>
                <span class="text-muted">User level: Administrator</span>
            </div>
            <div class="span1 dropdown-user" data-for=".cyruxx">
                <i class="icon-chevron-down text-muted"></i>
            </div>
        </div>
        <div class="row-fluid user-infos cyruxx">
            <div class="span10 offset1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">User information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">
                            <div class="span3">
                                <img class="img-circle"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
                                     alt="User Pic">
                            </div>
                            <div class="span6">
                                <strong>Cyruxx</strong><br>
                                <table class="table table-condensed table-responsive table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>User level:</td>
                                        <td>Administrator</td>
                                    </tr>
                                    <tr>
                                        <td>Registered since:</td>
                                        <td>11/12/2013</td>
                                    </tr>
                                    <tr>
                                        <td>Topics</td>
                                        <td>15</td>
                                    </tr>
                                    <tr>
                                        <td>Warnings</td>
                                        <td>0</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn  btn-primary" type="button"
                                data-toggle="tooltip"
                                data-original-title="Send message to user">ส่งข้อความ</button>
                        <span class="pull-right">
                            <button class="btn btn-warning" type="button"
                                    data-toggle="tooltip"
                                    data-original-title="Edit this user">แก้ไข</button>
                            <button class="btn btn-danger" type="button"
                                    data-toggle="tooltip"
                                    data-original-title="Remove this user">ลบ</button>
                        </span>
                    </div>
                </div>
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