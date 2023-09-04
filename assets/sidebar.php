<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php include_once("connection.php");
	    $connection = connection();

        if(!isset($_SESSION)){
            session_start();
        }
	if($_SESSION['UserLogin']){?>

    <body>
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                        <span class="icon"><ion-icon name="medkit-outline"></ion-icon></span>
                        <span class="title">VINCI.ENT</span>
                        </a>
                    </li>

                    <li class="<?php if($page=="dashboard") echo "click"?>">
                        <a href="dashboard.php" >
                        <span class="icon"><ion-icon name="apps-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li class="<?php if($page=="customers") echo "click"?>">
                        <a href="customers.php" >
                        <span class="icon"><ion-icon name="body-outline"></ion-icon></span>
                        <span class="title">Customers</span>
                        </a>
                    </li>

                    <li class="<?php if($page=="suppliers") echo "click"?>">
                        <a href="suppliers.php" >
                        <span class="icon"><ion-icon name="medkit-outline"></ion-icon></span>
                        <span class="title">Suppliers</span>
                        </a>
                    </li>

                    <li class="<?php if($page=="medicines") echo "click"?>">
                        <a href="medicines.php">
                        <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
                        <span class="title">Medicines</span>
                        </a>
                    </li>

                    <li class="<?php if($page=="account") echo "click"?>">
                        <a href="account.php?id=1">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Account</span>
                        </a>
                    </li>
                    <li  class="<?php if($page=="signout") echo "click"?>">
                        <a href="logout.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                        </a>
                    </li>

                </ul>
            </div>
            
        </div>
        <script src="js/main.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> 
    </body>



    
    </html>
    <?php }
else{
	header("location:login.php");
}?>