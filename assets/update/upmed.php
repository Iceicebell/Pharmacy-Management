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
        $stock="";
        $exp="";
        $sup="";
        $price="";

            if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
                if( !isset($_GET["id"])){
                    header("location: upmed.php");
                    exit;
                }

                $id= $_GET["id"];

                $query = "SELECT * FROM medicine WHERE medicine_id=$id";
                $result = $connection->query($query);
                $row1 = $result->fetch_assoc();

                    if(!$row1){
                        header("location: upmed.php");
                        exit;
                    }
                    $name=$row1['medicine_name'];
                    $stock=$row1['stock'];
                    $exp=$row1['exp_date'];
                    $sup=$row1['supplier_id']; 
                    $price=$row1['price']; 
            }
            else{
                $id= $_POST["id"];
                $no= $_POST["medicine_no"];
                $name= $_POST["name"];
                $stock=$_POST["stock"];
                $sup=$_POST["sup"];
                $exp= $_POST["exp"];
                $price= $_POST["price"];
                    do{
                        $update = "UPDATE `medicine` SET `medicine_no`='$no',`medicine_name`='$name',`stock`='$stock',`exp_date`='$exp',`supplier_id`='$sup',`price`='$price' WHERE medicine_id=$id";
                        $result = $connection->query($update);

                        if(!$result){
                            $connection->error;
                            break;
                        }

                        header("location: ../medicines.php");
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
            <h1 class="logo">Settings</h1>
            <div class="CTA">
                <h1>VINCI.ENT</h1>
            </div>
        </div>

        <div class="leftbox">
            <nav>
                <a href="#" class="active">
                    <i class="fa-sharp fa-solid fa-gear"></i>
                </a>
                <a href="../medicines.php" class="active">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </a>
            </nav>
        </div>
            <div class="rightbox">
                <div class="profile">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h1>Account</h1>
                            <h2>MEDICINE NO</h2>
                        <input class="update" name="no" value="<?php echo $id; ?>"> </input>
                            <h2>MEDICINE NAME</h2>
                        <input class="update" name="name" value="<?php echo $name; ?>"> </input>
                            <h2>STOCK</h2>
                        <input class="update" name="stock" value="<?php echo $stock; ?>"> </input>
                            <h2>EXP DATE</h2>
                        <input type="date" class="update" name="exp" value="<?php echo $exp; ?>"> </input>
                            <h2>SUPPLIER</h2>
                        <input class="update" name="sup" value="<?php echo $sup; ?>"> </input>
                            <h2>PRICE</h2>
                        <input class="update" name="price" value="<?php echo $price; ?>"> </input><button type="submit" class="btn">CHANGE</button>
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