<?php $page="account"?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pharmacy Management</title>
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<section>
</section>
<body>
<?php include_once("connection.php");
	    $connection = connection();

        if(!isset($_SESSION)){
            session_start();
        }
                    ?>
<div class="background">
	<div id='login-form'class="login-page">
			<div class="form-box">
				<h1 class="blank">Log In</h1>
				<form id="login" class='input-group-log-in' method='POST'>
					<input type="text" class='input-field' placeholder='Username' name='logname' required>
					<input type="text" class='input-field' placeholder='Password' name='logpass' required>
					<button type='submit' name="submit" class='signup'>Log In</button>
					<?php
   						if(isset($_POST['submit'])){
							$username = $_POST['logname'];
							$password = $_POST['logpass'];
					
								$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
								$user = $connection->query($sql) or die ($connection->error);
								$row = $user->fetch_assoc();
								$total = $user->num_rows;
									if ($total > 0) {
										$_SESSION['UserLogin'] = $row['username'];
											echo header("Location: dashboard.php");
													}  
									else{ ?>
											<h3 class="error1">No account found!</h3>
										<?php }
   													}?>
				</form>

            </div>
    </div>
</div>


</body>