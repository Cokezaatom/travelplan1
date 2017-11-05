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
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<!-- <script src="js/jquery-3.2.1.js"></script> -->
  
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDT0Ol8o9P0Dlo3Va0JRmUETohucGsOZws&libraries=places"></script>
	
	<script src="js/main.js"></script> <!-- Resource jQuery -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>

<body>
	


	<script type="text/javascript">
	var places_name =['Bangkok'];
	var places_id =[0];
	var count_place = 1;
    google.maps.event.addDomListener(window, 'load', intilize);
    function intilize() {
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById("txtautocomplete"));

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
        // var place = autocomplete.getplace();
        // var location = "Address: " + place.formatted_address + "<br/>";
        // location += "Latitude: " + place.geometry.location.A + "<br/>";
        // location += "Longitude: " + place.geometry.location.F;
        // document.getElementById('lblresult').innerHTML = location
        });

    };

	function routeDistance(origin, destination, travelMode) {
		return new Promise(function(resolve, reject) {
			var service = new google.maps.DistanceMatrixService;
			if(travelMode == 'DRIVING'){
				service.getDistanceMatrix({
					origins: [origin],
					destinations: [destination],
					travelMode: 'DRIVING',
					unitSystem: google.maps.UnitSystem.METRIC,
					avoidHighways: false,
					avoidTolls: false
				}, function(response, status) {
					if (status == 'OK') {
						resolve(response.rows[0].elements[0]);
					}else{
						reject(Error(status));
					}
				});
			} else if(travelMode == 'TRANSIT'){
				service.getDistanceMatrix({
					origins: [origin],
					destinations: [destination],
					travelMode: 'TRANSIT',
					transitOptions: {
						modes: ['BUS', 'RAIL', 'SUBWAY', 'TRAIN', 'TRAM'],
						routingPreference: 'FEWER_TRANSFERS',
						},
					unitSystem: google.maps.UnitSystem.METRIC,
					avoidHighways: false,
					avoidTolls: false
				}, function(response, status) {
					if (status == 'OK') {
						resolve(response.rows[0].elements[0]);
					}else{
						reject(Error(status));
					}
				});
			}
		});
	}

	function routeDirections(origin, destination, travelMode ){// travelMode:{DRIVING,TRANSIT}
		return new Promise(function(resolve, reject) {
			var service = new google.maps.DirectionsService;
			if(travelMode == 'DRIVING'){
				service.route({
					origin: origin,
					destination: destination,
					travelMode: 'DRIVING',
					unitSystem: google.maps.UnitSystem.METRIC,
					provideRouteAlternatives: true,
					avoidFerries: false ,
					avoidHighways: false,
					avoidTolls: false
				}, function(response, status) {
					if (status == 'OK') {
						resolve(response);
					}else{
						reject(Error(status));
					}
				});
			} else if(travelMode == 'TRANSIT'){
				service.route({
					origin: origin,
					destination: destination,
					travelMode: 'TRANSIT',
					transitOptions: {
						modes: ['BUS', 'RAIL', 'SUBWAY', 'TRAIN', 'TRAM'],
						routingPreference: 'FEWER_TRANSFERS',
						},
					unitSystem: google.maps.UnitSystem.METRIC,
					provideRouteAlternatives: true,
					avoidFerries: false ,
					avoidHighways: false,
					avoidTolls: false
				}, function(response, status) {
					if (status == 'OK') {
						resolve(response);
					}else{
						reject(Error(status));
					}
				});
			}
		});
	}

	//  how to call promises function 
	 //routeDirections('kmitl','siam paragon','TRANSIT').then(function(response) {
	// 	console.log(response);
	// }, function(error) {
	// 	console.error(error);
	// })

	$(document).ready(function(e) {
		$("#bt").click(function(){
			var txtautocomplete = $("#txtautocomplete").val();
			var content = $("#content").val();
			places_name.push(txtautocomplete);
			places_id.push(count_place);
			count_place++;
			document.getElementById("bt").disabled = true;
			routeDirections(places_name[places_name.length-2], txtautocomplete,'TRANSIT').then(function(response) {
				console.log(response);
				document.getElementById("bt").disabled = false;
				var tag = '<br/>' + '<div class="cd-timeline-content">'+
				'<form class="form-inline">'+
					'<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" >';
				var count_option = 0;	
				response.routes.forEach(function(element) {
					console.log(element);
					tag += '<option value="'+count_option+'">'; 
					var time = 0;
					var distance = 0;
					element.legs[0].steps.forEach(function(st) {
						//tag += st.travel_mode+'-';
						time += st.duration.value;
						distance += st.distance.value;
					});
					time
					tag +='time:'+time+'minute,distance:'+distance+'meter</option>';
					count_option++;
				});
				tag += '</select>'+	
				'</form></div>'
						+ '<br/>' +
				'<div class="cd-timeline-block">'+'<div class="cd-timeline-img green">' +'<div class="cd-timeline-content">' + '<div class="container">'+
								'<div class="row">'+'<div class="col-md-4">'+ '<img src="img/imgg.jpg" class="img-thumbnail" alt="เพิ่มภาพ" width="400" height="236">'+'</div>'+'<div class="col-md-8">'+ '<h2>'+ txtautocomplete +'</h2>'+'<button id="rmbt" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+'<br>'+ '<select class="form-control form-control-sm">'+
									'<option>DAY 1</option>'+
									'<option>DAY 2</option>'+
									'<option>DAY 3</option>'+
									'<option>DAY 4</option>'+
									'<option>DAY 5</option>'+
									'<option>DAY 6</option>'+
									'<option>DAY 7</option>'+
									'<option>DAY 8</option>'+
									'<option>DAY 9</option>'+
									'</select>'+
									'<select class="form-control form-control-sm">'+
									'<option>01:00 AM</option>'+
									'<option>02:00 AM</option>'+
									'<option>03:00 AM</option>'+
									'<option>04:00 AM</option>'+
									'<option>05:00 AM</option>'+
									'<option>06:00 AM</option>'+
									'<option>07:00 AM</option>'+
									'<option>08:00 AM</option>'+
									'<option>09:00 AM</option>'+
									'<option>10:00 AM</option>'+
									'<option>11:00 AM</option>'+
									'<option>12:00 AM</option>'+
									'<option>1:00 PM</option>'+
									'<option>2:00 PM</option>'+
									'<option>3:00 PM</option>'+
									'<option>4:00 PM</option>'+
									'<option>5:00 PM</option>'+
									'<option>6:00 PM</option>'+
									'<option>7:00 PM</option>'+
									'<option>8:00 PM</option>'+
									'<option>9:00 PM</option>'+
									'<option>10:00 PM</option>'+
									'<option>11:00 PM</option>'+
									'<option>12:00 PM</option>'+
									'</select>'+
									'<button type="button" class="btn btn-default btn-sm btn btn-primary">'+
										'<span class="glyphicon glyphicon-plus" aria-hidden="true">'+'</span> เพิ่มรูป </button>'+
										'<button type="button" class="btn btn-default btn-sm btn btn-primary">'+
										'<span class="glyphicon glyphicon-plus" aria-hidden="true">'+'</span>รีวิว </button>'+'</button>'+'</div>'+'</div>'+'</div>'+'</div></div></div>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>'+'<br/>';

				$('#myDIV').before(tag);
			}, function(error) {
				console.error(error);
				document.getElementById("bt").disabled = false;
			})
		});
	
	
		$("#rmbt").click(function(){
			var x = document.getElementById("myDIV");
			x.remove(x.selectedIndex);
		});
	});
    </script>

<nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" href="main.php">หน้าแรก</a>
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
  
  <br>
  
  <center><h1>สร้างแผนการท่องเที่ยว</h1></center><br>
  
  
   <div class="container">
      <div class="row">
		<div class="form-group">
			<label class="col-xs-3 control-label">ชื่อแผนการท่องเที่ยว</label>
			<div class="col-xs-5">
				<br /><input type="text" class="form-control" name="name" />
			</div>
		</div>

  <section id="cd-timeline">
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-movie">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
					<div class="container">
						<div class="row">
						<div class="col-md-4"><img src="img/bangkok.jpg" class="img-thumbnail" alt="เพิ่มภาพ" width="400" height="236"></div>
						<div class="col-md-8"><span><h2>กรุงเทพมหานคร ประเทศไทย</h2></span><br/>
						<select class="form-control form-control-sm">
							<option>DAY 1</option>
							</select>
							<select class="form-control form-control-sm">
							<option>01:00 AM</option>
							<option>02:00 AM</option>
							<option>03:00 AM</option>
							<option>04:00 AM</option>
							<option>05:00 AM</option>
							<option>06:00 AM</option>
							<option>07:00 AM</option>
							<option>08:00 AM</option>
							<option>09:00 AM</option>
							<option>10:00 AM</option>
							<option>11:00 AM</option>
							<option>12:00 AM</option>
							<option>1:00 PM</option>
							<option>2:00 PM</option>
							<option>3:00 PM</option>
							<option>4:00 PM</option>
							<option>5:00 PM</option>
							<option>6:00 PM</option>
							<option>7:00 PM</option>
							<option>8:00 PM</option>
							<option>9:00 PM</option>
							<option>10:00 PM</option>
							<option>11:00 PM</option>
							<option>12:00 PM</option>
							</select>
							
							<button type="button" class="btn btn-default btn-sm btn btn-primary">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>เพิ่มรูป
							</button>
							<button type="button" class="btn btn-default btn-sm btn btn-primary">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>รีวิว
							</button>
							</div>
						</div>
					</div>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
		
	<div id="myDIV"></div>

	<div class="cd-timeline-block">
		<div class="cd-timeline-content">
				<input type="text" id="txtautocomplete" name="txtautocomplete" class="form-control text-center" placeholder="เพิ่ม จังหวัด/สถานที่ท่องเที่ยว/ที่พัก/ร้านอาหาร" size="50" >
				<input id="bt" type="button" class="btn btn-info btn-sm pull-right" value="เพิ่มสถานที่">
			<div>
			</div>
		</div>
	</div>
	
		<div class="cd-timeline-content">
		<form class="form-inline">
			<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" >
			<option selected>เลือกการเดินทาง</option>
			<option value="1">รถยนต์</option>
			<option value="2">รถไฟ</option>
			<option value="3">เครื่องบิน</option>
			<option value="4">เรือ</option>
			<option value="5">รถสาธารณะ</option>
			<option value="6">จักรยาน</option>
			<option value="7">เดินเท้า</option>
		</select>
		</div>
	
		
		<div id="end" class="cd-timeline-block">
			<div class="cd-timeline-img cd-movie">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
					<div class="container">
						<div class="row">
						<div class="col-md-4"><img src="img/bangkok.jpg" class="img-thumbnail" alt="เพิ่มภาพ" width="400" height="236"></div>
						<div class="col-md-8"><span><h2>กรุงเทพมหานคร ประเทศไทย</h2></span><br/>
						<select class="form-control form-control-sm">
							<option>DAY 1</option>
							<option>DAY 2</option>
							<option>DAY 3</option>
							<option>DAY 4</option>
							<option>DAY 5</option>
							<option>DAY 6</option>
							<option>DAY 7</option>
							<option>DAY 8</option>
							<option>DAY 9</option>
							</select>
							<select class="form-control form-control-sm">
							<option>01:00 AM</option>
							<option>02:00 AM</option>
							<option>03:00 AM</option>
							<option>04:00 AM</option>
							<option>05:00 AM</option>
							<option>06:00 AM</option>
							<option>07:00 AM</option>
							<option>08:00 AM</option>
							<option>09:00 AM</option>
							<option>10:00 AM</option>
							<option>11:00 AM</option>
							<option>12:00 AM</option>
							<option>1:00 PM</option>
							<option>2:00 PM</option>
							<option>3:00 PM</option>
							<option>4:00 PM</option>
							<option>5:00 PM</option>
							<option>6:00 PM</option>
							<option>7:00 PM</option>
							<option>8:00 PM</option>
							<option>9:00 PM</option>
							<option>10:00 PM</option>
							<option>11:00 PM</option>
							<option>12:00 PM</option>
							</select>
							<button type="button" class="btn btn-default btn-sm btn btn-primary">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>เพิ่มรูป
							</button>
							<button type="button" class="btn btn-default btn-sm btn btn-primary">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>รีวิว
							</button>
							</div>
						</div>
					</div>
			</div>
		</div> <!-- cd-timeline-block -->
	</section> <!-- cd-timeline -->

	</div>
	</div>
	
	<center>
	<br><br>
	<br\>
	<button type="button" class="btn btn-success">บันทึกแผนการท่องเที่ยว</button>
	<button type="button" class="btn btn-danger">ยกเลิกแผนการท่องเที่ยว</button>
	</center>
	<br><br><br>
	
	

</body>

</html>