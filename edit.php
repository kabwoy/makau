<?php
include('config.php');

$id = $_POST['myid'];

$conv = settype($id , "integer");

if(isset($_POST['submit']))
{
	
	$u_f_name = $_POST['user_first_name'];
	$u_l_name = $_POST['user_last_name'];
	$u_gender = $_POST['user_gender'];
	$u_email = $_POST['user_email'];
	$u_phone = $_POST['user_phone'];
	$u_county = $_POST['county'];
	$u_dist = $_POST['dist'];
	
	$msg = "";

	//if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		//$msg = "Image uploaded successfully";
  	//}else{
  		//$msg = "Failed to upload image";
  	//}

	$update = "UPDATE student_data SET u_f_name = '$u_f_name', u_l_name = '$u_l_name', u_gender = '$u_gender', u_email = '$u_email', u_phone = '$u_phone', u_county = '$u_county', u_dist = '$u_dist', WHERE id = '$conv' ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:index.php');
	}else{
		echo "Data not update";
	}
}



?>