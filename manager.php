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
	<div class='e_ins'>
	<form class='box' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<input type='text' placeholder='ENTER USERNAME' name='new_user'></input><br>
	<input type='password' placeholder='ENTER PASWORD' name='new_pass'></input><br>
	Select Your Role: <br>
<input type='radio' value='Employee' name='role' checked >Employee</input><br>
<input type='radio' value='Manager' name='role' >Manager</input><br><br>

 <input type='submit' name='insert' value='insert'></input>
	</form>
	</div>
	
	<div class ='e_del'>
	<form class='box1' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<input type='text' placeholder='ENTER EMPLOYEE ID ' name='del_eid'></input><br>
	<input type='password' placeholder='ENTER USERNAME ' name='del_uname'></input><br>
	

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
			
			Insertemployees($conn,$uname,$pass,$role);
			CloseCon($conn);
		}
		
		if(isset($_POST['delete']))
		{
			$eid=trim($_POST['del_eid']);
			$uname=trim($_POST['del_uname']);
			
			
			$conn=OpenCon();
			
			if(Deleteemployees($conn,$eid,$uname))
			{
				echo "record deleted<br>";
			}
			else
			{
				echo "Error occured<br>";
			}
			CloseCon($conn);
		}
	}

?>
</body>
</html>
