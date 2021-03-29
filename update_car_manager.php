<?php
session_start();
include 'db_connection.php';
include 'gvar.php';

?>
<html>
<head>
  	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>Update CarForm</title>
  	<link rel="stylesheet" href="INSERT.css"><!change it to update.css>
  </head>
</head>
<body>
<?php 
	if(isset($_SESSION['role'])&&$_SESSION['role']==1)
	{
		?>
	<form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="title">
          Update Car data
        </div>
        <div class="form">
           <div class="inputfield">
              <label>Brand</label>
              <input type="text" name="brand" class="input">
           </div>
           <div class="inputfield">
              <label>Model Name</label>
              <input type="text" name="model" class="input">
           </div>  
            <div class="inputfield">
              <label>Number Plate</label>
              <input type="text" name="numplate" class="input">
           </div>  
           <div class="inputfield">
              <label>Price</label>
              <input type="number" name="price" class="input">
           </div>
           <div class="inputfield">
              <label>Include Image</label>
              <div class="custom_select" id="INimage" >
                <input type="radio" name="inimage" value="checked" id="yes" onclick="changeStatusYes()">
                <label for="yes">YES</label>
                <input type="radio" name="inimage" value="unchacked" id="no" onclick="changeStatusNo()">
                <label for="no">NO</label>
              </div>
            </div>  
            <div class="inputfield" id="imagefield" style="visibility: hidden;">
              <label>Image</label>
              <input type="file" name= "imgpath" class="input" >
            </div>
            <div class="inputfield">
              <label>Description</label>
              <textarea class="textarea" name="desc"></textarea>
            </div> 
            <div class="inputfield terms">
              <label class="check">
                <input type="checkbox" required>
                <span class="checkmark"></span>
              </label>
              <p>Entered data is correct<font color="RED">*</font></p>
            </div> 
            <div class="inputfield">
              <input type="submit" name="update" value="Update" class="btn">
            </div>
        </div>
    </form>
	
	<?php	
	
	}
	else
		echo "you got anothorized access!<br>";
	?>
<div>
<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	if(isset($_POST['update']))
	{
		if(isset($_POST['brand'])||isset($_POST['price'])||isset($_POST['model'])||isset($_POST['numplate'])||isset($_POST['imgpath'])||isset($_POST['desc']))
		{
			$brand=$_POST['brand'];
			$model=$_POST['model'];
			$numplate=$_POST['numplate'];
			$radio=$_POST['inimage'];
			$path="";
			if($radio=='checked')
			{
				$path=$_POST['imgpath'];
			}
			
			$desc=$_POST['desc'];
			$price=$_POST['price'];
			
			$conn=OpenCon();
			
			if($radio=='checked')
			{
			
				$flag=Updatecarsi($conn,$brand,$model,$numplate,$price,$desc,$path);
				if($flag)
				{
					echo "Car with $numplate updated succesfully.<br>";
				}
				else
				{
					echo "Error Occurred.<br>";
				}
					
			}
			else
			{
			
				$flag=Updatecarswi($conn,$brand,$model,$numplate,$price,$desc);
				
				if($flag)
				{
					echo "Car with $numplate updated succesfully.<br>";
				}
				else
				{
					echo "Error Occurred.<br>";
				}
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
  <script type="text/javascript">
    function changeStatusYes()
    {
        document.getElementById("imagefield").style.visibility="visible";
    }
    function changeStatusNo()
    {
        document.getElementById("imagefield").style.visibility="hidden";
    }
  </script>

</body>
</html>