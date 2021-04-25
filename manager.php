<?php
session_start();
include 'db_connection.php';
include 'gvar.php';

?>
<?php

	
	function findcar($conn,$numplt)
	{
		$sql = "SELECT * FROM `cars` WHERE `numberplate` = '$numplt'";
		$result = mysqli_query($conn,$sql);
		$arr=array();
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($arr,$row);
			//echo $row['numberplate']."<br>";
			
		}
		if(count($arr))
		{
			return $arr;
		}
		else
		{
			echo "No data found";
			mysqli_error($conn);
			return null;
		}
		
	}
	function display_non_rentedcars($conn)
	{
		$sql = "SELECT * FROM `cars` WHERE `rented` != 1";
        $result = mysqli_query($conn,$sql);
		$arr=array();
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($arr,$row);
			//echo $row['numberplate']."<br>";
			
		}
		if(count($arr))
		{
			return $arr;
		}
		else
		{
			//echo "ALL CARS ARE RENTED NO DATA FOUND<br>";
			mysqli_error($conn);
			return null;
		}
	}
	function display_cars($conn)
	{
		$sql = "SELECT * FROM `cars` WHERE 1 = 1";
        $result = mysqli_query($conn,$sql);
		$arr=array();
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($arr,$row);
			//echo $row['numberplate']."<br>";
			
		}
		if(count($arr))
		{
			return $arr;
		}
		else
		{
			//echo "No data found";
			mysqli_error($conn);
			return false;
		}
	}

?>
<html>
<head>
	<meta charset="utf-8">
	<title>MANAGER</title>
	
<style>


</style>
</head>
<body>
<div class="menu">
<?php 
	if(isset($_SESSION['role'])&&$_SESSION['role']==$manager)
	{
		?>
	<button ><a href="./insert_manager.php">Insert Employee</a></button>
	<button ><a href="./delete_manager.php">Delete Employee</a></button>
	<button ><a href="./update_manager.php">Update Password</a></button>
	<button ><a href="./promote_manager.php">Promote Employee</a></button>
	<button ><a href="./insert_car_manager.php">Insert Car</a></button>
	<button ><a href="./update_car_manager.php">Update Car</a></button>
	<button ><a href="./delete_car_manager.php">Delete Car</a></button>
	<div>
	
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"> 
	<button type='submit' name='dis_all'>Display All Cars</button>&nbsp;&nbsp;&nbsp;<button type='submit' name='dis_rent'>Display Non Rented</button>&nbsp;&nbsp;&nbsp;<input type='text' name='numplt' placeholder="Enter Numberplate " ></input>&nbsp;&nbsp;&nbsp;<button type='submit' name="findcar">FindCar</button>&nbsp;&nbsp;&nbsp;<button type='submit' name="Return" formaction="./billing.php" required>ReturnCar</button>
	<button type='submit' name='signout'>Signout</button>		
	</form>
	</div>
	
	
	
	
</div>



<?php

	$conn=OpenCon();
	$c=1; // for display all cars we will hide book button if $c=0;
	$a=display_non_rentedcars($conn);
	if(isset($_SERVER['REQUEST_METHOD']))
	{
		if(isset($_REQUEST['dis_all']))
		{
			$a=display_cars($conn);
			$c=0;
		}
		else if(isset($_REQUEST['findcar']))
		{
			if(isset($_REQUEST['numplt']))
			{
				$num=$_REQUEST['numplt'];
				$a=findcar($conn,$num);
				
			}
			else
			{
				echo "Please Enter Numberplate<br> ";
			}
		}
		else if(isset($_REQUEST['dis_ren']))
		{
			$c=1;
			$a=display_non_rentedcars($conn);
		}
		else if(isset($_REQUEST['signout']))
		{
			session_destroy();
			//header("Location:./login.php");
			echo "<script> location.replace('./login.php'); </script>";
		}
	}
		
	
	if(isset($a))
	{
		?>

<div class="outer" align="center">
<table border=3px>
<thead>
<th><strong>DATA<br><br><br></strong></th>
</thead>
<tbody>
	<?php 
		
	
		foreach($a as $row)
		{
			?>
			<div class="inner">
			<tr> <td align = "center"><img width = '300px' height='200px' src="image/<?php echo $row['image'];  ?>"><br>
			<strong>Car Name:</strong>&nbsp;<?php echo $row["brandname"]; ?>&nbsp; <br>
			<strong>Model Name:</strong>&nbsp;<?php echo $row["modelname"]; ?>&nbsp; <br>
			<strong>Number Plate:</strong>&nbsp;<?php echo $row["numberplate"]; ?><br>
			<strong>Price:</strong>&nbsp;&#8377;&nbsp;<?php echo $row["price"]; ?><br>
			<strong>Description:</strong><br><?php echo $row["description"]; ?><br>
			
			<button  name="<?php echo "update".$i?>" ><a href="./update_car_manager.php?brand=<?php echo $row['brandname'];?>&model=<?php echo $row['modelname'];?>&numplate=<?php echo $row['numberplate'];?>&price=<?php echo $row['price'];?>&desc=<?php echo urlencode($row['description']); // as it will contain blank spcaces?>">update</a></button>
			&emsp;<button name="delete" ><a href="./delete_car_manager.php?numplate=<?php echo $row['numberplate'] ;?>">delete</a></button>
			<br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			<?php if($c==1 && $row['rented']==0){?><button ><a href="./insert_user.php?numplate=<?php echo $row['numberplate'] ;?> ">Book Now</button><?php }?></td>
			
			</tr>
			<br>
			<br>
			<br>
			
			</div>
		<?php
			}
		?>
</tbody>
</table>
</div>
		<?php 

		}
		else 
		{
			echo "No data available";
		}
?>

<?php	
	}
	else
		echo "you got anothorized access!<br>";
	?>

</body>
</html>
