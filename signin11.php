<?php 
require_once("DBConnection.php"); 
//include("function1.php");
session_start();
?>

<?php

 	if (isset($_POST['submit'])) {
	 	if (!empty($_POST['name']) && !empty($_POST['pass'])) {
	 		$name = mysqli_real_escape_string($conn,$_POST['name']);
	 		$pass = mysqli_real_escape_string($conn,$_POST['pass']);



             function  signin11($name,$pass,$conn)
             {
             $query = mysqli_query($conn, "SELECT * FROM tbl_registration WHERE name='".$name."'");
			$numrows = mysqli_num_rows($query);
			if($numrows !=0)
			{
				while($row = mysqli_fetch_assoc($query))
				{
					$dbusername=$row['name'];
					$dbpassword=$row['pass'];
					$type=$row['type'];
					$id=$row['regId'];
				}
				if($name == $dbusername && ($pass==$dbpassword))
				{
					
					$_SESSION['sess_user']=$name;
					$_SESSION['sess_eid']=$id;
					//Redirect Browser
					mysqli_query($conn,"INSERT INTO `tbl_login`( `name`, `pass`, `type`) VALUES ('$name','$pass','$type')");
					if($type=="admin")
					{
						header("Location:../web/index.html");
					}
					else if($type=="user")
					{
					header("Location:userdb.html");
					}
					else if($type=="vendor")
					{
					header("Location:vendordb.html");
					}
                    return true;
				}
			}
			else{
	 			//echo "Invalid Username or Password";
                 return false;
                 
	 		}
        }
            $login = signin11($name,$pass,$conn);          
	 	}
	 	else{
		 	echo "Required All fields!";
		} 

 	}
    

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login #10</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Have an account?</h3>
		      	<form method="POST" class="signin-form">
					<?php      
                    if(isset($_POST['submit']))
                    {
                        if($login == false)
                            echo "<script type='text/javascript'>document.getElementById('invalidMsg').style.display = 'block';</script>";
                            echo "Invalid Username or Password";
                    }
                    else
                        echo "";
                ?>
		      		<div class="form-group">
		      			<input type="text" class="form-control" id="name" name="name" placeholder="Enter Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password"  name="pass" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<input type="submit" class="form-control btn btn-primary submit px-3" name="submit" value="Log In">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="forgotpass.php" type="submit" name="submit" value="submit" style="color: #fff">Forgot Password</a>
								</div>
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
	          	<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
	          </div>
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
