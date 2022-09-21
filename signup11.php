<?php 
require_once("DBConnection.php");
//include("function1.php");
//session_start();
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
<style>
    
    #err {
      display: none;
      padding: 1.5em;
      padding-left: 4em;
      font-size: 1.2em;
      font-weight: bold;
      margin-top: 1em;
    }

    .error {
      color: #FF0000;
    }
  </style>
	</head>
	<body class="img" style="background-image: url(images/bg.jpg);">
    <?php
$nameErr = $typeErr = $phoneErr = $addressErr = $passErr = $cpassErr = "";
$name = $type = $phone = $address = $pass = $cpass = "";
global $validate;

  if(isset($_POST['submit']))
  {

  if(empty($_POST['name']))
    {
      $nameErr = "Please Enter Fullname";
      $validate = false;
    }
    else{
      $name = mysqli_real_escape_string($conn,$_POST['name']);
      $validate = true;
    }
    if(empty($_POST['type'])){
        $typeErr = "Please Enter type";
        $validate = false;
      }
      else{
        $type = mysqli_real_escape_string($conn,$_POST['type']);
        $validate = true;
      }

    if(empty($_POST['phone'])){
      $phoneErr = "Please Enter Phone Number";
      $validate = false;
    }
    else{
      $phone = mysqli_real_escape_string($conn,$_POST['phone']);
      $validate = true;
      if(strlen($phone) > 10 || strlen($phone) < 10 || !preg_match("/[0-9]/",$phone)){
        $phoneErr = "Please Enter valid Phone Number";
        $validate = false;
      }
    }
    if(empty($_POST['address'])){
        $addressErr = "Please Enter Your Address";
        $validate = false;
      }
      else{
        $address = mysqli_real_escape_string($conn,$_POST['address']);
          $validate = true;
    
      }

    if(empty($_POST['pass'])){
      $passErr = "Please Enter Password";
      $validate = false;
    }
    else{
      $pass= mysqli_real_escape_string($conn,$_POST['pass']);
      $validate = true;
    }

    if(empty($_POST['cpass'])){
      $cpassErr = "Please Enter re-password";
      $validate = false;
    }
    else{
      $cpass = mysqli_real_escape_string($conn,$_POST['cpass']);
      $validate = true;
      if($pass !== $cpass){
        $cpassErr = "Password and Confirm Password don't match";
        $validate = false;
      }
    }
    /*$name = $_POST['name'];
    $type = $_POST['type'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];*/
    function  signup11($name,$type,$phone,$address,$pass,$cpass,$conn)
    {
    $hashedPassword = $pass;
    $query = mysqli_query($conn,"INSERT INTO tbl_registration(name, type,phone, address,pass,cpass) VALUES('$name', '$type','$phone', '$address','$hashedPassword','$cpass')");
    $query1 = mysqli_query($conn,"SELECT id from tbl_registration WHERE name='".$name."'");
    $eid = mysqli_fetch_assoc($query1);

    if($query){


        echo 'Registration successful!!';
        
        $_SESSION['sess_user'] = $name;
        $_SESSION['sess_eid'] = $eid['id'];

        header("Location:signin11.php");
        exit;
    }
    else{
        echo "Query Error : " . "INSERT INTO tbl_registration(name, type,phone, address,pass,cpass) VALUES('$name', '$type','$phone', '$address','$hashedPassword','$cpass')" . "<br>" . mysqli_error($conn);
        echo "<br>";
        echo "Query Error : " . "SELECT regId from tbl_registration WHERE name='".$name."'" . "<br>" . mysqli_error($conn);
    }
  }
  
    if($validate){
        signup11($name,$type,$phone,$address,$pass,$cpass,$conn);

    }
  }

ini_set('display_errors', true);
error_reporting(E_ALL);
  ?>	


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Sign Up #09</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap">
		      	<h3 class="text-center mb-4">Create Your Account</h3>

            
						<form class="signup-form" method="POST" autocomplete="off">
                    
                          <!--Name-->
		      		<div class="form-group mb-3">
		      			<label class="label" for="name">Name</label>
		      			<input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" placeholder="YOUR NAME" >
		      			<span class="icon fa fa-user-o"></span>
                          <span class="error"><?php echo $nameErr; ?></span>
		      		</div>

                     
                        <!--type-->
		      		<div class="form-group mb-3">
		      			<label class="label" for="type">TYPE</label>
		      			<input type="text" name="type" class="form-control" placeholder="YOUR TYPE" value="<?php echo $type; ?>" >
		      			<span class="icon fa fa-paper-plane-o"></span>
                          <span class="error"><?php echo $typeErr; ?></span>
		      		</div>

                    
                        <!--Phone No.-->
                      <div class="form-group mb-3">
		      			<label class="label" for="phone">Phone Number</label>
		      			<input type="text" name="phone" class="form-control" placeholder="YOUR PHONE NUMBER" value="<?php echo $phone; ?>" >
		      			<span class="icon fa fa-paper-plane-o"></span>
                          <span class="error"><?php echo $phoneErr; ?></span>
		      		</div>


                    <!--address.-->
                    <div class="form-group mb-3">
		      			<label class="label" for="address">Address</label>
		      			<input type="text" name="address" class="form-control" placeholder="YOUR ADDRESS" value="<?php echo $address; ?>">
                          <span class="error"><?php echo $addressErr; ?></span>
		      		</div>
                       

                      <!--password.-->
	            <div class="form-group mb-3">
	            	<label class="label" for="pass">Password</label>
	              <input id="pass" type="password" name="pass" class="form-control" placeholder=" YOUR PASSWORD" value="<?php echo $pass; ?>" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,100}$" oninvalid="this.setCustomValidity('Password should contain : \n\nminimum 8 characters.\nat least 1 uppercase.\nat least 1 lowercase.\nat least 1 number.\nat least 1 special character --> !@#$%^&*_=+-')" oninput="this.setCustomValidity('')"/>
	              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <span class="error"><?php echo $passErr; ?></span>
	              <span class="icon fa fa-lock"></span>
	            </div>

                    <!--confirm password.-->
	            <div class="form-group mb-3">
	            	<label class="label" for="cpass">Confirm Password</label>
	              <input id="cpass" type="password" name="cpass" class="form-control" placeholder="CONFIRM YOUR PASSWORD" value="<?php echo $cpass; ?>" >
	              <span toggle="#password-confirm" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <span class="error"><?php echo $cpassErr; ?></span>
	              <span class="icon fa fa-lock"></span>
	            </div>
	            <div class="form-group">
	            	<input type="submit" name="submit" class="form-control btn btn-primary submit px-3" value="submit">
	            </div>
	          </form>
	          <p>I'm already a member! <a href="signin11.php">Sign In</a></p>
	        </div>
				</div>
			</div>
		</div>
</section>
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

