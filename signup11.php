<?php 
require_once("DBConnection.php");
//include("function1.php");
session_start();
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
$nameErr = $emailErr=$typeErr = $phoneErr = $addressErr = $passErr = $cpassErr = "";
$name= $email= $type = $phone = $address = $pass = $cpass = "";
global $validate1,$validate2,$validate3,$validate4,$validate5,$validate6,$validate7;

  if(isset($_POST['submit']))
  {

  if(empty($_POST['name']))
    {
      $nameErr = "Please Enter Fullname";
      $validate1 = false;
    }
    else{
      $name = mysqli_real_escape_string($conn,$_POST['name']);
      $validate1 = true;
      if(preg_match("/[0-9]/",$name) || !preg_match("/[A-Za-z]/",$name))
      {
      
      $nameErr = "Please Enter valid Fullname";
      $validate1 = false;
      
        
      }
    }

    if(empty($_POST['email'])){
      $emailErr = "Please Enter Email";
      $validate7 = false;
    }
    else{
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $validate7 = true;
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "Please Enter valid email";
        $validate7 = false;
      }
    }
    if(empty($_POST['type'])){
        $typeErr = "Please Enter type";
        $validate2 = false;
      }
      else{
        $type = mysqli_real_escape_string($conn,$_POST['type']);
        $validate2 = true;
        if(preg_match("/[0-9]/",$type) || !preg_match("/[A-Za-z]/",$type))
        {
        
        $typeErr = "Please Enter valid type";
        $validate2 = false;
        
          
        }
      }
    if(empty($_POST['phone'])){
      $phoneErr = "Please Enter Phone Number";
      $validate3 = false;
    }
    else{
      $phone = mysqli_real_escape_string($conn,$_POST['phone']);
      $validate3 = true;
      if(!preg_match("/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/",$phone)){
        $phoneErr = "Please Enter valid Phone Number";
        $validate3 = false;
      }
    }
    if(empty($_POST['address'])){
        $addressErr = "Please Enter Your Address";
        $validate4 = false;
      }                                                                              
      else{
        $address = mysqli_real_escape_string($conn,$_POST['address']);
          $validate4 = true;
    
      }

    if(empty($_POST['pass'])){
      $passErr = "Please Enter Password";
      $validate5 = false;
    }
    else{
      $pass= mysqli_real_escape_string($conn,$_POST['pass']);
      $validate5 = true;
      if(preg_match("/[0-9]/",$pass) || !preg_match("/[A-Za-z]/",$pass))
      {
      
      $passErr = "Please Enter valid password";
      $validate5 = false;
      
      }
    }

    if(empty($_POST['cpass'])){
      $cpassErr = "Please Enter re-password";
      $validate6 = false;
    }
    else{
      $cpass = mysqli_real_escape_string($conn,$_POST['cpass']);
      $validate6 = true;
      if($pass !== $cpass){
        $cpassErr = "Password and Confirm Password don't match";
        $validate6 = false;
      }
    }
    /*$name = $_POST['name'];
    $type = $_POST['type'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];*/
    
    
    function  signup11($name,$email,$type,$phone,$address,$pass,$cpass,$conn)
    {
    $hashedPassword = $pass;
    $query2=mysqli_query($conn,"SELECT name FROM tbl_registration where name='".$name."'");
    if(mysqli_num_rows($query2)==0)
    {
     
      $query = mysqli_query($conn,"INSERT INTO tbl_registration(name,email, type,phone, address,pass,cpass) VALUES('$name','$email','$type','$phone', '$address','$hashedPassword','$cpass')");

    }
    else
    {
      echo "<script>
      alert('User name already exist');
      window.location.href='signup11.php';
     </script>";
     }
    $query1 = mysqli_query($conn,"SELECT regId from tbl_registration WHERE name='".$name."'");
    if($query1===FALSE)
    {
      die(mysqli_error($conn));
    }
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
  
    if($validate1==true&&$validate2==true&&$validate3==true&&$validate4==true&&$validate5==true&&$validate6==true&&$validate7=true){
        signup11($name,$email,$type,$phone,$address,$pass,$cpass,$conn);

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
		      			<input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" placeholder="YOUR NAME" required onchange="Validname()" >
		      			<span class="icon fa fa-user-o"></span>
                          <span class="error"><?php echo $nameErr; ?></span>
		      		</div>
              <span id="msg7" style="color:red;"></span>
                        <script>
                        function Validname() 
                        {
                        var val = document.getElementById('name').value;
                          if (!val.match(/^[A-Za-z]/))
                           {
                            document.getElementById('msg7').innerHTML="Use only letters";
                                  document.getElementById('name').value = "";
                                    return false;
                           }
                            document.getElementById('msg7').innerHTML=" ";
                          return true;
                        }
                       </script>

               <!--Email-->
               <div class="form-group mb-3">
		      			<label class="label" for="email">Email</label>
		      			<input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" placeholder="YOUR EMAIL" required onchange="Validemail()">
		      			<span class="icon fa fa-user-o"></span>
                          <span class="error"><?php echo $emailErr; ?></span>
		      		</div>
              <span id="msg8" style="color:red;"></span>
                        <script>
                        function Validemail() 
                        {
                        var val = document.getElementById('email').value;
                          if (!val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
                           {
                            document.getElementById('msg8').innerHTML="Enter valid email";
                                  document.getElementById('email').value = "";
                                    return false;
                           }
                            document.getElementById('msg8').innerHTML=" ";
                          return true;
                        }
                       </script>

                     
                        <!--type-->
		      		<div class="form-group mb-3">
		      			<label class="label" for="type">TYPE</label>
		      			<input type="text" id="type" name="type" class="form-control" placeholder="YOUR TYPE" value="<?php echo $type; ?>" required onchange="Validtype()" >
		      			<span class="icon fa fa-paper-plane-o"></span>
                          <span class="error"><?php echo $typeErr; ?></span>
		      		</div>
              <span id="msg9" style="color:red;"></span>
                        <script>
                        function Validtype() 
                        {
                        var val = document.getElementById('type').value;
                          if (!val.match(/^[A-Za-z]/))
                           {
                            document.getElementById('msg9').innerHTML="Use only letters while entering type";
                                  document.getElementById('type').value = "";
                                    return false;
                           }
                            document.getElementById('msg9').innerHTML=" ";
                          return true;
                        }
                       </script>
              

                    
                        <!--Phone No.-->
                      <div class="form-group mb-3">
		      			<label class="label" for="phone">Phone Number</label>
		      			<input type="text" name="phone" id="phno" class="form-control" placeholder="YOUR PHONE NUMBER" value="<?php echo $phone; ?>" required onchange="Validphone()">
		      			<span class="icon fa fa-paper-plane-o"></span>
                          <span class="error"><?php echo $phoneErr; ?></span>
		      		</div>

              <span id="msg10" style="color:red;"></span>
                        <script>
                        function Validphone() 
                        {
                        var val = document.getElementById('phno').value;
                          if (!val.match(/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/))
                           {
                            document.getElementById('msg10').innerHTML="Only Numbers are allowed and must contain 10 number";
                                  document.getElementById('phno').value = "";
                                    return false;
                           }
                            document.getElementById('msg10').innerHTML=" ";
                          return true;
                        }
                       </script>


                    <!--address.-->
                    <div class="form-group mb-3">
		      			<label class="label" for="address">Address</label>
		      			<input type="text" name="address" id="add" class="form-control" placeholder="YOUR ADDRESS" value="<?php echo $address; ?>" required onchange="Validaddress()">
                          <span class="error"><?php echo $addressErr; ?></span>
		      		</div>
              <span id="msg11" style="color:red;"></span>
                        <script>
                        function Validaddress() 
                        {
                        var val = document.getElementById('add').value;
                          if (!val.match(/^[A-Za-z]/))
                           {
                            document.getElementById('msg11').innerHTML="Enter address in correct format";
                                  document.getElementById('add').value = "";
                                    return false;
                           }
                            document.getElementById('msg11').innerHTML=" ";
                          return true;
                        }
                       </script>
                       

                      <!--password.-->
	            <div class="form-group mb-3">
	            	<label class="label" for="pass">Password</label>
	              <input id="pass" type="password" name="pass" class="form-control" placeholder=" YOUR PASSWORD" value="<?php echo $pass; ?>" required onchange="Validpassword()" >
	              <span toggle="#pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <span class="error"><?php echo $passErr; ?></span>
	              <span class="icon fa fa-lock"></span>
	            </div>
              <span id="msg12" style="color:red;"></span>
                        <script>
                        function Validpassword() 
                        {
                        var val = document.getElementById('pass').value;
                          if (!val.match(/^[A-Za-z]/))
                           {
                            document.getElementById('msg12').innerHTML="Enter address in correct format";
                                  document.getElementById('pass').value = "";
                                    return false;
                           }
                            document.getElementById('msg12').innerHTML=" ";
                          return true;
                        }
                       </script>
                       
              

                    <!--confirm password.-->
	            <div class="form-group mb-3">
	            	<label class="label" for="cpass">Confirm Password</label>
	              <input id="cpass" type="password" name="cpass" class="form-control" placeholder="CONFIRM YOUR PASSWORD" value="<?php echo $cpass; ?>" >
	              <span toggle="#cpass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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

