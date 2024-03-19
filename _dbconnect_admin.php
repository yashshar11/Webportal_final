<?php

$host="localhost";
$username="root";
$password="";
$database="login_database";

$conn=mysqli_connect($host, $username, $password, $database);

if(!$conn)
{
  echo "Connection Failed";
}
?>