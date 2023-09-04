<?php $page="medicines";
include("sidebar.php"); 
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
					$sql="SELECT medicine.medicine_id, medicine.medicine_name, medicine.stock, medicine.exp_date, supplier.name, medicine.price FROM medicine INNER JOIN supplier ON supplier.supplier_id = medicine.supplier_id ORDER BY medicine_name $sort_option ";
					$medicine=$connection->query($sql) or die($connection->error);
					$row=$medicine->fetch_assoc(); 
					
					if(isset($_POST['submit'])){
						$id=$_POST['id'];
						$name=$_POST['medname'];
						$amount=$_POST['amount'];
						$exp=$_POST['expdate'];
						$supid=$_POST['supid'];
						$price=$_POST['price'];
						
						$query = "SELECT * FROM supplier WHERE supplier_id = '$supid'";
						$med = $connection->query($query) or die ($connection->error);
						$row1 = $med->fetch_assoc();
							 if($row1 > 0) {
														$insert="INSERT INTO `medicine`(`medicine_no`,`medicine_name`,`stock`,`exp_date`,`supplier_id`,`price`) VALUES ('$id','$name','$amount','$exp','$supid','$price')";
														$connection->query($insert) or die($connection->error);
														echo "<script>
																alert('Medicine added successfully');
																window.location.href='medicines.php';
																</script>";
																	}  
																	else{ echo '<script>alert("No Supplier Found!")</script>';}}
													?>
														
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
	<link rel="stylesheet" href="css/medicines.css">
</head>

<body>
    
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
					<h2>Medicines</h2>
					<form action="" method="GET">
					<div>
						<label for="order" class="order">Order By:</label>
						<select name="sort"  class="select">
								<option value="NAMEASC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "NAMEASC"){echo "selected"; } ?>>Name ASC</option>
								<option value="NAMEDESC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "NAMEDESC"){echo "selected"; } ?>>Name DESC</option>
						</select>
						<button class="sort">Sort</button>
					</div>
					</form>
				</div>

				<table>
					<thead>
						<tr>
							<td>Medicine ID</td>
							<td>Medicine Name</td>
							<td>Stock</td>
							<td>Exp Date</td>
							<td>Supplier Name</td>
							<td>Price</td>
						</tr>
					</thead>

					<tbody>
				<?php do{ ?>
						  <tr>
						  <td><?php echo $row['medicine_id']; ?></td>
						  <td><?php echo $row['medicine_name']; ?></td>
						  <td><?php echo $row['stock']; ?></td>
						  <td><?php echo $row['exp_date']; ?></td>
						  <td><?php echo $row['name']; ?></td>
						  <td><?php echo $row['price']; ?></td>
						  <td> <a href='update/upmed.php?id=<?php echo $row['medicine_id']?>' class="update"> <ion-icon name="pencil-outline"></ion-icon> </a> </td>
						  <td> <a href='delete/deletemed.php?id=<?php echo $row['medicine_id']?>' class='delete'> <ion-icon name='trash-outline'></ion-icon> </a> </td>
					</tr>
					</tbody>

				<?php }while($row=$medicine->fetch_assoc()); ?>
				</table>
			</div>
			<!--==========ADDING MEDICINES===============-->
			<div class="newMedicines">
						<div class="cardHeader">
							<h2>New Medicine</h2>
						</div>
							<form id="addmed" class='input-group-log-in' method='POST'>

								<input type="text" class='input-field' placeholder='Medicine Number' name='id' required>
								<input type="text" class='input-field' placeholder='Medicine Name' name='medname' required>
								<input type="text" class='input-field' placeholder='Amount' name='amount' required>
								<input type="date" class='input-field' placeholder='Exp Date.' name='expdate' required>
								<input type="text" class='input-field' placeholder='Supplier ID' name='supid' required>
								<input type="text" class='input-field' placeholder='Price' name='price' required>
								<button type='submit' class='add' name="submit">Add</button>
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