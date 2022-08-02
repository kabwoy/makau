<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// database connection
include('config.php');

$added = false;


//Add  new student code 

if(isset($_POST['submit'])){
	$u_card = $_POST['card_no'];
	$u_f_name = $_POST['user_first_name'];
	$u_l_name = $_POST['user_last_name'];
	$u_gender = $_POST['user_gender'];
	$u_email = $_POST['user_email'];
	$u_phone = $_POST['user_phone'];
	$u_county = $_POST['county'];
	$u_dist = $_POST['dist'];
	$course_id = $_POST["course"];


	//image upload

	// $msg = "";
	// $target = "upload_images/".basename($image);

	// if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  	// 	$msg = "Image uploaded successfully";
  	// }else{
  	// 	$msg = "Failed to upload image";
  	// }

  	$insert_data = "INSERT INTO student_data(u_f_name, u_l_name,u_gender, u_email, u_phone,u_county, u_dist , course_id) VALUES ('$u_f_name','$u_l_name','$u_gender','$u_email','$u_phone','$u_county','$u_dist' ,'$course_id' )";
  	$run_data = mysqli_query($con,$insert_data);

	header("Location:index.php");

  	if($run_data){
		  $added = true;
  	}else{
  		echo "Data not insert";
  	}

}

?>







<!DOCTYPE html>
<html>
<head>
	<title>input form</title>
	<link rel="icon" type="images/x-icon" href="images/mtti.jpg">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
<a href="#" target="_blank"><img src="images/masai.png" alt="" width="350px" ></a><br><hr>

<!-- adding alert notification  -->
<?php
	if($added){
		echo "
			<div class='btn-success' style='padding: 15px; text-align:center;'>
				Your Student Data has been Successfully Added.
			</div><br>
		";
	}

?>





	<a href="logout.php" class="btn btn-success"><i class="fa fa-lock"></i> Logout</a>
	<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus"></i> Add New Student
  </button>
  <a href="export.php" class="btn btn-success pull-right"><i class="fa fa-download"></i> Export Data</a>
  <hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">S.L</th>
				<th class="text-center" scope="col">Name</th>
				<th class="text-center" scope="col">Phone</th>
				<th class="text-center" scope="col">View</th>
				<th class="text-center" scope="col">Edit</th><br>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php

        	$get_data = "SELECT * FROM student_data order by 1 desc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$u_f_name = $row['u_f_name'];
				$u_l_name = $row['u_l_name'];
				$u_phone = $row['u_phone'];
			

        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$u_f_name   $u_l_name</td>
				<td class='text-left'>$u_phone</td>
				
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Prfile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>

					     
					    
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>


        		";
        	}

        	?>

			
			
		</table>
		<form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Export Data" />
    </form>
	</div>


	<!---Add in modal---->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="images/masai.png" width="300px" height="120px" alt=""></center>
    
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
			
			<!-- This is test for New Card Activate Form  -->
			<!-- This is Address with email id  -->
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Student Id.</label>
<input type="text" class="form-control" name="card_no" placeholder="Enter 12-digit Student Id." maxlength="12" required>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Mobile No.</label>
<input type="phone" class="form-control" name="user_phone" placeholder="Enter 10-digit Mobile no." maxlength="10" required>
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="firstname">First Name</label>
<input type="text" class="form-control" name="user_first_name" placeholder="Enter First Name">
</div>
<div class="form-group col-md-6">
<label for="lastname">Last Name</label>
<input type="text" class="form-control" name="user_last_name" placeholder="Enter Last Name">
</div>
</div>

</div>

<div class="form-row" style="color: skyblue;">
<div class="form-group col-md-6">
<label for="email">Email Id</label>
<input type="email" class="form-control" name="user_email" placeholder="Enter Email id">
</div>
<div class="form-group col-md-6">
<label for="idno">ID No.</label>
<input type="text" class="form-control" name="user_idno" maxlength="12" placeholder="Enter 12-digit id no. ">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Gender</label>
<select id="inputState" name="user_gender" class="form-control">
  <option selected>Choose...</option>
  <option>Male</option>
  <option>Female</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Date of Birth</label>
