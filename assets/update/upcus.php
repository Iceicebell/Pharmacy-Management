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
        $address="";
        $num="";
        $age="";

            if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
                if( !isset($_GET["id"])){
                    header("location: upcus.php");
                    exit;
                }

                $id= $_GET["id"];

                $query = "SELECT * FROM customer WHERE customer_id=$id";
                $result = $connection->query($query);
                $row1 = $result->fetch_assoc();

                    if(!$row1){
                        header("location: upcus.php");
                        exit;
                    }
                    $name=$row1['name'];
                    $address=$row1['address'];
                    $num=$row1['phone_no'];
                    $age=$row1['age']; 
            }
            else{
                $id= $_POST["id"];
                $name= $_POST["name"];
                $address=$_POST["address"];
                $num= $_POST["num"];
                $age= $_POST["age"];
                    do{
                        $update = "UPDATE `customer` SET `name`='$name',`address`='$address',`phone_no`='$num',`age`='$age' WHERE customer_id= $id";
                        $result = $connection->query($update);

                        if(!$result){
                            $connection->error;
                            break;
                        }

                        header("location: ../customers.php");
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
            <h1 class="logo">Customer</h1>
            <div class="CTA">
                <h1>VINCI.ENT</h1>
            </div>
        </div>

        <div class="leftbox">
            <nav>
                <a href="#" class="active">
                    <i class="fa-sharp fa-solid fa-gear"></i>
                </a>
                <a href="../customers.php" class="active">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </a>
            </nav>
        </div>
            <div class="rightbox">
                <div class="profile">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h1>UPDATE</h1>
                            <h2>NAME</h2>
                        <input class="update" name="name" value="<?php echo $name; ?>"> </input>
                            <h2>ADDRESS</h2>
                        <input class="update" name="address" value="<?php echo $address; ?>"> </input>
                            <h2>No.</h2>
                        <input class="update" name="num" value="<?php echo $num; ?>"> </input>
                            <h2>AGE</h2>
                        <input class="update" name="age" value="<?php echo $age; ?>"> </input><button class="btn" type="submit">CHANGE</button>
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