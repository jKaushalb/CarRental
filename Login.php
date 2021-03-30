<!DOCTYPE html>
<?php 

session_start();
$role=-1;


include 'db_connection.php';

?>
<html>
<head>
	<meta charset="utf-8">
	<title>LOG IN</title>
	<link rel="stylesheet" type="text/css" href="LoginStyle.css">
</head>
<body>
	<form class="box" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<h1>LOGIN</h1>
		<input type="text" name="uname" placeholder="Username" required></input><br><br>
		<input type="password" name="pass" placeholder="Password" required></input><br>
		<input type="submit" name="login" value="Login">
	</form>
</body>
<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	if(isset($_POST['login']))
	{
		if(isset($_POST['uname'])&&$_POST['pass'])
		{
			$uname=trim($_POST['uname']);
			$pass=trim($_POST['pass']);
			$conn=OpenCon();  #openening database connection to check credentails
			
			$role=login($conn,$uname,$pass);
			$ed=eid($conn,$uname,$pass);
			echo $uname." ".$pass." ".$role." ".$ed."<br>";
			if($role>=0)
			{
				$_SESSION["role"]=$role;
				$_SESSION["uname"]=$uname;
				$_SESSION["pass"]=$pass;
				$_SESSION['eid']=$ed;
				
				if($role==1)
				{
					CloseCon($conn);
					sleep(2);//after 2 sec redirection will be happen
					header ("Location: manager.php");
					
				}
				else
				{
					sleep(2);
					header ("Location: emplyoee.php");
				}
				
			}
			
		}
		else
		{
			echo "Enter Valid Credentials<br>";
		}
		
	}
}

?>

</html>