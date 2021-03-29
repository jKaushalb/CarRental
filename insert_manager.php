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
	<div class='e_ins'>
	<h1>Insert Employee</h1>
	<form class='box' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<input type='text' placeholder='ENTER USERNAME' name='new_user' required></input><br>
	<input type='password' placeholder='ENTER PASWORD' name='new_pass' required></input><br>
	Select Your Role: <br>
<input type='radio' value='Employee' name='role' checked >Employee</input><br>
<input type='radio' value='Manager' name='role' >Manager</input><br><br>

 <input type='submit' name='insert' value='insert'></input>
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
		if(isset($_POST['insert']))
		{
			$uname=trim($_POST['new_user']);
			$pass=trim($_POST['new_pass']);
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
			
			$flag=Insertemployees($conn,$uname,$pass,$role);
			?>
			<div>
			<?php
			if($flag)
			{ 
				
				echo "Employee $uname  has been inserted successfully!<br>";
			}
			else
			{
				echo "Error occure<br> ";
				echo mysqli_error($conn);
			}
			CloseCon($conn);
			?>
			</div>
			<?php
		}
		
	}
?>
</body>
</html>