<?php $page="customers"?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
	<link rel="stylesheet" href="css/customers.css">
</head>

<body>
    <?php include("sidebar.php"); 
	if($_SESSION['UserLogin']){

		$sort_option="";
                if(isset($_GET['sort'])){
                    if($_GET['sort'] == "NAMEASC" ){

                        $sort_option="ASC";
                    }
                    else{
                        $sort_option="DESC";
                    }
                    
                }

		$sql="SELECT * FROM customer ORDER BY name $sort_option";
		$customers=$connection->query($sql) or die($connection->error);
		$row=$customers->fetch_assoc();


	if(isset($_POST['submit'])){
    $name=$_POST['cusname'];
	$address=$_POST['cusadd'];
	$phone=$_POST['cusnum'];
	$age=$_POST['cusage'];
    

    	$insert="INSERT INTO `customer`(`name`,`address`,`phone_no`,`age`) VALUES ('$name','$address','$phone','$age')";
    	$connection->query($insert) or die($connection->error);
    	echo "<script>
			alert('Customer addedd successfully');
			window.location.href='customers.php';
			</script>";
		}

?>

	<div class="container">
		<!--==========Topbar===============-->
	<div class="main">
		<div class="topbar">
			<div class="toggle">
				<ion-icon name="grid-outline"></ion-icon>
			</div>


			<div class="user">
				<img src="img/ice bear.png" alt="">
			</div>
		</div>

		<!--==========Recent Pruchase===============-->

		<div class="details">
			<div class="recentOrders">
				<div class="cardHeader">
					<h2>Customers</h2>
					<form action="" method="GET">
					<div >
						<label for="sort" class="order">Order By:</label>
						<select name="sort" id="sort" class="select">
								<option value="NAMEASC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "NAMEASC"){echo "selected"; } ?> class="option">Name (A - Z)</option>
								<option value="NAMEDESC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "NAMEDESC"){echo "selected"; } ?> class="option">Name (Z - A)</option>
						</select>
						<button type="submit" class="sort">SORT</button>
					</div>
					</form>
				</div>
		
				<table>

					<thead>
						<tr>
							<td>Customer ID</td>
							<td>Name</td>
							<td>Address</td>
							<td>Phone No.</td>
							<td>Age</td>
							<td>Settings</td>
						</tr>
					</thead>
					<tbody>
				<?php do{ ?>
					<tr>
						  <td><?php echo $row['customer_id']; ?></td>
						  <td><?php echo $row['name']; ?></td>
						  <td><?php echo $row['address']; ?></td>
						  <td><?php echo $row['phone_no']; ?></td>
						  <td><?php echo $row['age']; ?></td>
						  <td> <a href='update/upcus.php?id=<?php echo $row['customer_id']?>' class="update"> <ion-icon name="pencil-outline"></ion-icon> </a> </td>
						  <td> <a href='delete/deletecus.php?id=<?php echo $row['customer_id']?>' class='delete'> <ion-icon name='trash-outline'></ion-icon> </a> </td>
					</tr>

					
						
					</tbody>
					<?php }while($row=$customers->fetch_assoc());?>
				</table>
			</div>
			<!--==========Add Customers===============-->	
			<div class="newCustomers">
						<div class="cardHeader">
							<h2>New Customers</h2>
						</div>
							<form id="addcus" class='input-group-log-in' method='POST'>
								
								<input type="text" class='input-field' placeholder='Name' name='cusname' required>
								<input type="text" class='input-field' placeholder='Address' name='cusadd' required>
								<input type="text" class='input-field' placeholder='Phone No.' name='cusnum' required>
								<input type="text" class='input-field' placeholder='age' name='cusage' required>
								<button type='submit' class='signup' name="submit">Add</button>
							</form>
					</div>
		</div>

	</div>
	</div>
		<script src="js/main.js"></script>
		<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> 
</body>
<?php }
else{
	header("location:login.php");
}?>




