<?php
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist\css\ddddd.css" type="text/css"> </head>

<body>
  <div class="py-5 opaque-overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-2"> </div>
        <div class="col-md-8">
          <div class="card bg-dark text-white p-5">
            <div class="card-body">
              <h1 class="mb-4">เข้าสู่ระบบ</h1>
              <form action="checklog.php" method="post">
                <div class="form-group"> <label>Email address*</label>
                  <input name="email" type="text" class="form-control" placeholder="Enter email"> </div>
                <div class="form-group"> <label>Password *</label>
                  <input name="password" type="password" class="form-control" placeholder="Password"> </div>
                <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
				<a class="btn btn-default navbar-btn" href="index.php">กลับสู่หน้าหลัก</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	
	<?php
	if (isset($_SESSION['userid'])){
		echo $_SESSION['userid'];
	} else {
		/*echo "You are not logged in";*/
	}
	
?>

  </body>

</html>