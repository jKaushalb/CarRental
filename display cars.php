<!DOCTYPE html>
<html>
<body>
<?php
    function OpenCon()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "lamp";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        return $conn;
    }
    function CloseCon($conn)
    {
    $conn -> close();
    }
    function Displaycars($conn)
    {
        $sql = "SELECT * FROM `cars` WHERE `rented` != 1";
        $result = mysqli_query($conn,$sql);
		$arr=array();
		?>
		
        <table width="100%" border="1" style="border-collapse:collapse;"><thead><tr><th><strong>Image</strong></th><th><strong>Details</strong></th></thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result))
        {
            if((int)$row["rented"] != 1)
            {
				array_push($arr,$row);
                ?><tr><td align = "center"><img src="image/<?php echo $row['image']; ?>"></td><td><strong>Car Name:</strong>&nbsp;<?php echo $row["brandname"]; ?>&nbsp;<?php echo $row["modelname"]; ?><br><strong>Number Plate:</strong>&nbsp;<?php echo $row["numberplate"]; ?><br><strong>Price:</strong>&nbsp;&#8377;&nbsp;<?php echo $row["price"]; ?><br><strong>Description:</strong><br><?php echo $row["description"]; ?><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type = "submit" value = "Book Now"></td><?php
            }
        }
		echo "<br>".count($arr)."<br>";?>
		<tr><td align = "center"><img src="image/<?php echo $arr[0]['image']; ?>"></td><td><strong>Car Name:</strong>&nbsp;<?php echo $arr[0]["brandname"]; ?>&nbsp;<?php echo $arr[0]["brandname"]; ?>&nbsp;<?php echo $arr[0]["modelname"]; ?>
		</table>
		<?php
    }
?>
<?php
    $conn = OpenCon();
    echo "Connected Successfully!<br>";
    Displaycars($conn);
    CLoseCon($conn);
?>
</body>
</html>