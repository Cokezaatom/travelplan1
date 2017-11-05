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
  <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
              <a href="main_admin.php" class="active nav-link"><i class="glyphicon glyphicon-th-list"></i>&nbsp;รายการแผนท่องเที่ยว</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="member.php"><i class="glyphicon glyphicon-user"></i>สมาชิก</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link"><i class="glyphicon glyphicon-envelope"></i>ข้อความ</a>
            </li>
          </ul>
		  <br><br>
    </div>
	
	 <div class="panel panel-default widget">
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="http://www.jquery2dotnet.com/2013/10/google-style-login-page-desing-usign.html">
                                        Google Style Login Page Design Using Bootstrap</a>
                                    <div class="mic-info">
                                        By: <a href="#">Bhaumik Patel</a> on 2 Aug 2013
                                    </div>
                                </div>
                                <div class="comment-text">
                                    Awesome design
                                </div>
                                <div class="action">
                                    <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="http://bootsnipp.com/BhaumikPatel/snippets/4ldn">Cool Sign Up</a>
                                    <div class="mic-info">
                                        By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                    </div>
                                </div>
                                <div class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                                </div>
                                <div class="action">
                                    <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                
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