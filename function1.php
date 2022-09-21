<?php 
    require_once("DBConnection.php");
?>

<?php

   
session_start();
    function index2($name, $pass, $conn){
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
					if($type=="admin"){
						header("Location:adminpanel.html");
					}
					else{
					header("Location:register.html");
					}
                    return true;
				}
			}
			else{
	 			//echo "Invalid Username or Password";
                 return false;
                 
	 		}
    }

    function signup11($name,$type,$phone,$address,$pass,$cpass,$conn)
    {
        $hashedPassword = $pass;

        $query = mysqli_query($conn,"INSERT INTO tbl_registration(name, type,phone, address,pass,cpass) VALUES('$name', '$type','$phone', '$address','$hashedPassword','$cpass')");
        $query1 = mysqli_query($conn,"SELECT id from tbl_registration WHERE name='".$name."'");
        $eid = mysqli_fetch_assoc($query1);

        if($query){


            echo 'Registration successful!!';
            
            $_SESSION['sess_user'] = $name;
            $_SESSION['sess_eid'] = $eid['id'];

            header("Location:index2.php");
            exit;
        }
        else{
            echo "Query Error : " . "INSERT INTO tbl_registration(name, type,phone, address,pass,cpass) VALUES('$name', '$type','$phone', '$address','$hashedPassword','$cpass')" . "<br>" . mysqli_error($conn);
            echo "<br>";
            echo "Query Error : " . "SELECT regId from tbl_registration WHERE name='".$name."'" . "<br>" . mysqli_error($conn);
        }

    }

?>