<?php
session_start();
include 'db_connection.php';
include 'gvar.php';
$conn=OpenCon();
$data="";

?>
<html>
<head>
<title>BILLING</title>
</head>
<link rel="stylesheet" href="BILLING.css">
  	<?php include 'NAVBAR.html'; ?>
<body>
<?php 

	if(isset($_SESSION['role'])&&($_SESSION['role']==$manager || $_SESSION['role']==$employee ))
	{
		// we post the numplt here;
		if(isset($_REQUEST['numplt']))
		{
			
			$numplt=$_REQUEST['numplt'];
		
		
			$row=getrentaldata($conn,$numplt);
			if(isset($row))
			{
				$data=mysqli_fetch_array($row);
			
		
		
		?>
		
	<form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="title">
          BILLING Page
        </div>
        <div class="form">
          <div class="inputfield">
            <label>Renter Name</label>
            <input type="text" class="input" value="<?php echo $data[1]; ?>" readonly>&emsp;&emsp;&emsp;&emsp;
            <label>Mobile Number</label>
            <input type="text" class="input" value="replace with php_var_name" readonly>
          </div>
          <div class="inputfield">
           <label>License Number</label>
           <input type="text" class="input" value="replace with php_var_name" readonly>&emsp;&emsp;&emsp;&emsp;
           <label>Number Plate</label>
           <input type="text" class="input" value="replace with php_var_name" readonly>
          </div>
          <div class="inputfield">
            <label>Kms</label>
            <input type="text" class="input" value="replace with php_var_name" readonly>&emsp;&emsp;&emsp;&emsp;
            <label>Date of Rental</label>
            <input type="text" class="input" value="replace with php_var_name" readonly>
          </div>
          <div class="inputfield">
            <label>Advance</label>
            <input type="text" class="input" value="replace with php_var_name" readonly>&emsp;&emsp;&emsp;&emsp;
            <label>Date of Return</label>
            <input type="text" class="input" value="replace with php_var_name" readonly>
          </div>
          <div class="inputfield">
           <label>Total</label>
           <input type="text" class="input" value="replace with php_var_name" readonly>&emsp;&emsp;&emsp;&emsp;
           <label>Return Date</label>
           <input type="date" id="datePickerId" class="input" readonly>
          </div>
          <hr style="border: dotted;" color="white"></hr>
          <br>
          <div class="inputfield">
            <label>Return Kms</label>
            <input type="number" class="input">&emsp;&emsp;&emsp;&emsp;
            <label>Star Rating</label>
            <input type="float" class="input">
          </div>
          <div class="inputfield">
            <label>Damage</label>
            <input type="number" class="input">
          </div>
          <div class="inputfield">
            <label>New Total</label>
            <input type="number" class="input">
          </div>
          <div class="inputfield">
            <input type="submit" value="Register" class="btn">
          </div>
        </div>
    </form>
    <script>
        datePickerId.value = new Date().toISOString().split("T")[0];
    </script>
	
	<?php 
	
		}
		else
		{
			echo "No data with $numplt nuberplate found<br>";
			
		}
	
	}
}
	else {
		echo "You got unauthorized acess.<br>";
	}
	?>
	
</body>
</html>
	