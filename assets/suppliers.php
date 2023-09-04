<?php $page="suppliers"?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
	<link rel="stylesheet" href="css/supplier.css">
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
			$sql="SELECT * FROM supplier ORDER BY name $sort_option";
			$suppliers=$connection->query($sql) or die($connection->error);
			$row=$suppliers->fetch_assoc();
			
			if(isset($_POST['submit'])){
				$name=$_POST['supname'];
				$address=$_POST['supadd'];
				$phone=$_POST['supnum'];
				$email=$_POST['supemail'];
				
			
					$insert="INSERT INTO `supplier`(`name`,`address`,`phone_no`,`email`) VALUES ('$name','$address','$phone','$email')";
					$connection->query($insert) or die($connection->error);
					echo "<script>
					alert('Supplier added successfully');
					window.location.href='suppliers.php';
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
					<h2>Suppliers</h2>
					<form action="" method="GET">
					<div>
						<label for="cars" class="order">Order By:</label>
						<select name="sort" class="select">
								<option value="NAMEASC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "NAMEASC"){echo "selected"; } ?> >Name (A - Z)</option>
								<option value="NAMEDESC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "NAMEDESC"){echo "selected"; } ?>>Name (Z - A)</option>
						</select>
						<button type="submit" class="sort">Sort</button>
					</div>
					</form>
				</div>

				<table>
					<thead>
						<tr>
							<td>Supplier ID</td>
							<td>Name</td>
							<td>Address</td>
							<td>Phone No.</td>
							<td>Email</td>
							<td>Settings</td>
						</tr>
					</thead>

					<tbody>
					<?php do{ ?>
						  <tr>
						  <td><?php echo $row['supplier_id']; ?></td>
						  <td><?php echo $row['name']; ?></td>
						  <td><?php echo $row['address']; ?></td>
						  <td><?php echo $row['phone_no']; ?></td>
						  <td><?php echo $row['email']; ?></td>
						  <td> <a href='update/upsup.php?id=<?php echo $row['supplier_id']?>' class="update"> <ion-icon name="pencil-outline"></ion-icon> </a> </td>
						  <td> <a href='delete/deletesup.php?id=<?php echo $row['supplier_id']?>' class='delete'> <ion-icon name='trash-outline'></ion-icon> </a> </td>
					</tr>
					
						
					</tbody>
					<?php }while($row=$suppliers->fetch_assoc());?>
				</table>
				</div>
						<!--==========ADDING SUPPLIERS===============-->
						<div class="newSupplier">
						<div class="cardHeader">
							<h2>New Medicine</h2>
						</div>
							<form id="login" class='input-group-log-in' method='POST'>
								
								<input type="text" class='input-field' placeholder='Supplier Name' name='supname' required>
								<input type="text" class='input-field' placeholder='Supplier Address' name='supadd' required>
								<input type="text" class='input-field' placeholder='Supplier Phone No.' name='supnum' required>
								<input type="text" class='input-field' placeholder='Supplier Email.' name='supemail' required>
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