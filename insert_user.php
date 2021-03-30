<?php
session_start();
include 'db_connection.php';
include 'gvar.php';

?>
<html>
<head>
<title> Customer </title>
</head>
<style >
#new{
	
	display: none;
}
</style>
<body>



<?php 

	if(isset($_SESSION['role'])&&($_SESSION['role']==1 || $_SESSION['role']==0 ))
	{
		if(isset($_REQUEST['numplate'])) // as first time we reach here it has numplate in ints url;
		$_SESSION['numplate']=$_REQUEST['numplate'];
		?>
	<div class='form'>
	<div class='existing'>
	<h2>Search Customer</h2>
	  <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	  <input type="text" name='licno' placeholder='Enter License No.'></input>
	  <input type="submit" name='user' value='NEXT'></input>
	 </div>
	  </form>
	  
	  <h2>New Customer</h2>
	   <button name='new_c' onclick="unhide()" >Register</button>
	  <div id='new'>
	 
	  <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	  <input type="text" name='n_licno' placeholder='Enter License No.' required></input>
	  <input type="text" name="cname" placeholder='Enter Customer Name' required></input>
	  <input type="number"name="cmob" placeholder='Enter Customer Mobile No.' required></input>
	  <input type="submit" name='new_user' value='Register'></input>
	  </div>
	 </div>




<?php

if(isset($_SERVER['REQUEST_METHOD']))
{
	$conn=OpenCon();
	
	if(isset($_REQUEST['user']))
	{
		$lino=trim($_REQUEST['licno']);
		$flag=Checkusers($conn,$lino);
		if($flag)
		{
			echo "User with $lino doesnot exist.<br>";
			$_SESSION['licno']=$lino;
			header('Location: rental.php');
		}
		else
		{
			echo "User with $lino doesnot exist.<br>";
		}
		CloseCon($conn);
		
		
	}
	else if(isset($_REQUEST['new_user']))
	{
		$n_lino=trim($_REQUEST['n_licno']);
		$cname=trim($_REQUEST['cname']);
		$cmob=trim($_REQUEST['cmob']);
		$flag=Insertusers($conn,$cname,$cmob,$n_lino);
		if($flag)
		{
			echo "User with $n_lino inserted Succesfully.<br>";
			$_SESSION['licno']=$n_lino;
			
			header('Location: rental.php');
		}
		else
		{
			echo "<br>Error Occured<br>";
		}
		
	}
}

?>

<script type="text/javascript">
	function unhide()
	{
		document.getElementById("new").style.display="block";
	}	
</script>

<?php 
	}
	 else
	 {
		 echo "you got anothorized access!<br>";
	 }
?>
</body>
</html>