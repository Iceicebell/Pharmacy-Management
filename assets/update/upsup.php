<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
	<link rel="stylesheet" href="updatecss/update.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<?php include_once("../connection.php");
	    $connection = connection();

        if(!isset($_SESSION)){
            session_start();
        }
        $id="";
        $name="";
        $adress="";
        $num="";
        $email="";

            if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
                if( !isset($_GET["id"])){
                    header("location: upsup.php");
                    exit;
                }

                $id= $_GET["id"];

                $query = "SELECT * FROM supplier WHERE supplier_id = $id";
                $result = $connection->query($query);
                $row1 = $result->fetch_assoc();

                    if(!$row1){
                        header("location: upsup.php");
                        exit;
                    }
                    $name=$row1['name'];
                    $adress=$row1['address'];
                    $num=$row1['phone_no'];
                    $email=$row1['email']; 
            }
            else{
                $id= $_POST["id"];
                $name= $_POST["name"];
                $address=$_POST["address"];
                $num=$_POST["num"];
                $email= $_POST["email"];
                    do{
                        $update = "UPDATE `supplier` SET `name`='$name',`address`='$address',`phone_no`='$num',`email`='$email' WHERE supplier_id=$id";
                        $result = $connection->query($update);

                        if(!$result){
                            $connection->error;
                            break;
                        }

                        header("location: ../suppliers.php");
                        exit;
                    }
                    while(false);
            } 
	if($_SESSION['UserLogin']){
        $sql = "SELECT * FROM admin";
		$user = $connection->query($sql) or die ($connection->error);
		$row = $user->fetch_assoc();
        ?>

<body>
    <div class="container">
        <div id="logo">
            <h1 class="logo">UPDATE</h1>
            <div class="CTA">
                <h1>VINCI.ENT</h1>
            </div>
        </div>

        <div class="leftbox">
            <nav>
                <a href="#" class="active">
                    <i class="fa-sharp fa-solid fa-gear"></i>
                </a>
                <a href="../suppliers.php" class="active">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </a>
            </nav>
        </div>
            <div class="rightbox">
                <div class="profile">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h1>Supplier</h1>
                            <h2>NAME</h2>
                        <input class="update" name="name" value="<?php echo $name?>"> </input>
                            <h2>ADDRESS</h2>
                        <input class="update" name="address" value="<?php echo $adress?>"> </input>
                            <h2>NO.</h2>
                        <input class="update" name="num" value="<?php echo $num?>"> </input>
                            <h2>EMAIL</h2>
                        <input class="update" name="email" value="<?php echo $email?>"> </input><button class="btn" type="submit">CHANGE</button>
                    </form>
                </div>

            </div>
    </div>

    <footer></footer>
</body>
</html>
<?php }
else{
	header("location:login.php");
}?>