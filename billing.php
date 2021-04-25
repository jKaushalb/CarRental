<?php
session_start();
include 'db_connection.php';
include 'gvar.php';
$conn=OpenCon();
$data="";


function findprice($conn,$numplt)
{
	
		$sql = "SELECT `price` FROM `cars` WHERE   `numberplate` = '$numplt'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
			return mysqli_fetch_array($result)[0];
			
            
        }
        else
        {
            
            echo mysqli_error($conn);
			return null;
        }
}


?>
<html>
<head>
<title>BILLING</title>
</head>
<!<link rel="stylesheet" href="BILLING.css">
  	<?php // include 'NAVBAR.html'; ?>
<body>
<?php 

	if(isset($_SESSION['role'])&&($_SESSION['role']==$manager || $_SESSION['role']==$employee ))
	{
		// we post the numplt here;
		if(isset($_REQUEST['numplt']))
		{
			
			$numplt=$_REQUEST['numplt'];
			$price=findprice($conn,$numplt);
			if(isset($price))
			{
				echo "<script>var price = ".$price." </script>";
			}
		
			$row=getrentaldata($conn,$numplt);
			if(isset($row))
			{
				$data=mysqli_fetch_array($row);
			
		
		
		?>
		
	<form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?numplt=".$_REQUEST['numplt']);?>" method="post">
        <div class="title">
          BILLING Page
        </div>
        <div class="form">
          <div class="inputfield">
            <label>Renter Name</label>
            <input type="text" class="input" value="<?php echo $data[1]; ?>" readonly>&emsp;&emsp;&emsp;&emsp;
            <label>Mobile Number</label>
            <input type="text" class="input" value="<?php echo $data[2]; ?>"readonly>
          </div>
          <div class="inputfield">
           <label>License Number</label>
           <input type="text" class="input" value="<?php echo $data[3]; ?>" readonly>&emsp;&emsp;&emsp;&emsp;
           <label>Number Plate</label>
           <input type="text" class="input" value="<?php echo $data[4]; ?>" readonly>
          </div>
          <div class="inputfield">
            <label>Kms</label>
            <input type="text" class="input" value="<?php echo $data[6]; ?>" readonly>&emsp;&emsp;&emsp;&emsp;
            <label>Date of Rental</label>
            <input type="text" class="input" id='date1' value="<?php echo $data[7]; ?>" readonly>
          </div>
          <div class="inputfield">
            <label>Advance</label>
            <input type="text" class="input" id ="advance" value="<?php echo $data[9]; ?>" readonly>&emsp;&emsp;&emsp;&emsp;
            <label>Date of Return</label>
            <input type="text" class="input" id='date2' value="<?php echo $data[8]; ?>" readonly>
          </div>
          <div class="inputfield">
           <label>Total</label>
           <input type="text" class="input" value="<?php echo $data[10]; ?>" readonly>&emsp;&emsp;&emsp;&emsp;
           <label>Return Date</label>
           <input type="date" id="datePickerId" name="return_date" class="input" readonly>
          </div>
          <hr style="border: dotted;" color="white"></hr>
          <br>
          <div class="inputfield">
            <label>Return Kms</label>
            <input type="number" name="return_km" class="input">&emsp;&emsp;&emsp;&emsp;
            <label>Star Rating</label>
            <input type="float" name="star" class="input">
          </div>
          <div class="inputfield">
            <label>Damage</label>
            <input type="number" name="damage" id='damage' class="input">
          </div>
          <div class="inputfield">
            <label>New Total</label>
            <input type="number" name="newtotal" id='newTotal'class="input">
          </div>
          <div class="inputfield">
            <input type="submit" name='BILL' value="Bill it!" class="btn">
          </div>
        </div>
    </form>
	
    <script type="text/javascript" >
        datePickerId.value = new Date().toISOString().split("T")[0];
		
		const damage =document.getElementById('damage');
		const newtotal=document.getElementById('newTotal');
		const advance=document.getElementById('advance');
		console.log(advance);
		damage.addEventListener('input' ,function()
		{
			
			const date1= new Date(document.getElementById('date1').value); // actual date of renting
			const date3= new Date(document.getElementById('datePickerId').value);// actual date of return;
			const date2= new Date(document.getElementById('date2').value);//proposed date of return
			const d3d2 =(date3 - date2); // it gives time in mliliseconds
			console.log(d3d2);
			const Total=0;
			
			if(d3d2>0)
			{
				var extra= Math.ceil(d3d2 / (1000 * 60 * 60 * 24)); 
				Total= 100 * extra;
				alert(" Extra days "+ extra + " Extra Charge "+Total);
				
			}
			
			
			const d3d1= Math.abs(date3 - date1);
			var diffDays = Math.ceil(d3d1 / (1000 * 60 * 60 * 24)); 
			if(diffDays==0)
			{
				diffDays=1;
			}
			console.log(diffDays);
			
			newtotal.value = (diffDays * price) + this.value + Total ;// -advance.value ;
			
			
			
			
		});
		
		
    </script> 
	
	<?php 
		
		if(isset($_SERVER['REQUEST_METHOD']))
		{
			
			
				if(isset($_REQUEST['BILL']))
				{
					
					$km=$_REQUEST['return_km'];
					$rdat=$_REQUEST['return_date'];
					$star=$_REQUEST['star'];
					$damage=$_REQUEST['damage'];
					$newtotal=$_REQUEST['newtotal'];
					//echo "$km $rdat";
					$row=getrentaldata($conn,$numplt);
					$d=mysqli_fetch_assoc($row);
					
					//$flag=Bill($conn,$rentername,$rentermobile,$renterlicense,$numberplate,$returnempid,$rentalkms,$returnkms,$dorental,$doreturn,$doreturnact,$advance,$total,$damage,$finaltotal,$billno,$rentalempid)
					$flag=Bill($conn,$d['rentername'],$d['rentermobile'],$d['renterlicense'],$d['numberplate'],$d['empid'],$_SESSION['eid'],$d['kms'],$km,$d['dorental'],$rdat,$d['doreturn'],$d['advance'],$d['total'],$damage,$newtotal);
					
					echo (int)$flag;
					if($flag)
					{
						echo "Bill submitted successfully".$d['numberplate']."<br>";
						$flag1=Deleterentals($conn,$d['numberplate']);
						$flag2=Updatecardata($conn,$numplt,$km,$star);
						if($flag2)
						{
							echo "ratings changed ";
						}
						else
						{
							echo "error occured in updating star rating";
						}
						if($flag1)
						{
							echo "Car". $data[4]." with numberplate is now available <br>";
						}
						else
						{
							echo "Data couldnot be updated try again ";
						}
					}
					else
					{
							echo "Error occured ";
					}
				
				}
				else
				{
					
				}
			}
		
		
		
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
	