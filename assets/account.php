<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management 2</title>
	<link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<?php include_once("connection.php");
	    $connection = connection();

        if(!isset($_SESSION)){
            session_start();
        }
        $id="";
        $name="";
        $password="";

            if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
                if( !isset($_GET["id"])){
                    header("location: account.php");
                    exit;
                }

                $id= $_GET["id"];

                $query = "SELECT * FROM admin WHERE id=$id";
                $result = $connection->query($query);
                $row1 = $result->fetch_assoc();

                    if(!$row1){
                        header("location: account.php");
                        exit;
                    }
                    $username=$row1['username'];
                    $password=$row1['password']; 
            }
            else{
                $id= $_POST["id"];
                $username= $_POST["username"];
                $password= $_POST["password"];
                    do{
                        $update = "UPDATE `admin` SET `username`='$username',`password`='$password' WHERE id=$id";
                        $result = $connection->query($update);

                        if(!$result){
                            $connection->error;
                            break;
                        }

                        header("location: account.php?id=1");
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
                <a href="dashboard.php" class="active">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </a>
                <a href="logout.php" class="active">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </nav>
        </div>
            <div class="rightbox">
                <div class="profile">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h1>Account</h1>
                            <h2>USERNAME</h2>
                        <input name="username" class="update" value="<?php echo $username?>">
                            <h2>PASSWORD</h2>
                        <input name="password" class="update" value="<?php echo $password?>"> </input><button type="submit" class="btn">CHANGE</button>
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