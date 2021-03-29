<?php

session_start();
include "db_connection.php";

?>

<html>
<head>
	<meta charset="utf-8">
	<title>MANAGER</title>
	


</head>
<body>
<?php 
	if(isset($_SESSION['role'])&&$_SESSION['role']==1)
	{
		?>
	<div class ='e_del'>
	<h1>Delete Employee</h1>
	<form class='box1' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<input type='text' placeholder='ENTER EMPLOYEE ID ' name='del_eid' required></input><br>
	<input type='password' placeholder='ENTER USERNAME ' name='del_uname' required></input><br>
	

 <input type='submit' name='delete' value='delete'></input>
	</form>
	</div>
	<?php	
	}
	else
		echo "you got anothorized access!<br>";
	?>
	
	
<?php
	if(isset($_SERVER['REQUEST_METHOD']))
	{
		if(isset($_POST['delete']))
		{
			$eid=trim($_POST['del_eid']);
			$uname=trim($_POST['del_uname']);
			
			
			$conn=OpenCon();
			
			if(Deleteemployees($conn,$eid,$uname))
			{
				echo "Record with $eid and $uname is deleted<br>";
			}
			else
			{
				mysqli_error($conn);
				echo "Error occured<br>";
			}
			CloseCon($conn);
		}
		
	}
?>
</body>
</html>