<?php
session_start();
include 'db_connection.php';
include 'gvar.php';

?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Car</title>

	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
		*
		{
		  margin: 0;
		  padding: 0;
		  box-sizing: border-box;
		  font-family: 'Poppins' ,sans-serif;
		}
		body
		{
		  background: #ee6c4d;
		  padding: 0 10px;
		}
		.box 
		{
		  max-width: 500px;
		  width: 100%;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%,-50%);
		  background: #073b4c;
		  border-radius: 25px;
		  margin: 20px auto;
		  box-shadow: 1px 1px 2px rgba(0,0,0,0.125);
		  padding: 30px;
		}

		.box .title
		{
		  font-size: 24px;
		  font-weight: 700;
		  margin-bottom: 25px;
		  color: #ee6c4d;
		  text-transform: uppercase;
		  text-align: center;
		}

		.box .form
		{
		  width: 100%;
		}
		.box .form .inputfield
		{
		  margin-bottom: 15px;
		  display: flex;
		  align-items: center;
		}

		.box .form .inputfield label
		{
		  width: 200px;
		  color: #fff;
		  margin-right: 10px;
		  font-size: 18px;
		}

		.box .form .inputfield .input,
		.box .form .inputfield .textarea
		{
		  width: 100%;
		  outline: none;
		  border: 1px solid #d5dbd9;
		  font-size: 15px;
		  padding: 8px 10px;
		  border-radius: 3px;
		  transition: all 0.3s ease;
		}
		.box .form .inputfield .btn
		{
		  border: 0;
		  background: none;
		  display: block;
		  margin: 20px auto;
		  text-align: center;
		  border: 2px solid #ef476f;
		  padding: 14px 40px;
		  outline: none;
		  color: white;
		  border-radius: 24px;
		  transition: 0.25px;
		  cursor: pointer;
		}
		.box .form .inputfield .btn:hover
		{
		  background: #e63946;
		}

		.box .form .inputfield:last-child
		{
		  margin-bottom: 0;
		}
	</style>
</head>
<body>
	
<?php 
	if(isset($_SESSION['role'])&&$_SESSION['role']==1)
	{
		?>
	  <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	  <div class="title">
          DELETE
        </div>
        <div class="form">
            <div class="inputfield">
              <label>Enter Number Plate</label>
              <input type="text" name='numplate' value="<?php if(isset($_REQUEST['numplate'])){ echo $_REQUEST['numplate'];} ?>" class="input" required>
           </div>  
            <div class="inputfield">
              <input type="submit"  name='delete' value="Delete" class="btn">
            </div>
        </div>
		</form>
	<?php 
	
	
	}
	
	else
	{
		 echo "you got anothorized access!<br>";
	}
	?>
	
	<?php
	
	if(isset($_REQUEST['delete']))
	{
		$numplt=$_REQUEST['numplate'];
		$conn=OpenCon();
		$flag=DeleteCars($conn,$numplt);
		if($flag)
			{
				echo "Car with $numplt deleted succesfully.<br>";
			}
			else
			{
				echo "Error Occurred.<br>";
			}
	}
	
	?>
</body>
</html>  