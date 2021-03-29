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
<!.e_ins
{
	width: 40%;
	padding: 40px;
	position: absolute;
	top: 10%;
	left: 10%;
	transform: translate(-50%,-50%);
	background: #073b4c;
	text-align: center;
	border-radius: 25px;
}
<!.e_del
{	width: 40%;
	padding: 40px;
	position: absolute;
	top: 50%;
	left: 40%;
	transform: translate(-50%,-50%);
	background: #073b4c;
	text-align: center;
	border-radius: 25px;
}
>

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
	
	
	<?php	
	}
	else
		echo "you got anothorized access!<br>";
	?>
	

</body>
</html>
