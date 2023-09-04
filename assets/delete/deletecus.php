<?php 
include "../connection.php";
$connection = connection();

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $delete = "DELETE FROM customer WHERE customer_id = '$id'";
        $connection->query($delete) or die ($connection->error);
        echo header("Location: ../customers.php");
    }

?>