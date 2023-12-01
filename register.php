<?php

require 'config.php';
$con=mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$email=$_POST['email'];
$gender=$_POST['gender'];
$name=$_POST['name'];
$country=$_POST['country'];

mysqli_query($con,"INSERT INTO users (name, country, email, gender) VALUES ('$name', '$country' , '$email', '$gender')");

// print_r("INSERT INTO users (name, country, email, gender) VALUES ('$name', $country , '$email', '$gender')"); exit;
echo 'yes';