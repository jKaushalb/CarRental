<?php
session_start();
include 'db_connection.php';
include 'gvar.php';

?>
<html>
<head>
	<meta charset="utf-8">
	<title>MANAGER</title>
	
<style>


</style>
</head>
<body>
<?php 
	if(isset($_SESSION['role'])&&$_SESSION['role']==1)
	{
		?>
	<button ><a href="./insert_manager.php">Insert Employee</a></button>
	<button ><a href="./delete_manager.php">Delete Employee</a></button>
	<button ><a href="./update_manager.php">Update Password</a></button>
	<button ><a href="./promote_manager.php">Promote Employee</a></button>
	<button ><a href="./insert_car_manager.php">Insert Car</a></button>
	<button ><a href="./update_car_manager.php">Update Car</a></button>
	
	
	
	<?php	
	}
	else
		echo "you got anothorized access!<br>";
	?>
	

</body>
</html>
