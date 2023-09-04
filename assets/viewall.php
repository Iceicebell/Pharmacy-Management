<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
	<link rel="stylesheet" href="css/viewall.css">
</head>

<body>
	<?php include("sidebar.php"); 
	if($_SESSION['UserLogin']){
					
		?>
	<div class="container">
	    <div class="main">
		    <!--==========Recent Pruchase===============-->
		    <div class="details">
			    <div class="recentOrders">
				    <div class="cardHeader">
					    <h2>Recent Purchaces</h2>
                        <form action="" method="GET">
                        <div >
						        <label for="sort" class="order">Order By:</label>
						            <select name="sort" id="sort" class="select">
                                        <option value="DATEASC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "DATEASC"){echo "selected"; } ?> class="option">Date ASC</option>
                                        <option value="DATEDESC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "DATEDESC"){echo "selected"; } ?> class="option">Date DESC</option>
						            </select>
						                <button type="submit" class="sort">SORT</button>
					    </div>
                        </form>
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
				<?php 
				$sort_option="";
                if(isset($_GET['sort'])){
                    if($_GET['sort'] == "DATEASC" ){

                        $sort_option="ASC";
                    }
                    else{
                        $sort_option="DESC";
                    }
                    
                }
				$sql="SELECT customer.name, medicine.medicine_name,purchase.quantity, purchase.purchase_id, purchase.total_price, purchase.purchase_date FROM purchase INNER JOIN customer ON customer.customer_id=purchase.customer_id INNER JOIN medicine ON medicine.medicine_id=purchase.medicine_id ORDER BY purchase_date $sort_option";
				$purchase=$connection->query($sql) or die($connection->error);
				$row=$purchase->fetch_assoc(); 
					 do{ ?>
							<tr>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['medicine_name']; ?></td>
							<td><?php echo $row['quantity']; ?></td>
							<td><?php echo $row['total_price']; ?></td>
							<td><?php echo $row['purchase_date']; ?></td>
							<td> <a href='update/upsale.php?id=<?php echo $row['purchase_id']?>' class="update"> <ion-icon name="pencil-outline"></ion-icon> </a> </td>
							<td> <a href='delete/deletesale.php?id=<?php echo $row['purchase_id']?>' class='delete'> <ion-icon name='trash-outline'></ion-icon> </a> </td>
					  </tr>

				<?php }while($row=$purchase->fetch_assoc()); 

																?>
				
				</table>
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