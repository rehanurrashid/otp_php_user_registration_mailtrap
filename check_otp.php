<?php

require 'config.php';
$con=mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$email=$_POST['email'];
$otp=$_POST['otp'];

// Perform query

$result = mysqli_query($con,"SELECT code FROM otp WHERE email='$email' AND code='$otp' ORDER BY id DESC LIMIT 1");

if ($result->num_rows > 0) {
  	echo 'yes';
}
else{
	echo 'no';
}
