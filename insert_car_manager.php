<?php
session_start();
include 'db_connection.php';
include 'gvar.php';

?>
<html>
<head>
  	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>Insert CarForm</title>
  	<link rel="stylesheet" href="INSERT.css">
  </head>
</head>
<body>
<?php 
	if(isset($_SESSION['role'])&&$_SESSION['role']==1)
	{
		?>
	  <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="title">
          Insert Car data
        </div>
        <div class="form">
           <div class="inputfield">
              <label>Brand</label>
              <input type="text" name='brand' class="input" required>
           </div>
           <div class="inputfield">
              <label>Model Name</label>
              <input type="text" name='model' class="input" required>
           </div>  
            <div class="inputfield">
              <label>Number Plate</label>
              <input type="text" name='numberplate' class="input" required>
           </div>  
           <div class="inputfield">
              <label>Price</label>
              <input type="number" name='price' class="input" required>
           </div>
            <div class="inputfield" id="imagefield">
              <label>Image</label>
              <input type="file" name= "imgpath" class="input" required>
            </div>
            <div class="inputfield">
              <label>Description</label>
              <textarea class="textarea" name='desc'></textarea>
            </div> 
            <div class="inputfield terms">
              <label class="check">
                <input type="checkbox" required>
                <span class="checkmark"></span>
              </label>
              <p>Entered data is correct</p>
            </div> 
            <div class="inputfield">
              <input type="submit" name='register' value="Register" class="btn"></inp>
            </div>
        </div>
    </div>	
	<?php	
	
	}
	else
		echo "you got anothorized access!<br>";
	?>
<div>
<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	if(isset($_POST['register']))
	{
		if(isset($_POST['brand'])&&isset($_POST['price'])&&isset($_POST['model'])&&isset($_POST['numberplate'])&&isset($_POST['imgpath'])&&isset($_POST['desc']))
		{
			$brand=$_POST['brand'];
			$model=$_POST['model'];
			$numplate=$_POST['numberplate'];
			$path=$_POST['imgpath'];
			$desc=$_POST['desc'];
			$price=$_POST['price'];
			
			$conn=OpenCon();
			$flag=Insertcars($conn,$brand,$model,$numplate,$price,$desc,$path);
			if($flag)
			{
				echo "Car with $numplate insertated succesfully.<br>";
			}
			else
			{
				echo "Error Occurred.<br>";
			}
			
			
		}
		else
		{
			echo "Enter all the Details.<br>";
		}
	}
}


?>
	
</div>
</body>
</html>