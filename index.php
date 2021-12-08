<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbluser where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['detsuid']=$ret['ID'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }

  if(isset($_POST['submit']))
  {
    $fname=$_POST['name'];
    $mobno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $ret=mysqli_query($con, "select Email from tbluser where Email='$email' ");
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msg="This email  associated with another account";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, MobileNumber, Email,  Password) value('$fname', '$mobno', '$email', '$password' )");
    if ($query) {
    $msg="You have successfully registered";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
	}
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Expense Tracker - Login</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
	<link href="css/login.css" rel="stylesheet">
	<script type="text/javascript">
	function checkpass()
	{
	if(document.signup.password.value!=document.signup.repeatpassword.value)
	{
	alert('Password and Repeat Password field does not match');
	document.signup.repeatpassword.focus();
	return false;
	}
	return true;
	} 
	</script>
</head>

<body>

  <div class="d-flex justify-content-center align-items-center wrapper">
    
      <div class="card">

          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item text-center"> <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a> </li>
              <li class="nav-item text-center"> <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a> </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          
                <?php if($msg) { ?>
                  <p style="font-size:16px; color:red" text-align="center">
                    <?php	echo $msg; ?> 
                  </p>
                <?php } ?> 
          
                <form role="form" action="" method="post" id="" name="login">
                  <fieldset>
                    <div class="form px-4 pt-5"> 
                      <input class="form-control" placeholder="Email or Phone" name="email" type="email" autofocus="" required="true"> 
                      <input class="form-control" placeholder="Password" name="password" type="password" value="" required="true"> 
                      <button type="submit" value="login" name="login" class="btn btn-dark btn-block">Login</button>
                      <a href="forgot-password.php">Forgot Password?</a> 
                    </div>
                  </fieldset>
                </form>

              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="form px-4">
                  <form role="form" action="" method="post" id="" name="signup" onsubmit="return checkpass();">
                  
                  <p style="font-size:16px; color:red" text-align="center"> 
                    <?php   
                    if ($msg) { 
                      echo $msg;  
                    } ?> 
                  </p>
                  <fieldset>
                  <input class="form-control" placeholder="Full Name" name="name" type="text" required="true">
                  <input class="form-control" placeholder="E-mail" name="email" type="email" required="true"> 
                  <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" maxlength="8" pattern="[0-9]{8}" required="true">
                  <input class="form-control" placeholder="Password" name="password" type="password" value="" required="true">
                  <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Repeat Password" required="true">


                    <button type="submit" value="submit" name="submit" class="btn btn-dark btn-block">Signup</button> 
                    </fieldset>
                  </form>
                </div>
              </div>
          </div>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
