<?php
include("config.php");
"";
$dep = mysqli_query($con , "SELECT * FROM department");

$results = mysqli_fetch_assoc($dep);

$coursename = $_POST["coursename"];
$coursecode  = $_POST["coursecode"];
$department = $_POST["department"];

mysqli_query($con , "INSERT INTO course(coursename , coursecode , department_id)VALUES('$coursename' , '$coursecode' , '$department')");

header("Location:index.php");


?>