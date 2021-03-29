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
	<h1>Update Employee Password</h1>
	<form class='box' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<input type='text' placeholder='Enter Employee Id' name='u_eid' required></input><br>
	<input type='password' placeholder='Enter New Password' name='u_pass' required></input><br>
	<br><br>

 <input type='submit' name='update' value='update'></input>
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
		if(isset($_POST['update']))
		{
			$eid=trim($_POST['u_eid']);
			$pass=trim($_POST['u_pass']);
			
			
			$conn=OpenCon();
			
			$flag=Updateemployees($conn,$eid,$pass)
			?>
			<div>
			<?php
			if($flag)
			{
				echo "Password Changed Succesfully<br>";
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