<input type="date" class="form-control" name="user_dob" placeholder="Date of Birth">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="inputCity">District</label>
<input type="text" class="form-control" name="dist">
</div>
<div class="form-group col-md-4">
<label for="inputCounty">County</label>
<select name="county" class="form-control">
  <option selected>Choose county</option>
  <option value="Makueni">Makueni</option>
									<option value="Kisumu">Kisumu</option>
									<option value="Kiambu">Kiambu</option>
									<option value="Nairobi">Nairobi</option>
									<option value="Vihiga">Vihiga</option>
									<option value="Mombasa">Mombasa</option>
									<option value="Kilifi">Kilifi</option>
									<option value="Taita Taveta">Taita Taveta</option>
									<option value="Machakos">|Machakos</option>
									<option value="Nakuru">Nakuru</option>
									<option value="Kitui">Kitui</option>
									<option value="Kajiado">Kajiado</option>
									<option value="Narok">Narok</option>
									<option value="Kwale">Kwale</option>
									<option value="Tana River">Tana River</option>
									<option value="Lamu">Lamu</option>
									<option value="Garissa">Garissa</option>
									<option value="Wajir">Wajir</option>
									<option value="Mandera">Mandera</option>
									<option value="Marsabit">Marsabit</option>
									<option value="Isiolo">Isiolo</option>
									<option value="Meru">Meru</option>
									<option value="Tharaka-Nithi">Tharaka-Nithi</option>
									<option value="Embu">Embu</option>
									<option value="Nyandarua">Nyandarua</option>
									<option value="Nyeri">Nyeri</option>
									<option value="Kirinyaga">Kirinyaga</option>
									<option value="Kericho">Kericho</option>
									<option value="Kakamega">Kakamega</option>
									<option value="Bungoma">Bungoma</option>
									<option value="Siaya">Siaya</option>
									<option value="Migori">Migori</option>
									<option value="Nyamira">Nyamira</option>
									<option value="Kisii">Kisii</option>
									<option value="Bomet">Bomet</option>
									<option value="Laikipia">Laikipia</option>
</select>
</div>
			<?php
				$query="SELECT * FROM course";

				$courses = mysqli_query($con , $query);

				$res = mysqli_fetch_assoc($courses);

			?>
        	<div class="form-group">

	
        		<select name="course" id="">

					<option value="2">ICT</option>
					<option value="3">Wiring</option>

				</select>
        	</div>

        	
        	 <input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
        	
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!------DELETE modal---->




<!-- Modal -->
<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	echo "

<div id='$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>Are you want to sure??</h4>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Delete</a>
      </div>
      
    </div>

  </div>
</div>


	";
	
}


?>


<!-- View modal  -->
<?php 

// <!-- profile modal start -->
$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$phone = $row['u_phone'];
	$address = $row['u_county'];
	$dist = $row['u_dist'];
	$time = $row['uploaded'];
	
	echo "

		<div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title' id='exampleModalLabel'>Profile <i class='fa fa-user-circle-o' aria-hidden='true'></i></h5>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<div class='modal-body'>
			<div class='container' id='profile'> 
				<div class='row'>
					
					<div class='col-sm-3 col-md-6'>
						<h3 class='text-primary'>$name $name2</h3>
						<p class='text-secondary'>
						
						
						
						<i class='fa fa-venus-mars' aria-hidden='true'></i> $gender
						<br />
						<i class='fa fa-envelope-o' aria-hidden='true'></i> $email
						<br />
						<div class='card' style='width: 18rem;'>
						<i class='fa fa-users' aria-hidden='true'></i> Familiy :
								<div class='card-body'>
								
								</div>
						</div>					
						<br />
						</p>
						<!-- Split button -->
					</div>
				</div>

			</div>   
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
			</div>
			</form>
			</div>
		</div>
		</div> 


    ";
}


