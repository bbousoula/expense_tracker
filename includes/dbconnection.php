<?php
// Create connection
$con=mysqli_connect("localhost:3308", "root", "", "detsdb");
// Check connection
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

  ?>