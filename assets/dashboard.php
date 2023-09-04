<?php $page="dashboard"?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
	<link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
	<?php include("sidebar.php"); 
	if($_SESSION['UserLogin']){
		$sql_customers = "SELECT * from customer";
		$sql_suppliers = "SELECT * from supplier";
		$sql_sales = "SELECT * from purchase";
		$sql_medicines = "SELECT SUM(stock) AS stock from medicine";
		$customers=$connection->query($sql_customers) or die($connection->error);
		$suppliers=$connection->query($sql_suppliers) or die($connection->error);
		$sales=$connection->query($sql_sales) or die($connection->error);


		if(isset($_POST['submit'])){
			$cusid=$_POST['cusid'];
			$medid=$_POST['medid'];
			$quantity=$_POST['quantity'];
			$amount="";
			$date=$_POST['purchasedate'];

			$total = "SELECT * FROM medicine WHERE medicine_id = '$medid'";
			$total1 = $connection->query($total) or die ($connection->error);
			$total2 = $total1->fetch_assoc();

				$amount=$quantity*$total2['price'];

			$query1 = "SELECT * FROM customer WHERE customer_id = '$cusid'";
			$sale1 = $connection->query($query1) or die ($connection->error);
			$row1 = $sale1->fetch_assoc();
				 if($row1 > 0) {
					$query2 = "SELECT * FROM medicine WHERE medicine_id = '$medid'";
					$sale2 = $connection->query($query2) or die ($connection->error);
					$row2 = $sale2->fetch_assoc();
						if($row1 > 0) {
											$insert="INSERT INTO `purchase`(`purchase_date`, `medicine_id`, `quantity`, `total_price`, `customer_id`) VALUES ('$date','$medid','$quantity','$amount','$cusid')";
											$update="UPDATE `medicine` SET `stock`=`stock`- $quantity WHERE medicine_id = $medid";
											$connection->query($insert) or die($connection->error);
											$connection->query($update) or die($connection->error);
											echo "<script>
													alert('Pruchase addedd successfully');
													window.location.href='dashboard.php';
													</script>";
														}
						else {echo '<script>alert("No Medicine Found!")</script>';}
								}
						else{ echo '<script>alert("No Customer Found!")</script>';}

							}
					
		?>
	<div class="container">
		<!--==========Topbar===============-->
	<div class="main">
		<div class="topbar">
			<div class="toggle">
				<ion-icon name="grid-outline"></ion-icon>
			</div>

			<div class="search">
				<label>
					<input type="text" placeholder="Search here">
					<ion-icon name="search-outline"></ion-icon>
				</label>
			</div>

			<div class="user">
				<img src="img/ice bear.png" alt="">
			</div>
		</div>

		<!--==========Card Box===============-->
		<div class="cardBox">
			<div class="card">
				<div class="box">
					<div class="numbers"><?php 
		if($suppliers_total = mysqli_num_rows($suppliers)){
			echo $suppliers_total;
		} ?></div>
					<li>
					<a href="suppliers.php?" class="cardName">Suppliers</a>
					</li>
				</div>

				<div class="iconBx">
					
					<ion-icon name="medkit-outline"></ion-icon>
				</div>
				</div>

			<div class="card">
				<div>
					<div class="numbers"><?php 
		if($sales_total = mysqli_num_rows($sales)){
			echo $sales_total;
		} ?></div>
					<a href="#" class="cardName">Sales</a>
				</div>

				<div class="iconBx">
					<ion-icon name="cash-outline"></ion-icon>
				</div>
			</div>
			<div class="card">
				<div>
					<div class="numbers"><?php 
		if($customers_total = mysqli_num_rows($customers)){
			echo $customers_total;
		} ?></div>
					<a href="customers.php" class="cardName">Customers</a>
				</div>

				<div class="iconBx">
					<ion-icon name="accessibility-outline"></ion-icon>
				</div>
			</div>
			<div class="card">
				<div>
					<div class="numbers">
						<?php $medicines=$connection->query($sql_medicines) or die($connection->error);
						while($row = mysqli_fetch_assoc($medicines)){
							$output=$row['stock'];
							echo $output;}?>
					</div>
					<a href="medicines.php" class="cardName">Medicines</a>
				</div>

				<div class="iconBx">
					<ion-icon name="cart-outline"></ion-icon>
				</div>
			</div>

		</div>

		<!--==========Recent Pruchase===============-->
		<div class="details">
			<div class="recentOrders">
				<div class="cardHeader">
					<h2>Recent Purchaces</h2>
					<a href="viewall.php"><h2>VIEW ALL</h2></a>
				</div>

				<table>
					<thead>
						<tr>
							<td>Name</td>
							<td>Medicine Name</td>
							<td>Quantity</td>
							<td>Amount</td>
							<td>Date</td>
						</tr>
					</thead>
					<tbody>
				<?php 
				
				$sql="SELECT customer.name, medicine.medicine_name,purchase.quantity, purchase.total_price, purchase.purchase_date FROM purchase INNER JOIN customer ON customer.customer_id=purchase.customer_id INNER JOIN medicine ON medicine.medicine_id=purchase.medicine_id ORDER BY purchase_date DESC LIMIT 10";
				$purchase=$connection->query($sql) or die($connection->error);
				$row=$purchase->fetch_assoc(); 
						do{
					echo "<tr>
						  <td>".$row['name']."</td>
						  <td>".$row['medicine_name']."</td>
						  <td>".$row['quantity']."</td>
						  <td>".$row['total_price']."</td>
						  <td>".$row['purchase_date']."</td>"
				?>
					</tbody>

				<?php }while($row=$purchase->fetch_assoc()); 

																?>
				
				</table>
			</div>
			<div class="newMedicines">
						<div class="cardHeader">
							<h2>New Purchase</h2>
						</div>
							<form id="addmed" class='input-group-log-in' method='POST'>
								<input type="text" class='input-field' placeholder='Customer Id' name='cusid' required>
								<input type="text" class='input-field' placeholder='Medicine Id' name='medid' required>
								<input type="text" class='input-field' placeholder='Quantity' name='quantity' required>
								<input type="date" class='input-field' placeholder='Date of Purchase.' name='purchasedate' required>
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
</html>

<?php }
else{
	header("location:login.php");
}?>