// <!-- profile modal end -->


?>





<!----edit Data--->

<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$phone = $row['u_phone'];
	$address = $row['u_county'];
	$dist = $row['u_dist'];
	echo "

<div id='edit$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title text-center'>Edit your Data</h4> 
      </div>

      <div class='modal-body'>
        <form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>

		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputEmail4'>Student Id.</label>

		<div class='form-group col-md-6'>
		<label for='inputPassword4'>Mobile No.</label>
		<input type='phone' class='form-control' name='user_phone' placeholder='Enter 10-digit Mobile no.' maxlength='10' value='$phone' required>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='firstname'>First Name</label>
		<input type='text' class='form-control' name='user_first_name' placeholder='Enter First Name' value='$name'>
		</div>
		<div class='form-group col-md-6'>
		<label for='lastname'>Last Name</label>
		<input type='text' class='form-control' name='user_last_name' placeholder='Enter Last Name' value='$name2'>
		</div>
		</div>
		
		
		<div class='form-row'>
		
		
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='email'>Email Id</label>
		<input type='email' class='form-control' name='user_email' placeholder='Enter Email id' value='$email'>
		</div>
		</div>
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputCounty'>Gender</label>
		<select id='inputCounty' name='user_gender' class='form-control' value='$gender'>
		  <option selected>$gender</option>
		  <option>Male</option>
		  <option>Female</option>
		  <option>Other</option>
		</select>
		</div>
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputCity'>District</label>
		<input type='text' class='form-control' name='dist' value='$dist'>
		</div>
		<div class='form-group col-md-4'>
		<label for='inputCounty'>County</label>
		<select name='county' class='form-control'>
		  <option></option>
	   				    <option value='Makueni'>Makueni</option>
		  			    <option value=Kisumu>Kisumu</option>
		        	    <option value='Kiambu'>Kiambu</option>
		  				<option value='Nairobi'>Nairobi</option>
		  				<option value='Vihiga'>Vihiga</option>
		  				<option value='Mombasa'>Mombasa</option>
		 				<option value='Kilifi'>Kilifi</option>
		 				<option value=Taita Taveta'>Taita Taveta</option>
		 				<option value='Machakos'>|Machakos</option>
		 				<option value='Nakuru'>Nakuru</option>
						<option value='Kitui'>Kitui</option>
						<option value='Kajiado'>Kajiado</option>
		  				<option value='Narok'>Narok</option>
		 				<option value='Kwale'>Kwale</option>
		  				<option value='Tana River'>Tana River</option>
		 			    <option value='Lamu'>Lamu</option>
		 			    <option value='Garissa'>Garissa</option>
		                <option value='Wajir'>Wajir</option>
		                <option value='Mandera'>Mandera</option>
		                <option value='Marsabit'>Marsabit</option>
		                <option value='Isiolo'>Isiolo</option>
						<option value='Meru'>Meru</option>
		 				<option value='Tharaka-Nithi'>Tharaka-Nithi</option>
		 				<option value='Embu'>Embu</option>
		  			    <option value='Nyandarua'>Nyandarua</option>
		 				<option value='Nyeri'>Nyeri</option>
		  			    <option value='Kirinyaga'>Kirinyaga</option>
		  			    <option value='Kericho'>Kericho</option>
		  			    <option value='Kakamega'>Kakamega</option>
		  			    <option value='Bungoma'>Bungoma</option>
		 			    <option value='Siaya'>Siaya</option>
		 			    <option value='Migori'>Migori</option>
		 			    <option value='Nyamira'>Nyamira</option>
					    <option value='Kisii'>Kisii</option>
					    <option value='Bomet'>Bomet</option>
		 			    <option value='Laikipia'>Laikipia</option>
		</select>
		</div>
		
        	
			 <div class='modal-footer'>
			 <input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
			 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 </div>
		 <input type=`text` value = '$id'  name='myid' hidden/>

        </form>
      </div>

    </div>

  </div>
</div>

	
	";
}


?>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

</body>
</html>
