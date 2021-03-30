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
              <input type="text" name="brand" value="<?php if(isset($_REQUEST['brand'])){ echo $_REQUEST['brand'];}?>" class="input">
           </div>
           <div class="inputfield">
              <label>Model Name</label>
              <input type="text" name="model" value="<?php if(isset($_REQUEST['model'])){ echo $_REQUEST['model'];}?>"class="input">
           </div>  
            <div class="inputfield">
              <label>Number Plate</label>
              <input type="text" name="numplate" value="<?php if(isset($_REQUEST['numplate'])){ echo $_REQUEST['numplate'];}?>" class="input">
           </div>  
           <div class="inputfield">
              <label>Price</label>
              <input type="number" name="price" value="<?php if(isset($_REQUEST['price'])){ echo $_REQUEST['price'];}?>"class="input">
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
              <textarea class="textarea" name="desc" ><?php if(isset($_REQUEST['desc'])){ echo $_REQUEST['desc'];}?></textarea>
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
	
	
<div>
<?php

if(isset($_SERVER['REQUEST_METHOD']))
{
	
	if(isset($_REQUEST['update']))
	{
		if(isset($_REQUEST['brand'])||isset($_REQUEST['price'])||isset($_REQUEST['model'])||isset($_REQUEST['numplate'])||isset($_REQUEST['imgpath'])||isset($_REQUEST['desc']))
		{
			$brand=$_REQUEST['brand'];
			$model=$_REQUEST['model'];
			$numplate=$_REQUEST['numplate'];
			$radio=$_REQUEST['inimage'];
			$path="";
			if($radio=='checked')
			{
				$path=$_REQUEST['imgpath'];
			}
			
			$desc=$_REQUEST['desc'];
			$price=$_REQUEST['price'];
			
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

<?php	
	
	}
	else
		echo "you got anothorized access!<br>";
	?>

</body>
</html>