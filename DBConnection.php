<?php
  $conn = mysqli_connect('localhost','root','','e_store');
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
  }
  else
  echo "connection successful";
?>