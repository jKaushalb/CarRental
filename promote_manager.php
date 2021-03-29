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
		<div>
	<h1>Change Role</h1>
	<form class='box' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<input type='text' placeholder='Enter Employee Id' name='p_eid' required></input><br>
	Select The Role: <br>
<input type='radio' value='Employee' name='role' checked >Employee</input><br>
<input type='radio' value='Manager' name='role' >Manager</input><br><br>

 <input type='submit' name='change' value='change'></input>
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
		if(isset($_POST['change']))
		{
			$emid=trim($_POST['p_eid']);
			$role=trim($_POST['role']);
			if($role=='Manager')
			{
				$role=1;
			}							#this if for insertion of employee 
			else
			{
					$role=0;
			}
			
			$conn=OpenCon();
			
			$flag=Promoteemployees($conn,$emid,$role)
			?>
			<div>
			<?php
			if($flag)
			{
				echo "$emid changed succesfully<br> ";
			}
			else
			{
				echo "Error Occured<br>";
			}
			CloseCon($conn);
		}
		
	}
?>
</div>
</body>
</html>