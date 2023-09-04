<?php
function connection(){
    $host="localhost";
$username="root";
$password="";
$database="pharmacy_management";

$connect=new mysqli($host,$username,$password,$database);

if($connect->connect_error){
    die('Connection failed'.$connection->connect_error);
}
else{
    return $connect;
}
}
?>