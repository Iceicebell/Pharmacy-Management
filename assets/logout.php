<?php
	session_start();
	session_destroy();
	unset($_SESSION['UserLogin']);
	unset($_SESSION['Usertype']);


		echo "<script>
		alert('Log out successfully');
		window.location.href='login.php';
		</script>";
	
