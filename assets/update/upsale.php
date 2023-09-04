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
        $cid="";
        $mid="";
        $quantity="";
        $amount="";
        $purchasedate="";

            if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
                if( !isset($_GET["id"])){
                    header("location: upsale.php");
                    exit;
                }

                $id= $_GET["id"];

                $query = "SELECT * FROM purchase WHERE purchase_id=$id";
                $result = $connection->query($query);
                $row1 = $result->fetch_assoc();


                    if(!$row1){
                        header("location: upsale.php");
                        exit;
                    }
                    $cid=$row1['customer_id'];
                    $mid=$row1['medicine_id'];
                    $quantity=$row1['quantity'];
                    $purchasedate=$row1['purchase_date'];

                    
            }
            else{

                $id= $_POST["id"];
                $cid= $_POST["cid"];
                $mid=$_POST["mid"];
                $quantity=$_POST["quantity"];
                $purchasedate= $_POST["purchasedate"];

                $query2 = "SELECT * FROM medicine WHERE medicine_id = '$mid'";
                $result2 = $connection->query($query2) or die ($connection->error);
                $row2 =  $result2->fetch_assoc();

                $amount=$quantity*$row2['price'];

                    do{
                        $update = "UPDATE `purchase` SET `purchase_date`='$purchasedate',`medicine_id`='$mid',`quantity`='$quantity',`total_price`='$amount',`customer_id`='$cid' WHERE purchase_id=$id";
                        $result = $connection->query($update);

                        if(!$result){
                            $connection->error;
                            break;
                        }

                        header("location: ../viewall.php");
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
                <a href="../dashboard.php" class="active">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </a>
            </nav>
        </div>
            <div class="rightbox">
                <div class="profile">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h1>SALES</h1>
                            <h2>Customer ID</h2>
                        <input class="update" name="cid" value="<?php echo $cid; ?>"> </input>
                            <h2>Medicine ID</h2>
                        <input class="update" name="mid" value="<?php echo $mid; ?>"> </input>
                            <h2>QUANTITY</h2>
                        <input class="update" name="quantity" value="<?php echo $quantity; ?>"> </input>
                            <h2>PURCHASE DATE</h2>
                        <input class="update" type="date" name="purchasedate" value="<?php echo $purchasedate; ?>"> </input><button type="submit" class="btn">CHANGE</button>
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