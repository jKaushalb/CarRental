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
<style>
.outer
{
	background: #073b4c;
	text-align: center;
	border-radius: 25px;

}
.inner
{
	background: #FFFFFF;
	border-solid : 5px;
	padding : 10px;
}
</style>
</head>

<body>
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
		<tr> <td align = "center"><img src="image/<?php echo $row['image']; ?>"><br>
		<strong>Car Name:</strong>&nbsp;<?php echo $row["brandname"]; ?>&nbsp; <br>
		<strong>Model Name:</strong>&nbsp;<?php echo $row["modelname"]; ?>&nbsp; <br>
		<strong>Number Plate:</strong>&nbsp;<?php echo $row["numberplate"]; ?><br>
		<strong>Price:</strong>&nbsp;&#8377;&nbsp;<?php echo $row["price"]; ?><br>
		<strong>Description:</strong><br><?php echo $row["description"]; ?><br>
		
		<button  name="<?php echo "update".$i?>" ><a href="./update_car_manager.php?brand=<?php echo $row['brandname'];?>&model=<?php echo $row['modelname'];?>&numplate=<?php echo $row['numberplate'];?>&price=<?php echo $row['price'];?>&desc=<?php echo urlencode($row['description']); // as it will contain blank spcaces?>">update</a></button><br><br>
		<br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type = "submit"  value = "Book Now"></td>
		
		</tr>
		<tr><br></tr>
		
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



</body>
</html>