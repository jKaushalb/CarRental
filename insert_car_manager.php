<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start();
            include "db_connection.php";
            include 'gvar.php';
            $Err = "";
        ?>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="INSERT.css">
        <link rel="stylesheet" type="text/css" href="MANAGER.css">
        <title>MANAGER</title>
    </head>
    <body>
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $numplate = $_POST['numberplate'];
				if(!preg_match ("/^[A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4}$/", $numplate))
				{
					echo "<script>alert('Please enter a valid number plate (Ex: GJ06KM6786)');</script>";
				}
				else
				{
					if(isset($_POST['register']))
					{
						if(isset($_POST['brand'])&&isset($_POST['price'])&&isset($_POST['model'])&&isset($_POST['numberplate'])&&isset($_FILES['image']['name'])&&isset($_POST['desc']))
						{
							$brand=$_POST['brand'];
							$model=$_POST['model'];
							$numplate=$_POST['numberplate'];
							//$path=$_POST['image'];
							$desc=$_POST['desc'];
							$price=$_POST['price'];
							$kms=$_POST['kms'];
							$mileage=$_POST['mileage'];
							$extensions = array("jpeg","jpg","png");
							$img = $_FILES['image']['name'];
							$conn=OpenCon();
							if(in_array(strtolower(pathinfo("D:\\xampp\\htdocs\\CarRental\\image\\$img",PATHINFO_EXTENSION)),$extensions) === true)
							{
								if(file_exists("C:\\xampp\\htdocs\\CarRental\\image\\$img") == false)
								{
									$flag=Insertcars($conn,$brand,$model,$numplate,$price,$desc,$_FILES['image']['name']);
									$flag1=Insertcardata($conn,$numplate,$brand." ".$model,$mileage,$kms);
									if($flag && $flag1)
									{
										$Err = "Car with $numplate inserted successfully.<br>";
										move_uploaded_file($_FILES['image']['tmp_name'],"D:\\xampp\\htdocs\\CarRental\\image\\$img");
									}
									else
									{
										$Err = "The numberplate already exists";
									}
								}
								else
									echo "<script>alert('A file with the same name already exists, please rename the file you are trying to upload.');</script>";
							}
							else
								echo "<script>alert('Upload a file with an image extension only.');</script>";
						}
						else
						{
							$Err = "Enter all the Details.<br>";
						}
					}
				}
            }
        ?>
        <?php
        	if(isset($_SESSION['role'])&&$_SESSION['role']==$manager)
        	{
        		?>
                <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" >
                    <div class="title">Insert Car data</div>
                    <div class="form">
                        <div class="inputfield">
                            <label>Brand</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <input type="text" name='brand' class="input" value="<?php if(isset($_REQUEST['brand'])){ echo $_REQUEST['brand'];}?>" required>&emsp;&emsp;&emsp;
                            <label>Model Name</label>&emsp;&emsp;
                            <input type="text" name='model' class="input" value="<?php if(isset($_REQUEST['model'])){ echo $_REQUEST['model'];}?>" required>
                        </div>
                        <div class="inputfield">
                            <label>Number Plate</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <input type="text" name='numberplate' class="input" value="<?php if(isset($_REQUEST['numberplate'])){ echo $_REQUEST['numberplate'];}?>" required>&emsp;&emsp;&emsp;
                            <label>Price</label>&emsp;&emsp;
                            <input type="number" name='price' class="input" value="<?php if(isset($_REQUEST['price'])){ echo $_REQUEST['price'];}?>" required>
                        </div>
                        <div class="inputfield" id="imagefield">
                            <label>Image</label>
                            <input type="file" name="image" id="image" class="input" required>
                        </div>
                        <div class="inputfield">
                            <label>Description</label>
                            <input type="text" name='desc' class="input" value="<?php if(isset($_REQUEST['desc'])){ echo $_REQUEST['desc'];}?>">
                        </div>
                        <div class="inputfield">
                            <label>Kms</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <input type="number" name='kms' class="input" value="<?php if(isset($_REQUEST['kms'])){ echo $_REQUEST['kms'];}?>" required>&emsp;&emsp;&emsp;
                            <label>Mileage</label>&emsp;&emsp;
                            <input type="number" name='mileage' class="input" value="<?php if(isset($_REQUEST['mileage'])){ echo $_REQUEST['mileage'];}?>" required>
                        </div>
                        <div class="inputfield">
                            <input type="submit" name='register' value="Register" class="btn"></inp>
                        </div>
                    </div>
                    <span style="color:white;">Message: <?php echo $Err; ?></span>
                </form>
                <header>
                    <nav>
                        <div class="logo">RENT-A-CAR</div>
                        <label for="btn" class="icon">
                            <span class="fa fa-bars"></span>
                        </label>
                        <input class="rad" type="checkbox" id="btn">
                        <ul>
                            <li><a href="./manager.php">HOME</a></li>
                            <li>
                                <label for="btn-1" class="show">EMPLOYEE +</label>
                                <a href="#">EMPLOYEE</a>
                                <input class="rad" type="checkbox" id="btn-1">
                                <ul>
                                    <li><a href="./insert_manager.php">INSERT EMPLOYEE</a></li>
                                    <li><a href="./delete_manager.php">DELETE EMPLOYEE</a></li>
                                    <li><a href="./promote_manager.php">PROMOTE EMPLOYEE</a></li>
                                    <li><a href="./update_manager.php">UPDATE PASSWORD</a></li>
                                </ul>
                            </li>
                            <li>
                                <label for="btn-2" class="show">CAR +</label>
                                <a href="#">CAR</a>
                                <input class="rad" type="checkbox" id="btn-2">
                                <ul>
                                    <li><a href="./insert_car_manager.php">INSERT CAR</a></li>
                                    <li><a href="./update_car_manager.php">UPDATE CAR</a></li>
                                    <li><a href="./delete_car_manager.php">DELETE CAR</a></li>
                                </ul>
                            </li>&emsp;&emsp;&emsp;
                        </ul>
                    </nav>
                </header>
        <?php
            }
            else
                echo "You got unauthorized access!<br>";
        ?>
    </body>
</html>
