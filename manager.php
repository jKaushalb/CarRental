<?php
session_start();
include 'db_connection.php';
include 'gvar.php';

?>
<?php

	

	function display_cars($conn)
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
			echo "No data found";
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
	if(isset($_SESSION['role'])&&$_SESSION['role']==1)
	{
		?>
	<button ><a href="./insert_manager.php">Insert Employee</a></button>
	<button ><a href="./delete_manager.php">Delete Employee</a></button>
	<button ><a href="./update_manager.php">Update Password</a></button>
	<button ><a href="./promote_manager.php">Promote Employee</a></button>
	<button ><a href="./insert_car_manager.php">Insert Car</a></button>
	<button ><a href="./update_car_manager.php">Update Car</a></button>
	<button ><a href="./delete_car_manager.php">Delete Car</a></button>
	
	
	
	
</div>



<?php
	$conn=OpenCon();
	$a=display_cars($conn);
	

	if(count($a))
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
			<br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<button ><a href="./insert_user.php?numplate=<?php echo $row['numberplate'] ;?> ">Book Now</button></td>
			
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
			echo "no data available";
		}
?>

<?php	
	}
	else
		echo "you got anothorized access!<br>";
	?>

</body>
</html>
