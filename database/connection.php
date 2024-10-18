<?php 
$servername="localhost";
$username="root";
$password="";
$databasename="database_system";

$conn=new mysqli($servername,$username,$password,$databasename);

if ($conn->connect_error){
    echo "Connection is not found";
}
?>