<?php
session_start();
include 'db_connection.php';
include 'gvar.php';
$conn=OpenCon();
$car="";
$user="";
$car_ex="";
?>
<html>
<head>
  	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>Renting</title>
  	<link rel="stylesheet" href="rental.css">
  </head>
</head>
<body>
<?php 
	if(isset($_SESSION['role'])&&($_SESSION['role']==$manager || $_SESSION['role']==$employee ))
	{
		$lno=$_SESSION['licno'];
		$numplate=$_SESSION['numplate'];
		
		//echo $lno." ".$numplate;
		$data=Findusers($conn,$lno);
		$info=Findcars($conn,$numplate);
		$info1=Displaycardata($conn,$numplate);
		
		if(isset($data) &&  isset($info) && isset($info1))
		{
			$user=mysqli_fetch_assoc($data);
			$car=mysqli_fetch_assoc($info);
			$car_ex=mysqli_fetch_array($info1); //fetched as normal array
		}
		else
		{
			echo "user or car does not exist";
		}
		
		?>

    <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="title">
          Booking Page
        </div>
        <div class="form">
           <div class="inputfield">
              <label>Renter Name</label>
              <input type="text" class="input" value="<?php echo $user['clientname'];?>" readonly>&emsp;&emsp;&emsp;&emsp;
              <label>Mobile Number</label>
              <input type="text" class="input" value="<?php echo $user['clientmobile'];?>" readonly>
           </div>
           <div class="inputfield">
             <label>License Number</label>
             <input type="text" class="input"  value="<?php echo $user['clientlicense'];?>" readonly>&emsp;&emsp;&emsp;&emsp;

             <label>Number Plate</label>
              <input type="text" class="input" value="<?php echo $car['numberplate'];?>" readonly>
           </div>
           <div class="inputfield">
              <label>Kms</label>
              <input type="text" class="input" value="<?php echo $car_ex[3];?>"  readonly>&emsp;&emsp;&emsp;&emsp;
              <label>Date of Rental</label>
              <input type="date" id="datePickerId" name='da_rental' class="input" readonly>
           </div>
           <br>
           <div class="inputfield">
             <label>Date of Return</label>
             <input type="date" id="datePickerId2" name='da_return' class="input" required> 
           </div>
           <div class="inputfield">
             <label>Advance</label>
             <input type="number" name="advance" class="input" required>
           </div>
           <div class="inputfield">
             <label>Total</label>
             <input type="number" name='total' class="input" required>
           </div>
          <div class="inputfield terms">
              <label class="check">
                <input type="checkbox" required>
                <span class="checkmark"></span>
              </label>
              <p>Entered data is correct</p>
           </div>
          <div class="inputfield">
            <input type="submit" name='submit' value="Register" class="btn">
          </div>
        </div>

          
	
	
	<?php
		if(isset($_SERVER['REQUEST_METHOD']))
		{
			if(isset($_REQUEST['submit']))
			{
				
				
				
				$flag=Givenrentals($conn,$user['clientname'],$user['clientmobile'],$_SESSION['licno'],$_SESSION['numplate'],$_SESSION['eid'],$car_ex[3],$_REQUEST['da_rental'],$_REQUEST['da_return'],$_REQUEST['advance'],$_REQUEST['total']);
			
				if($flag)
				{
					
					echo "Car with $numplate rented Successfullyt to customer with $lno license no.<br>";
					sleep(3); //after 3 sec redirection will be happen
					if($_SESSION('eid')==1)
					{
						header("Location:manager.php");
					}
					else
					{
						header("Location:employee.php");
					}
					
				}
				else
				{
					echo "Error occured";
				}
			}
		}
	?>
	
	<?php
	
	}
	else 
	{
		echo "you got anauthorized access";
	}
	?>
	
	
	
	
    <script>
        datePickerId2.min = new Date().toISOString().split("T")[0];
        datePickerId.value = new Date().toISOString().split("T")[0];
    </script>
	
	
	
  </body>
</html>